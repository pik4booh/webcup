<?php
require 'flight/Flight.php';
require 'flight/autoload.php';
require 'module/fonction.php';
require 'module/connect.php';


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
  login($mail,$mdp);
});

Flight::route('/signup', function () {
  $data = Flight::request()->data;
  $fn = $data['fn'];
  $ln = $data['ln'];
  $gender = $data['gender'];
  $mail = $data['mail'];
  $mdp = $data['mdp'];
  $nickname = $data['nickname'];
  singin($fn,$ln,$gender,$mail,$mdp,$nickname);
});

Flight::route('/shuffle-superpowers', function () {
  $data = Flight::request()->data;
  shuffleItem();
});

Flight::route('/choose-superpowers', function () {
  $data = Flight::request()->data;
  $id = $data['id'];
  $c1 = $data['c1'];
  $c2 = $data['c2'];
  $c3 = $data['c3'];
  singin($fn,$ln,$gender,$mail,$mdp,$nickname);
});

Flight::route('/superpower-list/@id/@minidpage', function ($id,$minidpage) {
  pouvoirsinsteressants($id,$minidpage);
});

Flight::route('/my-superpower-list', function ($id,$minidpage) {
  mespouvoirs($id);
});

Flight::route('/transaction-history', function ($id) {
  historique($id);
});

Flight::route('/start-transaction', function () {
  $data = Flight::request()->data;
  $id=$data['id'];
  $obj=$data['obj'];
  create($id,$obj);
});

Flight::route('/validate-transaction', function ($idT,$id,$obj) {
  valide($idT,$id,$obj);
});

Flight::route('/negate-transaction', function ($idT,$id,$obj) {
  negate($idT,$id,$obj);
});

Flight::route('/pending-transaction', function ($id) {
  nonvalide($id);
});

Flight::route('/chat/@id/@id2',function ($id,$id2){
  getMess($id,$id2);
});

Flight::route('/chat/send-message',function (){
  $data = Flight::request()->data;
  $id=$data['id'];
  $id2=$data['id2'];
  $mess=$data['message'];
  envoieMess($id,$mess,$id2);
});

Flight::route('/create-superpower',function (){
  $data = Flight::request()->data;
  $nom=$data['id'];
  $damage=$data['id2'];
  $accuracy=$data['message'];
  $mana=$data['mana'];
  $effect=$data['effect'];
  $element=$data['element'];
  $type=$data['type'];
  $rarity=$data['rarity'];
  creerPouvoir($nom,$damage,$accuracy,$mana,$effect,$element,$type,$rarity);
});
// End Data Game Routes


Flight::map('error', function(Exception $ex){
  echo $ex->getMessage();
});

Flight::start();