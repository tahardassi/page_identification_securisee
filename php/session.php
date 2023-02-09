<?php
    class Session {
        private $username;
        private $passwoerd;

        public function __construct($username, $passwoerd){
            $this->username = $username;
            $this->password = $passwoerd;
        }
        
        public function etablish_conn($servername, $dbusername, $dbpassword, $dbname){
            $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
            // Vérification de la connexion
            if (!$conn) {
                die("Connexion échouée : " . mysqli_connect_error());
            }
            return $conn;
        }
    }
?>