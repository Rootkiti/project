<?php

include "connect.php";
$data= array(
    'status'=> 0,
    'message'=> 'Form submission failed, please try again.' 
);

if(isset($_POST["action"]))
{
    if ($_POST["action"] == "create") 
   {    

         $folder = $_POST["folder_name"];
         $parentfolder = $_POST["parentfolder"];
         $path= 'folders/'.$_POST["path"].'/'.$folder;
      if (!file_exists($path))
       {
        $path1= 'folders/'.$_POST["path"].'/';
         
         mkdir($path, 0777, true);
         $query = $db->prepare('INSERT INTO folders set name= :folder, parentfolder= :parentfolder, path= :path');
         $query -> execute(array(':folder' => $folder, ':parentfolder' => $parentfolder, ':path' => $path1 ));

        if($query)
        {
             $data['status'] = 1;
            $data['message'] = 'folder created !'; 
        
        } 
        else
        { 
         $data['status'] = 1;
         $data['message'] = 'failed, try again'; 
        }      
        }
          
       else
       {
         $data['status'] = 1;
         $data['message'] = 'Folder Exist';
      }
  
   }
  echo json_encode($data);
}

?>