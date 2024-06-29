<?php
// Avant de stocker les informations de notre membre, nous devons d'abord démarrer la session
session_start();

// Créez une nouvelle fonction pour vérifier si la variable de session member_id est définie
if (!function_exists('logged_in')) {
    function logged_in() {
        return isset($_SESSION['MEMBER_ID']);
    }
}

// Cette fonction redirige vers login.php si la session member n'est pas définie
if (!function_exists('confirm_logged_in')) {
    function confirm_logged_in() {
        if (!logged_in()) {
?>
            <script type="text/javascript">
                window.location = "login.php";
            </script>
<?php
        }
    }
}
?>
