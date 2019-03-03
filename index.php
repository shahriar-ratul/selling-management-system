<?php include 'inc/header.php'; ?>

          <div class="container-fluid">
            <h1 class="mt-4">Welcome to Dashboard

               <?php
                
                  if(isset($name)){
                      echo $name;
                  }

               ?>
          </h1>
          </div>

<?php include 'inc/footer.php'; ?>
