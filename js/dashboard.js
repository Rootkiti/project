


// -------------- folder operation--------
    $(document).ready(function() {
       
    
        
        //------------------  create folder-----------------
        
        $(document).on('click', '#create_folder', function(){
          
            $('#folderModal').show();


        });
        $('#folder_button').on('click', function(){
            var folder_name = $('#folder_name').val();
            var path = $('#path').val();
            var action = "create";
            $.ajax({
                url:"recover.php",
                method:"POST",
                dataType: 'json',
                data:{folder_name:folder_name, action:action},
                success:function(data)
                {
                  $('#folderModal').hide();
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
           });
        });
        // close
        $(document).on('click', '#close', function(){
            
            $('#folderModal').hide();
            $('#editfolderModal').hide();
            $('#changeModal').hide();
            $('#recoverModal').hide();
        });
        $(document).on('click', '.close', function(){
            
            $('#folderModal').hide();
            $('#editfolderModal').hide();
            $('#changeModal').hide();
            $('#recoverModal').hide();
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
                    url:"action.php",
                    method:"POST",
                    dataType: 'json',
                    data:{old_name:old_name, new_name:new_name, action:action},
                    success:function(data)
                    {
                      $('#editfolderModal').hide();
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
     
        //----------------------change password----------------
        $(document).on('click', '#change_password', function(){
            
            
            $('#changeModal').show();
        });
        $('#change_form').on('submit', function(){
            var action = "change";
            var password = $('#password').val();
            var new_password = $('#new_password').val();
            var pass_renter = $('#pass_renter').val();
            $.ajax({
               url: "change.php",
               method: "POST",
               data: {action:action, password:password, new_password:new_password, pass_renter:pass_renter},
               success:function(data){
                   alert(data);
                   $('#changeModal').show();

               }
            })
    });

    //---------------------------  delete folder---------------------------------
    $(document).on('click', '#removefolder', function(){
        var folder_name = $(this).val();
        var action = "delete";
        if(confirm(folder_name+" "+"folder will be sent in trash"))
        {
            $.ajax({
                url:"recover.php",
                method:"POST",
                dataType: 'json',
                data:{folder_name:folder_name, action:action},
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

     //---------------------- recovery question ----------------
     $(document).on('click', '#recovery_question', function(){
            
            
        $('#recoverModal').show();
    });
    $('#recover_form').on('submit', function(){
        var action = "set";
        var question = $('#question').val();
        var answer = $('#answer').val();
        $.ajax({
           url: "action.php",
           method: "POST",
           dataType: 'json',
           data: {action:action, question:question, answer:answer},
           success:function(data)
           {
               
            $('.status').html();
            if(data.status == 1){
                
                $('.status').html('<p class="alert alert-success">'+data.message+'</p>');
                   setTimeout(() => {
                  location.reload();
                 }, 2000);
         
              }else{
                 $('.status').html('<p class="alert alert-dander">'+data.message+'</p>');
                 setTimeout(() => {
                  location.reload();
                 }, 2000);
               }

           }
        })
   });
});

