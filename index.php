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


Flight::route('/', function () {
    echo 'huhu world!';
});
Flight::route('/login', function () {
    $data = Flight::request()->query;

    $mail = $data['mail'];
    $mdp = $data['mdp'];
    login($mail,$mdp);
});
Flight::route('/insert/@test', function ($test) {
    inserttest($test);
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
});
Flight::route('/shuffle', function () {
    $data = Flight::request()->query;
    shuffleItem();
});
Flight::route('/choices', function () {
    $data = Flight::request()->query;
    $id = $data['id'];
    $c1 = $data['c1'];
    $c2 = $data['c2'];
    $c3 = $data['c3'];
    addPower($id,$c1,$c2,$c3);
});
Flight::route('/dispo/@id/@minidpage', function ($id,$minidpage) {
    pouvoirsinsteressants($id,$minidpage);
});
Flight::route('/mine/@id', function ($id) {
    mespouvoirs($id);
});
Flight::route('/historique/@id', function ($id) {
    historique($id);
});
Flight::route('/startTransaction', function () {
    $data = Flight::request()->query;
    $id=$data['id'];
    $obj=$data['obj'];
    create($id,$obj);
});
Flight::route('/validate/@idT/@id/@obj', function ($idT,$id,$obj) {
    valide($idT,$id,$obj);
});
Flight::route('/negate/@idT/@id/@obj', function ($idT,$id,$obj) {
    negate($idT,$id,$obj);
});
Flight::route('/non_valide_transaction/@id', function ($id) {
    nonvalide($id);
});
Flight::route('/getChat/@id/@id2',function ($id,$id2){
    getMess($id,$id2);
});
Flight::route('/setChat',function (){
    $data = Flight::request()->query;
    $id=$data['id'];
    $id2=$data['id2'];
    $mess=$data['message'];
    envoieMess($id,$mess,$id2);
});
Flight::route('/historique/@id',function ($id){
    historique($id);
});

Flight::route('/createPower',function (){
    $data = Flight::request()->query;
    $nom=$data['id'];
    $damage=$data['id2'];
    $accuracy=$data['message'];
    $mana=$data['mana'];
    $effect=$data['ef$effect'];
    $element=$data['element'];
    $type=$data['type'];
    $rarity=$data['rarity'];
    creerPouvoir($nom,$damage,$accuracy,$mana,$effect,$element,$type,$rarity);
});

Flight::start();
