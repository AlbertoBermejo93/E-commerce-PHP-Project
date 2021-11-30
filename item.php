<?php require 'inc/config.php'; ?>
<?php require 'list.php'; ?>

<div class="row mb-3">
        
			<?php foreach($mes_articles as $mon_article):?>
                <div class="col-4 p-5" style="box-sizing: border-box;">

                        

						<img class="img-fluid" src="<?php echo $mon_article['images'];?>" alt="1">

                        <h3 class="mt-4"><?php echo $mon_article['title'];?></h3>


						<p style="color: #777777;"><?php echo $mon_article['descriptions'];?></p>

                        <div class="span d-flex justify-content-between">
                            <span style="color: black; font-size:22px; font-weight: 600;"><?php echo $mon_article['price'];?>€</span>

                            <span style="color: grey; font-size:20px; font-weight: 400;">Stock: <?php echo $mon_article['quantity'];?></span>
                        </div>
                        

                        <div class="p-0 mt-3 btn d-flex justify-content-between">
                            <a class="btn btn-warning" href="read-item.php?itemId=<?php echo $mon_article['id'];?>">Ajouter au panier</a>
                            <a class="btn btn-dark" href="details-item.php?id=<?php echo $mon_article['id'];?>">Voir détails</a>
                        </div>
                        

                </div>
            <?php endforeach;?>
        
			
</div>