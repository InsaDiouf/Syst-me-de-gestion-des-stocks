<?php
include_once '../includes/connection.php';
include_once '../includes/sidebar.php'; 
  $query = 'SELECT ID, t.TYPE
            FROM users u
            JOIN type t ON t.TYPE_ID=u.TYPE_ID WHERE ID = '.$_SESSION['MEMBER_ID'].'';
  $result = mysqli_query($db, $query) or die (mysqli_error($db));
  
  while ($row = mysqli_fetch_assoc($result)) {
            $typeUtilisateur = $row['TYPE'];
                   
  if ($typeUtilisateur == 'User'){
?>
  <script type="text/javascript">
    // puis il sera redirigé
    alert("Page restreinte! Vous serez redirigé vers POS");
    window.location = "pos.php";
  </script>
<?php
  }           
}
 $query = 'SELECT *, FIRST_NAME, LAST_NAME, PHONE_NUMBER, EMPLOYEE, ROLE
              FROM transaction T
              JOIN customer C ON T.`CUST_ID`=C.`CUST_ID`
              JOIN transaction_details tt ON tt.`TRANS_D_ID`=T.`TRANS_D_ID`
              WHERE TRANS_ID ='.$_GET['id'];
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
        while ($row = mysqli_fetch_assoc($result)) {
          $prenom = $row['FIRST_NAME'];
          $nom = $row['LAST_NAME'];
          $telephone = $row['PHONE_NUMBER'];
          $date = $row['DATE'];
          $idTransaction = $row['TRANS_D_ID'];
          $montantCash = $row['CASH'];
          $sousTotal = $row['SUBTOTAL'];
          $moinsTVA = $row['LESSVAT'];
          $netTVA = $row['NETVAT'];
          $ajoutTVA = $row['ADDVAT'];
          $totalGeneral = $row['GRANDTOTAL'];
          $employe = $row['EMPLOYEE'];
          $role = $row['ROLE'];
        }
?>
            
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="form-group row text-left mb-0">
                <div class="col-sm-9">
                  <h5 class="font-weight-bold">
                    Ventes et Inventaire
                  </h5>
                </div>
                <div class="col-sm-3 py-1">
                  <h6>
                    Date: <?php echo $date; ?>
                  </h6>
                </div>
              </div>
<hr>
              <div class="form-group row text-left mb-0 py-2">
                <div class="col-sm-4 py-1">
                  <h6 class="font-weight-bold">
                    <?php echo $prenom; ?> <?php echo $nom; ?>
                  </h6>
                  <h6>
                    Téléphone: <?php echo $telephone; ?>
                  </h6>
                </div>
                <div class="col-sm-4 py-1"></div>
                <div class="col-sm-4 py-1">
                  <h6>
                    Transaction #<?php echo $idTransaction; ?>
                  </h6>
                  <h6 class="font-weight-bold">
                    Encodé par: <?php echo $employe; ?>
                  </h6>
                  <h6>
                    <?php echo $role; ?>
                  </h6>
                </div>
              </div>
          <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Produits</th>
                <th width="8%">Quantité</th>
                <th width="20%">Prix</th>
                <th width="20%">Sous-total</th>
              </tr>
            </thead>
            <tbody>
<?php  
           $query = 'SELECT *
                     FROM transaction_details
                     WHERE TRANS_D_ID ='.$idTransaction;
            $result = mysqli_query($db, $query) or die (mysqli_error($db));
            while ($row = mysqli_fetch_assoc($result)) {
              $sousTotalProduit =  $row['QTY'] * $row['PRICE'];
                echo '<tr>';
                echo '<td>'. $row['PRODUCTS'].'</td>';
                echo '<td>'. $row['QTY'].'</td>';
                echo '<td>'. $row['PRICE'].'</td>';
                echo '<td>'. $sousTotalProduit.'</td>';
                echo '</tr> ';
                        }
?>
            </tbody>
          </table>
            <div class="form-group row text-left mb-0 py-2">
                <div class="col-sm-4 py-1"></div>
                <div class="col-sm-3 py-1"></div>
                <div class="col-sm-4 py-1">
                  <h4>
                    Montant en espèces: FCFA <?php echo number_format($montantCash, 2); ?>
                  </h4>
                  <table width="100%">
                    <tr>
                      <td class="font-weight-bold">Sous-total</td>
                      <td class="text-right">FCFA <?php echo $sousTotal; ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Moins TVA</td>
                      <td class="text-right">FCFA <?php echo $moinsTVA; ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Net de TVA</td>
                      <td class="text-right">FCFA <?php echo $netTVA; ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Ajouter TVA</td>
                      <td class="text-right">FCFA <?php echo $ajoutTVA; ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Total</td>
                      <td class="font-weight-bold text-right text-primary">FCFA <?php echo $totalGeneral; ?></td>
                    </tr>
                  </table>
                </div>
                <div class="col-sm-1 py-1"></div>
              </div>
            </div>
          </div>


<?php
include'../includes/footer.php';
?>
