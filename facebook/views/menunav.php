<!-- Este es el menu superior de la página -->
<?php
require_once('controller/UserPermits.php');
$id_user=$_SESSION['id_user'];
$userpermits= new UserPermits;
$nivel_permiso= $userpermits->getNivelPermiso($id_user);
?>
<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <div class="navbar-minimize">
        <button id="minimizeSidebar" class="btn btn-icon btn-round">
            <i class="nc-icon nc-minimal-right text-center visible-on-sidebar-mini"></i>
            <i class="nc-icon nc-minimal-left text-center visible-on-sidebar-regular"></i>
        </button>
      </div>
      <div class="navbar-toggle">
        <button type="button" class="navbar-toggler">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </button>
      </div>
      <a class="navbar-brand" href="#"></a>
              <?php if(isset($pages)):?>
                <?php foreach($pages as $page):?>
                  <?php if($page["id_facebook_page"]==$_SESSION['psid']):?>
                    <a href="https://www.facebook.com/<?= $page["id_facebook_page"]; ?>" class="ft-title" target="_blank"><img src="https://ssgenius.com/app/assets/images/facebook-icon.png"> <span class="nameFacebookPage"> <?php if(isset($_GET['psid']))echo $page['name']; ?></span></a>
                  <?php endif?>
                <?php endforeach?>
              <?php endif?>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-bar navbar-kebab"></span>
      <span class="navbar-toggler-bar navbar-kebab"></span>
      <span class="navbar-toggler-bar navbar-kebab"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navigation">
<!--       <form>
        <div class="input-group no-border">
          <input type="text" value="" class="form-control" placeholder="Search...">
          <div class="input-group-append">
            <div class="input-group-text">
              <i class="nc-icon nc-zoom-split"></i>
            </div>
          </div>
        </div>
      </form> -->
      <ul class="navbar-nav">
<!--         <li class="nav-item">
          <a class="nav-link btn-magnify" href="#pablo">
            <i class="nc-icon nc-layout-11"></i>
            <p>
              <span class="d-lg-none d-md-block">Stats</span>
            </p>
          </a>
        </li> -->
        <li class="nav-item btn-rotate dropdown">
          <a class="nav-link dropdown-toggle" href="http://example.com/" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="<?php echo $user->picture; ?>">
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#"><?php  echo " ". $user->short_name;?></a>
          <?php if($nivel_permiso>3):?>
            <a class="dropdown-item" href="adminRolUserSuperAdministrador.php">Administrar Roles</a>
          <?php endif?>
            <a class="dropdown-item" href="logout.php"> Cerrar sesi&oacute;n</a>
          </div>
        </li>
<!--         <li class="nav-item">
          <a class="nav-link btn-rotate" href="#pablo">
            <i class="nc-icon nc-settings-gear-65"></i>
            <p>
              <span class="d-lg-none d-md-block">Account</span>
            </p>
          </a>
        </li> -->
      </ul>
    </div>
  </div>
</nav>