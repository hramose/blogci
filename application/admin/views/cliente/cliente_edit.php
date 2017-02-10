<?php
if(isset($info) && count($info) > 0){

  $header = 'Editando Cliente';
  $id = $info->id_cliente;
  $nombre_cliente = $info->nombre_cliente;
  $dni_cliente = $info->dni_cliente;
  $telefono_cliente = $info->telefono_cliente;
  $direccion_cliente = $info->direccion_cliente;
  $observaciones_cliente = $info->observaciones_cliente;
}else{
  $header = 'Añadir Cliente';
  $id = '';
  $nombre_cliente = '';
  $dni_cliente = '';
  $telefono_cliente = '';
  $direccion_cliente = '';
  $observaciones_cliente = '';
 }
?>
<section class="content-header">
  <h1>
    Clientes
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo '#/';?>"><i class="fa fa-dashboard"></i> Escritorio</a></li>
    <li class="active">Clientes</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li><a href="<?php echo '#/cliente?m=index';?>">Clientes</a></li>
          <li class="active"><a href="<?php echo '#/cliente?m=cliente_edit';?>">Añadir cliente</a></li>
        </ul>
          <div class="tab-content table-responsive no-padding"><div class="col-xs-12">
            <?php
      		  echo form_open('c=cliente&m=save_cliente', 'class="bs-docs-example" id="cliente-edit-form"');
      		  echo form_hidden('id', $id);
      		  ?>

            <div class="form-group">
              <label class="control-label">Nombre del cliente</label>
                <input type="text" name="nombre_cliente" value="<?php echo $nombre_cliente;?>" class="form-control" />
            </div>

            <div class="form-group">
              <label class="control-label">DNI del cliente</label>
                <input type="text" name="dni_cliente" value="<?php echo $dni_cliente;?>" class="form-control" />
            </div>

            <div class="form-group">
              <label class="control-label">Telefono cliente</label>
                <input type="text" name="telefono_cliente" value="<?php echo $telefono_cliente;?>" class="form-control" />
            </div>

            <div class="form-group">
              <label class="control-label">Dirección cliente</label>
                <input type="text" name="direccion_cliente" value="<?php echo $direccion_cliente;?>" class="form-control" />
            </div>

            <div class="form-group">
              <label class="control-label">Observaciones</label>
              <textarea name="observaciones_cliente" class="form-control" rows="4" cols="80"><?php echo $observaciones_cliente;?></textarea>
            </div>

            <div class="form-group">
              <div class="controls">
								<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
        				<button type="reset" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span> Reiniciar</button>
        				<button type="button" class="btn btn-danger" onclick="history.go(-1);"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
              </div>
            </div>

            <?php echo form_close();?>

                <!-- /.box-body -->
          </div>
      <!-- /.box -->
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
$(function(){
	$('#cliente-edit-form').validate({
		rules:{
			nombre_cliente:{
				required:true
			},
      dni_cliente:{
				required:true
			},
      telefono_cliente:{
				required:true
			},
      direccion_cliente:{
				required:true
			}
		},
		messages:{
			nombre_cliente:{
				required:'Este campo es requerido'
			},
      dni_cliente:{
				required:'Este campo es requerido'
			},
      telefono_cliente:{
				required:'Este campo es requerido'
			},
      direccion_cliente:{
				required:'Este campo es requerido'
			}
		}
	});
	$('#cliente-edit-form').ajaxForm({
		beforeSubmit:function(formData, jqForm, options){
			return $('#cliente-edit-form').valid();
		},
		success:function(responseText, statusText, xhr, form){
			var json = $.parseJSON(responseText);
			if(json.success){
				toastr.success(json.msg);
				<?php
				if($id == ''){
					?>
					location.href = '#/cliente?m=index';
					<?php
				}else{
					?>
					location.href = '#/blog?m=cliente_edit&id=<?php echo $id;?>&after=edit';
					<?php
				}
				?>
			}else{
				toastr.error(json.msg);
			}
			return false;
		}
	});
});
</script>
