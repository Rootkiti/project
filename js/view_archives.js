$(document).ready(function(){
       //--------------  records--------------

       load_record_list();

       function load_record_list() {
            
            var action = "fetch";
            $.ajax({
                url:"archive_action.php",
                method:"POST",
                data:{action:action},
                success:function(data) {
                    $("#record_table").html(data);
                }
            })
           
       }
});