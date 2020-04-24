<?php require("../system/client.php"); ?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- font-awesome-4.7.0 -->
  <link rel="stylesheet" href="<?=$lib?>/font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- Jquery -->
  <script src="<?=$public?>/js/jquery-3.4.1.min.js"></script>
  <!-- Local Bootstrap 4.4.1 -->
  <link rel="stylesheet" href="<?=$public?>/theme/standar.css">
  <script src="<?=$lib?>/bootstrap-4.4.1_lite/popper.min.js"></script>
  <script src="<?=$lib?>/bootstrap-4.4.1_lite/bootstrap.min.js"></script>
</head>
<body class="bg-light">
  <div class="py-3" >
    <div class="container">
      <div class="row">
        <div class="col-md-2"> </div>
        <div class="col-md-8">
          <div class="card text-white p-4 xs-p-0 bg-primary">
            <div class="card-body">
              <h2 class="mb-4 text-center">Covid Infracciones Ilo</h2>
              <center><img src="../public/img/acceso.png" style="width:60%;"></center>
              <span>
                <div class="form-group"> <label>Usuario</label>
                  <input type="email" id="usuario" class="form-control" placeholder="Nombre de Usuario" value=""> </div>
                <div class="form-group"> <label>Contraseña</label>
                  <input type="password" id="password" class="form-control" placeholder="******" value="" onkeyup="(event.keyCode==13?logear():'')"> </div>
                <div align="center">
                  <button class="btn btn-secondary" onclick="logear();">Validar Acceso</button>
                </div>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    function logear() {
      // window.location.href = "autoridad/index.php"
      he.post("usuario/acceso@logear",{
        login: $("#usuario").val()
        ,pass: $("#password").val()
      },function(res){
        console.log(res)
        if(res.success){
          window.location.href=res.rdr
        }else
          alert(res.message)
      },"json")
    }
  </script>
</body>
</html>