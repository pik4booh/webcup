<!doctype html>
<html class="h-100" lang="en">

  <head>
      <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
  <meta name="description" content="A well made and handcrafted Bootstrap 5 template">
  <link rel="icon" type="image/png" sizes="96x96" href="assets/logo/logo-symbole.png">
  <meta name="author" content="Holger Koenemann">
  <meta name="generator" content="Eleventy v2.0.0">
  <meta name="HandheldFriendly" content="true">
  <title>Power Switch</title>
  <link rel="stylesheet" href="assets/css/theme.min.css">
  <link rel="stylesheet" href="assets/css/home_module_style.css">

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
  <a class="nav-link fs-5" href="/" aria-label="Homepage">
    Accueil
  </a>
</li>
<li class="nav-item">
  <a class="nav-link fs-5" href="#" aria-label="A sample content page">
    Tutoriel
  </a>
</li>
<li class="nav-item">
  <a class="nav-link fs-5" href="#" aria-label="A system message page">
    Troquer
  </a>
</li>

    </ul>
      <a href="login-page" class="btn btn-light log-in">
        <small>Se connecter</small>
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
              <span class="h5 text-secondary fw-lighter">La manoire a voeaux</span>
              <h1 class="display-huge mt-3 mb-3 lh-1"><b>Ici vous pouver avoire tous ce que vous voulez</b></h1>
            </div>
            <div class="col-12 col-xl-8">
              <p class="lead text-secondary">Lancez-vous et forgez-vous le meilleur set de sorts</p>
            </div>
            <div class="col-12 text-center">
            <form action="#" method="POST" class="row">
                <div class="col-12">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Enrer votre voeux</label>
                    <input name="mail" type="email" class="form-control form-control-lg bg-gray-800 border-dark" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <button type="submit" id="login_button" class="btn btn-white btn-xl mb-4">Exaucer</button>
                </div>
                </form>
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

    </main>

<footer class="bg-black border-top border-dark">
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