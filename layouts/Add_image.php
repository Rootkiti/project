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
 <form action="" method="post" enctype="multipart/form-data">
 <center style="margin-top: 4cm;">
 <input type="file"   name="new_file[]" class="form-control" style=" width:10cm;" value="" multiple required="required">
  <input type="submit" name="add" class="btn-danger m-2" style="border: none; border-radius: 5px;" value="Add Files">
  <a href="editfile.php?fileid=<?=$_GET['fileid'];?>&folder=<?=$_GET['folder'];?>&path=<?=$_GET['path'];?>&folderid=<?=$_GET['folder'];?>">
  <input type="button" name="back"   class="btn-danger m-2" style="border: none; border-radius: 5px;" value="back">
  </a>
  
  
  </center>
 </form>
</body>
</html>

<?php
include 'connect.php';
if(isset($_POST['add']))
{

  $new_file_name = $_FILES['new_file']['name'];
$id = $_GET['fileid'];
$folder = $_GET['folder'];
$paths = $_GET['path'];
$new_file='';
$status = 1; // used in file upload
$add_file_query = $db->prepare('SELECT fileName FROM archives WHERE id = :id'); 
$add_file_query->execute(array(':id' => $id));
$files = $add_file_query->fetch(PDO::FETCH_OBJ);

  $path = 'folders/'.$_GET["path"];

    $file='';
    $file_tmp='';
    $location= $path.'/';
    $data ='';
  if ($_FILES["new_file"]["name"] !='')
{
foreach($_FILES['new_file']['name'] as $key=>$val)
{
  $file = $_FILES['new_file']['name'][$key];
  $file_tmp = $_FILES['new_file']['tmp_name'][$key];
 
  $data .=$file.",";
  if ( move_uploaded_file($file_tmp,$location.$file))
       { 
       $status = $status + 1;
     }
}
  if ($status >= 1)
       {       
             $data.=$files->fileName;
             $new_file =$data; 
                 $update_query = $db->prepare('UPDATE archives SET fileName = :new_file WHERE id = :id');
             $update_query ->execute(array(':new_file'=>$new_file, ':id'=>$id));
           
             if($update_query)
             {
               echo"<script>window.location.href='editfile.php?fileid=$id&folder=$folder&path=$paths&folderid=$folder';</script>";
             }
      else
      {
          echo 'failed to upload';
      }

      
  }
 ;
  
}

}
?>