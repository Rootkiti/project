<?php 
include "connect.php";
$error ="";
if(isset($_POST["forget"])){
    $ans = $_POST["answer"];
    $q = $_POST["question"];
    $query = $db->prepare("SELECT * FROM recovery WHERE question=?");
    $query->execute(array($q));
    $control = $query->fetch(PDO::FETCH_OBJ);

    if($control->answer == $ans){
        header("location:forgetcontinue.php");
    }else{
        $error="wrong Answer provided";
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
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
    <div class="login-div">
        <div class="logo"></div>
        <div class="title">Answer Recovery Question</div>
        <div>
        <?php if(!empty($error)): ?>
          <div class="alert alert-success">
          <?=$error;?>
        </div>
        <?php endif; ?>
        <?php
              $query=$db->prepare("SELECT * FROM recovery where id");
              $query->execute(array());
              $list=$query->fetchAll(PDO::FETCH_OBJ);
              foreach ($list as $list2) { ?>
        
        </div>
        <div class="fields">
            <div class="">
                <input type="email" name="question" value="<?= $list2->question;?>" class="user-input"
                readonly required="required">
                 
            </div>
            <?php }?>
            <div class="password" required="required">
                <input type="text" name="answer" value="" class="pass-input"
                 placeholder="Answer" required="required">
            </div>
        </div>
        <button name="forget" type="submit"  class="signin-button">Next</button>
        <div class="link">
        <a href="login.php">back</a>
        </div>
        
    </div>
    </form>
</body>
</html>