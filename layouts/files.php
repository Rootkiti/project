
<?php

if(isset($_POST["action"]))
{
    if($_POST["action"] == "viewfiles")
    {
        include "connect.php";
     $message = "";

  $id = $_POST['id'];
  $folder = 'folders/'.$_POST['folder'];
  $data="";

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
    
  $data = '<img src="'.$folder.'/'.$list3[$i].'"  style="margin: 20px; width: 5cm; align-items: center;"> <br>
  <input type="hidden" name="id" class="id_holder"  value="'.$id.'">
  
  ';
  echo $data;
 
               }
              
 } 

    }
}

?>
