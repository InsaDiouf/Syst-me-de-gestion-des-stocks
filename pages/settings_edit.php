<?php
include('../includes/connection.php');
require_once('session.php');

// Récupérer les données du formulaire
$zz = $_POST['id'];
$a = $_POST['firstname'];
$b = $_POST['lastname'];
$c = $_POST['gender'];
$d = $_POST['username'];
$e = $_POST['password'];
$f = $_POST['email'];
$g = $_POST['phone'];
$i = $_POST['hireddate'];
$j = $_POST['province'];
$k = $_POST['city'];

// Mettre à jour les informations de l'utilisateur
$query = 'UPDATE users u 
            JOIN employee e ON e.EMPLOYEE_ID=u.EMPLOYEE_ID
            JOIN location l ON l.LOCATION_ID=e.LOCATION_ID
            SET e.FIRST_NAME = ?, e.LAST_NAME = ?, e.GENDER = ?, u.USERNAME = ?, u.PASSWORD = sha1(?), 
                e.EMAIL = ?, l.PROVINCE = ?, l.CITY = ?, e.PHONE_NUMBER = ?, e.HIRED_DATE = ?
            WHERE u.ID = ?';
$stmt = $db->prepare($query);
$stmt->bind_param('ssssssssssi', $a, $b, $c, $d, $e, $f, $j, $k, $g, $i, $zz);

if ($stmt->execute()) {
    $stmt->close();
    // Redirection en fonction du type d'utilisateur
    if ($_SESSION['TYPE'] == 'Admin') {
        echo '<script type="text/javascript">
                alert("You\'ve updated your account successfully.");
                window.location = "index.php";
              </script>';
    } elseif ($_SESSION['TYPE'] == 'User') {
        echo '<script type="text/javascript">
                alert("You\'ve updated your account successfully.");
                window.location = "pos.php";
              </script>';
    }
} else {
    die(mysqli_error($db));
}
?>

