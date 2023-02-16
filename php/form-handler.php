<?php
    // Inclure le fichier de configuration contenant les identifiants de connexion
    require_once '../config.php';
    if (isset($_POST['submit_button'])) {
        // Récupération des données du formulaire
        $username = $_POST["username"];
        $password = $_POST["password"];

        $hash =  password_hash($password, PASSWORD_BCRYPT);


        $conn = mysqli_connect(SERVERNAME, DBUSERNAME, DBPASSWORD, DBNAME);
        // Vérification de la connexion
        if (!$conn) {
            die("Connexion échouée : " . mysqli_connect_error());
        }


        // Escape the username before using it in an SQL query
        $escaped_username = mysqli_real_escape_string($conn, $username); 

        $sql = "SELECT * FROM users WHERE user = '$escaped_username'";
        $exist_user = mysqli_query($conn, $sql);
        

        if ($_POST['submit_button'] == "SignIn") {
            // handle form submission for soumettre

            if(mysqli_num_rows($exist_user) == 1){

                $pdo = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, DBUSERNAME, DBPASSWORD );
                $stmt = $pdo->prepare("SELECT password FROM users WHERE user = :username");
                $stmt->bindParam(':username', $escaped_username);
                $stmt->execute();
                $hash = $stmt->fetchColumn();
               
                if(password_verify($password, $hash)){
                    echo "<p>Bonjour ".$username. "!</p>";
                    echo "<p>Bonjour ".$escaped_username. "!</p>";

                }
                else{
                    echo "Mot de passe incorrect";

                }
            }
            else{
                echo "Enregistrez-vous ";
            }

        } elseif ($_POST['submit_button'] == "SignUp"){
            // handle form submission for s'inscrire

            if (mysqli_num_rows($exist_user)==1) {
                // user already exists
                echo "l'utlisteur existe déjà.";

            } else {
                // Hachage du mot de passe avec bcrypt
                //$options = ['cost' => 12];
                //$password = password_hash($password, PASSWORD_BCRYPT, $options);

                // Préparation de la requête SQL d'insertion
                $sql = "INSERT INTO users (user, password)
                VALUES ('$escaped_username', '$hash')";

                // Exécution de la requête SQL
                if (mysqli_query($conn, $sql)) {
                    echo "Nouvel utilisateur ajouté avec succès.";
                    
                } else {
                    echo "Erreur lors de l'ajout de l'utilisateur : " . mysqli_error($conn);
                }

            }
        
        }
        echo "<a href=\"../index.php\">Cliquez ici pour retourner au formulaire</a>";
        // Fermeture de la connexion
        mysqli_close($conn);
    }

?>