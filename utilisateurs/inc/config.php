<?php
    $bdd = new PDO('mysql:host=localhost;dbname=eshop;charset=utf8mb4', 'root', '');

    $categories= [
        
        't-shirt' 		=> 'T-shirts',
        'sweaters' 		=> 'Pulls',
        'jeans'	    	=> 'Pantalons',
        'accessories' 	=> 'Accessoires',
        'shoes' 		=> 'Chaussures',
    ];

?>