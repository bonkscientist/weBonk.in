// Allows expansion of sidenav
$(document).ready(function(){
  $('.sidenav').sidenav({
    edge: 'right'
  });
});

$(document).ready(function(){
  $('.collapsible').collapsible();
});

// Dropdown element of navbar
$(".dropdown-trigger").dropdown();

// Close button for dynamic meme page
$('#close-btn').click(function(e) {    
  $('#meme-page').fadeOut('fast', function() {
    $('#meme-gallery').fadeIn('fast');
  });
});