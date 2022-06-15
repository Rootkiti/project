// Can also be used with $(document).ready() / $(window).load()
$(document).ready(function(){
  $('body').css('display', 'none');
  $('body').fadeIn(500);

  // An offset to push the content down from the top
  var listElement = $('#mynav li');
 
  

  
  listElement.find('a[href^="#"]').click(function(event) { 
    // Prevent from default action to intitiate
    event.preventDefault();
    
    // The id of the section we want to go to.
    var anchorId = $(this).attr("href");
    
    // Our scroll target : the top position of the
    // section that has the id referenced by our href.
        if (anchorId.length > 1 && $(anchorId).length > 0)
        {
     var target = $(anchorId).offset().top - offset;
        }
        else
        {
         var target = 0;
        }
    //console.log(target);
    
    
    $('html, body').animate({ scrollTop: target }, 500, function () {
      //window.location.hash = '!' + id;
      window.location.hash = anchorId;
    });
    
    setActiveListElements();

  });
  

       // Update current item class
  function setActiveListElements(event){
    var windowPos = $(window).scrollTop();
    $('#mynav li a[href^="#"]').each(function() { 

            var currentLink = $(this);
      if ($(currentLink.attr("href")).length > 0)
                {
                var refElement = $(currentLink.attr("href"));
                if (refElement.position().top <= windowPos && (refElement.position().top + refElement.height() + $("#mynav").height() ) > windowPos) {
                    $('#mynav li a').removeClass("current");
                    currentLink.addClass("current");
                }
                else{
                    currentLink.removeClass("current");
                }
            }
    });
  }
  
  

    // Update menu item on scroll
  $(window).scroll(function() {
           // Call function
    setActiveListElements();
  });



  $('#home').click(function () {
    $('html, body').animate({ scrollTop: 0}, 1250);
    return false;
  });

});
