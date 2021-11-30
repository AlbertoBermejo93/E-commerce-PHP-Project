<?php

require 'inc/config.php';

$errors = [];

// Si mon formulaire est envoyé, je passe dans la condition ci-dessous
if(!empty($_POST)){

	$safe = array_map('trim', array_map('strip_tags', $_POST)); // On nettoie pour sécuriser

	if(strlen($safe['title']) < 5 || strlen($safe['title']) > 60){
		$errors[] = 'Votre titre doit compoter entre 5 et 60 caractères';
	}


	if(!isset($safe['category'])){ // J'ajoute cette condition puisque la premiere <option> des catégories est "disabled" donc illisible en php
		$errors[] = 'Vous devez sélectionner une catégorie';
	}
	elseif(!in_array($safe['category'], array_keys($categories))){
		$errors[] = 'Vous avez essayé de modifier la catégorie et c\'est pas très sympa et pas très gentil';
	}


	if(strlen($safe['descriptions']) < 10 || strlen($safe['descriptions']) > 1000){
		$errors[] = 'Votre contenu doit compoter entre 50 et 1000 caractères';
	}



	if(count($errors) == 0){
		// ici, lorsque je n'ai pas d'erreur que je vais enregistrer mon article


		$sql = 'UPDATE item SET title = :param_title, category = :param_category, descriptions = :param_descriptions, price = :param_price, quantity = :param_quantity, images = :param_images WHERE id = :id_param';

				
		// la variable $bdd se trouve dans le fichier config.php et est ma connexion à ma de données
		// $bdd->prepare() me permet de préparer ma requete SQL
		$query = $bdd->prepare($sql); 

		// Les bindValues permettent d'associer les :param_* aux valeurs du formulaire
		$query->bindValue(':param_title', $safe['title']);
        $query->bindValue(':param_category', $safe['category']);
		$query->bindValue(':param_descriptions', $safe['descriptions']);
		// $query->bindValue(':param_color', $safe['color']);
        $query->bindValue(':param_images', $safe['images']);
        $query->bindValue(':param_quantity', $safe['quantity']);
        $query->bindValue(':param_price', $safe['price']);
        $query->bindValue(':id_param', $_GET['id'], PDO::PARAM_INT);

		$query->execute(); // J'execute ma requete


		$formIsValid = true;
	}
	else {
		$formIsValid = false;
	}

}

if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){

	$query = $bdd->prepare('SELECT * FROM item WHERE id = :id_param');
	$query->bindValue(':id_param', $_GET['id'], PDO::PARAM_INT);
	$query->execute();

	$article = $query->fetch(PDO::FETCH_ASSOC); // Je récupère une ligne de données
}

?>

<?php
    require 'header.php';
?>

	<main class="flex-shrink-0">
		<div class="container">
			<div class="row justify-content-center">

            <?php if(!isset($article) || empty($article)):?>

                <div class="col-6">
					<div class="alert alert-danger mt-5">Article introuvable ou aucun identifiant renseigné</div>
				</div>
                <?php else:?>

				<div class="col-6">
					<h1 class="text-center my-5">Modification du produit</h1>


					<?php 

					if(isset($formIsValid) && $formIsValid == true){
						echo '<div class="alert alert-success">Votre article a bien été enregistré</div>';
					}
					elseif(isset($formIsValid) && $formIsValid == false){
						echo '<div class="alert alert-danger">'.implode('<br>', $errors).'</div>';

					}
					?>


					<form method="POST">
						<!-- titre -->
						<div class="mb-3">
							<label for="title" class="form-label">Name</label>
							<input type="text" id="title" name="title" class="form-control"
                            value="<?=$article['title'];?>">
						</div>

						<!-- categorie -->
						<div class="mb-3">
							<label for="category" class="form-label">Catégorie</label>
							<select id="category" name="category" class="form-control">
								<option value="0" selected disabled>-- Choisir --</option>
								<?php foreach($categories as $kCat => $vCat):?>
									<option value="<?=$kCat;?>" <?=($article['category'] == $kCat) ? 'selected' : '';?>><?=mb_strtoupper(mb_substr($vCat, 0, 1)) . mb_substr($vCat, 1);?></option>
								<?php endforeach;?>								
							</select>
						</div>

						<!-- Description de l'article -->
						<div class="mb-3">
							<label for="descriptions" class="form-label">Description</label>
							<textarea id="descriptions" name="descriptions" class="form-control" rows="15"><?=$article['descriptions'];?></textarea>
						</div>

                        <!-- Prix de vente -->
                        <div class="mb-3">
							<label for="price" class="form-label">Add price in €</label>
							<input type="number" id="price" name="price" class="form-control" value="<?=$article['price'];?>">
						</div>

                        <!-- Stock disponible -->
                        <div class="mb-3">
							<label for="quantity" class="form-label">Add stock</label>
							<input type="number" id="quantity" name="quantity" class="form-control" value="<?=$article['quantity'];?>">
						</div>

                        <!-- Image -->
                        <div class="mb-3">
							<label for="images" class="form-label">Add stock</label>
							<input type="images" id="images" name="images" class="form-control" value="<?=$article['images'];?>">
						</div>
						


						<button type="submit" class="btn btn-warning">Enregistrer</button>
					</form>
				</div>
                <?php endif;?>
			</div>
		</div>
	</main>

<?php include 'footer.php'; ?>