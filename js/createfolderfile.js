$(document).ready(function(){

    $(document).on('click', '#uploadFile', function(){
        $('#uploadFileModal').show();
    });
    $(document).on('click', '.close', function(){
            
        $('#uploadFileModal').hide();
        

    });
    $(document).on('click', '#close', function(){
            
        $('#uploadFileModal').hide();
        

    });

   /* $(document).on('submit', function(){
        var action = "Upload";
        var dCode = $('#dc').val();
        var phone = $('#tl').val();
        var impamvu = $('#case').val();
        var idn = $('#idn').val();
        var fname = $('#fn').val();
        var amount = $('#am').val();
        var lname = $('#ln').val();
        var file = $('#file').val();
        var folder = $('#hidden_folder_name').val();

        $.ajax({
            url:"createfile.php",
            method:"POST",
            data:{action:action, dCode:dCode, phone:phone, impamvu:impamvu, idn:idn, fname:fname, amount:amount, 
                  lname:lname, file:file, folder:folder},
            
            success:function(data){
                //load_folder_list();
                alert(data);
            }
         })
    } );*/

});