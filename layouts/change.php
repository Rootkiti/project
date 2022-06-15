<?php session_start();
        include "connect.php";
      if(isset($_SESSION["password"]))
      {
        if(isset($_POST["password"]) && isset($_POST["new_password"]) && isset($_POST["pass_renter"]))
        {
             function validate($data)
            {
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            return $data;

            }
            $password = validate($_POST["password"]);
            $new_password = validate($_POST["new_password"]);
            $pass_renter = validate($_POST["pass_renter"]);

             if(empty($password))
             {
                 echo "current password required";
             }
             else if(empty($new_password))
             {
                echo "new password required";
             }
             else if($new_password != $pass_renter)
             {
                echo "new passwords not match";
             }
             else
             {
                 // hashing
                 $password = md5($password);
                 $new_password= md5($new_password);
                 
                 $sql = "SELECT password FROM login WHERE password = :password";
                 $pass = $db->prepare($sql);
                 $pass->execute(array(":password" => $password));
                 $passvalue=$pass->fetch(PDO::FETCH_OBJ);
                 if(@$passvalue->password == $password)
                 {
                    $newpass =$db->prepare( "UPDATE login SET password=? WHERE password= ?");
                    $newpass->execute(array($new_password,$password));
                    echo 'password changed';
                 }
                 else
                 {
                     echo 'incorrect';
                 }
             }
    }
    else{
        echo 'no data provided';
    }

      }



      else
      {
         echo ' u are not allowed to change password';
      }

?>