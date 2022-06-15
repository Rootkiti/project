<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

    <!-- Bootstrap core CSS -->
 <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/edit.css">
    <link href="../dashboard/dashboard.css" rel="stylesheet">
    <link href="../css/dashboard_design.css" rel="stylesheet">
    <link href="../css/style1.css" rel="stylesheet">
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
$path = $_GET["path"];
$folder = $_GET["folder"];
$folderid = $_GET["folderid"];
$message = "";
if(isset($_POST["submit"]))
{
  $fileid = $_GET['fileid'];
 
  $dc = $_POST["documentCode"];
  $imp = $_POST["impamvu"];
  $fn = $_POST["fname"];
  $ln = $_POST["lname"];
  $phn = $_POST["phone"];
  $idn = $_POST["idNumber"];
  $amt = $_POST["amount"];

  $slq = "UPDATE archives SET documentCode= :dc, impamvu= :imp, fname= :fn, lname= :ln, phone= :phn, idNumber= :idn, amount= :amt WHERE id= :fileid";
  $query=$db->prepare($slq);
  $query->execute(array(":dc"=>$dc,":imp"=>$imp,":fn"=>$fn,":ln"=>$ln,":phn"=>$phn,":idn"=>$idn,":amt"=>$amt,":fileid"=>$fileid));
  if($query){
    
    echo "<script>alert('changes are saved');window.location.href='editfile.php?folderid=$folderid&&fileid=$fileid&&folder=$folder&&path=$path';</script>";
    
  }
  else{
    echo "<script>alert('failed to edit');window.location.href='createfolderfile.php?name=$folder';</script>";
  }
}
 $fileid = $_GET['fileid'];
 $path = $_GET["path"];
  $folder = $_GET["folder"];
  $folderquery=$db->prepare("SELECT * FROM folders where id= :folderid");
 $folderquery->execute(array(":folderid" => $folderid));
 $namelist=$folderquery->fetchAll(PDO::FETCH_OBJ);
 foreach ($namelist as $name) {
   $foldername = $name->name;
 }

 $query=$db->prepare("SELECT * FROM archives where id= :fileid");
 $query->execute(array(":fileid" => $fileid));
 $list=$query->fetchAll(PDO::FETCH_OBJ);
 foreach ($list as $list2) {
   $images = $list2->fileName;
   ?>
            <div class="l-column">
              <div class="input-box">
                <input type="text" name="documentCode" value="<?= $list2->documentCode;?>"  required="required" maxlength="6" readonly style="color: red; font-size: 24px;">
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
                <div class="input-box">
                <input type="hidden" name="path" value="<?=$list2->path;?>"  >
                <div class="lin"></div>
              </div><br>

              <?php
              $ex_images = explode(",",$images); // extracted images
              $n_images = count($ex_images) - 1; // number of images
              $new_line = 0;
              for ($i = 0; $i<$n_images; $i++)  {
                $new_line = $new_line +1;
                if($new_line <= 4){

                
               
                           ?>
                <img src="folders/<?= $path;?>/<?= $ex_images[$i];?>" style="padding: 10px; height: 2cm; width: 2cm; align-items: center;">
                
                <button class="btn-info" style="background: transparent;margin-left: -60px; color:white; border: none; border-radius: 4px;"><a href="edit_image.php?old_name=<?=$ex_images[$i];?>&path=<?=$_GET['path'];?>&fileid=<?=$_GET['fileid'];?>&folder=<?=$_GET['folder'];?>" style="color: white;">Edit</a>
              </button>&nbsp;
                
  
                      <?php
              }
              else{
                $new_line = 0;
                ?>
                <br>
                <img src="folders/<?= $path;?>/<?= $ex_images[$i];?>" style="padding: 10px; height: 2cm; width: 2cm; align-items: center;">
                
                <button class="btn-info" style="background: transparent; margin-left: -60px; color:white; border: none; border-radius: 4px;"><a href="edit_image.php?old_name=<?=$ex_images[$i];?>&path=<?=$_GET['path'];?>&fileid=<?=$_GET['fileid'];?>&folder=<?=$_GET['folder'];?>"style="color: white;" >Edit</a>
              </button>&nbsp;
                
                <?php
              }
            }
                      ?>
             
                <div class="input-box">
                <input type="hidden" name="path" value="<?=$list2->path;?>"  >
                
              </div><br>
             <!--input type="button" name="submit" value="send"-->
                
                
                <button class="btn btn-primary" style="border: none; border-radius: 4px; font-weight: 500;">
                <a href="createfolderfile.php?id=<?=$folder;?>&folder=<?=$foldername;?>&path=<?=$path;?>"   style="text-decoration: none; color:white;  font-size:20px;">Back</a>
              </button>

                <button type="submit" style="border: none; border-radius: 4px;" class="btn btn-primary " name="submit" value="<?=$list2->path;?>">save</button>

                <button class="btn btn-danger" style="border: none; border-radius: 4px;"><a href="Add_image.php?old_name=<?=$ex_images[$i];?>&path=<?=$_GET['path'];?>&fileid=<?=$_GET['fileid'];?>&folder=<?=$_GET['folder'];?>" style="color:white; font-weight: 500;">Add Files</a>
              </button>
              </div>
            </div>
            <?php }	 ?>
          </form>
          
</body>
</html>