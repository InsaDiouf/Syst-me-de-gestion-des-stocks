<?php

include_once '../includes/connection.php';
// Vérification de l'action à effectuer
if (!isset($_GET['do']) || $_GET['do'] != 1) {
    // Switch pour les différents types d'actions possibles
    switch ($_GET['type']) {
        // Cas de suppression d'un fournisseur
        case 'supplier':
            // Requête pour supprimer le fournisseur avec l'ID donné
            $query = 'DELETE FROM supplier WHERE SUPPLIER_ID = ' . $_GET['id'];
            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            ?>
            <script type="text/javascript">
                alert("Fournisseur supprimé avec succès.");  // Message de confirmation de suppression
                window.location = "supplier.php";  // Redirection vers la page des fournisseurs
            </script>
            <?php
            break;
    }
}
?>
