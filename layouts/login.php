<?php session_start();
include "connect.php";
$error ="";
if(isset($_POST["login"])){
    $email = trim($_POST["email"]);
    $password = strip_tags(trim($_POST["password"]));
    $password = md5($password);
    $query = $db->prepare("SELECT * FROM login WHERE email=? AND password=?");
    $query->execute(array($email,$password));
    $control = $query->fetch(PDO::FETCH_OBJ);

    if($control>0){
        $_SESSION["password"] = $password;
        
    	
        header("location:dashboard.php");
    }else{
        $error="wrong email or password";
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
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <title>ARCHIVE KEEPING SYSTEM</title>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
    <div class="login-div">
        <div class="logo"></div>
        <div class="title">welcome</div>
        <div>
        <?php if(!empty($error)): ?>
          <div class="alert alert-success">
          <?=$error;?>
        </div>
        <?php endif; ?>
        </div>
        <div class="fields">
            <div class="username">
                <input type="email" name="email" value="" class="user-input"
                 placeholder="Email">
            </div>
            <div class="password">
                <input type="password" name="password" value="" class="pass-input"
                 placeholder="password">
            </div>
        </div>
        <button name="login" type="submit" name="password" class="signin-button">Login</button>
        <div class="link">
            <a href="forget.php">Forget password</a>
        </div>
    </div>
    </form>
</body>
</html>