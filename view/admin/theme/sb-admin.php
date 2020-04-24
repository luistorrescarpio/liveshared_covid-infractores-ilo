<?function admin_script($libs = false){
  // Head
 echo '<link href="'.$GLOBALS['sys_lib'].'/startbootstrap-sb-admin-gh-pages/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="'.$GLOBALS['sys_lib'].'/startbootstrap-sb-admin-gh-pages/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="'.$GLOBALS['sys_lib'].'/startbootstrap-sb-admin-gh-pages/css/sb-admin.css" rel="stylesheet">
  <!-- Bootstrap core JavaScript-->
  <script src="'.$GLOBALS['sys_lib'].'/startbootstrap-sb-admin-gh-pages/vendor/jquery/jquery.min.js"></script>
  <script src="'.$GLOBALS['sys_lib'].'/startbootstrap-sb-admin-gh-pages/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>';
  // footers
  echo '<!-- Core plugin JavaScript-->
  <!-- Custom scripts for all pages-->
  <script src="'.$GLOBALS['sys_lib'].'/startbootstrap-sb-admin-gh-pages/js/sb-admin.js"></script>';

  if($libs) //Exists Librarys
    foreach ($libs as $i => $lib) {
      switch ($lib) {
        case 'charts':
          echo '<script src="'.$GLOBALS['sys_lib'].'/startbootstrap-sb-admin-gh-pages/vendor/chart.js/Chart.min.js"></script>';
          break;
        case 'datatables':
          echo '<link href="'.$GLOBALS['sys_lib'].'/startbootstrap-sb-admin-gh-pages/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">';
          echo '<script src="'.$GLOBALS['sys_lib'].'/startbootstrap-sb-admin-gh-pages/vendor/datatables/jquery.dataTables.js"></script>
            <script src="'.$GLOBALS['sys_lib'].'/startbootstrap-sb-admin-gh-pages/vendor/datatables/dataTables.bootstrap4.js"></script>';
          echo '<script src="'.$GLOBALS['sys_lib'].'/startbootstrap-sb-admin-gh-pages/js/sb-admin-datatables.min.js"></script>';
          break;
      }
    }
}?>
<?function admin_start($configSet = false){?>
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="/admin/welcome.php">ADMIN</a> 
    <a href="/admin/config/marcador.php" style='font-size: 20px;color:#E4FFFF;'>2019</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <select id="con_nivel" class="d-none">
      <option value="PRIMARIA">PRIMARIA</option>
      <option value="SECUNDARIA">SECUNDARIA</option>
    </select>
    <!-- <a href="/admin/config.php" style='font-size: 20px;color:#E4FFFF;'>Reportes</a> -->
    &nbsp;&nbsp;&nbsp;&nbsp;
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">

        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
          <li style="display:;" class="nav-item" data-toggle="tooltip" data-placement="right" title="INICIO">
            <a class="nav-link" href="/admin/welcome.php">
              <i class="fa fa-fw fa-dashboard"></i>
              <span class="nav-link-text">INICIO</span>
            </a>
          </li>
          <li style="display:;" class="nav-item" data-toggle="tooltip" data-placement="right" title="Estudiantes">
	          <a class="nav-link" href="/admin/new_student.php">
	            <i class="fa fa-fw fa-address-book-o"></i>
	            <span class="nav-link-text">Estudiantes</span>
	          </a>
	        </li>
	        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Gestión de Asistencia">
	          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents2" data-parent="#exampleAccordion">
	            <i class="fa fa-fw fa-sliders"></i>
	            <span class="nav-link-text">Gestión de Asistencia</span>
	          </a>
	          <ul class="sidenav-second-level collapse hide" id="collapseComponents2">
	            <li>
	              <a href="/admin/asistencias.php">Control de Asistencia</a>
	            </li>
	            <li>
	              <a href="/admin/cuadroAsistencia_<?=$GLOBALS['anio']?>.php">Cuadro General</a>
	            </li>
	            <li>
	              <a href="/admin/resumenSemanal.php">Resumen Semanal</a>
	            </li>
	            <li>
	              <a href="/admin/asistencia_general.php">Asistencia General</a>
	            </li>
	          </ul>
	        </li>
	        <li style="display:;" class="nav-item" data-toggle="tooltip" data-placement="right" title="Generador de Carnets">
	          <a class="nav-link" href="/admin/carnets.php">
	            <i class="fa fa-fw fa-address-card-o"></i>
	            <span class="nav-link-text">Generador de Carnets</span>
	          </a>
	        </li>
	        <li style="display:;" class="nav-item" data-toggle="tooltip" data-placement="right" title="Marcador de Asistencia">
	          <a class="nav-link" target="_blank" href="/control_asistencia.php">
	            <i class="fa fa-fw fa-clock-o" style='color:#26AFA0;'></i>
	            <span class="nav-link-text" style='color:#26AFA0;'>Marcador de Asistencia</span>
	          </a>
	        </li>
	        <li style="display:;" class="nav-item" data-toggle="tooltip" data-placement="right" title="Configuración">
	          
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents3" data-parent="#exampleAccordion">
              <i class="fa fa-fw fa-wrench"></i>
              <span class="nav-link-text">Configuración</span>
            </a>
            <ul class="sidenav-second-level collapse hide" id="collapseComponents3">
              <li>
                <a href="/admin/config/marcador.php">Marcador</a>
              </li>
              <li class="d-none">
                <a href="/admin/config/sync_app.php">Sync App Grau</a>
              </li>
            </ul>
	        </li>
	        <li style="display:;" class="nav-item" data-toggle="tooltip" data-placement="right" title="Manual de Usuario">
	          <a class="nav-link" style="color: #CB820E" href="/admin/userManual.php">
	            <i class="fa fa-book"></i>
	            <span class="nav-link-text">Manual de Usuario</span>
	          </a>
	        </li>
        </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown d-none">
          <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope"></i>
            <span class="d-lg-none">Messages
              <span class="badge badge-pill badge-primary">12 New</span>
            </span>
            <span class="indicator text-primary d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Messages:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>David Miller</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>Jane Smith</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>John Doe</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all messages</a>
          </div>
        </li>
        <li class="nav-item dropdown d-none">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts
              <span class="badge badge-pill badge-warning">6 New</span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">New Alerts:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-danger">
                <strong>
                  <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all alerts</a>
          </div>
        </li>
        <li class="nav-item">
          <div class="mr-2">
            <button type="button" class="btn btn-light" title="Stock Bajo" id="stockAlertNotify" style="display: none;">
              <span title="Stock Bajo">
                <i class="fa fa-exclamation-triangle text-warning ico_alert" aria-hidden="true"></i> <span id="stockAlertNotify_cant">(0)</span>
              </span>
            </button>
          </form>
        </li>
        <li class="nav-item">
          <form class="form-inline my-2 my-lg-0 mr-lg-2" id="search_salesForName">
            <div class="input-group">
              <input class="form-control" type="text" id="wordSearch" placeholder="Buscar estudiante..." onClick="$(this).select()" autocomplete="off">
              <span class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" data-toggle="modal" data-target="#outSession_modal">
            <i class="fa fa-fw fa-sign-out"></i>Salir
          </a>
        </li>
      </ul>
    </div>
  </nav>
  
  <div class="content-wrapper">
    <div class="container-fluid">
<?}?>

<?function admin_end(){?>
</div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Software Desarrollado por <a href="http://www.solsitecinnova.com" target="_blank">SOLSITEC INNOVA</a> - 
          <i class="text-muted">Copyright © Prohibida su Distribución sin Autorización</i></small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="outSession_modal" tabindex="-1" role="dialog" aria-labelledby="outSession_modalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="outSession_modalLabel">¿Esta seguro que desea Cerrar Sessión?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Seleccione "Confirmar" para cerrar sessión.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <!-- <a class="btn btn-primary" href="<?=$config['close']?>">Logout</a> -->
            <a class="btn btn-primary" href='<?=$GLOBALS['controller']?>/usuarioController.php?action=cerrar_session'>Confirmar</a>
          </div>
        </div>
      </div>
    </div>
    
    <script>
      
      $("head").append(
        "<meta http-equiv='X-UA-Compatible' content='IE=edge'>"
        +"<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>"
      );
      $("body")
      .addClass('fixed-nav sticky-footer bg-dark')
      .attr("id","page-top");
      // var link = window.location.href.split("/").pop();
      var link = window.location.href;

      if(link.indexOf("?")>0)
        link = link.split("?")[0];

      var linkFileName = link.split("/");
      var fileNameLink = linkFileName[ linkFileName.length-1 ];
      if(fileNameLink != "search_salesForName.php"){
        $("a[href='"+link+"']").parent().parent().removeClass('hide').addClass('show');

        $("a[href='"+link+"']").parent().addClass('active');

        var scrollPos =  $("a[href='"+link+"']").parent().offset().top;
        $(".navbar-sidenav").scrollTop(scrollPos);
        try{
          $($("a[href='"+link+"']").parent().parent().parent()[0].children[0]).removeClass('collapsed');
        }catch(ex){
          console.log(ex);
        }
      }

      $(document).ready(function() {
        $("#sidenavToggler").trigger('click');
      });
    </script>
  </div>
<?}?>