<?php

include('../includes/connection.php');
$zz = $_POST['id'];
$pc = $_POST['prodcode'];
$pname = $_POST['prodname'];
$desc = $_POST['description'];
$pr = $_POST['price'];
$cat = $_POST['category'];

$query = 'UPDATE product SET NAME="'.$pname.'",
    DESCRIPTION="'.$desc.'", PRICE="'.$pr.'", CATEGORY_ID ="'.$cat.'" WHERE
    PRODUCT_CODE ="'.$pc.'"';
$result = mysqli_query($db, $query) or die(mysqli_error($db));

?>  
<script type="text/javascript">
    alert("Produit mis à jour avec succès.");
    window.location = "product.php";
</script>
