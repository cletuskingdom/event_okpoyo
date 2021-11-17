<?php
    require_once("DBconnection.php");

    class Fetch extends DbConnection{
        Public function registerUser($firstname, $lastname, $username, $password, $avatar, $type){
            $sql = "INSERT INTO users (firstname, lastname, username, password, avatar, type)
            VALUES (:firstname, :lastname, :username, :password, :avatar, :type)";

            $query = $this->connection->prepare($sql);
            $exec = $query->execute([':firstname' => $firstname, ':lastname' => $lastname, ':username' => $username, ':password' => $password, ':avatar' => $avatar, ':type' => $type,]);
            
            if ($query->errorCode() == 0) {
                return ['status'=>1];
            } else {
                return ['status'=>0, 'message'=>$query->errorInfo()];
            }
        }
    }
  $fetch = new Fetch;