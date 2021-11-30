<?php require 'pass_header.php'; ?>
      <div class="container lol">
          <div class="col-11">
              <div class="card text-center m-4 shadow p-3 mb-5 bg-white rounded">
                <div class="card-body">
                  <img class="mb-4" src="../../assets/logo2.png" alt="">
                  <h4 class="card-title p-3">J'ai oublié mon mot de passe</h4>
                    <div class="form-group">
                        <form action="src/forgot.php" method="POST">
                            <input type="email" class="form-control" name="email" placeholder="Email" autocomplete="off" required />
                            <button type="submit" class="btn btn-warning btn-lg m-3">Envoyer</button>
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
          margin-top: 220px;
          margin-bottom: 246px;
          width: 800px;
        }
      </style>

<?php require 'pass_footer.php'; ?>