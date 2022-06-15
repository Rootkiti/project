<?php session_start();
include "connect.php";
if(!isset($_SESSION["password"]))
         header("location:login.php");
?>
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

    
    <!-- Custom styles for this form -->
    <link href="../dashboard/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/zoom.css">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">ARCHIVE KEEPING SYSTEM</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input id="search_value" value="" class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      
      <!--- seaerc-->
    </div>
  </div>
</header>
  
<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="dashboard.php">
              <span data-feather="home"></span>
              
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 5.69l5 4.5V18h-2v-6H9v6H7v-7.81l5-4.5M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3z"/></svg>
              Dashboard
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="shopping-cart"></span>
              
<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><rect fill="none" height="24" width="24"/><path d="M3,5v14h18V5H3z M7,7v2H5V7H7z M5,13v-2h2v2H5z M5,15h2v2H5V15z M19,17H9v-2h10V17z M19,13H9v-2h10V13z M19,9H9V7h10V9z"/></svg>
              View Archives
            </a>
          </li>
        </ul>
        
        <div class="">
         <a class="nav-link px-3" href="report.php">
      <span>
      <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g><path d="M0,0h24v24H0V0z" fill="none"/></g><g><g><path d="M15,3H5C3.9,3,3.01,3.9,3.01,5L3,19c0,1.1,0.89,2,1.99,2H19c1.1,0,2-0.9,2-2V9L15,3z M5,19V5h9v5h5v9H5z M9,8 c0,0.55-0.45,1-1,1S7,8.55,7,8s0.45-1,1-1S9,7.45,9,8z M9,12c0,0.55-0.45,1-1,1s-1-0.45-1-1s0.45-1,1-1S9,11.45,9,12z M9,16 c0,0.55-0.45,1-1,1s-1-0.45-1-1s0.45-1,1-1S9,15.45,9,16z"/></g></g></svg>

Report
      </span>
          </a>
       </div>

       
        <a class="nav-link px-3" href="logout.php">
          
<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g><path d="M0,0h24v24H0V0z" fill="none"/></g><g><path d="M17,8l-1.41,1.41L17.17,11H9v2h8.17l-1.58,1.58L17,16l4-4L17,8z M5,5h7V3H5C3.9,3,3,3.9,3,5v14c0,1.1,0.9,2,2,2h7v-2H5V5z"/></g></svg>
          Sign out
        </a>
      </div>
    </nav>
        <div class="container">
          
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <!----------------------------- form------------------------------- -->
    <form  method="POST" enctype="multipart/form-dat">
      <div class="move-nav">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <?php
       
       include "connect.php";
      
       $sql='SELECT count(*) FROM archives where status=1';
        $result=$db->query($sql);
        $count=$result->fetchColumn(0);

        ?>
           
           
           <h1 class="h4">Archives(<?php  echo $count ?>) </h1>
          
       <?php 	?>
       <div align = "right">
             <svg class="direction" id="right" xmlns="http://www.w3.org/2000/svg" height="48" width="48">
                  <path d="M28 34 18 24 28 14Z"/>
             </svg>

             <svg class="direction" id="left" xmlns="http://www.w3.org/2000/svg" height="48" width="48">
                  <path d="M20 34V14L30 24Z"/></svg>
        </div>
        </div>
      </div>
        <h2 class="h2"></h2>
        <!-------------------------------------   php            -------------------->
        <div class="statusMsg"></div>
    <div id="Result_list">
    <?php
    
    if($count >0)
    {
      $table = 
      '
      <table class="table table-striped">
            <tr>
                <th>Document Code</th>
                <th>Document Category</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone</th>
                <th>ID Number</th>
                <th>Amount</th>
                <th>Quick Path</th>
                <th></th>
            </tr>
      
      ';
      echo $table;
    }
    ?>
        <?php
       
       include "connect.php";
         // getting the page
         if(isset($_GET['page']))
         {
             $page = $_GET['page'];
             
         }
         else
         {
            $page = 1;
         }
         $num_per_page = 10;
         $start_from = ($page-1)*$num_per_page;
       $query=$db->prepare("SELECT * FROM archives where status=1 limit $start_from,$num_per_page");
       $query->execute(array());
       $list=$query->fetchAll(PDO::FETCH_OBJ);
       foreach ($list as $list2) { ?>
           <!--div style="float: left;border: 2px solid red; width: 200px;height: 100px; margin: 5px;"-->
           <tr > 
               <td style="color: red; font-size: 18px; font-family:'Courier New', Courier, monospace;">
               <?= $list2->documentCode;?></td>
               <td><?= $list2->impamvu;?></td>
               <td><?= $list2->fname;?></td>
               <td><?= $list2->lname;?></td>
               <td><?= $list2->phone;?></td>
               <td><?= $list2->idNumber;?></td>
               <td><?= $list2->amount;?></td>
               <?php
               $folder = substr($list2->path,strrpos($list2->path,'/')+1,null);
               $folderid = $list2->folder;
     // getting folder path
               $pathquery=$db->prepare("SELECT name FROM folders where id = :folderid");
               $pathquery->execute(array(':folderid' => $folderid));
               $pathlist=$pathquery->fetch(PDO::FETCH_OBJ);
               $sub_path = substr($list2->path,8,null);
               $folder_name = $pathlist->name;
               ?>
               <td><a style="text-decoration: none;" href="foldercontent.php?id=<?= $list2->folder;?>&&folder=<?=$folder_name;?>&&path=<?=$sub_path;?>">
               
               <?=$folder;?></a></td>
               <td>
               
               <a href="viewfiles.php?id=<?= $list2->id;?>&folder=<?= $list2->folder;?>" style="text-decoration: none;">
              <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" fill="#000000">
	                  <path d="M0 0h24v24H0V0z" fill="none"/>
	                  <path d="M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z"/>
               </svg>
                 Files
              </a>
              &nbsp;&nbsp;
              
              </td>
           </tr>
               
           <!--/div-->
       <?php }	?>
        </table>
    </div>
        <?php
          // getting number of rows uploaded in particula folder
          $query=$db->prepare("SELECT count(*) FROM archives where status=1");
          $query->execute(array());
          $total_record=$query->fetchColumn(0);
          
          $total_pages = ceil($total_record/$num_per_page);
          if($page>1)
          {
            echo"<a href='view_archives.php?page=".($page-1)."' class='btn btn-danger m-1'>Previous</a>";
            
          }
          for($i=1; $i<$total_pages; $i++)
          {
            echo"<a href='view_archives.php?page=".$i."' class='btn btn-primary m-1'>$i</a>";
            
          }
          if($i>$page)
          {
            echo"<a href='view_archives.php?page=".($page+1)."' class='btn btn-danger m-1'>Next</a>";
          }
          
          ?>
    </form>
       
    </main>
        </div>
      </div>
  </div>
</div>

  </body>
</html>

<script>
  $(document).ready(function(){
     

        // ******************* auto search  ******************************
        $(document).on('keyup', '#search_value', function(){
          var search_value = $(this).val();
          var action = "search";
          
          $.ajax({
              url:"smartsearch.php",
              method:"POST",
              data:{action:action, search_value:search_value},
              success:function(data)
              {
                $('#Result_list').html(data);
                
              }
        });
      }); 

//****************** directions ********************** */
$(document).on('click', '#right', function(){
       history.back();
});
$(document).on('click', '#left', function(){
      history.forward();
});
    
});
</script>
