<?php
    require_once('DBconnection.php');
    class insertData extends DbConnection {
        public function register($fname, $lname, $username, $password, $avatar, $type) {
            $sql = "INSERT INTO users(fname, lname, username, password, avatar, type) VALUES(:fname, :lname, :username, :password, :avatar, :type)";

            $query = $this->connection->prepare($sql);
            $exec = $query->execute(array(':fname'=>$fname, ':lname'=>$lname, ':username'=>$username, ':password'=>$password,':avatar'=>$avatar, ':type'=>$type));
            
            if ($query->errorCode() == 0) {
                return ['status'=>1];
            } else {
                return ['status'=>0, 'message'=>$query->errorInfo()];
            } 
        }
        
    }
?>