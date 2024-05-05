<!doctype html>
<html class="h-100" lang="en">

  <head>
      <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
  <meta name="description" content="A well made and handcrafted Bootstrap 5 template">
  <link rel="icon" type="image/png" sizes="96x96" href="assets/logo/logo-symbole.png">
  <link rel="stylesheet" href="assets/css/auth_module_style.css">
  <meta name="author" content="Holger Koenemann">
  <meta name="generator" content="Eleventy v2.0.0">
  <meta name="HandheldFriendly" content="true">
  <title>Register a new account</title>
  <link rel="stylesheet" href="assets/css/theme.min.css">
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


  </head>

  <body class="d-flex h-100 w-100 bg-black text-white" data-bs-spy="scroll" data-bs-target="#navScroll">

    <div class="h-100 container-fluid">
      <div class="h-100 row d-flex align-items-stretch">
        
          <div id="login_box" class="col-12 col-md-7 col-lg-6 col-xl-5 d-flex align-items-start flex-column px-vw-5">
          
            <header class="mb-auto py-vh-2 col-12">
              <a class="navbar-brand pe-md-4 fs-4 col-12 col-md-auto text-center" href="index.html">
                <img src="assets/logo/logo-blanc.png" alt="" width="147.6" height="71.8">
              </a>

            </header>
            <main class="mb-auto col-12">
              <h1>Rejoignez-nous aujourd'hui !</h1>

              <hr>
              <br>

<form action="https://localhost/WebCup-2024/webcup/signup" method="POST" class="row">
  <div class="sign_in_stepper">
    <div class="col-12">
        <div id="step1" class="step">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nom</label>
                <input name="ln" type="text" class="form-control form-control-lg bg-gray-800 border-dark" id="exampleInputName1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Prénom</label>
                <input name="fn" type="text" class="form-control form-control-lg bg-gray-800 border-dark" id="exampleInputSurname1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Sexe</label>
                <select name="gender" id="signup-gender-dropdown" class="form-control form-control-lg bg-gray-800 border-dark"></select>
                <script>
                  axios.get('https://localhost/WebCup-2024/webcup/genders')
                    .then(response => {
                        const genders = response.data;
                        const select = document.getElementById('signup-gender-dropdown');
                        genders.forEach(gender => {
                            const option = document.createElement('option');
                            option.value = gender.power_switch_gender_id;
                            option.textContent = gender.power_switch_gender_name;
                            select.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching genders:', error);
                    });
                </script>
            </div>
            <button type="button" onclick="nextStep(2)" class="btn btn-white btn-xl mb-4 next-button">Suivant</button>
        </div>
        <div id="step2" class="step">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input name="mail" type="email" class="form-control form-control-lg bg-gray-800 border-dark" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                <input name="mdp" type="password" class="form-control form-control-lg bg-gray-800 border-dark" id="exampleInputPassword1">
            </div>
            <button type="button" onclick="prevStep(1)" class="btn btn-white btn-xl mb-4">Retour</button>
            <div class="to-the-right">
                <button type="button" onclick="nextStep(3)" class="btn btn-white btn-xl mb-4 next-button">Suivant</button>
            </div>
        </div>
        <div id="step3" class="step">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Quel sera votre pseudo ?</label>
                <input name="nickname" type="text" class="form-control form-control-lg bg-gray-800 border-dark" id="exampleInputPassword1">
            </div>
            <button type="button" onclick="prevStep(2)" class="btn btn-white btn-xl mb-4">Retour</button>
            <div class="to-the-right">
                <button type="submit" class="btn btn-white btn-xl mb-4 next-button">Finaliser</button>
            </div>
        </div>
    </div>
  </div>
</form>
<a id="signup-page-link" class="link" href="login-page">Déjà inscrit ? Connectez-vous.</a>

            </main>
          </div>
          
            <div id="side-picture-sign-in" class="col-12 col-md-5 col-lg-6 col-xl-7"></div>
          
        </div>

      </div>

      <script src="assets/js/sign_in_stepper.js"></script>
    
    </body>
</html>
