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
          var folder = $('#parentfolder').val();
          var action = "search";
          
          $.ajax({
              url:"folderfilesearch.php",
              method:"POST",
              data:{action:action, folder:folder, search_value:search_value},
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
             var folder_name = $('#folder_name').val();
             var parentfolder = $('#parentfolder').val();
             var path = $('#path').val();
             var action = "create";
             
             $.ajax({
                 type: 'POST',
                 url: 'childfolder.php',
                 data:{folder_name:folder_name, parentfolder:parentfolder, path:path, action:action},
                 dataType: 'json',
                 success: function(data){
                     $('.Msg').html('');
                     if(data.status == 1){
                         
                         $('.Msg').html('<p class="alert alert-success">'+data.message+'</p>');
                         setTimeout(function() {
                          location.reload();
                         }, 2000);
                           
                     }else{
                         $('.Msg').html('<p class="alert alert-dander">'+data.message+'</p>');
                         setTimeout(() => {
                          location.reload();
                         }, 2000);
                     }
                     
                 }
             });
         });


          //------------------  edit folder ---------------
        $(document).on('click', '#editfolder', function(){
             $('#editfolderModal').show();
             var action = "rename";
             var old_name = $(this).val();
             var path = $('#folder_path').val();
             
             $('#new_folder_name').val(old_name);
             $('#edit_button').on('click', function(){
                var new_name = $('#new_folder_name').val();
                $.ajax({
                    url:"recover.php",
                    method:"POST",
                    dataType: 'json',
                    data:{path:path, old_name:old_name, new_name:new_name, action:action},
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
             });
        });


         //---------------------------  delete folder---------------------------------
    $(document).on('click', '#removefolder', function(){
        var folder_name = $(this).val();
        var path = $(this).attr("name");
        var action = "delete";
        if(confirm(folder_name+" "+"folder will be sent in trash"))
        {
            $.ajax({
                url:"recover.php",
                method:"POST",
                dataType: 'json',
                data:{folder_name:folder_name, path:path, action:action},
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
    });
    //***************** view files ************************* */
    $(document).on('click', '#viewfiles', function(){
      $('#viewfilesModal').show();
      var id =$(this).attr("class");
      var folder = $(this).attr("name");
      
      //$('.files').html(folder);
       var action ="viewfiles";
      $.ajax({
                url:"files.php",
                method:"POST",
                data:{id:id, folder:folder, action:action},
                success:function(data)
                {
                    
                    $('.files').html(data);
                   
                }
            })
             
        });


      //*********** close*********** */
      $(document).on('click','#close', function(){
        $('#folderModal').hide();
        $('#editfolderModal').hide();
        $('#viewfilesModal').hide();

      });
//******************* history *********************** */

//*https://grow.google/certificates/?utm_source=gDigital&utm_medium=paidha&utm_campaign=ytdr-gen-mt-glp&utm_content=InDemand_GwG&utm_source=gDigital&utm_medium=paid-ha&utm_campaign=ytdr-pros&gclid=EAIaIQobChMIxdvKqPrz9wIVOeK7CB2xWQNHEAEYASAAEgLQevD_BwE#?modal_active=none*/

$(document).on('click', '#right', function(){
  history.back();
});
$(document).on('click', '#left', function(){
  history.forward();
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
         <div >
        

         <?php
    //***************************************** path link **************************** */
    $path_link = $_GET['path'];
    $paths = explode("/",$path_link);
    
    $paths_number = count($paths) - 1;
    if($paths_number == 0)
    { 
      $folder_id = $_GET['id'];
      $name_query =$db->prepare('SELECT name FROM folders WHERE status = 1 && id = :folder_id');
      $name_query->execute(array(':folder_id' => $folder_id));
      $folder_name = $name_query->fetch(PDO::FETCH_OBJ);

      ?>
      <a href="createfolderfile.php?id=<?=$_GET['id'];?>&folder=<?=$folder_name->name;?>&path=<?=$folder_name->name;?>" style="text-decoration: none"><?=$_GET['folder'];?></a>
      <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20">
        <path d="M7.833 14.646 6.958 13.771 10.75 9.979 6.958 6.188 7.833 5.312 12.5 9.979Z"/>
      </svg>
   <?php  }
    else
    { 

      for ($i = 0; $i<$paths_number; $i++)
    {
      $pathn= $paths[$i];
       
      $f_id =$db->prepare('SELECT id FROM folders WHERE status = 1 && name = :pathn');
      $f_id->execute(array(':pathn' => $pathn));
      $fld_id = $f_id->fetch(PDO::FETCH_OBJ);
       
      $archive_folder = $fld_id->id;
      $path_query =$db->prepare('SELECT path FROM folders WHERE status = 1 && id = :archive_folder');
      $path_query->execute(array(':archive_folder' => $archive_folder));
      $path_name = $path_query->fetch(PDO::FETCH_OBJ);
      $archive_path = substr($path_name->path,8,null).$pathn;
      ?>
      
    <button style="border: none; background: none; margin-left: -11px;" onMouseOver="this.style.background='#b5dafe'" onMouseOut="this.style.background='#fff'">
    <a href="createfolderfile.php?id=<?=$fld_id->id;?>&folder=<?=$pathn?>&path=<?=$archive_path?>" style="text-decoration: none"><?=$paths[$i];?></a>
    </button>
    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" style="margin-left: -11px;">
      <path d="M7.833 14.646 6.958 13.771 10.75 9.979 6.958 6.188 7.833 5.312 12.5 9.979Z"/>
    </svg>
    
    <?php
    }
       ?>
       <button style="border: none; background: none; margin-left: -11px;" onMouseOver="this.style.background='#b5dafe'" onMouseOut="this.style.background='#fff'">
       <a href="" style="text-decoration: none"><?=$_GET['folder'];?></a>
      </button>
      <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" style="margin-left: -11px;">
        <path d="M7.833 14.646 6.958 13.771 10.75 9.979 6.958 6.188 7.833 5.312 12.5 9.979Z"/>
      </svg>
       
       <?php
    }
    ?>
         <svg class="direction" id="right" xmlns="http://www.w3.org/2000/svg" height="48" width="48"><path d="M28 34 18 24 28 14Z"/></svg>

      <svg class="direction" id="left" xmlns="http://www.w3.org/2000/svg" height="48" width="48"><path d="M20 34V14L30 24Z"/>
    </svg>
    
         <?php
            
           @$folder = $_GET['id'];
           @$path = $_GET['path'];

           $namequery=$db->prepare("SELECT name FROM folders where status = 1 && id = :folder ");
          $namequery->execute(array(':folder' => $folder));
          $namelist=$namequery->fetch(PDO::FETCH_OBJ);
           
           $query=$db->prepare("SELECT * FROM folders where status = 1 && parentfolder = :folder ");
          $query->execute(array(':folder' => $folder));
          $list=$query->fetchAll(PDO::FETCH_OBJ);
          
          $a=0;
       foreach ($list as $list2) { 
          $ln = strlen($list2->name);
          $a +=1;
          if($a <=1):
         ?>
         <?php
         $idquery=$db->prepare("SELECT id FROM folders where status = 1 && parentfolder = :folder ");
         $idquery->execute(array(':folder' => $folder));
         $idlist=$idquery->fetch(PDO::FETCH_OBJ);
         ?>
      
      <?php endif; }
           
           	?>
      </div>
        </div>
        
        </div>
        
        <h2 class="h2"></h2>
        
       <?php
            
           @$folder = $_GET['id'];
           @$path = $_GET['path'];
           
           $query=$db->prepare("SELECT * FROM folders where status = 1 && parentfolder = :folder ");
          $query->execute(array(':folder' => $folder));
          $list=$query->fetchAll(PDO::FETCH_OBJ);
       
       foreach ($list as $list2) { 
        
         ?>
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
                          
                        <button id="removefolder" style="border:none ; background: none; " value="<?=$list2->name;?>" name="<?=$list2->path;?>">
                               <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 13H5v-2h14v2z"/></svg>
                        </button>
                      </div>
                       
                      
                      <a id="folder" href="createfolderfile.php?id=<?=$list2->id;?>&&folder=<?=$list2->name;?>&&path=<?=$path.'/'.$list2->name;?>" style="text-decoration: none; cursor: auto;padding: -1cm;">
                      <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 50 512 512" height="100px" width="100px" fill="#d3a13b"  class="svg">
                        <path d="M464 128H272l-64-64H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V176c0-26.51-21.49-48-48-48z"/></svg>
                      </a>
                      <br />
                      <span style="font-size:12px; font-family: bold; "><?=$list2->name;?> </span>
           </div>
           
           <?php }
           
           	?>
           <!--/div-->
           
           
        <!--********************************  output *******************************-->
        <div style="margin-left: -.5cm;" id="Result_list">
        <?php
       
       include "connect.php";
       
      
       $sql="SELECT count(*) FROM archives where status=1 && folder = '$_GET[id]'";
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
         @$folder = $_GET['id'];
         @$path = $_GET['path'];
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

       $query=$db->prepare("SELECT * FROM archives where folder = ? && status = 1 limit $start_from,$num_per_page");
       $query->execute(array($folder));
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
                 
              
              <a id="viewfiles" class="<?= $list2->id;?>" name="<?=$folder;?>" style="text-decoration: none; cursor: pointer;">
              <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" fill="#000000">
	                  <path d="M0 0h24v24H0V0z" fill="none"/>
	                  <path d="M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z"/>
               </svg>
                 Files
              </a>
              <a style="text-decoration: none;" id="download" href="download.php?id=<?= $list2->id;?>&folder=<?=$folder;?>">
              <svg xmlns="http://www.w3.org/2000/svg" height="38" width="40">
                <path d="M24 32.35 14.35 22.7 16.5 20.55 22.5 26.55V8H25.5V26.55L31.5 20.55L33.65 22.7ZM11 40Q9.8 40 8.9 39.1Q8 38.2 8 37V29.85H11V37Q11 37 11 37Q11 37 11 37H37Q37 37 37 37Q37 37 37 37V29.85H40V37Q40 38.2 39.1 39.1Q38.2 40 37 40Z"/>
              </svg>
              Files
                </a>

              &nbsp;
              <a  href="printfiles.php?id=<?= $list2->id;?>&folder=<?=$folder;?>" style="text-decoration: none;">
              <svg xmlns="http://www.w3.org/2000/svg" height="35" width="48">
	                <path d="M32.9 15.6V9H15.1V15.6H12.1V6H35.9V15.6ZM7 18.6Q7 18.6 7.65 18.6Q8.3 18.6 9.3 18.6H38.7Q39.7 18.6 40.35 18.6Q41 18.6 41 18.6H35.9H12.1ZM36.95 23.35Q37.55 23.35 38 22.9Q38.45 22.45 38.45 21.85Q38.45 21.25 38 20.8Q37.55 20.35 36.95 20.35Q36.35 20.35 35.9 20.8Q35.45 21.25 35.45 21.85Q35.45 22.45 35.9 22.9Q36.35 23.35 36.95 23.35ZM32.9 39V29.4H15.1V39ZM35.9 42H12.1V33.2H4V20.9Q4 18.65 5.525 17.125Q7.05 15.6 9.3 15.6H38.7Q40.95 15.6 42.475 17.125Q44 18.65 44 20.9V33.2H35.9ZM41 30.2V20.9Q41 19.9 40.35 19.25Q39.7 18.6 38.7 18.6H9.3Q8.3 18.6 7.65 19.25Q7 19.9 7 20.9V30.2H12.1V26.4H35.9V30.2Z"/>
              </svg>
                 Files
              </a>
              <!-- #################### EDIT ################################-->
              <a href="editfile.php?fileid=<?= $list2->id;?>&folder=<?= $list2->folder;?>&path=<?=$path;?>&folderid=<?=$folder;?>" style="text-decoration: none;">

              <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" fill="#000000">
	              <path d="M0 0h24v24H0V0z" fill="none"/>
	              <path d="M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z"/>
              </svg>
              Edit
              </a>
              <!-- #################### DELETE ################################-->
                <a onclick="return confirm('Are Your sure You Want To Delete This Record ?')" href="deletefile.php?id=<?= $list2->id; ?>&folder=<?= $list2->folder;?>&path=<?=$path;?>" style="text-decoration: none;">
                  
              
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
            echo"<a href='createfolderfile.php?page=".($page-1)."&id=".$folder."' class='btn btn-danger m-1'>Previous</a>";
            
          }
          for($i=1; $i<$total_pages; $i++)
          {
            echo"<a href='createfolderfile.php?page=".$i."&id=".$folder."' class='btn btn-primary'>$i</a>";
            
          }
          if($i>$page)
          {
            echo"<a href='createfolderfile.php?page=".($page+1)."&id=".$folder."' class='btn btn-danger'>Next</a>";
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
<?php

       $idquery=$db->prepare("SELECT documentCode, id FROM archives order by documentCode desc");
       $idquery->execute(array());
       $idlist=$idquery->fetch(PDO::FETCH_OBJ);
       $lastid = $idlist->documentCode;
       $ids = $idlist->documentCode;

       if(empty($lastid))
       {
         $prefix = 'A';
         $sfix =1;
         $sfix = str_pad($sfix,4,0,STR_PAD_LEFT) ;
         $inputid = $prefix.'-'.$sfix;

       }
       else
       {
          
        $prefix = substr($lastid, 0,-5);
        $sfix= (int)substr($lastid, 2, null);
        $sfix = str_pad($sfix,4,0,STR_PAD_LEFT) ;
        
        if($sfix == 9999)
         {
            $prefix++;
            $sfix = 0001;
            $sfix = str_pad($sfix,4,0,STR_PAD_LEFT) ;
            $inputid = $prefix.'-'.$sfix;

    
          }
            else
             {
             $sfix++;
             $sfix = str_pad($sfix,4,0,STR_PAD_LEFT) ;
             $inputid = $prefix.'-'.$sfix;
            }

       }
       
?>

<div id="uploadFileModal" class="modal fadeOut" role="dialog" >
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
                                <td> <input type="text" name="documentCode" id="documentCode"  value="<?=$inputid;?>" class="form-control" required="required" readonly style="color: red; font-size: 24px;"/></td>
                                <td> <input type="tel" name="phone" id="phone" pattern="[0-9]{10}" placeholder="tel: 0781236541" class="form-control" required="required" /></td>
                            </tr>
                            <tr>
                                <td> <textarea name="impamvu" id="impamvu" cols="30" rows="5" placeholder="Document Category" class="form-control" required="required" /></textarea></td>
                                <td> <input type="text" name="idNumber" id="idNumber" pattern="[0-9]{16}" placeholder="ID Number" class="form-control" required="required" /></td>
                            </tr>
                            <tr>
                                <td> <input type="text" name="fname" id="fname" placeholder="First Name" class="form-control" required="required" /></td>
                                <td> <input type="number" name="amount" id="amount" pattern="[0-9]" placeholder="Amount Paid" class="form-control" required="required" /></td>
                            </tr>
                            <tr>
                                <td> <input type="text" name="lname" id="lname" placeholder="Last Name" class="form-control" required="required" />
                                     <input type="hidden" name="path" id="file_path" value="<?= $_GET['path'];?>">
                              </td>
                                <td> <input type="file" class="form-control" name="files[]" id="file" placeholder="enter file" multiple required="required" /></td>
                            </tr>
                        </table>
                    </p>
                    <br>
                    <input type="hidden" name="hidden_folder_name" id="hidden_folder_name" value="<?= $_GET['id'];?>">
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
                
                <input type="hidden" name="parentfolder" id="parentfolder" value="<?= $_GET['id'];?>">
                <input type="hidden" name="path" id="path" value="<?= $_GET['path'];?>">
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
            <div class="statusMsg"></div>
                <p>
                    Enter Folder Name
                    <input type="text" name="new_folder_name" id="new_folder_name" class="form-control" required="required">
                </p>
                <br>
                <input type="hidden" name="folder_path" id="folder_path" value="<?= $_GET['path'];?>">
                <input type="button" name="edit_button" id="edit_button" class="btn btn-info" value="Edit">
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-default" data-dismiss="modal">Close</button>                
            </div>
        </div>
        
    </div>
</div>

<!-- ---------------------------- view files modal -------------------------->
<div id="viewfilesModal" class="modal fadeOut" role="dialog" style="overflow-y:auto;">
    <div class="modal-dialog" style="overflow-y: initial !important;">
        <div class="modal-content" style="width: 7cm; margin-top: 3cm;">
            <div class="modal-header">
                <h4 class="mdal-title"><span id="change_title">Files</span></h4>
            </div>
            <div class="modal-body" style="height: 50vh;overflow-y: auto; ">
            <div class="statusMsg"></div>
               <form action="viewfiles.php">
               <p class="files">
                    files will be here
                </p>
                <br>
                <input type="hidden" name="folder_path" id="folder_path" value="<?= $_GET['path'];?>">
                
                <input type="submit" class="btn btn-info" value="View In Full">
                
                
               </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-default" data-dismiss="modal">Close</button>                
            </div>
        </div>
        
    </div>
</div>
