<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="this is a stand alone system">
    <meta name="author" content="rootkit">
    <meta name="generator" content="">
    <title>ARCHIVE KEEPING SYSTEM</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
    <script src="../js/jquery-3.js"></script>

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


<?php
include "connect.php";
if(isset($_POST["print"]))
{
    $output = '';
    if( isset($_POST['from1']) and isset($_POST['to1']) )
   
    {
        
       $from = $_POST['from1'];
       $to = $_POST['to1'];
    
            
             $countquery=$db->prepare("SELECT count(*) FROM archives where status=1 and date(submitted_on) 
             between :form and :to");
            $countquery->execute(array(':form'=>$from, ':to'=>$to));
            $total_record=$countquery->fetchColumn(0);
    
            $totalquery=$db->prepare("SELECT sum(amount) FROM archives where status=1 and date(submitted_on) 
            between :form and :to ");
            $totalquery->execute(array(':form'=>$from, ':to'=>$to));
            $total=$totalquery->fetchColumn(0);
    
            $query=$db->prepare("SELECT * FROM archives where status=1 and date(submitted_on)
            between :form and :to");
            $query->execute(array(':form'=>$from, ':to'=>$to));
            $list=$query->fetchAll(PDO::FETCH_OBJ);
    
         if($total_record >0)
         {
             $output.='        
         
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
            echo $output;
       
           
    }
    }

    if(isset($_POST['from']) and isset($_POST['to']))
    {
        
        $from = $_POST['from'];
        $to = $_POST['to'];
     
          

          
            $countquery=$db->prepare("SELECT count(*) FROM archives where status=1 and month(submitted_on) 
            between :form and :to || status=1 and year(submitted_on) between :form and :to");
           $countquery->execute(array(':form'=>$from, ':to'=>$to));
           $total_record=$countquery->fetchColumn(0);
   
           $totalquery=$db->prepare("SELECT sum(amount) FROM archives where status=1 and month(submitted_on) 
           between :form and :to || status=1 and year(submitted_on) between :form and :to ");
           $totalquery->execute(array(':form'=>$from, ':to'=>$to));
           $total=$totalquery->fetchColumn(0);
   
           $query=$db->prepare("SELECT * FROM archives where status=1 and month(submitted_on) 
           between :form and :to || status=1 and year(submitted_on) between :form and :to");
           $query->execute(array(':form'=>$from, ':to'=>$to));
           $list=$query->fetchAll(PDO::FETCH_OBJ);
   
        if($total_record >0)
        {
            $output.='        
        
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
           echo $output;
      
          
   }
    }

    echo'<script>window.print();</script>';

}
?>

</body>
</html>