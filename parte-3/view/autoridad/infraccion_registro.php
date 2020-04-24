<?require("../../system/client.php")?>
<?
  $ind = $he->post("individuo/tool@ind_getdata",[
    "idind"=> $_GET['idind']
  ],"json")
?>
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
  <script src="<?=$lib?>/bootstrap-4.4.1_lite/js/popper.min.js"></script>
  <script src="<?=$lib?>/bootstrap-4.4.1_lite/js/bootstrap.min.js"></script>
</head>

<body>
  <?include("layout/head.php")?>
  <div class="py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"> <a href="<?=sess("user_dir")?>">Inicio</a> </li>
            <li class="breadcrumb-item active">Registro de Infracción</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <div class="table-responsive">
            <table class="table table-sm mb-0">
              <tbody>
                <tr>
                  <td>DNI</td>
                  <td>: <?=$ind["ind_nro_doc"]?></td>
                </tr>
                <tr>
                  <td>Nombres</td>
                  <td>: <?=$ind["ind_nombres"]?></td>
                </tr>
                <tr>
                  <td>Apellidos</td>
                  <td>: <?=$ind["ind_apellidos"]?></td>
                </tr>
                <tr>
                  <td>Sexo</td>
                  <td>: <?=$ind["ind_sexo"]?></td>
                </tr>
                <tr>
                  <td>Edad</td>
                  <td>: <?=$ind["ind_edad"]?></td>
                </tr>
                <tr>
                  <td class="text-danger" colspan="2" align="center"><b> -- NUEVA INFRACCIÓN --</b></td>
                </tr>
                <tr>
                  <td class="text-dark">Infración en</td>
                  <td>
                    <select class="form-control" id="inf_tipo">
                      <option value="PERSONA NATURAL">Persona Natural</option>
                      <option value="NEGOCIO">Negocio</option>
                      <option value="VEHICULO">Vehiculo</option>
                    </select>
                  </td>
                </tr>
                <tr class="alert-danger vehiculo_content" style="display: none;">
                  <td class="text-dark">Placa Vehicular</td>
                  <td>
                    <input type="text" class="form-control" id="inf_placa">
                  </td>
                </tr>
                <tr class="alert-danger negocio_content" style="display: none;">
                  <td class="text-dark">Razon Social</td>
                  <td>
                    <input type="text" class="form-control" id="inf_razon_social">
                  </td>
                </tr>
                <tr class="alert-danger negocio_content vehiculo_content" style="display: none;">
                  <td class="text-dark">¿Es propietario?</td>
                  <td>
                    <select id="inf_propietario">
                      <option value="NO">NO</option>
                      <option value="SI">SI</option>
                    </select>
                    <small> Propietario / Titular</small>
                  </td>
                </tr>
                <tr>
                  <td class="text-dark"> Localización</td>
                  <td>
                    <div class="input-group">
                      <input type="text" placeholder="Active su GPS" class="form-control" disabled="" id="inf_localizacion">
                      <div class="input-group-append">
                        <a href="#" class="btn btn-primary gps_preview">
                          <i class="fa fa-map-marker" aria-hidden="true"></i>
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="text-dark"> Fecha y hora</td>
                  <td>
                    <input type="date" value="<?=date("Y-m-d")?>" class="date_regis">
                    <input type="time" value="<?=date("H:i:s")?>" class="time_regis">
                  </td>
                </tr>
                <tr>
                  <td class="text-dark">Registrado por</td>
                  <td>
                    <input type="text" placeholder="" value="<?=sess("user")['us_login']?>" disabled="" class="form-control">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="table-responsive">
            <table class="table table-sm">
              <tbody>
                <tr>
                  <td colspan="2">
                    <div class="text-secondary">Motivo de Infracción:</div>
                    <div> <textarea class="form-control" id="inf_motivo"></textarea> </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div align="center">
            <a class="btn btn-secondary btn-lg" href="javascript:infraccion_registrar()">Registrar <i class="fa fa-paper-plane fa-fw"></i> </a>
            <a class="btn btn-danger btn-lg ml-2" href="<?=sess("user_dir")?>">Cancelar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(window).on("load",function(){
      $("#inf_tipo").change(function(e){
        switch ($(this).val()) {
          case "PERSONA NATURAL":
            $(".negocio_content").hide()
            $(".vehiculo_content").hide()
            break;
          case "NEGOCIO":
            $(".vehiculo_content").hide()
            $(".negocio_content").show()
            break;
          case "VEHICULO":
            $(".negocio_content").hide()
            $(".vehiculo_content").show()
            break;
        }
      })
    })
    function infraccion_registrar(){
      if($("#inf_motivo").val()==""){
        alert("Debe añadir motivo de la infracción")
        $("#inf_motivo").focus()
        return;
      }

      if(!confirm("¿Estas seguro que quieres registrar infracción?"))
        return;


      he.post("infraccion/registro@addToInd",{
        inf_tipo: $("#inf_tipo").val()
        ,inf_placa: $("#inf_placa").val()
        ,inf_razon_social: $("#inf_razon_social").val()
        ,inf_propietario: $("#inf_propietario").val()
        ,inf_localizacion: $("#inf_localizacion").val()
        ,inf_regis_dtime: $(".date_regis").val()+" "+$(".time_regis").val()
        ,id_usuario: $("#id_usuario").val()
        // ,inf_motivo: $("#inf_motivo").val()
        ,inf_motivo: $("#inf_motivo").val()
        ,id_individuo: <?=$_GET['idind']?>
      },function(res){
        console.log(res)
        if(!res.success){
          alert(res.message);
          return;
        }
        window.location.href="<?=sess("user_dir")?>"
      },"json")
    }
    // Try HTML5 geolocation.
    function initMap() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            console.log(pos)
            // infoWindow.setPosition(pos);
            // infoWindow.setContent('Location found.');
            // infoWindow.open(map);
            // map.setCenter(pos);
          }, function() {
            handleLocationError(true);
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false);
        }
        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
          console.log(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.')
      }
    }
    
    setInterval(function(){
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position){
          console.log(position.coords.latitude);
          console.log(position.coords.longitude);
          var latLng = position.coords.latitude+","+position.coords.longitude;
          $("#inf_localizacion").val(latLng)
          $(".gps_preview").attr("href",'https://www.google.com/maps/search/?api=1&query='+latLng)
          $(".gps_preview").attr("target",'_blank')
        }, function(msg){
          console.log(typeof msg == 'string' ? msg : "error");
        });
      } else {
        alert("Not Supported!");
      }
    },1500)
   

    /*var watchId = navigator.geolocation.watchPosition(function(position) {  
      console.log(position.coords.latitude);
      console.log(position.coords.longitude);
      
    });

    navigator.geolocation.clearWatch(watchId);*/
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6dZL8UZTqT0tvlJqfls5vCLV0DYAciWk&callback=initMap">
    </script>
</body>
</html>