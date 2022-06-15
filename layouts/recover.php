<?php
include "connect.php";


if(isset($_POST["action"]))
{
    $data= array(
        'status'=> 0,
        'message'=> 'Form submission failed, please try again.' 
    );

    if($_POST["action"] === "recover")
    {
      $folder = $_POST['folder'];
      $add=$db->prepare("UPDATE folders set status = 1 WHERE name like '$_POST[folder]%' || parentfolder like '$_POST[folder]%' || path like '%$_POST[folder]%'");
      $ok=$add->execute(array());

      $arc=$db->prepare("UPDATE archives set status = 1 WHERE folder like '$_POST[folder]%' || path like '%$_POST[folder]%'");
      $okarc=$arc->execute(array());
      if($ok && $okarc)
      {
        $data['status'] = 1;
        $data['message'] = 'folder is recovered';
          
      }
      else
      {  
        $data['status'] = 1;
        $data['message'] = 'folder is not recovered';
          
      }
      
    }
    
  //--------- sending folder in trash ----------------------
    if($_POST["action"] === "delete")
    {
      if(isset($_POST['path']))
      {
          
        $folder = $_POST['folder_name'];
        $path = $_POST['path'].$_POST['folder_name'];
        $add=$db->prepare("UPDATE folders set status = 0 WHERE name like '$_POST[folder_name]%'  ||  path like '%$path%'");
        $ok=$add->execute(array());
  
        $arc=$db->prepare("UPDATE archives set status = 0 WHERE folder  like '$_POST[folder_name]%' ||  path like '%$path%'");
        $okarc=$arc->execute(array());
  
        if($ok && $okarc)
        {
          $data['status'] = 1;
          $data['message'] = 'folder sent in trash';
        }
        else
        {  
          $data['status'] = 1;
          $data['message'] = 'failed, tray again !';
            
        }

      }
      else
      {
        $folder = $_POST['folder_name'];
        $path = 'folders/'.$_POST['folder_name'];
        $add=$db->prepare("UPDATE folders set status = 0 WHERE name like '$_POST[folder_name]%' || parentfolder like '$_POST[folder_name]%' ||  path like '%$path%'");
        $ok=$add->execute(array());
  
        $arc=$db->prepare("UPDATE archives set status = 0 WHERE folder  like '$_POST[folder_name]%' ||  path like '%$path%'");
        $okarc=$arc->execute(array());
  
        if($ok && $okarc)
        {
          $data['status'] = 1;
          $data['message'] = 'folder sent in trash';
        }
        else
        {  
          $data['status'] = 1;
          $data['message'] = 'failed, tray again !';
            
        }

      }
      
    }
    
     //---------------- creating folder--------------------
     if ($_POST["action"] == "create") 
     {
      $folder = $_POST["folder_name"];
      $path = 'folders/'.$_POST["folder_name"];

       if (!file_exists($path))
        {
            
         mkdir($path, 0777, true);
         $query = $db->prepare('INSERT INTO folders set name= :folder');
         $query -> execute(array(':folder' => $folder ));
 
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
     //------------- rename folder ----------------
     if ($_POST["action"] == "rename")
     {
      if(isset($_POST['path']))
      {
           
        $new_name = $_POST["new_name"];
      $old_name =  $_POST["old_name"];
      $oldPath = 'folders/'.$_POST["path"].'/';
      $old_name1 = 'folders/'.$_POST["path"].'/'.$_POST["old_name"];
      $new_name1 = 'folders/'.$_POST["path"].'/'.$_POST["new_name"];
      $newparent_name = $_POST["new_name"];
      $oldparent_name = $_POST["old_name"];
      $newfolder_path ='folders/'.$_POST["path"].'/'.$_POST["new_name"];
      $oldfolder_path ='folders/'.$_POST["path"].'/'.$_POST["old_name"];

     

      if (!file_exists('folders/'.$_POST["path"].'/'.$_POST["new_name"]))
       {
         rename($oldfolder_path,$newfolder_path);
         
         $query = $db->prepare('UPDATE folders set name = :new_name WHERE name = :old_name and path = :oldPath ');
         $query -> execute(array(':new_name'=>$new_name, ':old_name'=>$old_name, ':oldPath'=>$oldPath));

         $rplc = $db->prepare("UPDATE folders set path = replace(path,'$old_name1','$new_name1') WHERE 
         path like'%$old_name1%' ");
         $rplc -> execute(array());

         

         $pathupdate = $db->prepare("UPDATE archives set path = replace(path,'$old_name1','$new_name1') WHERE 
         path like'%$old_name1%'");
         $pathupdate -> execute(array());

        if($query &&  $rplc && $pathupdate){
            $data['status'] = 1;
            $data['message'] = 'Folder Name Changed !';
         
       }
       else{
        $data['status'] = 1;
        $data['message'] = 'failde !';
       }
      }
      else
      { 
          $data['status'] = 1;
        $data['message'] = 'Folder with the same name exist !';
        
      }
        
      }
     
    }

    // delete forever

    if($_POST["action"] == "deleteforever")
    {
      
      $folder = $_POST["folder"];
      $path1= $_POST['path'];
      $path= $_POST['path'].$folder;
      $files = scandir($path);
      foreach($files as $file)
      {
          if($file === '.' || $file ==='..')
          {
              continue;
          }
          else
          {
              unlink($path . '/' . $file);
          }
      }

         $query = $db->prepare('DELETE FROM folders WHERE name = :folder && path = :path1');
         $query -> execute(array(':folder'=>$folder, ':path1'=>$path1));
         
      if(rmdir($path) && $query)
      {
        $data['status'] = 1;
        $data['message'] = 'Folder deleted !';
      }
  }


echo json_encode($data);
  
    }


?>
