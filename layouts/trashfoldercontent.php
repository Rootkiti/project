<?php
    include "connect.php";
    $message = "";
    $name = "";
   
    if(isset($_POST["submit"]))
    {
      $name = $_GET['name'];

}
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

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="../styles/jquery-3.js"></script>
<script src="../js/jquery-3.js"></script>

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
    <link href="../css/filefolder.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">ARCHIVE KEEPING SYSTEM</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <!-- search--->
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
              <span data-feather="file"></span>
              
<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g><rect fill="none" height="24" width="24"/><g><path d="M19,5v14H5V5H19 M19,3H5C3.9,3,3,3.9,3,5v14c0,1.1,0.9,2,2,2h14c1.1,0,2-0.9,2-2V5C21,3.9,20.1,3,19,3L19,3z"/></g><path d="M14,17H7v-2h7V17z M17,13H7v-2h10V13z M17,9H7V7h10V9z"/></g></svg>
              Keep Archives
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="view_archives.php">
              <span data-feather="shopping-cart"></span>
              
<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><rect fill="none" height="24" width="24"/><path d="M3,5v14h18V5H3z M7,7v2H5V7H7z M5,13v-2h2v2H5z M5,15h2v2H5V15z M19,17H9v-2h10V17z M19,13H9v-2h10V13z M19,9H9V7h10V9z"/></svg>
              View Archives
            </a>
          </li>
        </ul>
        
        <a class="nav-link px-3" href="logout.php">
          
<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g><path d="M0,0h24v24H0V0z" fill="none"/></g><g><path d="M17,8l-1.41,1.41L17.17,11H9v2h8.17l-1.58,1.58L17,16l4-4L17,8z M5,5h7V3H5C3.9,3,3,3.9,3,5v14c0,1.1,0.9,2,2,2h7v-2H5V5z"/></g></svg>
          Sign out
        </a>
      </div>
    </nav>
        <div class="container">
          
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="move-nav">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
         
         <div align="right">
         <svg class="direction" id="right" xmlns="http://www.w3.org/2000/svg" height="48" width="48">
           <path d="M28 34 18 24 28 14Z"/>
          </svg>

         <svg class="direction" id="left" xmlns="http://www.w3.org/2000/svg" height="48" width="48">
           <path d="M20 34V14L30 24Z"/>
         </svg>
         </div>
        </div>
        </div>
        <h2 class="h2"></h2>

        <?php
            
           @$folder = $_GET['name'];
           $query=$db->prepare("SELECT * FROM folders where status = 0 && parentfolder = :folder");
          $query->execute(array(':folder' => $folder));
          $list=$query->fetchAll(PDO::FETCH_OBJ);
       
       foreach ($list as $list2) { ?>
           <!--div style="float: left;border: 2px solid red; width: 200px;height: 100px; margin: 5px;"-->
           <div style="display:inline-block; 
	                     background: none;
	                     margin-bottom: 5px;
	                     padding: 10px;
                       width: 3.2cm;
                       height: 4cm;
	                     box-shadow: 0 0 10px 0 #eee;">
                    <div style="margin-top: -.3cm">
                       
            <button id="deleteforever"  style="border:none ; background: none; " value="<?=$list2->name;?>">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
	                 <path d="M0 0h24v24H0V0z" fill="none"/>
	                 <path d="M14.12 10.47L12 12.59l-2.13-2.12-1.41 1.41L10.59 14l-2.12 2.12 1.41 1.41L12 15.41l2.12 2.12 1.41-1.41L13.41 14l2.12-2.12zM15.5 4l-1-1h-5l-1 1H5v2h14V4zM6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9z"/>
               </svg>
            </button>
                      </div>
                       
                      
                      <a id="folder" href="trashfoldercontent.php?name=<?=$list2->name;?>" style="text-decoration: none; cursor: auto;padding: -1cm;">
                      <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 50 512 512" height="100px" width="100px" fill="#d3a13b"  class="svg">
                        <path d="M464 128H272l-64-64H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V176c0-26.51-21.49-48-48-48z"/></svg>
                      </a>
                      <br />
                      <span style="font-size:12px; font-family: bold; "><?=$list2->name;?> </span>
           </div>
           
           <?php }
           	?>
       

        <!--********************************  output *******************************-->
        <?php
       
       include "connect.php";
          $idquery=$db->prepare("SELECT id FROM folders where status = 0 && name = :folder ");
          $idquery->execute(array(':folder' => $folder));
          $idlist=$idquery->fetch(PDO::FETCH_OBJ);
          $fid=$idlist->id;
      
       $sql="SELECT count(*) FROM archives where status=0 && folder = $fid";
        $result=$db->query($sql);
        $count=$result->fetchColumn(0);

        
    
    if($count >0)
    {
      $table = 
      '
      <table class="table table-striped">
            <tr>
                <th>Code</th>
                <th>Document Category</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone</th>
                <th>ID Number</th>
                <th>Amount</th>
                <th></th>
            </tr>
      
      ';
      echo $table;

          
    }
          
    ?>
        <?php
       
       include "connect.php";
         $folder = $_GET['name'];
         // getting the page
        if(isset($_GET['page']))
          {
              $page = $_GET['page'];
              
          }
          else
          {
             $page = 1;
          }
          $num_per_page = 05;
          $start_from = ($page-1)*$num_per_page;

       $query=$db->prepare("SELECT * FROM archives where folder = ? && status = 0 limit $start_from,$num_per_page");
       $query->execute(array($fid));
       $list=$query->fetchAll(PDO::FETCH_OBJ);
       foreach ($list as $list2) { ?>
           <!--div style="float: left;border: 2px solid red; width: 200px;height: 100px; margin: 5px;"-->
           <tr> 
               <td style="color: red; font-size: 18px; font-family:'Courier New', Courier, monospace;">
               <?= $list2->documentCode;?></td>
               <td><?= $list2->impamvu;?></td>
               <td><?= $list2->fname;?></td>
               <td><?= $list2->lname;?></td>
               <td><?= $list2->phone;?></td>
               <td><?= $list2->idNumber;?></td>
               <td><?= $list2->amount;?></td>
               <td>
               
              &nbsp;&nbsp;
              <a href="viewfiles.php?id=<?= $list2->id;?>&folder=<?= $list2->folder;?>" style="text-decoration: none;">
              <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" fill="#000000">
	                  <path d="M0 0h24v24H0V0z" fill="none"/>
	                  <path d="M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z"/>
               </svg>
                 Files
              </a>
              </td>
           </tr>
           <?php }	?>
           <!--/div-->
       
        </table>
         <?php
          // getting number of rows uploaded in particula folder
          $query=$db->prepare("SELECT count(*) FROM archives where folder = ?");
          $query->execute(array($folder));
          $total_record=$query->fetchColumn(0);
          
          $total_pages = ceil($total_record/$num_per_page);
          if($page>1)
          {
            echo"<a href='trashfoldercontent.php?page=".($page-1)."&name=".$folder."' class='btn btn-danger m-1'>Previous</a>";
            
          }
          for($i=1; $i<$total_pages; $i++)
          {
            echo"<a href='trashfoldercontent.php?page=".$i."&name=".$folder."' class='btn btn-primary'>$i</a>";
            
          }
          if($i>$page)
          {
            echo"<a href='trashfoldercontent.php?page=".($page+1)."&name=".$folder."' class='btn btn-danger'>Next</a>";
          }
          
          ?>
          
    </main>
        </div>
      </div>
  </div>





    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    
    <!--script src="../js/createfolderfile.js"></script-->

      
  </body>
</html>

<!-- ********************************************* uploadfile modal ******************************-->

<script>
  $(document).ready(function(){
    // delete forever
    $(document).on('click','#deleteforever', function(){
          var action = "deleteforever";
          var folder = $(this).val();
            
            if (confirm("Are you sure to delete "+folder+" " + "folder ?"))
            {
              $.ajax({
                            url:"recover.php",
                            method:"POST",
                            dataType: 'json',
                            data:{folder:folder, action:action},
                            success:function(data)
                            {
                              $('.statusMsg').html();
                              if(data.status == 1){
                                  
                                  $('.statusMsg').html('<p class="alert alert-success">'+data.message+'</p>');
                                     setTimeout(() => {
                                    location.reload();
                                    }, 2000);
                           
                                }else{
                                   $('.statusMsg').html('<p class="alert alert-dander">'+data.message+'</p>');
                                   setTimeout(() => {
                          location.reload();
                         }, 2000);
                                 }
                                  
                                
                            }
                       })
               }
            
            else
            {
              return false;
            }

        });
        //***************** directions  ****************** */

        $(document).on('click', '#right', function(){
  history.back();
});
$(document).on('click', '#left', function(){
  history.forward();
});
  });
</script>

