
<div align = "right">
<svg class="direction" id="right" xmlns="http://www.w3.org/2000/svg" height="48" width="48">
  <path d="M28 34 18 24 28 14Z"/></svg>

<svg class="direction" id="left" xmlns="http://www.w3.org/2000/svg" height="48" width="48">
  <path d="M20 34V14L30 24Z"/></svg>
</div>
<?php

include "connect.php";
$message = "";

  $id = $_GET['id'];
  $folder = 'folders/'.$_GET['folder'];
  $query=$db->prepare("SELECT * FROM archives where id= :id");
 $query->execute(array(":id" => $id));
 $list=$query->fetchAll(PDO::FETCH_OBJ);
 foreach ($list as $list2) {
    $folder = $list2->path;
    $list2 = $list2->fileName;
    $list3 = explode(",",$list2);
    
    $count = count($list3) - 1;
    
    for ($i = 0; $i<$count; $i++)
               {
    ?>
  <img src="<?= $folder;?>/<?= $list3[$i];?>" align = "center">
  <br><br><br>
  
 <?php
               }
              
 } 

echo "<script>window.print();</script>";
?>


<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="../styles/jquery-3.js"></script>
<script src="../js/jquery-3.js"></script>
<script>
$(document).ready(function(){
  $(document).on('click', '#right', function(){
       history.back();
});
$(document).on('click', '#left', function(){
      history.forward();
});
});
</script>