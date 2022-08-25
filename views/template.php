<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIGEFAv1.0</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo BASE_URL;?>/views/plugins/fontawesome-free/css/all.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo BASE_URL;?>/views/plugins/sweetalert2/sweetalert2.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo BASE_URL;?>/views/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo BASE_URL;?>/views/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL;?>/views/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo BASE_URL;?>/views/plugins/toastr/toastr.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo BASE_URL;?>/views/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo BASE_URL;?>/views/plugins/adminlte/css/adminlte.min.css">
  <!-- elegent preloader jquery-->
  <link rel="stylesheet" href="<?php echo BASE_URL;?>/assets/css/preloader.css">
  <!-- payment page-->
  <link rel="stylesheet" href="<?php echo BASE_URL;?>/assets/css/payment.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo BASE_URL;?>/views/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo BASE_URL;?>/views/plugins/daterangepicker/daterangepicker.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader 
  <div  class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo BASE_URL;?>/views/plugins/adminlte/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>
 -->
 
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo BASE_URL;?>/home" class="nav-link">Dashboard</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo BASE_URL;?>/#" class="nav-link">Sobre</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
    <!-- 
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>      
        </div>
      </li> 
        
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    -->
      <li class="nav-item">
        <a class="nav-link"  href="<?php echo BASE_URL;?>/logout" role="button">
        <i class="fas fa-power-off "></i> Sair 
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link hide-on-print ">
      <img src="<?php echo BASE_URL;?>/views/plugins/adminlte/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SIGEFA <small>V1.0</small></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo BASE_URL;?>/views/plugins/adminlte/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?php echo BASE_URL?>/home" class="d-block"><?php echo $viewData["info"]->getLoggedUser();?></a>
        </div>
      </div>
       <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Pesquisar itens do menu" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="<?php echo BASE_URL;?>/home" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>

          <!--Menu Administracao  -->
          <?php if($viewData["user"]->hasPermission('administrar')):?>
            <li class="nav-item menu-open">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                  Administração
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
              
              <?php if($viewData["user"]->hasPermission('verpermissoes')):?>
                <li class="nav-item">
                  <a href="./permissions" class="nav-link">
                    <i class="nav-icon fas fa-key"></i>
                    <p>
                      Permissões do sistema
                    </p>
                  </a>
                </li>
              <?php endif;?>

               <?php if($viewData["user"]->hasPermission('celebrarContrato')):?>

                <li class="nav-item">
                  <a href="./contrato" class="nav-link">
                    <i class="nav-icon fas fa-user-friends"></i>
                    <p>
                      Abrir contrato
                    </p>
                  </a>
                </li>

                <?php endif;?>

                <?php if($viewData["user"]->hasPermission('gerarBarcode')):?>
                <li class="nav-item">
                  <a href="./gerarcodigodebarras" class="nav-link">
                    <i class="nav-icon fas fa-barcode"></i>
                    <p>
                      Gerar código de barras
                    </p>
                  </a>
                </li>

                <?php endif;?>

              </ul>
            </li>
          <?php endif;?>

           <!--Menu cadastros  -->
           <?php if($viewData["user"]->hasPermission('cadastros')):?>

            <li class="nav-item menu-open">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Cadastros
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
              <?php if($viewData["user"]->hasPermission('cadastrarCliente')):?>
                <li class="nav-item">
                  <a href="./cadastrarcliente" class="nav-link">
                    <i class="fas fa-user-tie nav-icon"></i>
                    <p>Cliente</p>
                  </a>
                </li>
              <?php endif;?>

              <?php if($viewData["user"]->hasPermission('cadastrarAgente')):?>
                <li class="nav-item">
                  <a href="./cadastraragente" class="nav-link">
                    <i class="fas fa-user-cog nav-icon"></i>
                    <p>Agente</p>
                  </a>
                </li>
              <?php endif;?>
              <?php if($viewData["user"]->hasPermission('cadastrarContador')):?>
                <li class="nav-item">
                  <a href="./cadastrarcontador" class="nav-link">
                    <i class="fas fa-faucet nav-icon"></i>
                    <p>Contador</p>
                  </a>
                </li>
                <?php endif;?>
              </ul>
            </li>
            <?php endif;?>

           <!--Menu facturas  -->
           <?php if($viewData["user"]->hasPermission('facturacao')):?>
            <li class="nav-item menu-open">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                  Facturas
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <?php if($viewData["user"]->hasPermission('registarLeitura')):?>
                  <li class="nav-item">
                    <a href="./leitura" class="nav-link">
                      <i class="fas fa-eye nav-icon"></i>
                      <p>Registar leitura</p>
                    </a>
                  </li>
                <?php endif;?>

                <?php if($viewData["user"]->hasPermission('EmitirFactura')):?>
                <li class="nav-item">
                  <a href="./fatura" class="nav-link">
                    <i class="fas fa-file-invoice nav-icon"></i>
                    <p>Emitir factura</p>
                  </a>
                </li>
                <?php endif;?>
                <?php if($viewData["user"]->hasPermission('visualizarFactura')):?>
                <li class="nav-item">
                  <a href="./visualizarfatura" class="nav-link">
                    <i class="fas fa-eye nav-icon"></i>
                    <p>Minhas facturas</p>
                  </a>
                </li>
                <?php endif;?>
              </ul>
            </li>
            <?php endif;?>
   

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

<!--Here we load the view in template(leave content-wrapper)-->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- /.content-header -->
    <!-- Main content -->
    <?php
      $this->loadViewInTemplate($viewName,$viewData);
    ?> 
    <!-- End Main-->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer hide-on-print ">
    <strong>Copyright &copy; 2021 <a href="#">SIGEFA</a>.</strong>
    Alguns direitos reservados.
    <div class="float-right d-none d-sm-inline-block">
      <b>Versão</b> 1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script type="text/javascript" src="<?php echo BASE_URL;?>/views/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo BASE_URL;?>/views/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo BASE_URL;?>/views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?php echo BASE_URL;?>/views/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Select2 -->
<script src="<?php echo BASE_URL;?>/views/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<!-- ChartJS -->
<script src="<?php echo BASE_URL;?>/views/plugins/chart.js/Chart.min.js"></script>

<!-- jQuery Knob Chart -->
<script src="<?php echo BASE_URL;?>/views/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo BASE_URL;?>/views/plugins/moment/moment.min.js"></script>
<script src="<?php echo BASE_URL;?>/views/plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="<?php echo BASE_URL;?>/views/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo BASE_URL;?>/views/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo BASE_URL;?>/views/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- jquery-validation -->
<script src="<?php echo BASE_URL;?>/views/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo BASE_URL;?>/views/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo BASE_URL;?>/views/plugins/adminlte/js/adminlte.js"></script>
<!-- Toastr -->
<script src="<?php echo BASE_URL;?>/views/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo BASE_URL;?>/views/plugins/adminlte/js/demo.js"></script>
<!--Elusive elegent Preloader-->
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/javascript/jquery.preloader.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo BASE_URL;?>/views/plugins/adminlte/js/pages/dashboard3.js"></script>
<!--Custom JS -->
<script type="text/javascript"> var BASE_URL="<?php echo BASE_URL;?>"</script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/javascript/scripts.js"></script>
</body>
</html>

<style>

a{
  color:#28a745;
}

@media print {
   .hide-on-print {
     display: none !important;
   }
}

@page { size: auto;  margin: 0mm; }

</style>