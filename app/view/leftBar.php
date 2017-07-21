<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Project name</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Settings</a></li>
        <li><a href="#">Profile</a></li>
        <li><a href="#">Help</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container-fluid">
  <div class="row">
    <!-- Left NavBar -->
    <div class="col-sm-3 col-md-2 sidebar">
      <ul class="nav nav-sidebar">
        <?php
          $c = (isset($_GET["c"]) && $_GET['c'] !== '') ? $_GET["c"] : "User";
          foreach($navLinks as $link){
             $linkActive = ($c == $link['controller']) ? "active" : "";
             echo '<li class="'.$linkActive.'"><a href="'.$link['href'].'">'.$link['name'].'</a></li>';
          }
        ?>
      </ul>
    </div>
    <!-- Left NavBar -->
    <!-- Container Right -->
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
