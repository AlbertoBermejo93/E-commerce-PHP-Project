<!DOCTYPE html>
<html lang="en">
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
                <a href="checkout.php">- Profitez des Soldes jusqu'à 40%!</a>

            </div> <!-- Col-md-6 Finish -->

            <div class="col-md-6 offer"> <!-- Col-md-6 Begin -->

                <ul class="menu"> <!-- Menu Begin -->

                    <li>
                        <a href="../inscription.php">Inscrivez-vous</a>
                    </li>
                    <li>
                        <a href="../index.php">Connectez-vous</a>
                    </li>

                </ul> <!-- Menu Finish -->

            </div> <!-- Col-md-6 Finish -->

        </div> <!-- Container Finish -->

    </div> <!-- Top Finish -->


<nav class="navbar navbar-expand-lg navbar-dark bg-dark"> <!-- Nav Begin -->
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