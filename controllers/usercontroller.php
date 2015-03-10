<?php
class UserController{
    public function indexAction(){
        require_once "./views/loginregister.php";
    }

    public function registerAction(){
        //We validate that all form fields are NOT empty
        if(!empty($_POST["fname"]) && !empty($_POST["lname"]) && !empty($_POST["email2"]) && !empty($_POST["password2"]) && !empty($_POST["password3"])){

            //We validate that the passwords match and that the password is at least 4 characters
            if(($_POST["password2"] == $_POST["password3"]) && (strlen($_POST["password2"]) >= 4)){

                //We validate the email string
                if(filter_var($_POST["email2"], FILTER_VALIDATE_EMAIL)){
                    //We has the password
                    $hashPass = password_hash($_POST["password2"], PASSWORD_BCRYPT, array("cost" => 11));

                    //Add to database
                    $db = new PDO("mysql:host=localhost;dbname=chatup", "root", "");
                    $stm = $db->prepare("INSERT INTO users (user_fname, user_lname, user_email, user_pass) VALUES (:fname, :lname, :email2, :password2)");
                    $result = $stm->execute(array(
                        ":fname" => $_POST["fname"],
                        ":lname" => $_POST["lname"],
                        ":email2" => $_POST["email2"],
                        ":password2" => $hashPass
                    ));

                    //If we added without problems we redirect the user
                    if($result){
                        echo "You are now registered - try to log in!";
                        //header("location:../user?msg=ok");
                    }
                    else{
                        echo "user already exists!";
                        //$msg = "user already exists!";
                    }
                }
                else{
                    echo "email is invalid!";
                    //$msg = "email is invalid!";
                }
            }
            else{
                echo "Passwords don't match or less than 4 characters!";
                //$msg = "Passwords don't match or less than 4 characters!";
            }
        }
        else{
            echo "the entire form must be filled!";
            //$msg = "the entire form must be filled!";
        }

        //The $msg from above is displayed in the template
    }

    // asd.com/user/login
    public function loginAction(){
        /*  Gets the hash-password from the db and puts the value inside $hash */
        $db = new PDO("mysql:host=localhost;dbname=chatup", "root", "");
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $stm = $db->prepare("SELECT user_pass FROM users WHERE user_email = :user_email");
        $stm->bindParam(":user_email", $_POST["email1"]);

        $stm->execute();
        $hash = $stm->fetchColumn();

        //verify it by comparing to the given passowrd
        if (password_verify($_POST["password1"], $hash)) {
            $db = new PDO("mysql:host=localhost;dbname=chatup", "root", "");
            $stm = $db->prepare("SELECT * FROM users WHERE user_email = :email1 AND user_pass = :hash");
            $stm->execute(array(
                ":hash" => $hash,
                ":email1" => $_POST["email1"]
            ));

            //If we logged in the person without problems
            if($stm->rowCount() == 1){
                $row = $stm->fetch(PDO::FETCH_ASSOC);

                session_start();
                $_SESSION["status"] = "inloggad";
                $_SESSION["email"] = $row["user_email"];
                $_SESSION["fname"] = $row["user_fname"];
                $_SESSION["lname"] = $row["user_lname"];
                $_SESSION["id"] = $row["user_id"];
                $_SESSION ["current_userid"]=$db->lastInsertId ( );

                header("location:/PHP_171114/chatup/chat");
            }
            else{
                echo "Unable to log you in, no session started!";
            }
        }
        else {
            echo 'Invalid password.';
        }
    }

    public function logoutAction(){
        if(isset($_POST["submit_logout"])){
            session_unset();
            session_destroy();
            header("location:/PHP_171114/chatup");
        }
    }
}