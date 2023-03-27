var tabla;

function init(){
    $("#depto_form").on("submit",function(e){
        guardaryeditar(e);	
    });
}

function guardaryeditar(e){
    e.preventDefault();
	var formData = new FormData($("#depto_form")[0]);
    $.ajax({
        url: "../../controller/depto.php?op=guardaryeditar",
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
    tabla=$('#depto_data').dataTable({
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
            url: '../../controller/depto.php?op=listar',
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

function Editar(depto_id){
    //alert(depto_id);
    $('#mdltitulo').html('Editar Departamentos');

    $.post("../../controller/depto.php?op=mostrar", {depto_id : depto_id}, function (data) {
        //data = JSON.stringify(data);
        data = JSON.parse(data);
        $('#depto_id').val(data.depto_id);
        $('#depto_nom').val(data.depto_nom).trigger('change');
    }); 

    $('#modaldepartamento').modal('show');
}

function Eliminar(depto_id){
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
            $.post("../../controller/depto.php?op=eliminar", {depto_id : depto_id}, function (data) {

            }); 

            $('#depto_data').DataTable().ajax.reload();	

            swal({
                title: "HelpDesk!",
                text: "Registro Eliminado.",
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
    $('#modaldepartamento').modal('show');
});

function Ver_usuarios(depto_id){
    
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


    $('#modaldeptoUser').modal('show');


}

function Add_usuarios(depto_id){
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


    $('#modaldeptoUser').modal('show');    
    
}

function CambiarEstado(depto_id,est){
    swal({
        title: "HelpDesk",
        text: "Esta seguro de cambiarlo de estado a este departamento?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.post("../../controller/depto.php?op=cambiar_estado", {depto_id : depto_id,est : est}, function (data) {

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


init();