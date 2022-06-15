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
  <script>
    $(document).ready(function(e){
          $(document).on('click', '#uploadFile', function(){
          $('#uploadFileModal').show();
          });
          $(document).on('click', '.close', function(){
            
          $('#uploadFileModal').hide();
        

          });
         $(document).on('click', '#close', function(){
            
            $('#uploadFileModal').hide();
        

          });
             $("#fupForm").on('submit', function(e){
             e.preventDefault();
             $.ajax({
                 type: 'POST',
                 url: 'submit.php',
                 data: new FormData(this),
                 dataType: 'json',
                 contentType: false,
                 cache: false,
                 processData: false,
                 beforeSend: function(){
                     $('.submitBtn').attr("disabled","disabled");
                     $('#fupForm').css("opacity",".5");
                     
                 },
                 success: function(response){
                     $('.statusMsg').html('');
                     if(response.status == 1){
                         $('#fupForm')[0].reset();
                         $('.statusMsg').html('<p class="alert alert-success">'+response.message+'</p>');
                         setTimeout(function() {
                          location.reload();
                         }, 3000);
                           
                     }else{
                         $('.statusMsg').html('<p class="alert alert-dander">'+response.message+'</p>');
                         setTimeout(() => {
                          location.reload();
                         }, 3000);
                     }
                     $('#fupForm').css("opacity","");
                     $(".submitBtn").removeAttr("disabled");
                 }
             });
         });
         
         // file type validation
        $("#file").change(function() {
              var file = this.files[0];
              var imagefile = file.type;
              var match = ['application/pdf','application/wnd.ms-office','image/jpeg','image/png','image/jpg','image/JPG','image/PNG','image/JPEG'];
              if(!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]) || (imagefile == match[3]) || (imagefile == match[4]) || (imagefile == match[5]) || (imagefile == match[6]) || (imagefile == match[7]))){
                  alert('sorry, only PDF, DOC, JPG, JPEG, & PNG are allowed');
                  $("#file").val('');
                  return false;
              }
        });


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

      //************* create folder   ******************** ***/
      $(document).on('click','#createfolder', function(){
        $('#folderModal').show();

      });
      $('#createfolderform').on('submit', function(e){
             e.preventDefault();
             $.ajax({
                 type: 'POST',
                 url: 'childfolder.php',
                 data: new FormData(this),
                 dataType: 'json',
                 contentType: false,
                 cache: false,
                 processData: false,
                 success: function(response){
                     $('.Msg').html('');
                     if(response.status == 1){
                         
                         $('.Msg').html('<p class="alert alert-success">'+response.message+'</p>');
                         setTimeout(function() {
                          location.reload();
                         }, 2000);
                           
                     }else{
                         $('.Msg').html('<p class="alert alert-dander">'+response.message+'</p>');
                         setTimeout(() => {
                          location.reload();
                         }, 2000);
                     }
                     
                 }
             });
         });

      //*********** close*********** */
      $(document).on('click','#close', function(){
        $('#folderModal').hide();

      });

    });
     </script>
    
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
  <input id="search_value" value="" class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
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
         <div class="dropdown" >
           <svg  class="add" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="24" width="24"><path d="M352 240v32c0 6.6-5.4 12-12 12h-88v88c0 6.6-5.4 12-12 12h-32c-6.6 0-12-5.4-12-12v-88h-88c-6.6 0-12-5.4-12-12v-32c0-6.6 5.4-12 12-12h88v-88c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v88h88c6.6 0 12 5.4 12 12zm96-160v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48zm-48 346V86c0-3.3-2.7-6-6-6H54c-3.3 0-6 2.7-6 6v340c0 3.3 2.7 6 6 6h340c3.3 0 6-2.7 6-6z"/></svg>
            <div class="dropdown-content" style=" margin-left: .6cm;">
                <button id="createfolder" style="border:none; background:none; margin: 10px;"  onMouseOver="this.style.background='#b9b8b8'" onMouseOut="this.style.background='#fff'"> create folder</button>
                <button id="uploadFile" style="border:none; background:none;"  onMouseOver="this.style.background='#b9b8b8'" onMouseOut="this.style.background='#fff'">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="15px" width="15px"><path d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"/></svg>
                        Upload File
                    </span>
                </button>
            </div>
         </div>
         
        </div>
        </div>
        <h2 class="h2"></h2>
       <?php
        $query=$db->prepare("SELECT * FROM folders where status = 1 limit $start_from,$num_per_page");
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
                       
                      
                      <a id="folder" href="createfolderfile.php?name=<?=$list2->name;?>" style="text-decoration: none; cursor: auto;padding: -1cm;">
                      <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 50 512 512" height="100px" width="100px" fill="#d3a13b"  class="svg">
                        <path d="M464 128H272l-64-64H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V176c0-26.51-21.49-48-48-48z"/></svg>
                      </a>
                      <br />
                      <span style="font-size:12px; font-family: bold; "><?=$list2->name;?> </span>
           </div>
           
           <?php }	?>
           <!--/div-->
           
           
        <!--********************************  output *******************************-->
        <div id="Result_list">
        <table class="table table-striped" cellspacing="0" cellpadding="10" style="width: 25cm;">
            <tr>
                <th>code</th>
                <th>document category</th>
                <th>first name</th>
                <th>last name</th>
                <th>phone</th>
                <th>idNumber</th>
                <th>amount</th>
                <th>         </th>
            </tr>
        <?php
       
       include "connect.php";
         @$folder = $_GET['name'];
         // getting the page
        if(isset($_GET['page']))
          {
              $page = $_GET['page'];
              
          }
          else
          {
             $page = 1;
          }
          $num_per_page = 03;
          $start_from = ($page-1)*$num_per_page;

       $query=$db->prepare("SELECT * FROM archives where folder = ? limit $start_from,$num_per_page");
       $query->execute(array($folder));
       $list=$query->fetchAll(PDO::FETCH_OBJ);
       foreach ($list as $list2) { ?>
           <!--div style="float: left;border: 2px solid red; width: 200px;height: 100px; margin: 5px;"-->
           <tr> 
               <td><?= $list2->documentCode;?></td>
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
              &nbsp;&nbsp;
              <a href="editfile.php?id=<?= $list2->id;?>&folder=<?= $list2->folder;?>" style="text-decoration: none;">

              <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" fill="#000000">
	              <path d="M0 0h24v24H0V0z" fill="none"/>
	              <path d="M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z"/>
              </svg>
              Edit
              </a>
              &nbsp;&nbsp;
                <a onclick="return confirm('Are Your sure You Want To Delete This Record ?')" href="deletefile.php?id=<?= $list2->id; ?>&folder=<?= $list2->folder;?>" style="text-decoration: none;">
                  
              
                  <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="20px" fill="#000000">
                     	<path d="M0 0h24v24H0V0z" fill="none"/>
	                    <path d="M19 13H5v-2h14v2z"/>
                  </svg>
                  Delete
                </a>
              </td>
           </tr>
           <?php }	?>
           <!--/div-->
       
        </table>
        </div>
         <?php
          // getting number of rows uploaded in particula folder
          $query=$db->prepare("SELECT count(*) FROM archives where folder = ?");
          $query->execute(array($folder));
          $total_record=$query->fetchColumn(0);
          
          $total_pages = ceil($total_record/$num_per_page);
          if($page>1)
          {
            echo"<a href='createfolderfile.php?page=".($page-1)."&name=".$folder."' class='btn btn-danger m-1'>Previous</a>";
            
          }
          for($i=1; $i<$total_pages; $i++)
          {
            echo"<a href='createfolderfile.php?page=".$i."&name=".$folder."' class='btn btn-primary'>$i</a>";
            
          }
          if($i>$page)
          {
            echo"<a href='createfolderfile.php?page=".($page+1)."&name=".$folder."' class='btn btn-danger'>Next</a>";
          }
          
          ?>
          
    </main>
        </div>
      </div>
  </div>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

<!-- ********************************************* uploadfile modal ******************************-->

<div id="uploadFileModal" class="modal fadeOut" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="mdal-title"><span id="change_title">Upload File</span></h4>
            </div>
            <div class="modal-body">
              <!--  status message--->
              <div class="statusMsg"></div>
                <form  id="fupForm" enctype="multipart/form-data">
                    <p>
                        <table border="0" cellpadding="5" cellspacing="5">
                            
                            <tr>
                                <td> <input type="number" name="documentCode" id="documentCode"  placeholder="Document code" class="form-control" required="required" /></td>
                                <td> <input type="tel" name="phone" id="phone" pattern="[0-9]{10}" placeholder="tel: 0781236541" class="form-control" required="required" /></td>
                            </tr>
                            <tr>
                                <td> <textarea name="impamvu" id="impamvu" cols="30" rows="5" placeholder="case" class="form-control" required="required" /></textarea></td>
                                <td> <input type="text" name="idNumber" id="idNumber" pattern="[0-9]{16}" placeholder="ID Number" class="form-control" required="required" /></td>
                            </tr>
                            <tr>
                                <td> <input type="text" name="fname" id="fname" placeholder="First Name" class="form-control" required="required" /></td>
                                <td> <input type="number" name="amount" id="amount" pattern="[0-9]" placeholder="Amount Paid" class="form-control" required="required" /></td>
                            </tr>
                            <tr>
                                <td> <input type="text" name="lname" id="lname" placeholder="Last Nmae" class="form-control" required="required" /></td>
                                <td> <input type="file" class="form-control" name="files[]" id="file" placeholder="enter file" multiple required="required" /></td>
                            </tr>
                        </table>
                    </p>
                    <br>
                    <input type="hidden" name="hidden_folder_name" id="hidden_folder_name" value="<?= $_GET['name'];?>">
                    <input type="submit" name="submit" class="btn btn-success submitBtn" value="SUBMIT" >
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-default" data-dismiss="modal">Close</button>                
            </div>
        </div>
        
    </div>
</div>

<!-- ----------------------------- create folder  modal---------------------------------    -->
<div id="folderModal" class="modal fadeOut" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 7cm; margin-top: 3cm;">
            <div class="modal-header">
                <h4 class="mdal-title"><span id="change_title">Create Folder</span></h4>
            </div>
            <div class="modal-body">
               <form id="createfolderform" enctype="multipart/form-data">
                 <div class="Msg"></div>
               <p>
                    Enter Folder Name
                    <input type="text" name="folder_name" id="folder_name" class="form-control" required="required" />
                </p>
                <br>
                
                <input type="hidden" name="parentfolder" id="parentfolder" value="<?= $_GET['name'];?>">
                <input type="submit" name="submit" id="folder_button" class="btn btn-info" value="Create">
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
