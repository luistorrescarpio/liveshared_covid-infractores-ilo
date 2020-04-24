<?require("../../system/client.php")?>
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
            <li class="breadcrumb-item active">Registro de Individuo</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <form id="form_ind_registro">
            <div class="table-responsive">
              <table class="table table-sm mb-0" style="font-size:11px;">
                <tbody>
                  <tr>
                    <td class="text-primary" colspan="2" align="center"> -- FORMULARIO UNICO DE REGISTRO --</td>
                  </tr>
                  <tr class="d-none">
                    <td class="text-dark">ID</td>
                    <td>
                      <input type="text" id="id_individuo" placeholder="" value="" class="form-control" disabled="">
                    </td>
                  </tr>
                  <tr>
                    <td class="text-dark">
                      <select id="ind_tipo_doc" class="form-control" style="font-size:12px;">
                          <option value="DNI">DNI</option>
                          <option value="PASAPORTE">PASAPORTE</option>
                        </select>
                      </td>
                    <td>
                        <input type="text" id="ind_nro_doc" placeholder="" value="" class="form-control">
                    </td>
                  </tr>
                  <tr>
                    <td class="text-dark">Nombres</td>
                    <td>
                      <input type="text" id="ind_nombres" placeholder="" value="" class="form-control">
                    </td>
                  </tr>
                  <tr>
                    <td class="text-dark">Apellidos</td>
                    <td>
                      <input type="text" id="ind_apellidos" placeholder="" value="" class="form-control">
                    </td>
                  </tr>
                  <tr>
                    <td class="text-dark">Sexo</td>
                    <td>
                      <select class="form-control" id="ind_sexo">
                        <option value="">Seleccione...</option>
                        <option value="Hombre">Hombre</option>
                        <option value="Mujer">Mujer</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-dark">Edad</td>
                    <td>
                      <input type="number" id="ind_edad" placeholder="" value="" class="form-control">
                    </td>
                  </tr>
                  <tr>
                    <td class="text-secondary">Registrado por</td>
                    <td>
                      <input type="text" placeholder="" id="usuario_name" value="<?=sess("user")["us_login"]?>" class="form-control" disabled="">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div align="center" class="my-2">
              <?if(isset($_GET['next'])):
                  if($_GET['next']=="infraccion_register"){?>
                  <button class="btn btn-secondary btn-lg" type="submit">Registrar y Continuar <i class="fa fa-paper-plane fa-fw"></i> </button>
                  <?}?>
                <?else:?>
                <button class="btn btn-outline-primary btn-lg" type="submit">Registrar <i class="fa fa-paper-plane fa-fw"></i> </button>
                <?endif?>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(window).on("load",function(){

      <?if(isset($_GET['dni'])):
          if(strlen($_GET['dni'])==8 ){?>
            $("#ind_nro_doc").val("<?=$_GET['dni']?>")
            $("#ind_nombres").focus()
      <?  }else{ ?>
            $("#ind_nro_doc").focus()
          <?}?>    
      <?else:?>
        $("#ind_nro_doc").focus()
      <?endif?>
    })
    $("#form_ind_registro").submit(function(e){

      e.preventDefault()
      form = $("#form_ind_registro")
      form.find("input,select").css("background","white")
      var obj_in = {
        id_individuo: $("#id_individuo").val()
        ,ind_nro_doc: $("#ind_nro_doc").val()
        ,ind_nombres: $("#ind_nombres").val()
        ,ind_apellidos: $("#ind_apellidos").val()
        ,ind_sexo: $("#ind_sexo").val()
        ,ind_edad: $("#ind_edad").val()
        ,ind_tipo_doc: $("#ind_tipo_doc").val()
      }
      var confirm_form = true;
      for( i in obj_in ){
        if(i == "id_individuo") continue;
        if($("#"+i).val() == ""){
          $("#"+i).css({"background":"#FFE6E6"})
          confirm_form = false;
          continue;
        }
      }
      if(confirm_form == false) return;
      he.post("individuo/registro@add",obj_in,function(res){
        console.log(res)
        if(!res.success){
          if(res.diag=="dni_exist"){
            $("#ind_nro_doc").css({"background":"#FFE6E6"})
            $("#ind_nro_doc").select()
          }
          alert(res.message)
          return;
        }

        <?
          if(isset($_GET['next'])):
            if($_GET['next']=="infraccion_register"){
              $rdr = sess("user_dir")."/infraccion_registro.php";
          }
        ?>

        window.location.href="<?=$rdr?>?idind="+res.id;

        <?else:?>
          if(confirm("Registrado exitosamente, ¿Deseas registrar a otra persona mas?")){
            window.location.reload()
          }else
            window.location.href="infraccion_consulta.php?idinv="+res.id;

        <?endif?>
      },"json")
    })
  </script>
</body>
</html>