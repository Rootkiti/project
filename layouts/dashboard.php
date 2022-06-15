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
    <link href="../css/dashboard_design.css" rel="stylesheet">
    <link href="../css/style1.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/zoom.css">
  
  <script src="../styles/jquery-3.js"></script>
  
  </head>
  <body >
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">ARCHIVE KEEPING SYSTEM</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <!-- erarch-->
    </div>
  </div>
</header>
  
<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">
              <span data-feather="home"></span>
              
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 5.69l5 4.5V18h-2v-6H9v6H7v-7.81l5-4.5M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3z"/></svg>
              Dashboard
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
      </div>

      <div class="">
         <a class="nav-link px-3" href="report.php">
      <span>
      <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g><path d="M0,0h24v24H0V0z" fill="none"/></g><g><g><path d="M15,3H5C3.9,3,3.01,3.9,3.01,5L3,19c0,1.1,0.89,2,1.99,2H19c1.1,0,2-0.9,2-2V9L15,3z M5,19V5h9v5h5v9H5z M9,8 c0,0.55-0.45,1-1,1S7,8.55,7,8s0.45-1,1-1S9,7.45,9,8z M9,12c0,0.55-0.45,1-1,1s-1-0.45-1-1s0.45-1,1-1S9,11.45,9,12z M9,16 c0,0.55-0.45,1-1,1s-1-0.45-1-1s0.45-1,1-1S9,15.45,9,16z"/></g></g></svg>

Report
      </span>
          </a>
       </div>

       
        <div class="dropdown">
           <span>
             
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19.43 12.98c.04-.32.07-.64.07-.98 0-.34-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.09-.16-.26-.25-.44-.25-.06 0-.12.01-.17.03l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.06-.02-.12-.03-.18-.03-.17 0-.34.09-.43.25l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98 0 .33.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.09.16.26.25.44.25.06 0 .12-.01.17-.03l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.06.02.12.03.18.03.17 0 .34-.09.43-.25l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zm-1.98-1.71c.04.31.05.52.05.73 0 .21-.02.43-.05.73l-.14 1.13.89.7 1.08.84-.7 1.21-1.27-.51-1.04-.42-.9.68c-.43.32-.84.56-1.25.73l-1.06.43-.16 1.13-.2 1.35h-1.4l-.19-1.35-.16-1.13-1.06-.43c-.43-.18-.83-.41-1.23-.71l-.91-.7-1.06.43-1.27.51-.7-1.21 1.08-.84.89-.7-.14-1.13c-.03-.31-.05-.54-.05-.74s.02-.43.05-.73l.14-1.13-.89-.7-1.08-.84.7-1.21 1.27.51 1.04.42.9-.68c.43-.32.84-.56 1.25-.73l1.06-.43.16-1.13.2-1.35h1.39l.19 1.35.16 1.13 1.06.43c.43.18.83.41 1.23.71l.91.7 1.06-.43 1.27-.51.7 1.21-1.07.85-.89.7.14 1.13zM12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 6c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/></svg>
             Settings
            </span>
           <div class="dropdown-content">
               <button  class="change_password" id="change_password" style="border:none; background:none;" name="change_password" value="submit" onMouseOver="this.style.background='#b9b8b8'" onMouseOut="this.style.background='#fff'">Change Password</button>
               <button  id="recovery_question" style="border:none; background:none;" name="recoverQ" value="submit" onMouseOver="this.style.background='#b9b8b8'" onMouseOut="this.style.background='#fff'">Set Recovery Question</button>
               <a  href="trash.php" id="trash" style="background:none; color:black;" name="trash" value="#" onMouseOver="this.style.background='#b9b8b8'" onMouseOut="this.style.background='#fff'">Trash</a>
               
            </div>
        </div>
        
        

       <div class="logout">
         <a class="nav-link px-3" href="logout.php">
           
<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g><path d="M0,0h24v24H0V0z" fill="none"/></g><g><path d="M17,8l-1.41,1.41L17.17,11H9v2h8.17l-1.58,1.58L17,16l4-4L17,8z M5,5h7V3H5C3.9,3,3,3.9,3,5v14c0,1.1,0.9,2,2,2h7v-2H5V5z"/></g></svg>
           Sign out
          </a>
       </div>

      
    </nav>
          
    <nav>
      <div class="container" style="margin-left: 6.2cm; width:28cm;  ">
               
                  
                     <div align = "right">
                       <button type="button" name="create_folder" id="create_folder" class="btn btn-success m-2">create Folder</button>
           
                      </div>
                      <div class="statusMsg"></div>
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
          $num_per_page = 24;
          $start_from = ($page-1)*$num_per_page;

       $query=$db->prepare("SELECT * FROM folders where status = 1 && parentfolder='dashboard' limit $start_from,$num_per_page");
       $query->execute(array());
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
                       <button id="editfolder" style="border:none ; background: none; " value="<?=$list2->name;?>">
                            <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24"     width="18px"fill="#000000">
	                             <path d="M0 0h24v24H0V0z" fill="none"/>
                               <path d="M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z"/></svg>
                       </button>
                          
                        <button id="removefolder" style="border:none ; background: none; " value="<?=$list2->name;?>">
                               <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 13H5v-2h14v2z"/></svg>
                        </button>
                      </div>
                       
                      
                      <a id="folder" href="createfolderfile.php?id=<?=$list2->id;?>&&folder=<?=$list2->name;?>&&path=<?=$list2->name;?>" style="text-decoration: none; cursor: auto;padding: -1cm;">
                      <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 50 512 512" height="100px" width="100px" fill="#d3a13b"  class="svg">
                        <path d="M464 128H272l-64-64H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V176c0-26.51-21.49-48-48-48z"/></svg>
                      </a>
                      <br />
                      <span style="font-size:12px; font-family: bold; "><?=$list2->name;?> </span>
           </div>
           
           <?php }	?>
           <!--/div-->
           
           
           <?php
          // getting number of rows uploaded in particula folder
          $query=$db->prepare("SELECT count(*) FROM folders where status = 1");
          $query->execute(array());
          $total_record=$query->fetchColumn(0);
          
          $total_pages = ceil($total_record/$num_per_page);
          if($page>1)
          {
            echo"<a href='dashboard.php?page=".($page-1)."' class='btn btn-danger m-1'>Previous</a>";
            
          }
          for($i=1; $i<$total_pages; $i++)
          {
            echo"<a href='dashboard.php?page=".$i."' class='btn btn-primary m-1'>$i</a>";
            
          }
          if($i>$page)
          {
            echo"<a href='dashboard.php?page=".($page+1)."' class='btn btn-danger m-1'>Next</a>";
          }
          
          ?>
                                         
                       
              </div>
        </nav>                  
                   
            </div>
            <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
             <script src="../js/jquery-3.js"></script>
             <script src="../js/dashboard.js"></script>
            
          </div>         
        </div>
  </body>
</html>
<!-- ----------------------------- create folder  modal---------------------------------    -->
<div id="folderModal" class="modal fadeOut" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 7cm; margin-top: 3cm;">
            <div class="modal-header">
                <h4 class="mdal-title"><span id="change_title">Create Folder</span></h4>
            </div>
            <div class="modal-body">
                <p>
                    Enter Folder Name
                    <input type="text" name="folder_name" id="folder_name" class="form-control" required="required" />
                </p>
                <br>
                <input type="hidden" name="action" id="action">
                <input type="hidden" name="old_name" id="old_name">
                <input type="button" name="folder_button" id="folder_button" class="btn btn-info" value="Create">
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-default" data-dismiss="modal">Close</button>                
            </div>
        </div>
        
    </div>
</div>

<!-- ------------------------------- change password modal------------------------------ -->
<div id="changeModal" class="modal fadeOut" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="mdal-title"><span id="change_title">change password</span></h4>
              
            </div>
            <div class="modal-body">
                <form method="POST" id="change_form" enctype="multipart/form-data">
                <p>
                    <input type="password" name="password" id="password" placeholder="current password" class="form-control">
                </p>
                <p>
                    <input type="password" name="new_password" id="new_password" placeholder="new password"  class="form-control">
                </p>
                <p>
                    <input type="password" name="pass_renter" id="pass_renter" placeholder="Re-enter new password" class="form-control">
                </p>
               
                <input type="submit" name="upload_button" class="btn btn-info" value="change">
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-default" data-dismiss="modal">Close</button>                
            </div>
        </div>
        
    </div>
</div>
<!-- ------------------------------recover modal----------------- -->
<div id="recoverModal" class="modal fadeOut" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="mdal-title"><span id="change_title">Set Recovery Question </span></h4>
                
            </div>
            <div class="modal-body">
              
                <form method="POST" id="recover_form" enctype="multipart/form-data">
                  <div class="status"></div>
                <p>
                    <input type="text" name="question" id="question" placeholder="Recovery Question" required="required" class="form-control">
                </p>
                <p>
                    <input type="text" name="answer" id="answer" placeholder="Answer" required="required" class="form-control">
                </p>
                               
                <input type="submit" name="upload_button" class="btn btn-info" value="Set">
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-default" data-dismiss="modal">Close</button>                
            </div>
        </div>
        
    </div>
</div>
<!-- ---------------------------- edit folder -------------------------->
<div id="editfolderModal" class="modal fadeOut" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 7cm; margin-top: 3cm;">
            <div class="modal-header">
                <h4 class="mdal-title"><span id="change_title">Rename Folder</span></h4>
            </div>
            <div class="modal-body">
            <div class="statusMsg"></div>
                <p>
                    Enter Folder Name
                    <input type="text" name="new_folder_name" id="new_folder_name" class="form-control" required="required">
                </p>
                <br>
                
                <input type="button" name="edit_button" id="edit_button" class="btn btn-info" value="Edit">
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-default" data-dismiss="modal">Close</button>                
            </div>
        </div>
        
    </div>
</div>

