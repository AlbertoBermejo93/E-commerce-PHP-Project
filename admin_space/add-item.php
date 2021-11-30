<?php
require '../inc/config.php';


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
	
	
	if(strlen($safe['descriptions']) < 50 || strlen($safe['descriptions']) > 1000){
		$errors[] = 'Votre contenu doit comporter entre 50 et 1000 caractères';
	}
	
	if(strlen($safe['images']) < 5 ){
		$errors[] = 'lien url invalide';
	}
	
	
	// vérification du prix
	if(!is_numeric($safe['price']) || $safe['price'] < 1 || $safe['price'] > 100){
		$errors[] = 'le prix ne peut pas être inférieur à 1 euro ou supérieur de 100euros';
	}
	
	// vérification du stock
	if(!is_numeric($safe['quantity']) || $safe['quantity'] < 1 || $safe['quantity'] > 100){
		$errors[] = 'le nombre darticles ne peut pas être inférieur de 1 unité ou spérieu à 100 unités';
	}


	if(count($errors) == 0){
		// ici, lorsque je n'ai pas d'erreur que je vais enregistrer mon article


		$sql = 'INSERT INTO item (title, category, descriptions, price, quantity, images) VALUES(:param_title,:param_category,:param_descriptions, :param_price, :param_quantity, :param_images)';

				

		// la variable $bdd se trouve dans le fichier config.php et est ma connexion à ma de données
		// $bdd->prepare() me permet de préparer ma requete SQL
		$query = $bdd->prepare($sql); 

		// Les bindValues permettent d'associer les :param_* aux valeurs du formulaire
		$query->bindValue(':param_title', $safe['title']);
		$query->bindValue(':param_descriptions', $safe['descriptions']);
		// $query->bindValue(':param_color', $safe['color']);
		$query->bindValue(':param_category', $safe['category']);
        $query->bindValue(':param_images', $safe['images']);
        $query->bindValue(':param_quantity', $safe['quantity']);
        $query->bindValue(':param_price', $safe['price']);
		$query->execute(); // J'execute ma requete


		$formIsValid = true;
	}
	else {
		$formIsValid = false;
	}

}
?>
<?php require 'admin_header.php'; ?>
<body class="d-flex flex-column h-100">

	<main class="flex-shrink-0 mb-5">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-6">
					<h1 class="text-center my-5">Ajouter un article</h1>


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
							<label for="title" class="form-label">Titre du produit</label>
							<input type="text" id="title" name="title" class="form-control">
						</div>

						<!-- categorie -->
						<div class="mb-3">
							<label for="category" class="form-label">Catégorie</label>
							<select id="category" name="category" class="form-control">
								<option value="0" selected disabled>-- Choisir --</option>
								<?php foreach($categories as $kCat => $vCat):?>
									<option value="<?=$kCat;?>"><?=mb_strtoupper(mb_substr($vCat, 0, 1)) . mb_substr($vCat, 1);?></option>
								<?php endforeach;?>
							</select>
						</div>

						<!-- Description de l'article -->
						<div class="mb-3">
							<label for="descriptions" class="form-label">Description</label>
							<textarea id="descriptions" name="descriptions" class="form-control" rows="15"></textarea>
						</div>

                        <!-- Prix de vente -->
                        <div class="mb-3">
							<label for="price" class="form-label">Prix en €</label>
							<input type="number" id="price" name="price" class="form-control" value="Prix">
						</div>

                        <!-- Stock disponible -->
                        <div class="mb-3">
							<label for="quantity" class="form-label">Stock</label>
							<input type="number" id="quantity" name="quantity" class="form-control">
						</div>

                        <!-- Image -->
                        <div class="mb-3">
							<label for="images" class="form-label">Ajoutez une image</label>
							<input type="file" id="images" name="images" class="form-control">
						</div>


						<button type="submit" class="btn btn-primary">Envoyer</button>
					</form>
				</div>
			</div>
		</div>
	</main>

<?php include '../footer.php'; ?>