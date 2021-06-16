<?php
   
    // Database connection
    include('config/db.php');
    
    // Error & success messages
    global $success_msg, $email_exist, $emptyError1, $emptyError2, $emptyError3, $emptyError4, $emptyError5;
    

    if(isset($_POST["submit"])) {
        $name     = $_POST["name"];
        $adresse      = $_POST["adresse"];
        $mobile        = $_POST["mobile"];
        $email         = $_POST["email"];
        $password      = $_POST["password"];

        // verify if email exists
        $emailCheck = $connection->query( "SELECT * FROM requests WHERE email = '{$email}' ");
        $rowCount = $emailCheck->fetchColumn();

        // PHP validation
        if(!empty($name) && !empty($adresse) && !empty($mobile)  && !empty($email) && !empty($password)){
            
            // check if user email already exist
            if($rowCount > 0) {
                $email_exist = '
                    <div class="alert alert-danger" role="alert">
                        User with email already exist!
                    </div>
                ';
            } else {

            // Password hash
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $sql = $connection->query("INSERT INTO requests (nom, adresse, tel, email, shadow,date) 
            VALUES ('{$name}', '{$adresse}','{$mobile}', '{$email}', '{$password_hash}', now())");
            
                if(!$sql){
                    die("MySQL query failed!" . mysqli_error($connection));
                } else {
                    $success_msg = '<div class="alert alert-success">
                        User registered successfully!
                </div>';
                
                }
            }
        } else {
            if(empty($name)){
                $emptyError1 = '<div class="alert alert-danger">
                     Name is required.
                </div>';
            }
            if(empty($adresse)){
                $emptyError2 = '<div class="alert alert-danger">
                    Adresse is required.
                </div>';
            }
            if(empty($mobile)){
                $emptyError4 = '<div class="alert alert-danger">
                    Mobile number is required.
                </div>';
            }
            if(empty($email)){
                $emptyError3 = '<div class="alert alert-danger">
                    Email is required.
                </div>';
            }
            if(empty($password)){
                $emptyError5 = '<div class="alert alert-danger">
                    Password is required.
                </div>';
            }            
        }
    }
   
?>