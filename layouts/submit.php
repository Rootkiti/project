<?php
include "connect.php";
$response= array(
    'status'=> 0,
    'message'=> 'Form submission failed, please try again.' 
);
// if form submitted
if(isset($_POST['documentCode']) || isset($_POST['impamvu']) || isset($_POST['fname']) || isset($_POST['lname']) || 
   isset($_POST['phone']) || isset($_POST['idNumber']) || isset($_POST['amount']) || isset($_POST['hidden_folder_name']) ||
    isset($_POST['files'])){
      $doc        = $_POST["documentCode"];
      $impamvu    = $_POST["impamvu"];
      $fname      = $_POST["fname"];
      $lname       = $_POST["lname"];
      $phone      = $_POST["phone"];
      $idNumber   = $_POST["idNumber"];
      $amount     = $_POST["amount"];
  	  $upload_dir =$_POST["hidden_folder_name"];
      $folder = $_POST['hidden_folder_name'];
      $path = 'folders/'.$_POST["path"];

      $file='';
      $file_tmp='';
      $location= $path.'/';
      $data ='';

     if(!empty($_FILES['files']['name']))
     {
        foreach($_FILES['files']['name'] as $key=>$val)
        {
          $file = $_FILES['files']['name'][$key];
          $file_tmp = $_FILES['files']['tmp_name'][$key];
          move_uploaded_file($file_tmp,$location.$file);
          $data .=$file.",";
          $uploadstatus = 1;

        }
        

            $add=$db->prepare("INSERT INTO archives set documentCode=? , impamvu=? , fname=? , lname=?
            , phone=? , idNumber=? , amount=? , fileName=?, folder=?, path=? ");
            $ok=$add->execute(array($doc,$impamvu,$fname,$lname,$phone,$idNumber,$amount,$data,$folder,$path));
            if ($ok && $uploadstatus == 1) {
                $response['status'] = 1;
                $response['message'] = 'data submitted';
                
            }else{
                $response['status'] = 1;
                $response['message'] = 'data not submitted';
            }
        
     }  

     
}


echo json_encode($response);
?>
