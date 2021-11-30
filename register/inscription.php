<?php
session_start();
require '../inc/config.php';

$errors = [];

if(!empty($_POST)){

	$safe = array_map('trim', array_map('strip_tags', $_POST));

    if(strlen($safe['user']) < 1 || strlen($safe['user']) > 60){
		$errors[] = 'Votre prénom doit comporter entre 5 et 60 caractères';
	}

    if(!filter_var(strtolower($safe['email']), FILTER_VALIDATE_EMAIL)){
		$errors[] = 'Votre email n\'est pas valide';
	}

    if($safe['password'] == $safe['repassword']){
        $safe['password'] = hash('sha256', $safe['password']);
    }

    if(count($errors) == 0){
        $sql = 'INSERT INTO register (user, email, password, role) VALUES (:user, :email, :password, :role)';

        $insert = $bdd->prepare($sql); 

        // $insert->bindValue(':id', $safe['id']);
        $insert->bindValue(':user', $safe['user']);
        $insert->bindValue(':email', $safe['email']);
        $insert->bindValue(':password', $safe['password']);
        // $insert->bindValue(':token', $safe['token']);
        $insert->bindValue(':role', 'member');

        $insert->execute();
        

        $formIsValid = true;
	}
	else {
		$formIsValid = false;
	}
}

?>


<?php require 'co_header.php'; ?>

<?php 

    if(isset($formIsValid) && $formIsValid == true){
        echo '<div class="alert alert-success">Votre inscription a bien été enregistré</div>';
    }
    elseif(isset($formIsValid) && $formIsValid == false){
        echo '<div class="alert alert-danger">'.implode('<br>', $errors).'</div>';

    }
?>

<form style="margin-top: 200px;" method="POST">
    <div style="width: 700px;" class="container my-5 form-group card text-center shadow p-3 bg-white rounded">

        <img class="mx-auto p-2 mb-3 w-25" src="../assets/logo2.png" alt="logo">

        <div class="mb-3 row">
            <label for="user" class="col-sm-4 col-form-label text-start">Prénom</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" name="user" id="user" placeholder="name" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="email" class="col-sm-4 col-form-label text-start">Email</label>
            <div class="col-sm-8">
            <input type="email" class="form-control" name="email" id="email" placeholder="email@example.com" required>
            </div>
        </div>


        <div class="mb-3 row">
            <label for="password" class="col-sm-4 col-form-label text-start">Mot de passe</label>
            <div class="col-sm-8">
            <input type="password" class="form-control" name="password" id="password" placeholder="123" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="repassword" class="col-sm-4 col-form-label text-start">Répétez le mot de passe</label>
            <div class="col-sm-8">
            <input type="password" class="form-control" name="repassword" id="repassword" placeholder="123" required>
            </div>
        </div>

        <button class="btn btn-warning form-control">S'inscrire</button>
        
        <a class="mt-3 text-dark" href="connexion.php">J'ai dejà un compte</a>
        <!-- <a class="mt-1 text-dark" href="connexion.php">Mot de passe oublié</a> -->
    </div>
</form>

<style>

body {
  background-image: url(https://images.unsplash.com/photo-1445205170230-053b83016050?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1471&q=80);
  background-size: cover;
}

</style>
