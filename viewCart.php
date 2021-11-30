<?php 
// Initialize shopping cart class 
include_once 'panier/Cart.class.php'; 
$cart = new Cart; 
?>


<script>
function updateCartItem(obj,id){
    $.get("cartAction.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
        if(data == 'ok'){
            location.reload();
        }else{
            alert('Cart update failed, please try again.');
        }
    });
}
</script>
<?php require 'header.php' ?>
<div class="container" style="height:58.5vh">
    <h1>Panier</h1>
    <div class="row">
        <div class="cart">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="45%">Produit</th>
                                <th width="10%">Prix</th>
                                <th width="15%">Quantité</th>
                                <th class="text-right" width="20%">Total</th>
                                <th width="10%"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if($cart->total_items() > 0){ 
                                // Get cart items from session 
                                $cartItems = $cart->contents(); 
                                foreach($cartItems as $item){ 
                            ?>
                            <tr>
                                <td><?php echo $item["name"]; ?></td>
                                <td><?php echo '€'.$item["price"].' EUR'; ?></td>
                                <td><input class="form-control" type="number" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item['rowid']; ?>')"/></td>
                                <td class="text-right"><?php echo '€'.$item["subtotal"].' EUR'; ?></td>
                                <td class="text-right"><button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')?window.location.href='cartAction.php?action=removeCartItem&id=<?php echo $item['rowid']; ?>':false;"><i class="itrash"></i>Retirer</button> </td>
                            </tr>
                            <?php } }else{ ?>
                            <tr><td colspan="5"><p>Votre panier est vide.....</p></td>
                            <?php } ?>
                            <?php if($cart->total_items() > 0){ ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><strong>Total</strong></td>
                                <td class="text-right"><strong><?php echo '€'.$cart->total().' EUR'; ?></strong></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col mb-2">
                <div class="row">
                    <div class="col-sm-12  col-md-6">
                        <a href="home.php" class="btn btn-block btn-dark">Continuer le shopping</a>
                        <a href="#" class="btn btn-block btn-warning">Passer au paiement</a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
<?php
require 'footer.php'
?>