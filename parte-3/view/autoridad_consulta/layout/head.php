<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container"> <a class="navbar-brand text-primary" href="<?=$view?>/autoridad/index.php">
        <i class="fa d-inline fa-lg fa-circle-o"></i>
        <b>COVINILO</b>
      </a> <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar5">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar5">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item d-none"> <a class="nav-link" href="#">Product</a> </li>
        </ul>
        <a href="<?=$he->con('usuario/acceso@close_session')?>" class="btn btn-outline-danger navbar-btn ml-md-2">Salir <i class="fa fa-sign-out" aria-hidden="true"></i></a>
      </div>
    </div>
  </nav>
  <script>
  	function session_close(){
  		if(!confirm('¿Estas seguro que deseas cerrar session?'))
  			return;
  		window.location.href="<?=$view?>/login.php"
  	}
  </script>