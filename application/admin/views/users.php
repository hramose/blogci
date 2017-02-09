<link rel="stylesheet" href="<?php echo base_url();?>resource/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css" />
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
					<li class="active"><a href="<?php echo '#/users';?>">Usuarios</a></li>

					<li><a href="<?php echo '#/users?m=add';?>">Añadir usuario</a></li>


				</ul>
				<div class="tab-content table-responsive no-padding"><div class="col-xs-12">
              <table class="table table-striped table-bordered table-hover" id="users-datatable" width="100%">
					<thead>
						<tr>
							<th nowrap>#</th>
							<th nowrap>Nombre de usuario</th>
							<th nowrap>Estado</th>
							<th nowrap>Email</th>
							<th nowrap>Fecha de registro</th>
							<th nowrap>¿Cuántas veces entró?</th>
							<th nowrap>Fecha de último ingreso</th>
							<th nowrap>Acciones</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table></div></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>




    </section>
    <!-- /.content -->
 <script src="<?php echo base_url();?>resource/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script type="text/javascript">
$(function(){

	var table = $('#users-datatable').DataTable({
    language: {
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
       "sFirst":    "Primero",
       "sLast":     "Último",
       "sNext":     "Siguiente",
       "sPrevious": "Anterior"
      },
      "oAria": {
       "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
       "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
          },
    deferRender: true,
		select:{
			style:'single',
			blurable: true
		},
		ajax:{
			url:'<?php echo site_url('c=users&m=data');?>',
			type:'post',
			data:function(d){
				//d.csrf_test_name = $.cookie(CSRF_COOKIE_NAME);
			}
		},
		columns:[
			{
				data:'id',
				className:'select-checkbox',
				render:function(data, type, row){
					return data;
				}
			},
			{data:'username'},
			{
				data:'status',
				render:function(data, type, row){

					var status_1 = '';
					if(data == '1') status_1 = 'checked="checked"';
					return '<input type="checkbox" ' + status_1 + ' class="switch-small switchchk"  data-on-text="Activado" data-off-text="Desactivado" data-table="users" data-field="status" data-size="mini" data-pk="' + row.id + '" />';


				}
			},
			{data:'email'},
			{data:'reg_time'},
			{data:'login_times'},
			{data:'last_login_time'},
			{
				data:'id',
				sortable:false,
				render:function(data, type, row){
					var html = '';
					html += '<div class="btn-group">';
						  html += '<a href="<?php echo '#/users?m=edit&id=';?>' + data + '" data-toggle="tooltip" data-placement="bottom" title="Editar" class="btn btn-default btn-xs"><i class="fa fa-pencil icon-pencil"></i></a>';
						  html += '<a href="<?php echo '#/users?m=edit_password&user_id=';?>' + data + '" data-toggle="tooltip" data-placement="bottom" title="Cambiar contraseña" class="btn btn-default btn-xs"><i class="fa fa-lock icon-pencil"></i></a>';
						  if(row.issys == '1'){

						  }else{
							  html += '<a href="javascript:;" onclick="del_confirm(\'Advertencia\', \'Estás seguro de eliminar este usuario?\', \'<?php echo site_url('c=users&m=delete&id=');?>' + data + '\',\'users-datatable\');" data-toggle="tooltip" data-placement="bottom" title="Eliminar" class="btn btn-default btn-xs"><i class="fa fa-trash icon-trash"></i></a>';
						  }

					html += '</div>';
					return html;
				}
			}
		],
		fnDrawCallback:function(oSettings){
			$(".switchchk").bootstrapSwitch({
				onSwitchChange:function(e, state){
				var fieldval = state;
				var $element = $(e.currentTarget);
				var tablename = $element.attr('data-table');
				var fieldname = $element.attr('data-field');
				var rowid = $element.attr('data-pk');
				if(fieldval){
					fieldval = 1;
				}else{
					fieldval = 0;
				}
				$.post(
				   "<?php echo site_url('c=ajax&m=setboolattribute');?>",
				   {
					   act:'upsort',
					   tbname:tablename,
					   tbfield:fieldname,
					   tbfieldvalue:fieldval,
					   id:rowid//,
					   // csrf_test_name:$.cookie(CSRF_COOKIE_NAME)

				   },
				   function(data){
					//alert(data);
					   if(data=='success'){
						   toastr.success('Cambio exitoso.');

					   }else{
						   toastr.error('change error');
					   }
				   }
				  );
				}
			});
		}
	});
});
</script>
