<?php
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "root";
    $dbname = "usersdb";
    if (isset($_POST['submit_button'])) {
        // Récupération des données du formulaire
        $username = $_POST["username"];
        $password = $_POST["password"];

        $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
        // Vérification de la connexion
        if (!$conn) {
            die("Connexion échouée : " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM users WHERE user = '$username'";
        $exist_user = mysqli_query($conn, $sql);
        

        if ($_POST['submit_button'] == "SignIn") {
            // handle form submission for soumettre
            if($exist_user){
                // Hachage du mot de passe avec bcrypt
                $options = ['cost' => 12];
                $password = password_hash($password, PASSWORD_BCRYPT, $options);
                $sql = "SELECT * FROM users WHERE user='$username' AND password='$password'";
                $right_password = mysqli_query($conn, $sql);
                if($right_password){
                    echo "<p>Bonjour ".$username. "!</p>";
                }
            }

        } elseif ($_POST['submit_button'] == "SignUp"){
            // handle form submission for s'inscrire

            if (mysqli_num_rows($exist_user)) {
                // user already exists
                echo "Error: User already exists.";
            } else {
                // Hachage du mot de passe avec bcrypt
                $options = ['cost' => 12];
                $password = password_hash($password, PASSWORD_BCRYPT, $options);

                // Préparation de la requête SQL d'insertion
                $sql = "INSERT INTO users (user, password)
                VALUES ('$username', '$password')";

                // Exécution de la requête SQL
                if (mysqli_query($conn, $sql)) {
                    echo "Nouvel utilisateur ajouté avec succès.";
                    
                } else {
                    echo "Erreur lors de l'ajout de l'utilisateur : " . mysqli_error($conn);
                }

            }
            echo "<a href=\"../html/index.html\">Cliquez ici pour retourner au formulaire</a>";
            // Fermeture de la connexion
            mysqli_close($conn);
        }
    }
?>