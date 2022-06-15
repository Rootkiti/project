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
    <link href="../css/view_archive_desidn.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/zoom.css">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">ARCHIVE KEEPING SYSTEM</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
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
        <div align = "right">
             <svg class="direction" id="right" xmlns="http://www.w3.org/2000/svg" height="48" width="48">
                  <path d="M28 34 18 24 28 14Z"/>
             </svg>

             <svg class="direction" id="left" xmlns="http://www.w3.org/2000/svg" height="48" width="48">
                  <path d="M20 34V14L30 24Z"/></svg>
        </div>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <!----------------------------- form------------------------------- -->
    <form action="printr.php" method="POST" enctype="multipart/form-dat">
      <div class="move-nav">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <lable for="report" style="font-family: bold; font-size: 14px;" >Report<lable>
            <select name="" id="report1" >
                <option value=""></option>
                <option value="day">dayly</option>
                
                <option value="month">monthly</option>
                <option value="year">Annual</option>
            </select>
            <br><br>
            <div id="duretion">
            <lable for="report" style="font-family: bold; font-size: 14px;" >From<lable>
            <select name="from" id="from" >
                
            </select>
            <input type="hidden" value="" name="from1" id="from1">
            <lable for="report" style="font-family: bold; font-size: 14px;" >To<lable>
            <select name="to" id="to" >
                
            </select>
            <input type="hidden" name="to1" value="" id="to1">
            </div>
            <button style="border: none; background: none;" type="submit" name="print">
            <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48">
                	<path d="M32.9 15.6V9H15.1V15.6H12.1V6H35.9V15.6ZM7 18.6Q7 18.6 7.65 18.6Q8.3 18.6 9.3 18.6H38.7Q39.7 18.6 40.35 18.6Q41 18.6 41 18.6H35.9H12.1ZM36.95 23.35Q37.55 23.35 38 22.9Q38.45 22.45 38.45 21.85Q38.45 21.25 38 20.8Q37.55 20.35 36.95 20.35Q36.35 20.35 35.9 20.8Q35.45 21.25 35.45 21.85Q35.45 22.45 35.9 22.9Q36.35 23.35 36.95 23.35ZM32.9 39V29.4H15.1V39ZM35.9 42H12.1V33.2H4V20.9Q4 18.65 5.525 17.125Q7.05 15.6 9.3 15.6H38.7Q40.95 15.6 42.475 17.125Q44 18.65 44 20.9V33.2H35.9ZM41 30.2V20.9Q41 19.9 40.35 19.25Q39.7 18.6 38.7 18.6H9.3Q8.3 18.6 7.65 19.25Q7 19.9 7 20.9V30.2H12.1V26.4H35.9V30.2Z"/>
           </svg>

            </button>

            
        </div>
      </div>
      
        <h2 class="h2"></h2>
        
        <!-------------------------------------  report           -------------------->

        <div id="report_content"></div>
    </form>
       
    </main>
        </div>
      </div>
  </div>
</div>

  </body>
</html>
<!-- --------------- search modal ---------------------------- -->
<script>
  $(document).ready(function(){
    var value;
      $(document).on('change', '#report1', function(){
          value = $(this).val();
          if(value === "day" ){
            $('#from').hide();
            $('#to').hide();

            $('#from1').attr("type","date");
            $('#to1').attr("type","date");


          }
     
          if(value === "month" ){

            $('#from').show();
            $('#to').show();

            $('#from1').attr("type","hidden");
            $('#to1').attr("type","hidden");


            arr = ["January","February","March","April","May","June","July","August","September","October","November","December"];
              var options = " ";
              for(var a = 0; a<arr.length; a++)
              {
                  options += "<option value="+(a+1)+">"+arr[a]+"</option>";
                  document.getElementById('from').innerHTML = options;

                  document.getElementById('to').innerHTML = options;
              }
          }
          if(value === "year" ){

            $('#from').show();
            $('#to').show();

            $('#from1').attr("type","hidden");
            $('#to1').attr("type","hidden");


            arr = [1,2,3,4,5,6];
              var options = " ";
              for(var a = 1; a<50; a++)
              {
                  options += "<option>"+(2020+a)+"</option>";
                  document.getElementById('from').innerHTML = options;

                  document.getElementById('to').innerHTML = options;
              }
          }
      });
      $(document).on('change', '#from,#to', function(){
        var search_value1 = $('#from').val();
        var search_value2 = $('#to').val();
        var action = "report";
       if(search_value1 > search_value2)
       {
                    alert('start value must be lest than end value !');
       }
       else
       {
        $.ajax({
              url:"action.php",
              method:"POST",
              data:{action:action, search_value1:search_value1, search_value2:search_value2, value:value},
              success:function(data)
              {
                $('#report_content').html(data);
                
              }
            })
       }
      });


      $(document).on('change', '#from1,#to1', function(){
        var search_value1 = $('#from1').val();
        var search_value2 = $('#to1').val();
        var action = "report";
        if(search_value1 > search_value2)
       {
                    alert('start value must be lest than end value !');
       }
       else
       {
        $.ajax({
              url:"action.php",
              method:"POST",
              data:{action:action, search_value1:search_value1, search_value2:search_value2, value:value},
              success:function(data)
              {
                $('#report_content').html(data);
                
              }
            })
       }
      });

      $(document).on('click', '#right', function(){
       history.back();
});
$(document).on('click', '#left', function(){
      history.forward();
});


});
</script>
