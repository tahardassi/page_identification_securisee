<?php
    class Session {
        private $username;
        private $passwoerd;
        private $conn;


        public function __construct($username, $passwoerd, $connection){
            $this->username = $username;
            $this->password = $passwoerd;
            $this->connection = $connection;
        }
        

        public function exist_user(){
            $sql = "SELECT * FROM users WHERE user = '$this->username'";
            $exist_user = mysqli_query($this->connection, $sql);
            return mysqli_num_rows($exist_user)? TRUE : FALSE;
        }
    }
?>