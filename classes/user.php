<?php
require_once "Database.php";

// inherit the database class
class User extends Database{

    public function store($request){
        $first_name = $request['first_name'];
        $last_name = $request['last_name'];
        $username = $request['username'];
        $password = $request['password'];

        // make password hash // encryption
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `users` (`first_name`,`last_name`,`username`,`password`) VALUES('$first_name','$last_name','$username','$password')";

        if($this -> conn -> query($sql)){
            header('location:../views');
            exit;
        }else{
            die("Error creating user: ".$this -> conn -> error);
        }

    }

    public function login($request){
        $username = $request['username'];
        $password = $request['password'];

        $sql = "SELECT * FROM `users` WHERE `username` = '$username'";

        if($result = $this -> conn -> query($sql)){
            $user = $result -> fetch_assoc();
            if(password_verify($password,$user['password'])){

                session_start();
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['fullname'] = $user['first_name']." " .$user['last_name'];

                header('location: ../views/dashboard.php');
                exit;

            }else{
                die('password is incorrect');
            }
        
        }else{
            die('Username Not Found.'.$this -> conn -> error);
        }

    }
    
    public function logout(){
        session_start();
        session_unset();
        session_destroy();

        header('location: ../views');
        exit;
    }

    public function getAllUsers(){
        $sql = "SELECT * FROM `users`";
        if($result = $this -> conn -> query($sql)){
            return $result;
        }else{
            die("Error retrieving all users: ".$this -> conn -> error);
        }
    }

    public function getUser(){
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM `users` WHERE `id` = '$id'";

        if($result = $this -> conn -> query($sql)){
            return $result -> fetch_assoc();
        }else{
            die('Error Retrieving User:' .$this -> conn -> error);
        }
    }

    public function update($request,$files){
        session_start();
        $first_name = $request['first_name'];
        $last_name = $request['last_name'];
        $username = $request['username'];
        $photo = $files['photo']['name'];
        $tmp_name = $files['photo']['tmp_name'];
        $id = $_SESSION['id'];
       
        $sql = "UPDATE `users` SET `first_name` = '$first_name',`last_name` = '$last_name',`username` = '$username' WHERE `id` = '$id'";

        if($this -> conn -> query($sql)){
            // success
            // updating session variables
            $_SESSION['username'] = $username;
            $_SESSION['fullname'] = $first_name . " " . $last_name;

            if($photo){
                // Yes
                $sql2 = "UPDATE `users` SET `photo` = '$photo' WHERE `id` = '$id'";

                if($this -> conn -> query($sql2)){
                    //success
                    $destination = "../assets/images/$photo";

                    // moving the image to the assets
                    if(move_uploaded_file($tmp_name,$destination)){
                        // success
                        header('location: ../views/dashboard.php');
                        exit;
                    }else{
                        // fail
                        die("Error moving the photo");
                    }

                }else{
                    // fail
                    die("Error Uploading photo:" .$this -> conn -> error);
                }

            }else{
                // No
                header('location: ../views/dashboard.php');
                exit;
            }
        }else{
            // fail
            die("Error Updating user:" .$this -> conn -> error);
        }
    }

    public function delete(){
        session_start();
        $id = $_SESSION['id'];
        $sql = "DELETE FROM `users` WHERE `id` = '$id'";
        if($this -> conn -> query($sql)){
            $this->logout();
        }else{
            die('Error delete user:' .$this -> conn -> error);
        }
    }
}




?>