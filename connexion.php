  <?php
  
  $bdd = new PDO('mysql:host=localhost;dbname=backend-angular-dev2', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,  
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));