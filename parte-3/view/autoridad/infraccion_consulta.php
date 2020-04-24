<?require("../../system/client.php")?>
<?if(!sess("autoridad")) header("Location: {$view}/login.php")?>
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

<body >
  <?include("layout/head.php")?>
  <div class="py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-10 mx-auto">
          <h1 class="text-primary mb-3 text-center"><b>Consulta Rapida</b></h1>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Ingrese DNI" aria-label="Recipient's username" aria-describedby="button-addon2" id="search_word" onkeyup="event.keyCode==13?search_fast():''">
            <div class="input-group-append">
              <select class="form-control" disabled>
                <option>Todos</option>
                <option selected="true">DNI</option>
                <option>N° PLACA</option>
                <option>NOMBRES</option>
              </select>
              <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="search_fast()"> <i class="fa fa-search"></i></button>
            </div>
          </div>
          <div class="message_results_container"><span><span class="message_text"></span></span></div>
          <div class="options_after_search"></div>
          <div class="table-responsive">
            <table class="table table-striped table-borderless table-sm" id="tb_infraccion_search" style="display: none;font-size:13px;">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">DNI</th>
                  <th scope="col">Nombres Completos</th>
                  <!-- <th scope="col">N° Infracciones</th> -->
                  <td align="center">
                    <i class="fa fa-bolt" aria-hidden="true"></i>
                  </td>
                </tr>
              </thead>
              <tbody class="results_list">
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade modal_infraccion_detalles">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">DETALLES DE INFRACCIÓN</h5> <button type="button" class="close" data-dismiss="modal"> <span>×</span> </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-sm mb-0">
                  <tbody>
                    <tr>
                      <td>DNI</td>
                      <td>: <span class="ind_nro_doc"></span></td>
                    </tr>
                    <tr>
                      <td>Nombres</td>
                      <td>: <span class="ind_nombres"></span></td>
                    </tr>
                    <tr>
                      <td>Apellidos</td>
                      <td>: <span class="ind_apellidos"></span></td>
                    </tr>
                    <tr>
                      <td>Sexo</td>
                      <td>: <span class="ind_sexo"></span></td>
                    </tr>
                    <tr>
                      <td>Edad</td>
                      <td>: <span class="ind_edad"></span></td>
                    </tr>
                    <tr>
                      <td class="text-danger"> <span class="infraccion_label"></span></td>
                      <td>
                        <select class="form-control inf_select">
                          <option value="05-04-2020">05-04-2020</option>
                        </select>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="infraccion_result_container" style="display: none">
                <div class="table-responsive">
                  <table class="table table-sm">
                    <tbody class="" style="background-color:#FFFCDA;">
                      <tr>
                        <td>Infracción en</td>
                        <td>: <span class="inf_tipo"></span></td>
                      </tr>
                      <tr class="VEHICULO" style="display: none;">
                        <td>Placa Vehicular</td>
                        <td>: <span class="inf_placa"></span></td>
                      </tr>
                      <tr class="NEGOCIO" style="display: none;">
                        <td>Razon Social</td>
                        <td>: <span class="inf_razon_social"></span></td>
                      </tr>
                      <tr class="VEHICULO NEGOCIO" style="display: none;">
                        <td>Propietario</td>
                        <td>: <span class="inf_propietario"></span></td>
                      </tr>
                      <tr>
                        <td>Localización</td>
                        <td>: <span class="inf_localizacion"></span></td>
                      </tr>
                      <tr class="img_localizacion">
                        <td colspan="2">
                          <div class="mapa"></div>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2">
                          <small class="text-secondary">Motivo de Infracción:</small>
                          <div class="inf_motivo" style="font-size:18px;color:red;text-align: center;padding:10px;font-weight: bold;"> Persona con acompañante circulando libremente en pleno estado de emergencia. </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer"> <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button> </div>
      </div>
    </div>
  </div>
  <script>
  	$(window).on("load", function(){
  		$("#search_word").focus()
      search_fast()
  	})
  	function search_fast(){
  		var tb = $("#tb_infraccion_search");
  		tb.find(".results_list").html("")
  		he.post("infraccion/consulta@search_fast",{
  			word: $("#search_word").val()
  		},function(res){
  			console.log(res)
  			// $("#search_word").select()
  			rows = res;
  			if(rows.length==0){
  				$("#tb_infraccion_search").hide()

  				$(".message_results_container").show()
  				$(".message_text").html('<i class="text-danger mb-3">No se encontraron resultados</i>');
  				$(".options_after_search").html('<a href="individuo_registro.php?next=infraccion_register&dni='+$("#search_word").val()+'" class="btn btn-primary">Registrar Nuevo Infractor</a>')
  				return;
  			}
  			$(".message_results_container").show()
  			if(rows.length==1)
  				$(".message_text").html("( "+rows.length+" ) resultado encontrado:")
  			else if(rows.length>1)
  				$(".message_text").html("( "+rows.length+" ) resultados encontrados:")

  			$("#tb_infraccion_search").show()
  			for( i in rows ){
  				row = '<tr>'
					+'  <th scope="row">'+(parseInt(i)+1)+'</th>'
					+'  <td>'+rows[i].ind_nro_doc+'</td>'
					+'  <td>'+(rows[i].ind_nombres+" "+rows[i].ind_apellidos)+'</td>';

          row+='  <td align="center" style="width:100px;">';
          if(rows[i].nro_infracciones == 0)
            row+='  <button class="btn btn-sm btn-success" onclick="individuo_infraccion_info('+rows[i].id_individuo+')">'+rows[i].nro_infracciones+'</button>'
          else if(rows[i].nro_infracciones == 1)
            row+='  <button class="btn btn-sm btn-warning" onclick="individuo_infraccion_info('+rows[i].id_individuo+')">'+rows[i].nro_infracciones+'</button>'
          else
            row+='  <button class="btn btn-sm btn-danger" onclick="individuo_infraccion_info('+rows[i].id_individuo+')">'+rows[i].nro_infracciones+'</button>'
          row+='';

					row+='  '
					+'  	<button class="btn btn-sm btn-primary d-none m-1" onclick="individuo_infraccion_info('+rows[i].id_individuo+')">'
					+'      <i class="fa fa-file-text-o text-white"></i>'
					+'    </button>'
          +'    <a href="javascript:infraccion_add('+rows[i].id_individuo+');" class="btn btn-sm btn-secondary m-1" title="Añadir Nueva Infracción">'
          +'      <i class="fa fa-plus text-white"></i>'
          +'    </a>'
          +'  </td>'
					+'</tr>';
				tb.find(".results_list").append(row)
  			}
  		},"json")
  	}
    function individuo_infraccion_info(idind){
      mod = $(".modal_infraccion_detalles")
      he.post("infraccion/consulta@individuo_record",{
        idind: idind
      },function(res){
        console.log(res)
        if(!res.success){
          alert(res.message)
          return;
        }
        // Set Info Card Individuo
          mod.find(".ind_nro_doc").html(res.ind.ind_nro_doc)
          mod.find(".ind_nombres").html(res.ind.ind_nombres)
          mod.find(".ind_apellidos").html(res.ind.ind_apellidos)
          mod.find(".ind_sexo").html(res.ind.ind_sexo)
          mod.find(".ind_edad").html(res.ind.ind_edad)          

          // info infracciones
          mod.find(".infraccion_label").html("<b>("+res.infs.length+") Infraciones</b>");

          // infracciones list
          if(res.infs.length == 0){
            mod.find(".inf_select").html('<option value="">--</option>');
          }else
            mod.find(".inf_select").html("");

          for( i in res.infs ){
            mod.find(".inf_select").append('<option value="'+res.infs[i].id_infraccion+'">'+res.infs[i].inf_regis_dtime+'</option>')
          }
          mod.find(".inf_select").off().change(function(e){
            idinf = $(this).val();
            if(idinf ==""){
              mod.find(".infraccion_result_container").hide()
              return;
            }else
              mod.find(".infraccion_result_container").show()
            //view data infraccion
            individuo_infraccion_view(idinf)
          })
          mod.find(".inf_select:eq(0)").trigger("change")

      },"json")
      mod.modal("show")
    }
    function individuo_infraccion_view(idinf){
      mod = $(".modal_infraccion_detalles")
      he.post("infraccion/consulta@infraccion_checkXid",{
        idinf: idinf
      },function(data){  
        console.log(data)
        if(!data){
          alert("[Error]: No hay datos de infracción");
          return;
        }
        var result_container = mod.find(".infraccion_result_container")
        result_container.find(".inf_tipo").html(data.inf_tipo)
        result_container.find(".inf_placa").html(data.inf_placa)
        result_container.find(".inf_razon_social").html(data.inf_razon_social)
        result_container.find(".inf_propietario").html(data.inf_propietario)
        if(data.inf_localizacion){
          result_container.find(".inf_localizacion").html('<a href="https://www.google.com/maps/search/?api=1&query='+data.inf_localizacion+'" target="_blank">'+data.inf_localizacion+'</a>')
          result_container.find(".img_localizacion").show()
        }else{
          result_container.find(".inf_localizacion").html("No especificado")
          result_container.find(".img_localizacion").hide()
        }

        result_container.find(".inf_motivo").html(":: "+data.inf_motivo)

        //NEGOCIO OR VEHICULO
        if(data.inf_tipo=="PERSONA NATURAL"){
          result_container.find(".VEHICULO,.NEGOCIO").hide()
        }else if(data.inf_tipo=="NEGOCIO"){
          result_container.find(".VEHICULO").hide()
          result_container.find(".NEGOCIO").show()
        }else if(data.inf_tipo=="VEHICULO"){
          result_container.find(".NEGOCIO").hide()
          result_container.find(".VEHICULO").show()
        }

        // map view
        /*mapImgIframe = '<iframe width="100%" height="350" src="https://maps.google.com/maps?hl=en&q='+data.inf_localizacion+'&ie=UTF8&t=&z=14&iwloc=B&output=embed" scrolling="no" frameborder="0"></iframe>';*/
        mapImgIframe = '<img width="100%" src="https://maps.googleapis.com/maps/api/staticmap?center='+data.inf_localizacion+'&zoom=17&size=600x300&maptype=roadmap&markers=color:red|label:|'+data.inf_localizacion+'&key=AIzaSyA8kUXUFfG7B-auYnoA6nIUBtJbtHeFrsE">';
        result_container.find(".img_localizacion").find(".mapa").html(mapImgIframe)

      },"json")
    }
    function infraccion_add(idind){
      if(!confirm("¿Desea iniciar una nueva Infraccion?"))
        return;
      window.location.href="infraccion_registro.php?idind="+idind
    }
  </script>
</body>
</html>