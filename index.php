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
    // echo 'huhu world!';
});
Flight::route('/login', function () {
    $data = Flight::request()->data;

    $mail = $data['mail'];
    $mdp = $data['mdp'];
    login($mail,$mdp);
});
Flight::route('/insert/@test', function ($test) {
    inserttest($test);
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
Flight::route('/shuffle', function () {
    $data = Flight::request()->data;
    shuffleItem();
});
Flight::route('/choices', function () {
    $data = Flight::request()->data;
    $id = $data['id'];
    $c1 = $data['c1'];
    $c2 = $data['c2'];
    $c3 = $data['c3'];
    singin($fn,$ln,$gender,$mail,$mdp,$nickname);
});
Flight::route('/dispo/@id/@minidpage', function ($id,$minidpage) {
    pouvoirsinsteressants($id,$minidpage);
});
Flight::route('/other', function ($id,$minidpage) {
    mespouvoirs($id);
});
Flight::route('/historique', function ($id) {
    historique($id);
});
Flight::route('/startTransaction', function () {
    $data = Flight::request()->data;
    $id=$data['id'];
    $obj=$data['obj'];
    create($id,$obj);
});
Flight::route('/validate', function ($idT,$id,$obj) {
    valide($idT,$id,$obj);
});
Flight::route('/negate', function ($idT,$id,$obj) {
    negate($idT,$id,$obj);
});
Flight::route('/non_valide_transaction', function ($id) {
    nonvalide($id);
});
Flight::route('/getChat/@id/@id2',function ($id,$id2){
    getMess($id,$id2);
});
Flight::route('/setChat',function (){
    $data = Flight::request()->data;
    $id=$data['id'];
    $id2=$data['id2'];
    $mess=$data['message'];
    envoieMess($id,$mess,$id2);
});
Flight::route('/historique/@id',function ($id){
    historique($id);
});

Flight::route('/createPower',function (){
    $data = Flight::request()->data;
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
Flight::map('error', function(Exception $ex){
    echo $ex->getMessage();
});

Flight::start();

?>



<!doctype html>
<html class="h-100" lang="en">

  <head>
      <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
  <meta name="description" content="A well made and handcrafted Bootstrap 5 template">
  <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
  <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
  <meta name="author" content="Holger Koenemann">
  <meta name="generator" content="Eleventy v2.0.0">
  <meta name="HandheldFriendly" content="true">
  <title>Power Switch</title>
  <link rel="stylesheet" href="assets/css/theme.min.css">

   <style>

/* inter-300 - latin */
@font-face {
  font-family: 'Inter';
  font-style: normal;
  font-weight: 300;
  font-display: swap;
  src: local(''),
       url('fonts/inter-v12-latin-300.woff2') format('woff2'), /* Chrome 26+, Opera 23+, Firefox 39+ */
       url('fonts/inter-v12-latin-300.woff') format('woff'); /* Chrome 6+, Firefox 3.6+, IE 9+, Safari 5.1+ */
}

/* inter-400 - latin */
@font-face {
  font-family: 'Inter';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: local(''),
       url('fonts/inter-v12-latin-regular.woff2') format('woff2'), /* Chrome 26+, Opera 23+, Firefox 39+ */
       url('fonts/inter-v12-latin-regular.woff') format('woff'); /* Chrome 6+, Firefox 3.6+, IE 9+, Safari 5.1+ */
}

@font-face {
  font-family: 'Inter';
  font-style: normal;
  font-weight: 500;
  font-display: swap;
  src: local(''),
       url('fonts/inter-v12-latin-500.woff2') format('woff2'), /* Chrome 26+, Opera 23+, Firefox 39+ */
       url('fonts/inter-v12-latin-500.woff') format('woff'); /* Chrome 6+, Firefox 3.6+, IE 9+, Safari 5.1+ */
}
@font-face {
  font-family: 'Inter';
  font-style: normal;
  font-weight: 700;
  font-display: swap;
  src: local(''),
       url('fonts/inter-v12-latin-700.woff2') format('woff2'), /* Chrome 26+, Opera 23+, Firefox 39+ */
       url('fonts/inter-v12-latin-700.woff') format('woff'); /* Chrome 6+, Firefox 3.6+, IE 9+, Safari 5.1+ */
}

</style>


  </head>

  <body class="bg-black text-white mt-0" data-bs-spy="scroll" data-bs-target="#navScroll">

    <nav id="navScroll" class="navbar navbar-dark bg-black fixed-top px-vw-5" tabindex="0">
  <div class="container">
    <a class="navbar-brand pe-md-4 fs-4 col-12 col-md-auto text-center" href="index.html">
        <img src="assets/logo/logo-blanc.png" alt="" width="147.6" height="71.8">
    </a>

      <ul class="navbar-nav mx-auto mb-2 mb-lg-0 list-group list-group-horizontal">
      <li class="nav-item">
  <a class="nav-link fs-5" href="index.html" aria-label="Homepage">
    Accueil
  </a>
</li>
<li class="nav-item">
  <a class="nav-link fs-5" href="content.html" aria-label="A sample content page">
    Tutoriel
  </a>
</li>
<li class="nav-item">
  <a class="nav-link fs-5" href="system.html" aria-label="A system message page">
    Troquer
  </a>
</li>

    </ul>
      <a href="front/inscription" aria-label="Download this template" class="btn btn-light">
        <small>S'inscrire</small>
      </a>
</div>
</nav>

    <main>
      <div class="w-100 overflow-hidden position-relative bg-black text-white" data-aos="fade">
        <div class="position-absolute w-100 h-100 gradient-container" id="gradient-container">
          <div class="gradient-animation"></div>
        </div>
        <div class="container py-vh-4 position-relative mt-5 px-vw-5 text-center">
          <div class="row d-flex align-items-center justify-content-center py-vh-5">
            <div class="col-12 col-xl-10">
              
              <span class="h5 text-secondary fw-lighter">Bienvenue</span>
              <h1 class="display-huge mt-3 mb-3 lh-1">Echangez vos Super Pouvoirs</h1>
            </div>
            <div class="col-12 col-xl-8">
              <p class="lead text-secondary">Épicez votre Destinée avec de Nouvelles Capacités!</p>
            </div>
            <div class="col-12 text-center">
              <a href="#" class="btn btn-xl btn-light">Troquer
              </a>
            </div>
          </div>
        </div>
      </div>
      
</svg>
</a>
    </div>
  </div>
</div>

</div>

<div class="w-100 position-relative bg-black text-white bg-cover d-flex align-items-center">
  <div class="container-fluid px-vw-5">
    <div class="position-absolute w-100 h-50 bg-dark bottom-0 start-0"></div>
    <div class="row d-flex align-items-center position-relative justify-content-center px-0 g-5">
      <div class="col-12 col-lg-6">
        <img src="assets/img/webp/abstract18.png" width="2280" height="1732" alt="abstract image" class="img-fluid position-relative rounded-5 shadow" data-aos="fade-up">
      </div>
      <div class="col-12 col-md-6 col-lg-3">
        <img src="assets/img/webp/abstract6.png" width="1116" height="1578" alt="abstract image" class="img-fluid position-relative rounded-5 shadow" data-aos="fade-up" data-aos-duration="2000">
      </div>
      <div class="col-12 col-md-6 col-lg-3">
        <img src="assets/img/webp/abstract9.png" width="1116" height="848" alt="abstract image" class="img-fluid position-relative rounded-5 shadow" data-aos="fade-up" data-aos-duration="3000">
      </div>
    </div>
  </div>
</div>


<div class="bg-black py-vh-3">
  <div class="container bg-black px-vw-5 py-vh-3 rounded-5 shadow">

  <div class="row gx-5">
    <div class="col-12 col-md-6">
      <div class="card bg-transparent mb-5" data-aos="zoom-in-up">
        <div class="bg-dark shadow rounded-5 p-0">
          <img src="assets/img/webp/abstract3.png" width="582" height="327" alt="abstract image" class="img-fluid rounded-5 no-bottom-radius" loading="lazy">
          <div class="p-5">
            <h2 class="fw-lighter">Eau</h2>
            <p class="pb-4 text-secondary">Plongez dans les mystères de l'élément aquatique où les flux émotionnels rencontrent les secrets des profondeurs. Explorez la magie de l'eau, source de vie et de purification, capable de guérir et d'apaiser, mais aussi de déchaîner des tempêtes dévastatrices</p>
            <a href="#" class="link-fancy link-fancy-light">en savoir plus
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                </svg>
            </a>
          </div>
        </div>
      </div>

      <div class="card bg-transparent" data-aos="zoom-in-up">
        <div class="bg-dark shadow rounded-5 p-0">
          <img src="assets/img/webp/abstract17.png" width="582" height="442" alt="abstract image" class="img-fluid rounded-5 no-bottom-radius" loading="lazy">
          <div class="p-5">
            <h2 class="fw-lighter">Terre</h2>
            <p class="pb-4 text-secondary">Parcourez les vastes étendues de la terre, où la magie de la croissance et de la stabilité règne en maître. Découvrez les pouvoirs de l'élément solide, capable de nourrir, de protéger et de façonner le monde, mais aussi de trembler de colère et de détruire tout sur son passage.</p>
            <a href="#" class="link-fancy link-fancy-light">en savoir plus
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6">
      <div class="p-5 pt-0 mt-5" data-aos="fade">
        <span class="h5 text-secondary fw-lighter">Alors, on y vas</span>
        <h2 class="display-4">Explorez un monde enchanté où les différentes catégories de magie vous attendent</h2>
      </div>
      <div class="card bg-transparent mb-5 mt-5" data-aos="zoom-in-up">
        <div class="bg-dark shadow rounded-5 p-0">
          <img src="assets/img/webp/abstract2.png" width="582" height="390" alt="abstract image" class="img-fluid rounded-5 no-bottom-radius" loading="lazy">
          <div class="p-5">
            <h2 class="fw-lighter">Air</h2>
            <p class="pb-4 text-secondary">Envolez-vous vers les hauteurs du ciel et plongez dans l'essence de l'élément aérien, où la magie de la liberté et de la clairvoyance se déploie. Explorez les courants invisibles porteurs de messages, de rêves et d'inspiration, mais aussi capables de déclencher des tornades incontrôlables.</p>
            <a href="#" class="link-fancy link-fancy-light">en savoir plus
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                </svg>
            </a>
          </div>
        </div>
      </div>

      <div class="card bg-transparent" data-aos="zoom-in-up">
        <div class="bg-dark shadow rounded-5 p-0">
          <img src="assets/img/webp/abstract4.png" width="582" height="327" alt="abstract image" class="img-fluid rounded-5 no-bottom-radius" loading="lazy">
          <div class="p-5">
            <h2 class="fw-lighter">Feu</h2>
            <p class="pb-4 text-secondary">Bravez les flammes ardentes de l'élément feu, où la passion, la transformation et la destruction se rencontrent. Plongez dans la magie élémentaire de la chaleur et de la lumière, capable de purifier et de réchauffer, mais aussi de consumer tout sur son chemin dans un brasier infernal.</p>
            <a href="#" class="link-fancy link-fancy-light">en savoir plus
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

</div>



</div>
<div class="container-fluid px-vw-5 position-relative" data-aos="fade">
<div class="position-absolute w-100 h-50 bg-black top-0 start-0"></div>
<div class="position-relative py-vh-5 bg-cover bg-center rounded-5" style="background-image: url(img/webp/person103.png)">
  <div class="container bg-black px-vw-5 py-vh-3 rounded-5 shadow">
  <div class="row d-flex align-items-center">

  <div class="col-6 d-flex align-items-center bg-dark shadow rounded-5 p-0" data-aos="zoom-in-up">
    <div class="row d-flex justify-content-center">
      <div class="col-12">
    <img src="assets/img/webp/person103.png" width="684" height="457" alt="our CEO with some nice numbers" class="img-fluid rounded-5" loading="lazy">
  </div>
  <div class="col-12 col-lg-10 col-xl-8 text-center my-5">
    <p class="lead border-bottom pb-4 border-secondary">Découvrez un univers où les frontières entre les possibles s'effacent : Bienvenue sur notre plateforme d'échange de pouvoirs, où les individus extraordinaires peuvent troquer leurs dons uniques pour réaliser des destinées encore plus grandioses.</p>
    <p class="text-secondary text-center">Power Switch</p>
</div>
</div>
</div>
  <div class="col-5 offset-1">
    <span class="h5 text-secondary fw-lighter">Infinite de pouvoirs</span>
    <h2 class="display-huge fw-bolder" data-aos="zoom-in-left">infinie</h2>
<p class="h4 fw-lighter text-secondary">
  Explorez un univers où les limites n'existent pas.
</p>

<h2 class="display-huge fw-bolder border-top border-secondary pt-5 mt-5" data-aos="zoom-in-left">6</h2>
<p class="h4 fw-lighter text-secondary">
  Découvrez les six voies de la magie, chacune offrant un chemin unique vers le pouvoir et la connaissance
</p>
</div>
  </div>
</div>

</div>
</div>
    </main>

    <footer class="bg-black border-top border-dark">
  <div class="container py-vh-4 text-secondary fw-lighter">
    <div class="row">
      <div class="col-12 col-lg-5 py-4 text-center text-lg-start">
            <a class="navbar-brand pe-md-4 fs-4 col-12 col-md-auto text-center" href="index.html">
            <img src="assets/logo/logo-blanc.png" alt="" width="147.6" height="71.8">
</a>

      </div>
      <div class="col border-end border-dark">
                <span class="h6">Lien</span>
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a href="#" class="link-fancy link-fancy-light">Accueil</a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="link-fancy link-fancy-light">Tutoriel</a>
                  </li>

                  <li class="nav-item">
                    <a href="#" class="link-fancy link-fancy-light">On y vas</a>
                  </li>
                </ul>
      </div>
    </div>
  </div>
  <div class="container text-center small py-vh-2 border-top border-dark">Made by SuperDevy
  </div>
</footer>








<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/aos.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
  const gradientContainer = document.getElementById('gradient-container');
  
  gradientContainer.addEventListener('mousemove', function(e) {
    const xPos = e.clientX / window.innerWidth * 100;
    const yPos = e.clientY / window.innerHeight * 100;
    
    gradientContainer.style.backgroundPosition = `${xPos}% ${yPos}%`;
  });
});
AOS.init({
 duration: 800, // values from 0 to 3000, with step 50ms
});
</script>
<script>
  let scrollpos = window.scrollY
  const header = document.querySelector(".navbar")
  const header_height = header.offsetHeight

  const add_class_on_scroll = () => header.classList.add("scrolled", "shadow-sm")
  const remove_class_on_scroll = () => header.classList.remove("scrolled", "shadow-sm")

  window.addEventListener('scroll', function() {
    scrollpos = window.scrollY;

    if (scrollpos >= header_height) { add_class_on_scroll() }
    else { remove_class_on_scroll() }

    console.log(scrollpos)
  })
</script>

  </body>
</html>
