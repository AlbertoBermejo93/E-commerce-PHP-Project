<?php
session_start();
require '../inc/config.php';

$errors = [];

if(!empty($_POST)){
    $safe = array_map('trim', array_map('strip_tags', $_POST));

    $sql = $bdd->prepare('SELECT email, password, token
                          FROM register 
                          WHERE email = :email AND password = :password');

    $password_hash = hash('sha256', $safe['password']);

    $sql->bindValue(':email', $safe['email']);
    $sql->bindValue(':password', $password_hash);
    $sql->execute();
    
    $foundUser = $sql->fetch(); 

    

    if(!empty($foundUser)){ // J'ai un utilsateur
        
        $_SESSION['user'] = $foundUser['token'];
        header('Location: ../user_home.php');
        die();

    }else{
        echo 'Noo';
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
    <div style="width: 600px;" class="container my-5 form-group card text-center shadow p-3 bg-white rounded">

        <img class="mx-auto p-2 mb-3 w-25" src="../assets/logo2.png" alt="logo">

        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
            <input type="email" class="form-control" name="email" id="email" placeholder="email@example.com" required>
            </div>
        </div>


        <div class="mb-3 row">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
            <input type="password" class="form-control" name="password" id="password" placeholder="123" required>
            </div>
        </div>

        <button class="btn btn-warning form-control">Se connecter</button>

        <a class="mt-3 text-dark" href="inscription.php">S'inscrire</a>

    </div>
</form>

<style>

body {
  background-image: url(https://images.unsplash.com/photo-1445205170230-053b83016050?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1471&q=80);
  background-size: cover;
}

</style>