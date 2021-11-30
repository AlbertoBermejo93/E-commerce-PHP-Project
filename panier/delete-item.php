<?php

// Supprimer un article identifier par son id.

require 'inc/config.php';

if(isset($_GET['delete'])){

    $id =$_GET['delete'];
    $bdd->query('DELETE FROM item WHERE id= id');
}
require 'header.php'
?>


<?php 
require 'footer.php'
?>