<?php
include "connect.php";



if(isset($_POST["action"])){

    $data= array(
        'status'=> 0,
        'message'=> 'Form submission failed, please try again.' 
    );

    if($_POST["action"] == "set")
    {
        $q = $_POST["question"];
        $ans = $_POST["answer"];

        $sql='SELECT count(*) FROM recovery';
        $result=$db->query($sql);
        $count=$result->fetchColumn(0);

        if($count == 0)
        {
            $ql = " INSERT INTO recovery set question=? , answer=? ";
         $add=$db->prepare($ql);
         $ok=$add->execute(array($q,$ans));
         if($ok)
         {
            $data['status'] = 1;
            $data['message'] = 'recovery question is set';
         }
         else
         {
            $data['status'] = 1;
            $data['message'] = 'recovery question not  set';
         }
        }
        else
        {
            $ql = " UPDATE recovery set question=? , answer=? ";
         $add=$db->prepare($ql);
         $ok=$add->execute(array($q,$ans));
         if($ok)
         {
            $data['status'] = 1;
            $data['message'] = 'recovery question is set';
         }
         else
         {
            $data['status'] = 1;
            $data['message'] = 'recovery question not set';
         }
        }

        echo json_encode($data);
    }
    
//************************ renamefolder  ********************** */
if ($_POST["action"] == "rename")
{
    
$new_name = $_POST["new_name"];
$old_name =  $_POST["old_name"];
$oldPath = 'folders/';
$old_name1 = 'folders/'.$_POST["old_name"];
$new_name1 = 'folders/'.$_POST["new_name"];
$newparent_name = $_POST["new_name"];
$oldparent_name = $_POST["old_name"];
$newfolder_path ='folders/'.$_POST["new_name"];
$oldfolder_path ='folders/'.$_POST["old_name"];



if (!file_exists('folders/'.$_POST["new_name"]))
 {
   rename($oldfolder_path,$newfolder_path);
   
   $query = $db->prepare('UPDATE folders set name = :new_name WHERE name = :old_name and path = :oldPath');
   $query -> execute(array(':new_name'=>$new_name, ':old_name'=>$old_name, ':oldPath'=>$oldPath));
/*
   $parent = $db->prepare('UPDATE folders set parentfolder = :newparent_name WHERE parentfolder = :oldparent_name');
   $parent -> execute(array(':newparent_name'=>$newparent_name, ':oldparent_name'=>$oldparent_name));
*/
   $rplc = $db->prepare("UPDATE folders set path = replace(path,'$old_name1','$new_name1') WHERE 
   path like'%$old_name1%' ");
   $rplc -> execute(array());

   

   $pathupdate = $db->prepare("UPDATE archives set path = replace(path,'$old_name1','$new_name1') WHERE 
   path like'%$old_name1%'");
   $pathupdate -> execute(array());

  if($query &&  $rplc && $pathupdate ){
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
echo json_encode($data);

}
 // ****************** reort *******************


    if($_POST["action"] == "report"){
        
        $form = $_POST["search_value1"];
        $to = $_POST["search_value2"];
        
        $cond = $_POST["value"];
        $output = '';

        if($cond == "day")
        {
           
         $clientquery=$db->prepare("SELECT count(*) FROM archives where status=1 and date(submitted_on) between :form and :to");
        $clientquery->execute(array(':form'=>$form, ':to'=>$to));
        $total_record=$clientquery->fetchColumn(0);

        $totalquery=$db->prepare("SELECT sum(amount) FROM archives where status=1 and date(submitted_on) between :form and :to");
        $totalquery->execute(array(':form'=>$form, ':to'=>$to));
        $total=$totalquery->fetchColumn(0);

        $query=$db->prepare("SELECT * FROM archives where status=1 and date(submitted_on) between :form and :to");
        $query->execute(array(":form" => $form, ':to'=>$to));
        $list=$query->fetchAll(PDO::FETCH_OBJ);

     if($list)
    {
     $output = '
     
     <table class="table  table-striped">
     <tr>
     <th>Code</th>
     <th>Document category</th>
     <th>First Name</th>
     <th>Last Name</th>
     <th>Phone</th>
     <th>Amount</th>
     <th>ID Number</th>
     <th>Date</th>
 </tr>    
     ';
    foreach ($list as $list2) 
    {
        $output .='
        <tr> 
        <td> '.$list2->documentCode.'</td>
        <td> '.$list2->impamvu.'</td>
        <td> '.$list2->fname.'</td>
        <td> '.$list2->lname.'</td>
        <td> '.$list2->phone.'</td>
        <td> '.$list2->amount.'</td>
        <td> '.$list2->idNumber.'</td>
        <td> '.$list2->submitted_on.'</td>
        
    </tr> 
          
        ';
    }
          

          $output .='

       <tr>
         <td style="font-family: bold;">Clients Recived</td>
         <td style="font-family: bold;">'.$total_record.'</td>
       </tr>
       <tr>
         <td style="font-family: bold;">tota amount</td>
         <td style="font-family: bold;">'.$total.'</td>
       </tr>
        </table>
        ';
    }
    else
     {
        $output .= ' <div style="color:red; font-size: 20px; font-weight: 700; 
                                margin-top: 2.5cm;"> <center>no result found !</center>
                                </div>
        ';
     }
 }
 
 
 elseif($cond == "month")
 {
    $clientquery=$db->prepare("SELECT count(*) FROM archives where status=1 and month(submitted_on) between :form and :to");
    $clientquery->execute(array(':form'=>$form, ':to'=>$to));
    $total_record=$clientquery->fetchColumn(0);

    $totalquery=$db->prepare("SELECT sum(amount) FROM archives where status=1 and month(submitted_on) between :form and :to ");
    $totalquery->execute(array(':form'=>$form, ':to'=>$to));
    $total=$totalquery->fetchColumn(0);

    $query=$db->prepare("SELECT * FROM archives where status=1 and month(submitted_on) between :form and :to ");
    $query->execute(array(":form" => $form, ':to'=>$to));
    $list=$query->fetchAll(PDO::FETCH_OBJ);

 if($list)
{
 $output = '
 
 <table class="table  table-striped">
 <tr>
 <th>Code</th>
 <th>Document category</th>
 <th>First Name</th>
 <th>Last Name</th>
 <th>Phone</th>
 <th>Amount</th>
 <th>ID Number</th>
 <th>Date</th>
</tr>    
 ';
foreach ($list as $list2) 
{
    $output .='
    <tr> 
    <td> '.$list2->documentCode.'</td>
    <td> '.$list2->impamvu.'</td>
    <td> '.$list2->fname.'</td>
    <td> '.$list2->lname.'</td>
    <td> '.$list2->phone.'</td>
    <td> '.$list2->amount.'</td>
    <td> '.$list2->idNumber.'</td>
    <td> '.$list2->submitted_on.'</td>
    
    
</tr> 
      
    ';
}
      

      $output .='

   <tr>
     <td style="font-family: bold;">Clients Recived</td>
     <td style="font-family: bold;">'.$total_record.'</td>
   </tr>
   <tr>
     <td style="font-family: bold;">tota amount</td>
     <td style="font-family: bold;">'.$total.'</td>
   </tr>
    </table>
    ';
}
else
 {
    $output .= ' <div style="color:red; font-size: 20px; font-weight: 700; 
                            margin-top: 2.5cm;"> <center>no result found !</center>
                            </div>
    ';
 }
}
else
{
    $clientquery=$db->prepare("SELECT count(*) FROM archives where status=1 and year(submitted_on) between :form and :to ");
        $clientquery->execute(array(':form'=>$form, ':to'=>$to));
        $total_record=$clientquery->fetchColumn(0);

        $totalquery=$db->prepare("SELECT sum(amount) FROM archives where status=1 and year(submitted_on) between :form and :to ");
        $totalquery->execute(array(':form'=>$form, ':to'=>$to));
        $total=$totalquery->fetchColumn(0);

        $query=$db->prepare("SELECT * FROM archives where status=1 and year(submitted_on) between :form and :to ");
        $query->execute(array(":form" => $form, ':to'=>$to));
        $list=$query->fetchAll(PDO::FETCH_OBJ);

     if($list)
    {
     $output = '
     
     <table class="table  table-striped">
     <tr>
     <th>Code</th>
     <th>Document category</th>
     <th>First Name</th>
     <th>Last Name</th>
     <th>Phone</th>
     <th>Amount</th>
     <th>ID Number</th>
     <th>Date</th>
 </tr>    
     ';
    foreach ($list as $list2) 
    {
        $output .='
        <tr> 
        <td> '.$list2->documentCode.'</td>
        <td> '.$list2->impamvu.'</td>
        <td> '.$list2->fname.'</td>
        <td> '.$list2->lname.'</td>
        <td> '.$list2->phone.'</td>
        <td> '.$list2->amount.'</td>
        <td> '.$list2->idNumber.'</td>
        <td> '.$list2->submitted_on.'</td>
        
    </tr> 
          
        ';
    }
          

          $output .='

       <tr>
         <td style="font-family: bold;">Clients Recived</td>
         <td style="font-family: bold;">'.$total_record.'</td>
       </tr>
       <tr>
         <td style="font-family: bold;">tota amount</td>
         <td style="font-family: bold;">'.$total.'</td>
       </tr>
        </table>
        ';
    }
    else
     {
        $output .= ' <div style="color:red; font-size: 20px; font-weight: 700; 
                                margin-top: 2.5cm;"> <center>no result found !</center>
                                </div>
        ';
     }
 }
 echo $output;
}
 
        
 
}

        

?>