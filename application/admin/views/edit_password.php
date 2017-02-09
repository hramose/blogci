
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usuarios
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo '#/';?>"><i class="fa fa-dashboard"></i> Escritorio</a></li>
        <li class="active">Usuarios</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

		  <div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li><a href="<?php echo '#/users';?>">Usuarios</a></li>
				<li><a href="<?php echo '#/users?m=edit&id=' . $user_id;?>">Editar usuario</a></li>
				<li class="active"><a href="<?php echo '#/users?m=edit_password&user_id=' . $user_id;?>">Cambiar contraseña</a></li>

			</ul>
			<div class="tab-content">
				<?php
			echo form_open('c=users&m=edit_password', 'role="form" id="user-edit-form"');
			echo form_hidden('user_id', $user_id);
			?>



                <div class="form-group">
                  <label for="password">Nueva contraseña</label>
                  <input type="password" class="form-control" name="password" id="password">
                </div>

                <div class="form-group">
                  <label for="confirm_password">Confirmar nueva contraseña</label>
                  <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                </div>



              <div class="form-group">
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
				<button type="reset" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span> Reiniciar</button>
				<button type="button" class="btn btn-danger" onclick="history.go(-1);"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
              </div>
            <?php echo form_close();?>
			</div>
		  </div>


        </div>
      </div>




    </section>
    <!-- /.content -->

<script type="text/javascript">
$(function(){
	$('#user-edit-form').validate({
		rules:{
			password:{
				required:true,
				minlength:6
			},
			confirm_password:{
				required:true,
				equalTo:'#password'
			}
		},
		messages:{
			password:{
				required:'New Password Is Required',
				minlength:'At Least 6 chars'
			},
			confirm_password:{
				required:'Confirm New Password is required',
				equalTo:'Two Password do not match'
			}
		}
	});
	$('#user-edit-form').ajaxForm({
		beforeSubmit:function(formData, jqForm, options){
			return $('#user-edit-form').valid();
		},
		success:function(responseText, statusText, xhr, form){
			var json = $.parseJSON(responseText);
			if(json.success){
				toastr.success(json.msg);
			}else{
				toastr.error(json.msg);
			}
			return false;
		}
	});
});
</script>
