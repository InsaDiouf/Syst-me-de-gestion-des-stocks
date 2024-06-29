<?php

include_once '../includes/connection.php';
?>
          <!-- Contenu de la Page -->
          <div class="col-lg-12">
            <?php
              $name = $_POST['companyname'];
              $prov = $_POST['province'];
              $cit = $_POST['city'];
              $phone = $_POST['phonenumber'];
        
              switch($_GET['action']){
                case 'add':     
                    // Insérer une nouvelle entrée dans la table location
                    $query = "INSERT INTO location
                              (LOCATION_ID, PROVINCE, CITY)
                              VALUES (Null,'{$prov}','{$cit}')";
                    mysqli_query($db,$query)or die ('Erreur lors de la mise à jour de la localisation dans la base de données');

                    // Insérer une nouvelle entrée dans la table supplier
                    $query2 = "INSERT INTO supplier
                              (SUPPLIER_ID, COMPANY_NAME, LOCATION_ID, PHONE_NUMBER)
                              VALUES (Null,'{$name}',(SELECT MAX(LOCATION_ID) FROM location),'".$phone."')";
                    mysqli_query($db,$query2)or die ('Erreur lors de la mise à jour du fournisseur dans la base de données');
                break;
              }
            ?>
              <script type="text/javascript">window.location = "supplier.php";</script>
          </div>

<?php
include'../includes/footer.php';
?>
