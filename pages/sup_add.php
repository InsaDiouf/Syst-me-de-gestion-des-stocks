<?php
include_once '../includes/connection.php';
include_once '../includes/sidebar.php'; 

// Récupérer le type d'utilisateur pour vérifier les droits d'accès
$query = 'SELECT ID, t.TYPE
          FROM users u
          JOIN type t ON t.TYPE_ID=u.TYPE_ID WHERE ID = '.$_SESSION['MEMBER_ID'];
$result = mysqli_query($db, $query) or die (mysqli_error($db));

while ($row = mysqli_fetch_assoc($result)) {
    $Aa = $row['TYPE'];
    if ($Aa == 'User') {
        echo '<script type="text/javascript">
                alert("Page restreinte ! Vous serez redirigé vers le POS");
                window.location = "pos.php";
              </script>';
        exit();
    }
}

// Récupérer les titres de poste pour le menu déroulant (bien que cela semble inutilisé dans le formulaire)
$sql = "SELECT DISTINCT JOB_TITLE, JOB_ID FROM job ORDER BY JOB_ID ASC";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$opt = "<select class='form-control' name='jobs'>
        <option>Sélectionner le poste</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $opt .= "<option value='".$row['JOB_ID']."'>".$row['JOB_TITLE']."</option>";
}
$opt .= "</select>";
?>

<script src="chemin/vers/city.js"></script>
<script>
window.onload = function() {  
  var $ = new City();
  $.showProvinces("#province");
  $.showCities("#city");

  console.log($.getProvinces());
  console.log($.getAllCities());
  console.log($.getCities("Batangas")); 
}
</script>

<center>
<div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">Ajouter un fournisseur</h4>
    </div>
    <a href="supplier.php?action=add" type="button" class="btn btn-primary bg-gradient-primary">Retour</a>
    <div class="card-body">
        <div class="table-responsive">
            <form role="form" method="post" action="sup_transac.php?action=add">
                <div class="form-group">
                    <input class="form-control" placeholder="Nom de l'entreprise" name="companyname" required>
                </div>
                <div class="form-group">
                    <select class="form-control" id="province" name="province" required>
                        <option value="" disabled selected>Sélectionner la province</option>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" id="city" name="city" required>
                        <option value="" disabled selected>Sélectionner la ville</option>
                    </select>
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Numéro de téléphone" name="phonenumber" required>
                </div>
                <hr>
                <button type="submit" class="btn btn-success btn-block">
                    <i class="fa fa-check fa-fw"></i> Enregistrer
                </button>
                <button type="reset" class="btn btn-danger btn-block">
                    <i class="fa fa-times fa-fw"></i> Réinitialiser
                </button>
            </form>  
        </div>
    </div>
</div>
</center>

<?php
include '../includes/footer.php';
?>
