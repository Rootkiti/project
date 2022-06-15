$('.toggle').on('click', function() {
  $('.container').stop().addClass('active');
});

$('.close').on('click', function() {
  $('.container').stop().removeClass('active');
});
function fpover(){

  b = document.getElementById("fpass");
  b.backgroung_color="red";
};
