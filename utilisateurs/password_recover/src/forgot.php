<?php 
    require_once __DIR__.'/../config/config.php';

    if(isset($_POST['email']) && !empty($_POST['email'])){
        $email = htmlspecialchars($_POST['email']);

        $check = $bdd->prepare('SELECT token FROM utilisateurs WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();

        if($row){
            $token = bin2hex(openssl_random_pseudo_bytes(24));
            $token_user = $data['token']; // attention longueur du token : 128, prevoyez un varchar 130 dans votre table si vous utilisez les tokens du système d'inscription

            $insert = $bdd->prepare('INSERT INTO password_recover(token_user, token) VALUES(?,?)');
            $insert->execute(array($token_user, $token));

            $link = 'recover.php?u='.base64_encode($token_user).'&token='.base64_encode($token);

            echo '<!DOCTYPE html>
            <html lang="fr">
              <head>
                <!-- Required meta tags -->
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
            
                <!-- Bootstrap CSS -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            
                <!-- FontAwesome -->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            
                <!-- MyStyle -->
                <link rel="stylesheet" href="../../../styles/style.css">
            
                <title>ZORA - E-SHOP</title>
              </head>
            
              <body>
                <div id="top"> <!-- Top Begin -->
            
                    <div class="container"> <!-- Container Begin -->
            
                        <div class="col-md-6 offer"> <!-- Col-md-6 Begin -->
            
                            <a href="#" class="btn btn-outline-warning btn-sm">SOLDES%</a>
                            <a href="checkout.php">- Profitez des Soldes jusqu\'à 40%!</a>
            
                        </div> <!-- Col-md-6 Finish -->
            
                        <div class="col-md-6 offer"> <!-- Col-md-6 Begin -->
            
                            <ul class="menu"> <!-- Menu Begin -->
            
                                <li>
                                    <a href="utilisateurs/inscription.php">Inscrivez-vous</a>
                                </li>
                                <li>
                                    <a href="utilisateurs/index.php">Connectez-vous</a>
                                </li>
            
                            </ul> <!-- Menu Finish -->
            
                        </div> <!-- Col-md-6 Finish -->
            
                    </div> <!-- Container Finish -->
            
                </div> <!-- Top Finish -->
            
            
            <nav style="margin-bottom: 200px;" class="navbar navbar-expand-lg navbar-dark bg-dark"> <!-- Nav Begin -->
                <div class="container">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <a class="navbar-brand" href="../../home.php">
                          <img src="../../assets/logo.png" alt="">
                  </a>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fas fa-bars"></i> Catégories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="#">T-shirts</a></li>
                          <li><a class="dropdown-item" href="#">Pulls</a></li>
                          <li><a class="dropdown-item" href="#">Pantalons</a></li>
                          <li><a class="dropdown-item" href="#">Accessoires</a></li>
                          <li><a class="dropdown-item" href="#">Chaussures</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="utilisateurs/index.php">Se connecter</a></li>
                        </ul>
                      </li>
                    </ul>
                    <form class="d-flex">
                      <input class="form-control me-3" type="search" placeholder="Rechercher" aria-label="Search">
                      <button class="btn btn-warning" type="submit">Rechercher</button>
                    </form>
                  </div>
                </div>
            </nav> <!-- Nav Finish -->

            <div class="container align-middle w-25 justify-content-center d-flex card text-center shadow p-3 my-5 bg-white rounded">
            <div class="card-body">
                <img class="my-2" src="../../../assets/logo2.png" alt="">
                <div class="form-group align-middle justify-content-center d-flex">
                    <a style="margin-top: 50px; margin-bottom: 20px;" class="py-3 w-75 text-center btn btn-warning" href="'.$link.'">Modifier mon mot de passe</a>
                </div>
            </div>
            </div>

            
            
            <footer style="margin-top: 335px;">
            <div class="text-center p-3" style="background-color:#1d1d1d;">
      
                <p class="text-light" href="#">© 2020 Copyright: ZORA.COM</p>
                </div>
                <!-- Copyright -->
            </footer>

            </div>
            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            </body>
            </html>
            
            <style>
                body {
                background-image: url(https://images.unsplash.com/photo-1445205170230-053b83016050?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1471&q=80);
                background-size: cover;
                background-repeat: no-repeat;
                }
            </style>';
        }else{
            echo '<!DOCTYPE html>
            <html lang="fr">
              <head>
                <!-- Required meta tags -->
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
            
                <!-- Bootstrap CSS -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            
                <!-- FontAwesome -->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            
                <!-- MyStyle -->
                <link rel="stylesheet" href="../../../styles/style.css">
            
                <title>ZORA - E-SHOP</title>
              </head>
            
              <body>
                <div id="top"> <!-- Top Begin -->
            
                    <div class="container"> <!-- Container Begin -->
            
                        <div class="col-md-6 offer"> <!-- Col-md-6 Begin -->
            
                            <a href="#" class="btn btn-outline-warning btn-sm">SOLDES%</a>
                            <a href="checkout.php">- Profitez des Soldes jusqu\'à 40%!</a>
            
                        </div> <!-- Col-md-6 Finish -->
            
                        <div class="col-md-6 offer"> <!-- Col-md-6 Begin -->
            
                            <ul class="menu"> <!-- Menu Begin -->
            
                                <li>
                                    <a href="utilisateurs/inscription.php">Inscrivez-vous</a>
                                </li>
                                <li>
                                    <a href="utilisateurs/index.php">Connectez-vous</a>
                                </li>
            
                            </ul> <!-- Menu Finish -->
            
                        </div> <!-- Col-md-6 Finish -->
            
                    </div> <!-- Container Finish -->
            
                </div> <!-- Top Finish -->
            
            
            <nav style="margin-bottom: 200px;" class="navbar navbar-expand-lg navbar-dark bg-dark"> <!-- Nav Begin -->
                <div class="container">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <a class="navbar-brand" href="../../home.php">
                          <img src="../../assets/logo.png" alt="">
                  </a>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fas fa-bars"></i> Catégories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="#">T-shirts</a></li>
                          <li><a class="dropdown-item" href="#">Pulls</a></li>
                          <li><a class="dropdown-item" href="#">Pantalons</a></li>
                          <li><a class="dropdown-item" href="#">Accessoires</a></li>
                          <li><a class="dropdown-item" href="#">Chaussures</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="utilisateurs/index.php">Se connecter</a></li>
                        </ul>
                      </li>
                    </ul>
                    <form class="d-flex">
                      <input class="form-control me-3" type="search" placeholder="Rechercher" aria-label="Search">
                      <button class="btn btn-warning" type="submit">Rechercher</button>
                    </form>
                  </div>
                </div>
            </nav> <!-- Nav Finish -->

            <div class="container align-middle w-25 justify-content-center d-flex card text-center shadow p-3 my-5 bg-white rounded">
            <div class="card-body">
                <img class="my-2" src="../../../assets/logo2.png" alt="">
                <div class="form-group align-middle justify-content-center d-flex">
                    <h2 class="fs-4 my-5 text-danger">Erreur: Compte non existant</h2>
                </div>
            </div>
            </div>

            
            
            <footer style="margin-top: 355px;">
            <div class="text-center p-3" style="background-color:#1d1d1d;">
      
                <p class="text-light" href="#">© 2020 Copyright: ZORA.COM</p>
                </div>
                <!-- Copyright -->
            </footer>

            </div>
            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            </body>
            </html>
            
            <style>
                body {
                background-image: url(https://images.unsplash.com/photo-1445205170230-053b83016050?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1471&q=80);
                background-size: cover;
                background-repeat: no-repeat;
                }
            </style>';
            #header('Location: ../index.php');
            #die();
        }
    }
?>