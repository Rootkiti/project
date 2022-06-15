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
  <img src="  folders/<?=$_GET['path'];?>/<?=$_GET['old_name'];?>" alt="not found" width="400" height="300" style="border: solid red;"><br><br>
  <input type="file"   name="new_file" class="form-control" style=" width:10cm;" value="" multiple>
  <input type="submit" name="delete" class="btn-danger m-2" style="border: none; border-radius: 5px;" value="Delete">
  <input type="submit" name="change" class="btn-danger m-2" style="border: none; border-radius: 5px;" value="Change">
  <a href="editfile.php?fileid=<?=$_GET['fileid'];?>&folder=<?=$_GET['folder'];?>&path=<?=$_GET['path'];?>&folderid=<?=$_GET['folder'];?>">
  <input type="button" name="back"   class="btn-danger m-2" style="border: none; border-radius: 5px;" value="back">
  </a>
  
  
  </center>
 </form>
</body>
</html>

<?php
include 'connect.php';
if(isset($_POST['change']))
{
  $new_file_name = $_FILES['new_file']['name'];
  $id = $_GET['fileid'];
  $folder = $_GET['folder'];
  $paths = $_GET['path'];
  $new_file='';
  if(!empty($new_file_name))
  {
    // if file submitted

  $change_query = $db->prepare('SELECT fileName FROM archives WHERE id = :id'); 
  $change_query->execute(array(':id' => $id));
  $files = $change_query->fetch(PDO::FETCH_OBJ);
  
  $old_name = $_GET['old_name'];
  $path = 'folders/'.$_GET['path'].'/'.$_FILES['new_file']['name'];
  foreach ($files as $file) {
    $image_list = explode(",",$file);
    
    $count = count($image_list) - 1;
    
    for ($i = 0; $i<$count; $i++)
               {
                if($image_list[$i] == $old_name)
                {
                  if(unlink('folders/'.$_GET['path'] . '/' . $image_list[$i]) && move_uploaded_file($_FILES["new_file"]["tmp_name"], $path))
                  {
                    $new_file.= $new_file_name.',';
                  }
                }
                else
                {
                  echo 'files : '.$image_list[$i] .'<br>';
                  $new_file.=$image_list[$i].',';
                  echo 'new files : '.$new_file.'<br>';
                }
               }
  }
  $update_query = $db->prepare('UPDATE archives SET fileName = :new_file WHERE id = :id');
  $update_query ->execute(array(':new_file'=>$new_file, ':id'=>$id));

  if($update_query)
  {
    echo"<script>window.location.href='editfile.php?fileid=$id&folder=$folder&path=$paths&folderid=$folder';</script>";
  }
  }
  else
  {
    // if file not submitted
    echo"<script>window.location.href='editfile.php?fileid=$id&folder=$folder&path=$paths&folderid=$folder';</script>";
  }
}
if(isset($_POST['delete']))
{
  $new_file_name = $_FILES['new_file']['name'];
  $id = $_GET['fileid'];
  $folder = $_GET['folder'];
  $paths = $_GET['path'];
  $new_file='';
  $delete_query = $db->prepare('SELECT fileName FROM archives WHERE id = :id'); 
  $delete_query->execute(array(':id' => $id));
  $files = $delete_query->fetch(PDO::FETCH_OBJ);
  
  $old_name = $_GET['old_name'];
  $path = 'folders/'.$_GET['path'].'/'.$_FILES['new_file']['name'];
  foreach ($files as $file) {
    $image_list = explode(",",$file);
    
    $count = count($image_list) - 1;
    
    for ($i = 0; $i<$count; $i++)
               {
                if($image_list[$i] == $old_name)
                {
                  if(unlink('folders/'.$_GET['path'] . '/' . $image_list[$i]))
                  {
                    continue;
                  }
                }
                else
                {
                  echo 'files : '.$image_list[$i] .'<br>';
                  $new_file.=$image_list[$i].',';
                  echo 'new files : '.$new_file.'<br>';
                }
               }

               $update_query = $db->prepare('UPDATE archives SET fileName = :new_file WHERE id = :id');
               $update_query ->execute(array(':new_file'=>$new_file, ':id'=>$id));
             
               if($update_query)
               {
                 echo"<script>window.location.href='editfile.php?fileid=$id&folder=$folder&path=$paths&folderid=$folder';</script>";
               }
  }

  
}

?>