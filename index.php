<?php
require 'flight/Flight.php';
require 'flight/autoload.php';
require 'module/fonction.php';
require 'module/connect.php';
require 'Function API/function.php';


// CORS Policy configuration
Flight::before('start', function(){
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        
        exit(0);
    }
});
// End CORS Policy configuration


// Render Routes
Flight::route('/', function () {
  Flight::render('home.php');
});

Flight::route('/creation', function () {
    Flight::render('creation.php');
  });

Flight::route('/login-page', function () {
  Flight::render('power_switch_login.php');
});

Flight::route('/signup-page', function () {
  Flight::render('power_switch_signup.php');
});
// End Render Routes


// Data Game Routes
Flight::route('/login', function () {
  $data = Flight::request()->data;

  $mail = $data['mail'];
  $mdp = $data['mdp'];
  $login_data = login($mail,$mdp);
  session_start();
  $_SESSION['user_id'] = $login_data['power_switch_user_id'];
  Flight::redirect('/creation');
});

Flight::route('/signup', function () {
  $data = Flight::request()->query;
  $fn = $data['fn'];
  $ln = $data['ln'];
  $gender = $data['gender'];
  $mail = $data['mail'];
  $mdp = $data['mdp'];
  $nickname = $data['nickname'];
  singin($fn,$ln,$gender,$mail,$mdp,$nickname);
  Flight::redirect('/');
});

Flight::route('/shuffle-superpowers', function () {
  $data = Flight::request()->query;
  shuffleItem();
});

Flight::route('/choose-superpowers', function () {
  $data = Flight::request()->query;
  $id = $data['id'];
  $c1 = $data['c1'];
  $c2 = $data['c2'];
  $c3 = $data['c3'];
  singin($fn,$ln,$gender,$mail,$mdp,$nickname);
});

Flight::route('/superpower-list/@id/@minidpage', function ($id,$minidpage) {
  pouvoirsinsteressants($id,$minidpage);
});

Flight::route('/my-superpower-list/@id/@minidpage', function ($id,$minidpage) {
  mespouvoirs($id,$minidpage);
});

Flight::route('/transaction-history/@id', function ($id) {
  historique($id);
});

Flight::route('/start-transaction', function () {
  $data = Flight::request()->query;
  $id=$data['id'];
  $obj=$data['obj'];
  create($id,$obj);
});

Flight::route('/validate-transaction/@idT/@id/@obj', function ($idT,$id,$obj) {
  valide($idT,$id,$obj);
});

Flight::route('/negate-transaction/@idT/@id/@obj', function ($idT,$id,$obj) {
  negate($idT,$id,$obj);
});

Flight::route('/pending-transaction/@', function ($id) {
  nonvalide($id);
});

Flight::route('/chat/@id/@id2',function ($id,$id2){
  getMess($id,$id2);
});

Flight::route('/chat/send-message',function (){
  $data = Flight::request()->query;
  $id=$data['id'];
  $id2=$data['id2'];
  $mess=$data['message'];
  envoieMess($id,$mess,$id2);
});

Flight::route('/create-superpower',function (){
  $data = Flight::request()->data;
  $prompt = $data['superpower-prompt'];
  $superpower_characteristics = generatePouvoire($prompt);

  // var_dump($superpower_characteristics);

  $nom=preg_replace('/^\s+|\s+$/u', '', $superpower_characteristics[0]);
  $damage=preg_replace('/^\s+|\s+$/u', '', $superpower_characteristics[1]);
  $accuracy=preg_replace('/^\s+|\s+$/u', '', $superpower_characteristics[2]);
  $mana=preg_replace('/^\s+|\s+$/u', '', $superpower_characteristics[3]);
  $effect=preg_replace('/^\s+|\s+$/u', '', $superpower_characteristics[4]);
  $element=preg_replace('/^\s+|\s+$/u', '', $superpower_characteristics[5]);
  var_dump($element);
  $type=preg_replace('/^\s+|\s+$/u', '', $superpower_characteristics[6]);
  $rarity=$superpower_characteristics[7];

  session_start();
  creerPouvoir($nom,$damage,$accuracy,$mana,$effect,$element,$type,$rarity);
  $last_superpower = get_last_superpower();
  $user_id = $_SESSION['user_id'];
  set_user_superpower($user_id, $last_superpower["max(power_switch_superpower_id)"]);
  Flight::redirect('/');
});

Flight::route('GET /genders', function (){
  $genders = get_genders();
  Flight::json($genders);
});
// End Data Game Routes


Flight::map('error', function($ex) {
  if ($ex instanceof Exception || $ex instanceof Error) {
      echo $ex->getMessage();
  } else {
      echo "An error occurred.";
  }
});

Flight::start();