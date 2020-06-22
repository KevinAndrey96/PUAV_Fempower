
<!--<nav class="navbar navbar-default navbar-fixed-top" style="background-color: #02487D; height: 55px; padding: 5px 5px 5px 5px;">
  <div class="container-fluid">
     Brand and toggle get grouped for better mobile display
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="http://www.fempower.com.co">
        <img class="logoMenu" src="../images/logo_White.png" style="position: absolute; margin-top: -20px; margin-left: 20px; height: 50px;">
      </a>
    </div>


  </div> /.container-fluid
</nav>-->







<div class="row header-top fixed-top navbar-expand-lg navbar-light" style="background-color: #02487D; height: 55px; padding: 5px 5px 5px 5px;">
  <a href="http://www.fempower.com.co" target="_blank"><img class="logoMenu" style="position: absolute; margin-top: 1px; margin-left: 20px; height: 50px;" src="../images/logo_White.png"></a>
  <div class="collapse navbar-collapse" id="navbarText" style="margin-right: 20px;">
    <ul class="navbar-nav ml-md-auto d-md-flex">
      <li class="nav-item">
        <a class="nav-link" href="main.php">
          Inicio
        </a>
      </li>
      <?php
      include 'assets/include/DAO_menus.php';
      $objMenu = new DAO_menus();
      $addObjMenu = new menus();
      $result = $objMenu->getMenuByRol($result["tipo_usuario"]);
      ?>
      <li class="dropdown" style="background-color: #02487D; height: 55px; padding: 5px 5px 5px 5px;">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menú <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <?php
          if (is_array($result)) {
            foreach ($result as $key => $value) {
              printf("<li><a href='%s' target='_%s'>%s</a></li>", $value['url'], $value['target'], $value['etiqueta']);
            }
          }
          ?>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Mi cuenta</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Salida Segura</a>
      </li>
    </ul>
  </div>
</div>