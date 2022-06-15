<?php
include "connect.php";

if(isset($_POST["action"]))
{

      if($_POST["action"] == "search")
      {

         $data = $_POST["search_value"];
        $output = '';
        $data = $_POST["search_value"];
	  $query=$db->prepare("SELECT * FROM archives where documentCode = :data || phone like '$_POST[search_value]%' || fname like '$_POST[search_value]%' || lname like '$_POST[search_value]%'");
       $query->execute(array(':data'=>$data));
       $list=$query->fetchAll(PDO::FETCH_OBJ);

     if($list)
    {
     $output = '
     
     <table class="table  table-striped">
     <tr>
     <th>code</th>
     <th>document category</th>
     <th>first name</th>
     <th>last name</th>
     <th>phone</th>
     <th>amount</th>
     <th>idNumber</th>
     <th></th>
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
        <td>
        <a href="viewfiles.php?id='.$list2->id.'&folder='.$list2->folder.'" style="text-decoration: none;">
        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" fill="#000000">
              <path d="M0 0h24v24H0V0z" fill="none"/>
              <path d="M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z"/>
         </svg>
           Files
        </a>
        &nbsp;&nbsp;
        <a href="edit.php?id='.$list2->id.'" style="text-decoration: none;">

        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" fill="#000000">
          <path d="M0 0h24v24H0V0z" fill="none"/>
          <path d="M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z"/>
        </svg>
        Edit
        </a>
        &nbsp;&nbsp;
          <a onclick="return confirm(Are Your sure You Want To Delete This Record ?)" href="delete.php?id=<?= $list2->id; ?>&name='.$list2->fileName.'" style="text-decoration: none;">
            
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="20px" fill="#000000">
                 <path d="M0 0h24v24H0V0z" fill="none"/>
                <path d="M19 13H5v-2h14v2z"/>
            </svg>
            Delete
            
          </a>
        </td>
      </tr> 
          
        ';
    }
    }
      }
    echo $output;
}

?>