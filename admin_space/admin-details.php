<?php

// Inclut le fichier à l'intérieur de l'actuel
// je peux utiliser toutes les variables présentes dans le fichier "config.php" puisque j'ai utilisé "require"
require '../inc/config.php';

// Je cherche mon article en base de données
# url d'appel : http://localhost/php/site_actu/read-article.php?id=8
if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){

	$query = $bdd->prepare('SELECT * FROM item WHERE id = :id_param');
	$query->bindValue(':id_param', $_GET['id'], PDO::PARAM_INT);
	$query->execute();

	$article = $query->fetch(PDO::FETCH_ASSOC); // Je récupère une ligne de données
}
?>
<?php require 'admin_header.php'; ?>

<body class="d-flex flex-column h-100">

	<main class="flex-shrink-0 mb-4">
		<div class="container">

			<div class="row justify-content-center my-5">
			<?php if(!isset($article) || empty($article)):?>
				<div class="col-6">
					<div class="alert alert-danger mt-5">Article introuvable ou aucun identifiant renseigné</div>
				</div>
			<?php else:?>
				<!-- On affiche le titre et le contenu de l'article -->
				<div class="col-6">
		
					    <img class="img-zoom" src="assets/<?=$article['images'];?>">

				</div>
                <div class="col-4">
					<h2 class="mb-5"><?=$article['title'];?></h2>

					<div class="mb-5"><?=$article['descriptions'];?></div>


                    <div class="tailles mt-3">
                        <select name="tailles" class="form-control" id="tailles">
                            <option value="0" selected disabled>Choisissez votre taille</option>
                            <option value="1">XS</option>
                            <option value="2">S</option>
                            <option value="3">M</option>
                            <option value="4">L</option>
                            <option value="5">XL</option>
                            <option value="6">XXL</option>
                        </select>
                    </div> 

                    <div class="span d-flex justify-content-between mt-5">
                        <span style="color: black; font-size:22px; font-weight: 600;"><?php echo $article['price'];?>€</span>

                        <span style="color: grey; font-size:20px; font-weight: 400;">Stock: <?php echo $article['quantity'];?></span>
                    </div>

                    <a class="btn btn-warning form-control d-block mt-4" href="cartAction.php?action=addToCart&id=<?php echo $mon_article["id"];?>">Ajouter au panier <i class="fas fa-shopping-cart"></i></a>
                    <a class="btn btn-outline-dark d-block mt-3" href="list-item.php">Retour</a>

				</div>

			<?php endif;?>
			</div>

		</div>
	</main>

	<?php include '../footer.php'; ?>
