
<?php 
include "connect.php";
if(isset($_POST["forgetfinish"])){
    $password = $_POST["password"];
    $c_password = $_POST["cpassowrd"];

    // hashing
    $password =  md5( $password);
    $c_password = md5( $c_password);

    if( $password == $c_password )
    {
        $query = $db->prepare("UPDATE login SET password=:password");
        $ok=$query->execute(array(':password' => $password));
        if($ok)
        {
            header("location:login.php");
        }

    }
    else{
        $error="passwords mismatch";
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
        <div class="title">enter new password</div>
        <div>
        <?php if(!empty($error)): ?>
          <div class="alert alert-success">
          <?=$error;?>
        </div>
        <?php endif; ?>
        
        
        </div>
        <div class="fields">
            <div class="password" required="required">
                <input type="password" name="password" value="" class="pass-input"
                 placeholder=" new password" required="required">
            </div>
            <div class="password" required="required">
                <input type="password" name="cpassowrd" value="" class="pass-input"
                 placeholder=" confirm password" required="required">
            </div>
        </div>
        <button name="forgetfinish" type="submit"  class="signin-button">finish</button>
        <div class="link">
        <a href="forgetcontinue.php">back</a>
        </div>
    </div>
    </form>
</body>
</html>