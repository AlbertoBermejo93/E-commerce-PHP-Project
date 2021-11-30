<?php require 'inc/config.php'; ?>
<?php require 'list.php'; ?>

<div class="row mb-3">
            
        
			<?php 
            
            shuffle($mes_articles);
            foreach(array_slice($mes_articles,0 ,4) as $mon_article):?>
                <div class="col-3 p-4" style="box-sizing: border-box;">

                        

						<img class="img-fluid" src="assets/<?php echo $mon_article['images'];?>" alt="1">

                        <h3 class="mt-4"><?php echo $mon_article['title'];?></h3>


						<p style="color: #777777;"><?php echo $mon_article['descriptions'];?></p>

                        <div class="span d-flex justify-content-between">
                            <span style="color: black; font-size:22px; font-weight: 600;"><?php echo $mon_article['price'];?>€</span>

                            <span style="color: grey; font-size:20px; font-weight: 400;">Stock: <?php echo $mon_article['quantity'];?></span>
                        </div>
                        

                        <div class="p-0 mt-3 btn d-flex justify-content-between">
                            <a class="btn btn-warning btn-sm" href="cartAction.php?action=addToCart&id=<?php echo $mon_article["id"];?>">Ajouter au panier</a>
                            <a class="btn btn-dark btn-sm" href="details-item.php?id=<?php echo $mon_article['id'];?>">Voir détails</a>
                        </div>
                        

                </div>
            <?php endforeach;?>
        
			
</div>