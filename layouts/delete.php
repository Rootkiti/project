<?php
include "connect.php";
$id = $_GET['id'];
$path1= $_GET['path'];
$folder = $_GET["folder"];
$path= 'folders/'.$_GET['path'];
$files = scandir($path);

$status = 0;
      foreach($files as $file)
      {
          if($file === '.' || $file ==='..')
          {
              continue;
          }
          else
          {
              unlink($path . '/' . $file);
              $status = $status + 1;
          }
      }

         $query = $db->prepare('DELETE FROM archives WHERE id=:id');
         $query -> execute(array(':id'=>$id));

         $namequery = $db->prepare('SELECT name FROM folders WHERE id=:folder');
         $namequery -> execute(array(':folder'=>$folder));
         $fname = $namequery->fetch(PDO::FETCH_OBJ);
         
         $folder_name = $fname->name;

if( $query)
{
       echo "<script>window.location.href='foldercontent.php?id=$folder&folder=$folder_name&path=$path1';</script>";
}
?>