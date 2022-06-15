<?php 
include "connect.php";
$error ="";
if(isset($_POST["forgetcontinue"])){
    $c_email = $_POST["email"];
    $query = $db->prepare("SELECT email FROM login WHERE email=?");
    $query->execute(array($c_email));
    $control = $query->fetch(PDO::FETCH_OBJ);

    if(@$control->email == $c_email){
        header("location:forgetfinish.php");
    }else{
        $error="wrong email";
        header("refresh:2");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>ARCHIVE KEEPING SYSTEM</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

<!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
    <div class="login-div">
        <div class="logo"></div>
        <div class="title">Provide Your Login Email</div>
        <div>
        <?php if(!empty($error)): ?>
          <div class="alert alert-success">
          <?=$error;?>
        </div>
        <?php endif; ?>
        
        
        </div>
        <div class="fields">
            <div class="password" required="required">
                <input type="email" name="email" value="" class="pass-input"
                 placeholder=" Current Email" required="required">
            </div>
        </div>
        <button name="forgetcontinue" type="submit"  class="signin-button">Next</button>
        <div class="link">
        <a href="forget.php">back</a>
        </div>
    </div>
    </form>
</body>
</html>