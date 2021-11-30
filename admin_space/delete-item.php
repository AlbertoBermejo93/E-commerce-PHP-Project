<?php

// Supprimer un article identifier par son id.

require '../inc/config.php';

if(isset($_POST['delete']) && !empty($_POST['delete']) && is_numeric($_POST['delete'])){

	$query = $bdd->prepare('DELETE FROM item WHERE id = :id_param');
	$query->bindValue(':id_param', $_POST['delete'], PDO::PARAM_INT);
	$query->execute();

}
require 'admin_header.php'
?>
<body>
    
</body>
<body class="d-flex flex-column h-100">

	<main class="flex-shrink-0">
        <div class="container">
            <div class="row justify-content-center">
            <div class="col-3 mt-5">
            <form method="post">
                
                <select name="delete">
                <?php
                    $query = $bdd->prepare('SELECT * FROM item ORDER BY title asc');
                    $query->execute(); 

                    $result = $query->fetchAll(PDO::FETCH_ASSOC);

                    foreach($result as $toto){
                        echo '<option value="'.$toto['id'].'">'.$toto['title'].'</option>';
                    }

                ?>
                </select>
                <button type="submit" class="btn btn-warning">Effacer</button>
            </form>
            </div>
            </div>
        </div>
        
    
</main>

<?php require '../footer.php'; ?>