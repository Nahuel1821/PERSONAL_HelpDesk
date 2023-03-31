var tabla;

function init(){
    $("#cat_form").on("submit",function(e){
        guardaryeditar(e);	
    });
}

function guardaryeditar(e){
    e.preventDefault();
	var formData = new FormData($("#cat_form")[0]);
    $.ajax({
        url: "../../controller/categoria.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){    
            console.log(datos);
            $('#depto_form')[0].reset();
            $("#modaldepartamento").modal('hide');
            $('#depto_data').DataTable().ajax.reload();

            swal({
                title: "HelpDesk!",
                text: "Completado.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    }); 
}

$(document).ready(function(){
    tabla=$('#cat_data').dataTable({
        "order": [[ 1, "asc" ]],
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lengthChange: false,
        colReorder: true,
        buttons: [		          
                //'copyHtml5',
                //'excelHtml5',
                //'csvHtml5',
                'pdfHtml5'
                ],
        "ajax":{
            url: '../../controller/categoria.php?op=listar_categoria',
            type : "post",
            dataType : "json",						
            error: function(e){
                console.log(e.responseText);	
            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 15,
        "autoWidth": false,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando un total de 0 registros",
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
        }     
    }).DataTable(); 
});


function Editar(cat_id){
    //alert(depto_id);
    $('#mdltitulo').html('Editar Categoria');

    $.post("../../controller/categoria.php?op=mostrar", {cat_id : cat_id}, function (data) {
        //data = JSON.stringify(data);
        data = JSON.parse(data);
        $('#cat_id').val(data.cat_id);
        $('#cat_nom').val(data.cat_nom).trigger('change');
    }); 

    $('#modalSubcategoria').modal('show');
}

function EditarSub(id){
    //alert(depto_id);
    $('#mdltitulo').html('Editar Subcategoria');

    $.post("../../controller/categoria.php?op=mostrarSub", {Sub_cat_id : id}, function (data) {
        //data = JSON.stringify(data);
        data = JSON.parse(data);
        $('#Sub_cat_id').val(data.cat_id);
        $('#Sub_cat_nom').val(data.cat_nom).trigger('change');
    }); 

    $('#modalSubCategoriaNew').modal('show');
}

function Eliminar(cat_id){
    swal({
        title: "HelpDesk",
        text: "Esta seguro de Eliminar la Subcategoria?",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.post("../../controller/categoria.php?op=eliminar", {cat_id : cat_id}, function (data) {

            }); 

            $('#cat_data').DataTable().ajax.reload();	

            swal({
                title: "HelpDesk!",
                text: "Registro Eliminado.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });
}

function EliminarUsuCat(usu_cat_id){
    swal({
        title: "HelpDesk",
        text: "Esta seguro de Eliminar el registro?",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.post("../../controller/depto.php?op=eliminar_usu_depto", {usu_depto_id : usu_depto_id}, function (data) {

            }); 

            $('#depto_data').DataTable().ajax.reload(); 
            $('#modaldeptoUser').modal('hide');	

            swal({
                title: "HelpDesk!",
                text: "Registro Eliminado.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });
}

function AddUsuCategoria(usu_id,cat_id){
    swal({
        title: "HelpDesk",
        text: "Esta seguro de agregar este usuario al departamento?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.post("../../controller/depto.php?op=Add_usu_depto", {usu_id : usu_id,depto_id : depto_id}, function (data) {

            });

            $('#depto_data').DataTable().ajax.reload(); 
            $('#modaldeptoUser').modal('hide');   

            swal({
                title: "HelpDesk!",
                text: "El Usuario fue agregado a este Departamento.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });
    

}




$(document).on("click","#btnnuevo", function(){
    $('#mdltitulo').html('Nuevo Departamento');
    $('#depto_form')[0].reset();
    //$("#depto_id").prop("type", "text");
    $('#modalCategorias').modal('show');
});

function Ver_usuarios(cat_id){
    
    $('#mdltitulo2').html('Usuarios del Departamento');
    tabla=$('#depto_user_data').dataTable({
        "order": [[ 1, "asc" ]],
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lengthChange: false,
        colReorder: true,
        buttons: [		          
                //'copyHtml5',
                //'excelHtml5',
                //'csvHtml5',
                //'pdfHtml5'
                ],
            
        "ajax":{
            url: '../../controller/depto.php?op=listar_x_depto', 
            data:{depto_id:depto_id},
            type : "post",
            dataType : "json",						
            error: function(e){
                console.log(e.responseText);	
            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 15,
        "autoWidth": false,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando un total de 0 registros",
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
        }     
    }).DataTable(); 

    $('#boton_accion').html("<button  id='#' class='btn btn-rounded btn-primary' onClick='Add_usuarios("+depto_id+");'>Agregar Usuarios</button>");

    $('#modaldeptoUser').modal('show');


}

function Add_usuarios(cat_id){
     $('#mdltitulo2').html('Usuarios del Departamento');
    tabla=$('#depto_user_data').dataTable({
        "order": [[ 1, "asc" ]],
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lengthChange: false,
        colReorder: true,
        buttons: [                
                //'copyHtml5',
                //'excelHtml5',
                //'csvHtml5',
                //'pdfHtml5'
                ],
        "ajax":{
            url: '../../controller/depto.php?op=listar_sin_depto', 
            data:{depto_id:depto_id},
            type : "post",
            dataType : "json",                      
            error: function(e){
                console.log(e.responseText);    
            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 15,
        "autoWidth": false,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando un total de 0 registros",
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
        }     
    }).DataTable(); 

    $('#boton_accion').html(" ");
    $('#modaldeptoUser').modal('show');    
    
}

function CambiarEstado(cat_id,est){
    swal({
        title: "HelpDesk",
        text: "Esta seguro de cambiarlo de estado a esta subcategoria?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.post("../../controller/categoria.php?op=cambiar_estado", {cat_id : cat_id,est : est}, function (data) {

            });

            $('#depto_data').DataTable().ajax.reload();    

            swal({
                title: "HelpDesk!",
                text: "Departamento cambio de estado.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });
}

function CambiarEstadoSub(id,est){
    swal({
        title: "HelpDesk",
        text: "Esta seguro de cambiarlo de estado a esta subcategoria?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.post("../../controller/categoria.php?op=CambiarEstadoSub", {sub_cat_id : id,sub_cat_est : est}, function (data) {

            });

            $('#depto_data').DataTable().ajax.reload();    

            swal({
                title: "HelpDesk!",
                text: "Departamento cambio de estado.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });
}


function Ver_Sub_Categoria(cat_id){
    $('#mdltitulo2').html('Subcategorias');
    tabla=$('#Subcategoria_data').dataTable({
        "order": [[ 1, "asc" ]],
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lengthChange: false,
        colReorder: true,
        buttons: [                
                //'copyHtml5',
                //'excelHtml5',
                //'csvHtml5',
                //'pdfHtml5'
                ],
        "ajax":{
            url: '../../controller/categoria.php?op=listar_subcategoria', 
            data:{cat_id:cat_id},
            type : "post",
            dataType : "json",                      
            error: function(e){
                console.log(e.responseText);    
            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 15,
        "autoWidth": false,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando un total de 0 registros",
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
        }     
    }).DataTable(); 

    $('#boton_accion').html(" ");
    $('#modalSubcategorias').modal('show');    
 
}

function Add_Sub_Categoria(cat_id){
    $('#mdltitulo2').html('Subcategorias');
    tabla=$('#Subcategoria_data').dataTable({
        "order": [[ 1, "asc" ]],
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lengthChange: false,
        colReorder: true,
        buttons: [                
                //'copyHtml5',
                //'excelHtml5',
                //'csvHtml5',
                //'pdfHtml5'
                ],
        "ajax":{
            url: '../../controller/categoria.php?op=listar_subcategoria', 
            data:{cat_id:cat_id},
            type : "post",
            dataType : "json",                      
            error: function(e){
                console.log(e.responseText);    
            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 15,
        "autoWidth": false,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando un total de 0 registros",
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
        }     
    }).DataTable(); 

    $('#boton_accion').html(" ");
    $('#modalSubcategoria').modal('show');    
 
}

init();