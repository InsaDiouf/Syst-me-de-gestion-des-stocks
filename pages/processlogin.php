<?php
require('../includes/connection.php');
require('session.php');

if (isset($_POST['btnlogin'])) {
  $users = trim($_POST['user']);
  $upass = trim($_POST['password']);
  $h_upass = sha1($upass);

  if ($upass == ''){
     ?>    
     <script type="text/javascript">
        alert("Le mot de passe est manquant!");
        window.location = "login.php";
     </script>
     <?php
  } else {
    // créer une déclaration SQL             
    $sql = "SELECT ID, e.FIRST_NAME, e.LAST_NAME, e.GENDER, e.EMAIL, e.PHONE_NUMBER, j.JOB_TITLE, l.PROVINCE, l.CITY, t.TYPE
            FROM `users` u
            JOIN `employee` e ON e.EMPLOYEE_ID = u.EMPLOYEE_ID
            JOIN `location` l ON e.LOCATION_ID = l.LOCATION_ID
            JOIN `job` j ON e.JOB_ID = j.JOB_ID
            JOIN `type` t ON t.TYPE_ID = u.TYPE_ID
            WHERE `USERNAME` = '" . $users . "' AND `PASSWORD` = '" . $h_upass . "'";
    
    $result = $db->query($sql);

    if ($result) {
        // obtenir le nombre de résultats basé sur la déclaration SQL
        // vérifier le nombre de résultats, s'il est égal à un   
        // S'il y a un résultat
        if ($result->num_rows > 0) {
            // stocker le résultat dans un tableau et le passer à la variable found_user
            $found_user = mysqli_fetch_array($result);
            // remplir le résultat dans la variable de session
            $_SESSION['MEMBER_ID'] = $found_user['ID']; 
            $_SESSION['FIRST_NAME'] = $found_user['FIRST_NAME']; 
            $_SESSION['LAST_NAME'] = $found_user['LAST_NAME'];  
            $_SESSION['GENDER'] = $found_user['GENDER'];
            $_SESSION['EMAIL'] = $found_user['EMAIL'];
            $_SESSION['PHONE_NUMBER'] = $found_user['PHONE_NUMBER'];
            $_SESSION['JOB_TITLE'] = $found_user['JOB_TITLE'];
            $_SESSION['PROVINCE'] = $found_user['PROVINCE']; 
            $_SESSION['CITY'] = $found_user['CITY']; 
            $_SESSION['TYPE'] = $found_user['TYPE'];
            $AAA = $_SESSION['MEMBER_ID'];

            // cette partie est la vérification si admin ou utilisateur
            if ($_SESSION['TYPE'] == 'Admin') {
                ?>    
                <script type="text/javascript">
                    // il sera alors redirigé vers index.php
                    alert("<?php echo $_SESSION['FIRST_NAME']; ?> Bienvenue!");
                    window.location = "index.php";
                </script>
                <?php        
            } elseif ($_SESSION['TYPE'] == 'User') {
                ?>    
                <script type="text/javascript">
                    // il sera alors redirigé vers pos.php
                    alert("<?php echo $_SESSION['FIRST_NAME']; ?> Bienvenue!");
                    window.location = "pos.php";
                </script>
                <?php        
            }
        } else {
            // S'il n'y a pas de résultat
            ?>
            <script type="text/javascript">
                alert("Nom d'utilisateur ou mot de passe non enregistré! Contactez votre administrateur.");
                window.location = "index.php";
            </script>
            <?php
        }
    } else {
        echo "Erreur: " . $sql . "<br>" . $db->error;
    }
  }       
} 

$db->close();
?>
