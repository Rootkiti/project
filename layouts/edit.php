<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/edit.css">
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

<!--       ##################  form ######################## --> 
<div class="form-container">
          <form  method="POST" enctype="multipart/form-data">
            <div>
            <?php if(!empty($error)): ?>
          <div class="alert alert-success">
          <?=$error;?>
        </div>
        <?php endif; ?>
            </div>
          <?php
include "connect.php";
$message = "";
if(isset($_POST["submit"]))
{
  $id = $_GET['id'];
  $dc = $_POST["documentCode"];
  $imp = $_POST["impamvu"];
  $fn = $_POST["fname"];
  $ln = $_POST["lname"];
  $phn = $_POST["phone"];
  $idn = $_POST["idNumber"];
  $amt = $_POST["amount"];

  $slq = "UPDATE archives SET documentCode= :dc, impamvu= :imp, fname= :fn, lname= :ln, phone= :phn, idNumber= :idn, amount= :amt WHERE id= :id";
  $query=$db->prepare($slq);
  $query->execute(array(":dc"=>$dc,":imp"=>$imp,":fn"=>$fn,":ln"=>$ln,":phn"=>$phn,":idn"=>$idn,":amt"=>$amt,":id"=>$id));
  if($query){
    header("location:view_archives.php");
  }
  else{
       $message= "failed to update";
       header("refresh:2");
  }
}
 $id = $_GET['id'];
 
 $query=$db->prepare("SELECT * FROM archives where id= :id");
 $query->execute(array(":id" => $id));
 $list=$query->fetchAll(PDO::FETCH_OBJ);
 foreach ($list as $list2) { ?>
            <div class="l-column">
              <div class="input-box">
                <input type="number" name="documentCode" value="<?= $list2->documentCode;?>"  required="required" maxlength="6">
                <div class="lin"></div>
              </div>
              <div class="input-box">
                <textarea name="impamvu" id="" cols="10" rows="10" ><?= $list2->impamvu;?></textarea>
                <div class="lin"></div>
              </div>
              <div class="input-box">
                <input type="text" name="fname" value="<?= $list2->fname;?>"  required="required" maxlength="20">
                <div class="lin"></div>
              </div>
              <div class="input-box">
                <input type="text" name="lname" value="<?= $list2->lname;?>"  required="required" maxlength="20">
                <div class="lin"></div>
              </div>
              
            </div>
            <div class="r-column">
              <div class="input-box">
                <input type="tel" name="phone" pattern="[0-9]{10}" value="<?= $list2->phone;?>" required="required" maxlength="10" minlength="10">
                <div class="lin"></div>
              </div>
              <div class="input-box">
                <input type="text" name="idNumber" value="<?= $list2->idNumber;?>" pattern="[0-9]{16}"  required="required" maxlength="16" minlength="16">
                <div class="lin"></div>
              </div>
              <div class="input-box">
                <input type="number" name="amount" value="<?= $list2->amount;?>"  required="required" maxlength="6">
                <div class="lin"></div>
              </div><br>
             <!--input type="button" name="submit" value="send"-->
                
                <a href="view_archives.php" style="text-decoration: none; color:black;">Back</a>
                <button type="submit" name="submit">save</button>
              </div>
            </div>
            <?php }	?>
          </form>
          
</body>
</html>