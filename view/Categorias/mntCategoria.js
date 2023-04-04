var tabla;

function init(){
    $("#cat_form").on("submit",function(e){
        guardaryeditar(e);	
    });
    $("#sub_cat_form").on("submit",function(e){
        guardaryeditarSubcat(e);  
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
            $('#cat_form')[0].reset();
            $("#modalcategorias").modal('hide');
            $('#cat_data').DataTable().ajax.reload();

            swal({
                title: "HelpDesk!",
                text: "Completado.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    }); 
}

function guardaryeditarSubcat(e){
    e.preventDefault();
    var formData = new FormData($("#sub_cat_form")[0]);
    $.ajax({
        url: "../../controller/categoria.php?op=guardaryeditarSubcat",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){    
            console.log(datos);
            $('#sub_cat_form')[0].reset();
            $("#modalSubCategoriaNew").modal('hide');
            $('#Subcategoria_data').DataTable().ajax.reload();

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
        "columnDefs": [
                {
                    "targets": [0], // índice de la columna a centrar, iniciando desde cero
                    "className": "text-right" // clase CSS para centrar el contenido de la columna
                },
                {
                    "targets": [2,3,4,5,6], // índice de la columna a centrar, iniciando desde cero
                    "className": "text-center" // clase CSS para centrar el contenido de la columna
                }
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
    $('#mdltitulo_Sub_new').html('Editar Subcategoria');
    $('#l_titulo').html('Subcategoria Nombre');

    $.post("../../controller/categoria.php?op=mostrarSub", {sub_cat_id : id}, function (data) {
        //data = JSON.stringify(data);
        data = JSON.parse(data);
        $('#sub_cat_id').val(data.sub_cat_id);
        $('#sub_cat_nom').val(data.sub_cat_nom).trigger('change');
    }); 

    //$('#modalSubcategorias').modal('hide');
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

function EliminarSub(id){
    swal({
        title: "HelpDesk",
        text: "Esta seguro de Eliminar esta Subcategoria?",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.post("../../controller/categoria.php?op=EliminarSub", {sub_cat_id : id}, function (data) {

            }); 

            $('#Subcategoria_data').DataTable().ajax.reload();   

            swal({
                title: "HelpDesk!",
                text: "Registro Eliminado.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });
}

function Sacar_Sub_Cat(sub_cat_id,cat_id){
    swal({
        title: "HelpDesk",
        text: "Esta seguro de Sacar esta Subcategoria de la Categoria?",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.post("../../controller/categoria.php?op=Sacar_Sub_cat", {sub_cat_id : sub_cat_id, cat_id : cat_id}, function (data) {

            }); 

            $('#cat_data').DataTable().ajax.reload(); 
            $('#Subcategoria_data').DataTable().ajax.reload();   

            swal({
                title: "HelpDesk!",
                text: "Se saco la Subcategoria de la Categoria.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
            $('#modalSubcategorias').modal('hide');
        }
    });
}


function AddUsuCategoria(sub_cat_id,cat_id){
    swal({
        title: "HelpDesk",
        text: "Esta seguro de agregar esta subcategoria a la categoria?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.post("../../controller/categoria.php?op=Add_Subcat_cat", {sub_cat_id : sub_cat_id,cat_id : cat_id}, function (data) {

            });

            $('#depto_data').DataTable().ajax.reload(); 
            $('#modaldeptoUser').modal('hide');   

            swal({
                title: "HelpDesk!",
                text: "La Subcategoria fue agregado a esta Categoria.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });
    

}




$(document).on("click","#btnnuevo", function(){
    $('#mdltitulo').html('Nueva Categoria');
    $('#cat_form')[0].reset();
    $('#modalcategorias').modal('show');
});

$(document).on("click","#btnnuevoSubCategoria", function(){
    $('#mdltitulo_Sub_new').html('Nueva Subcategoria');
    $('#sub_cat_form')[0].reset();
    $('#modalSubcategorias').modal('hide');
    $('#modalSubCategoriaNew').modal('show');
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
            url: '../../controller/categoria.php?op=listar_x_categoria', 
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

            $('#Subcategoria_data').DataTable().ajax.reload();    

            swal({
                title: "HelpDesk!",
                text: "Departamento cambio de estado.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });
}


function Ver_Sub_Categoria(cat_id,flag){
    $('#mdltitulo2').html('Subcategorias');
    if(flag==1){
        url = "../../controller/categoria.php?op=listar_subcategoria";
        $('#boton_accion').html("<button type='button' id='btSubCategoria' class='btn btn-block btn-primary' onClick='Ver_Sub_Categoria("+cat_id+",2)' title='Agregar otras Subcategorias'>SubCategorias</button>"); 
    }else{
        url = "../../controller/categoria.php?op=listar_sin_subcategoria"; 
        $('#boton_accion').html("");  

    }
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
        "columnDefs": [
                {
                    "targets": [0], // índice de la columna a centrar, iniciando desde cero
                    "className": "text-right" // clase CSS para centrar el contenido de la columna
                },
                {
                    "targets": [2,3,4,5], // índice de la columna a centrar, iniciando desde cero
                    "className": "text-center" // clase CSS para centrar el contenido de la columna
                }
                ],


        "ajax":{
            //url: '../../controller/categoria.php?op=listar_subcategoria', 
            url: url, 
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

    
    
    $('#modalSubcategorias').modal('show');    
 
}

function AddSubCategoria(sub_cat_id,cat_id){
  swal({
        title: "HelpDesk",
        text: "Esta seguro de agregar esta Subcategoria a esta Categoria?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.post("../../controller/categoria.php?op=AddSubCategoria", {sub_cat_id : sub_cat_id,cat_id : cat_id}, function (data) {

            });

            $('#cat_data').DataTable().ajax.reload(); 
            $('#Subcategoria_data').DataTable().ajax.reload();

            

            swal({
                title: "HelpDesk!",
                text: "La Subcategoria fue agregada a esta Categoria.",
                type: "success",
                confirmButtonClass: "btn-success"
                   
            });
            $('#modalSubcategorias').modal('hide');
        }
    });
 
}

init();