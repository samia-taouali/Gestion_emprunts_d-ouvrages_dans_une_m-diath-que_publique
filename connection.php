<?php
// informations de connexion à la base de données
$servername = "localhost";
$username = "nom_utilisateur";
$password = "mot_de_passe";
$dbname = "nom_de_la_base_de_données";

// création de la connexion
$conn = mysqli_connect($servername, $username, $password, $dbname);

// vérification de la connexion
if (!$conn) {
    die("La connexion a échoué: " . mysqli_connect_error());
}

// vérification des données d'authentification
if (isset($_POST['nickname']) && isset($_POST['password'])) {
    $nickname = mysqli_real_escape_string($conn, $_POST['nickname']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // requête pour vérifier si l'utilisateur existe dans la base de données
    $sql = "SELECT * FROM users WHERE nickname = '$nickname'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // utilisateur trouvé, vérification du mot de passe
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            // mot de passe correct, utilisateur authentifié
            echo "Authentification réussie";
        } else {
            // mot de passe incorrect
            echo "Mot de passe incorrect";
        }
    } else {
        // utilisateur non trouvé
        echo "Nom d'utilisateur incorrect";
    }
}

// fermeture de la connexion
mysqli_close($conn);
?>
