<?php 
    require_once __DIR__.'/../config/config.php';
        if(!empty($_POST['password']) && !empty($_POST['password_repeat']) && !empty($_POST['token'])){
            $password = htmlspecialchars($_POST['password']);
            $password_repeat = htmlspecialchars($_POST['password_repeat']);
            $token = htmlspecialchars($_POST['token']);

            $check = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
            $check->execute(array($token));
            $row = $check->rowCount();

            if($row){
                if($password === $password_repeat){
                    $cost = ['cost' => 12];
                    $password = password_hash($password, PASSWORD_BCRYPT, $cost);

                    $update = $bdd->prepare('UPDATE utilisateurs SET password = ? WHERE token = ?');
                    $update->execute(array($password, $token));
                    
                    $delete = $bdd->prepare('DELETE FROM password_recover WHERE token_user = ?');
                    $delete->execute(array($token));

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
                        <div class="form-group align-middle justify-content-center">
                            <h2 class="fs-4 mt-5 text-success">Le mot de passe a bien été modifie</h2> <br>
                            <a href="../../connexion.php" class=" mt-3 text-dark">Se connecter</a>
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
                        <div class="form-group align-middle justify-content-center">
                            <h2 class="fs-4 mt-5 text-danger">Les mots de passes ne sont pas identiques</h2> <br>
                            <a href="../index.php" class=" mt-3 text-dark">Réessayer</a>
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
                }
            }else{
                echo "Compte non existant";
            }
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
                        <div class="form-group align-middle justify-content-center">
                            <h2 class="fs-4 mt-5 text-danger">Merci de renseigner un mot de passe</h2> <br>
                            <a href="../index.php" class=" mt-3 text-dark">Réessayer</a>
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
        }