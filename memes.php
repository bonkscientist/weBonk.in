<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>weBONK</title>

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/jpg" href="img/weBONK_Favicon.png"/>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>

<body class="black white-text">

  <header>
    <!-- Navigation Bar -->
    <div class="navbar-fixed text-orange">
      <nav class="grey darken-5" role="navigation">

        <div class="nav-wrapper">
          <a id="logo-container" href="#" class="brand-logo">
            <img class="left-align" src="img/weBONK_Logo-Transparent.png" alt="weBONK logo" class="align-text-top">
          </a>

          <!-- Normal Nav Bar -->
          <ul class="main-nav right hide-on-med-and-down">
            <li class="waves-effect"><a href="index.html">HOME</a></li>
            <li class="waves-effect"><a class="active" href="memes.php">MEMES</a></li>
          </ul>

          <!-- Mobile Menu Trigger -->
          <a href="#" data-target="nav-mobile" class="sidenav-trigger right">
            <i class="material-icons">menu</i>
          </a>
        </div>
      </nav>
    </div>

    <!-- Mobile Nav Bar -->
    <ul id="nav-mobile" class="sidenav right-align">
      <li><a class="active" href="index.html">HOME</a></li>
      <li><a href="#">MEMES</a></li>
    </ul>
  </header>

  <main>
    <div class="container">
      <div class="section">
        <p class="center-align">send your memes to <a class="orange-text" href="mailto: weBONK@protonmail.com">weBONK@protonmail.com</a> to get listed</p>
      </div>



      <div id="meme-gallery" class="section">

        <div id="meme-gallery-content">
        </div>

        <div id="page-controls" class="center row">
          <!-- Previous Page -->
          <a class="ph-button-theme  btn  waves-effect waves-orange" onclick="changePage(-1)">
            <i class="material-icons orange-text">chevron_left</i>
          </a>

          <!-- Dropdown Trigger -->
          <a class="ph-button-theme dropdown-trigger btn waves-effect waves-orange margin-lr-10" href='#'
          data-target='sorting-dropdown'>CHANGE SORTING</a>

          <!-- Dropdown Sorting Button -->
          <ul id='sorting-dropdown' class='dropdown-content'>
            <li><a href="#!" onclick="changeSorting(1)">Newest first</a></li>
            <li><a href="#!" onclick="changeSorting(2)">Oldest first</a></li>
          </ul>

          <!-- Next Page -->
          <a class="ph-button-theme btn waves-effect waves-orange" onclick="changePage(1)">
            <i class="material-icons orange-text">chevron_right</i>
          </a>
        </div>
      </div>



      <!-- Dynamic Meme Page -->
      <div id="meme-page" class="section">
        <div id="meme-page-content"></div>

        <p class="center-align">
          <a id="close-btn" class="ph-button-theme bold waves-effect btn-large center-align">
            <i class="material-icons left">navigate_before</i>return
          </a>
        </p>

      </div>


    </div>
  </main>

  <!-- Footer -->
  <footer class="page-footer grey darken-5">

  </footer>


  <!-- Meme Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

<?php include('php/get_max_page.php') ?>

  <script type="text/javascript">
    var max_page = <?php echo $max_page; ?>;
    var current_page = 1;
    var sorting = 1;

    function loadMemeGallery (page, sort) {
      $.post('php/load_meme_gallery.php', {new_page:page, sort:sorting}, function(data) {
        $('#meme-gallery-content').html(data);
      });
    }

    function loadMemePage (meme_id) {
      // Load the relevant content into the meme page
      $.post('php/load_meme_page.php', {id:meme_id}, function(data) {
        $('#meme-page-content').html(data);
      });

      // Transition to loaded meme page
      $('#meme-gallery').fadeOut('fast', function(){
        $('#meme-page').fadeIn('fast');
        $("html, body").animate({ scrollTop: 0 }, "fast");
      });
    }

    function changePage (inc) {
      var new_page = current_page + inc;

      if (new_page > 0 && new_page <= max_page) {
        current_page = current_page + inc;
      
        loadMemeGallery (current_page, sorting);
        $('#meme-gallery').fadeOut('fast', function(){
          $('#meme-gallery').fadeIn('fast');
          $("html, body").animate({ scrollTop: 0 }, "fast");
        });
      }
    }

    function changeSorting (new_sort) {
      sorting = new_sort;
      current_page = 1;

      loadMemeGallery (current_page, sorting);
      $('#meme-gallery').fadeOut('fast', function(){
        $('#meme-gallery').fadeIn('fast');
        $("html, body").animate({ scrollTop: 0 }, "fast");
      });
    }

    loadMemeGallery (current_page, sorting);
  </script>

</body>
</html>