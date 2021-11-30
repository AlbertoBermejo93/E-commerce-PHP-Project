<?php 
    require_once __DIR__.'/../config/config.php';
    if(!empty($_GET['u'])){
        $token = htmlspecialchars(base64_decode($_GET['u']));
        $check = $bdd->prepare('SELECT * FROM password_recover WHERE token_user = ?');
        $check->execute(array($token));
        $row = $check->rowCount();

        if($row == 0){
            echo "Lien non valide";
            die();
        }
    }
?>
<?php require 'pass_header.php'; ?>
        <div class="container">
          <div class="col-11 d-flex justify-content-center lol">
              <div class="card w-75 text-center m-4 shadow p-3 mb-5 bg-white rounded">
                <div class="card-body">
                  <h4 class="card-title p-3">Réinitialiser mon mot de passe</h4>
                    <div class="form-group">
                        <form action="password_change_post.php" method="POST">
                            <input type="hidden" name="token" value="<?php echo base64_decode(htmlspecialchars($_GET['u'])); ?>"  />
                            <input type="password" name="password" class="form-control" placeholder="Mot de passe" required />
                            <br />
                            <input type="password" name="password_repeat" class="form-control" placeholder="Répétez le mot de passe" required />
                            <button type="submit" class="btn btn-warning btn-lg m-3">Modifier</button>
                        </form>
                    </div>
                </div>
              </div>
          </div>
      </div>

      <style>
        body {
          background-image: url(https://images.unsplash.com/photo-1445205170230-053b83016050?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1471&q=80);
          background-size: cover;
          background-repeat: no-repeat;
        }

        .lol{
          margin-top: 190px;
          margin-bottom: 205px;
        }
      </style>


<?php require '../pass_footer.php'; ?>