<?php session_start();
/*include "connect.php";
if(!isset($_SESSION["password"]))
         header("location:login.php");*/
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
 
        <!-------------------------------------   php            -------------------->
        <div class="statusMsg"></div>
    <div id="Result_list">
    
    
   
      <table class="table table-striped">
            <tr>
                <th>code</th>
                <th>document category</th>
                <th>first name</th>
                <th>last name</th>
                <th>phone</th>
                <th>idNumber</th>
                <th>amount</th>
               
            </tr>
      
     
   
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
               <td><?= $list2->documentCode;?></td>
               <td><?= $list2->impamvu;?></td>
               <td><?= $list2->fname;?></td>
               <td><?= $list2->lname;?></td>
               <td><?= $list2->phone;?></td>
               <td><?= $list2->idNumber;?></td>
               <td><?= $list2->amount;?></td>
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

    
});
</script>
