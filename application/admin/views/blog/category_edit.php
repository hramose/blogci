<?php
if(isset($info) && count($info) > 0){

  $header = 'Editar Categoria';
  $id = $info->id_category;
  $name_category = $info->name_category;
}else{
  $header = 'Añadir Categoria';
  $id = '';
  $name_category = '';
 }
?>
<section class="content-header">
  <h1>
    Categorias
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo '#/';?>"><i class="fa fa-dashboard"></i> Escritorio</a></li>
    <li class="active">Categorias</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li><a href="<?php echo '#/blog?m=categories';?>">Categorias</a></li>
          <li class="active"><a href="<?php echo '#/blog?m=create_category';?>">Añadir categoria</a></li>
        </ul>
          <div class="tab-content table-responsive no-padding"><div class="col-xs-12">
            <?php
      		  echo form_open('c=blog&m=save_category', 'class="bs-docs-example" id="category-edit-form"');
      		  echo form_hidden('id', $id);
      		  ?>

            <div class="form-group">
              <label class="control-label">Nombre de la categoria</label>

                <input type="text" name="name_category" value="<?php echo $name_category;?>" class="form-control" />

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
	$('#category-edit-form').validate({
		rules:{
			name_category:{
				required:true
			}
		},
		messages:{
			name_category:{
				required:'Este campo es requerido'
			}
		}
	});
	$('#category-edit-form').ajaxForm({
		beforeSubmit:function(formData, jqForm, options){
			return $('#category-edit-form').valid();
		},
		success:function(responseText, statusText, xhr, form){
			var json = $.parseJSON(responseText);
			if(json.success){
				toastr.success(json.msg);
				<?php
				if($id == ''){
					?>
					location.href = '#/blog?m=categories';
					<?php
				}else{
					?>
					location.href = '#/blog?m=edit_category&id=<?php echo $id;?>&after=edit';
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
