
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Roles
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo '#/';?>"><i class="fa fa-dashboard"></i> Escritorio</a></li>
        <li class="active">Roles</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
					<li class="active"><a href="<?php echo '#/roles';?>">Roles</a></li>

					<li><a href="<?php echo '#/roles?m=add';?>">Añadir Rol</a></li>


				</ul>
				<div class="tab-content table-responsive no-padding"><div class="col-xs-12">
              <table class="table table-striped table-bordered table-hover" id="roles-datatable" width="100%">
												<thead>
													<tr>
														<th nowrap>#</th>
														<th nowrap>Nombre de rol</th>
														<th nowrap>Acciones</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>




    </section>
    <!-- /.content -->

<script type="text/javascript">
$(function(){

	var table = $('#roles-datatable').DataTable({
		deferRender: true,
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
		select:{
			style:'single',
			blurable: true
		},
		ajax:{
			url:'<?php echo site_url('c=roles&m=data');?>',
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
			{data:'roleName'},
			{
				data:'id',
				sortable:false,
				render:function(data, type, row){
					var html = '';
					html += '<div class="btn-group">';
						  html += '<a href="<?php echo '#/roles?m=edit&id=';?>' + data + '"  data-toggle="tooltip" data-placement="bottom" title="editar" class="btn btn-default btn-xs"><i class="fa fa-pencil icon-pencil"></i></a><a href="javascript:;" onclick="del_confirm(\'Advertencia\', \'Estas seguro de eliminar este Rol?  \', \'<?php echo site_url('c=roles&m=delete&id=');?>' + data + '\',\'roles-datatable\');"  data-toggle="tooltip" data-placement="bottom" title=" Eliminar" class="btn btn-default btn-xs"><i class="fa fa-trash icon-trash"></i></a>';
					html += '</div>';
					return html;
				}
			}
		]
	});
});
</script>
