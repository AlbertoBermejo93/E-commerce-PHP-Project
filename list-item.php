<?php require 'list.php'; ?>
<?php require 'header.php'; ?>
<body class="d-flex flex-column h-100">

	<main class="flex-shrink-0">
		<div class="container">

			<h1 class="text-center my-5">Nos produits</h1>

			<?php foreach($mes_articles as $mon_article):?>
				<div class="row mb-3 align-items-center">
					<div class="col-2">
						<img style="width: 180px; height: auto;" src="<?php echo $mon_article['images'];?>" alt="1">
					</div>
					<div class="col-6">
						<h3><?php echo $mon_article['title'];?></h3>
						<p><?php echo $mon_article['descriptions'];?></p>
					</div>
					<div class="col-4 d-flex justify-content-between align-items-center">
						<a class="btn btn-warning" href="read-item.php?id=<?php echo $mon_article['id'];?>">Voir détails</a>
					
						<a class="btn btn-secondary" href="edit-item.php?id=<?php echo $mon_article['id'];?>">Modifier ce produit</a>
					
						<a class="btn btn-dark" href="list-item.php?delete=<?php echo $mon_article['id'];?>">Supprimer</a>
					</div>
				</div>

			<?php endforeach;?>
		</div>
	</main>

   <?php require 'footer.php'; ?>