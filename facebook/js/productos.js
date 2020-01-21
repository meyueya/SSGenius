$(document).ready(function() {if (dTable instanceof $.fn.dataTable.Api) {
    $('#dvLoading').fadeIn(800); 
} else {
   $('#dvLoading').fadeOut(800); 
}
 var dTable = $('#example1').DataTable({
   dom: 'Bfrtip',
   processing: true,
   "fnInitComplete": function(oSettings, json) {
     $('#dvLoading').fadeOut(800); 
   },
    columnDefs: [
   {
       targets: [ -1, -2,-3,-4],
       className: 'dt-body-right'
   }
 ],
   pageLength: 15,
   buttons: [{
     extend: 'pdf',
     title: 'Reporte Informes',
     filename: 'reporteinformes'
   }],
   language: {
           search: "Buscar",
           emptyTable: "Sin Criterios de Catalogación!!",
           infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
           lengthMenu: "Mostrar _MENU_ Entradas",
           loadingRecords: "Cargando...",
           processing: "Procesando...",
           infoFiltered: "(Filtrado de _MAX_ total entradas)",
           info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
           zeroRecords: "Sin resultados encontrados",
           paginate: {
               first:      "Inicio",
               previous:   "Anterior",
               next:       "Siguiente",
               last:       "Anterior"
           }
           
           }
 });
});


   function deleteRecord(id) {
       swal({
           title: '¿Estas seguro de eliminar este elemento?',
           text: 'también destruirá las relaciones de este producto con las campañas',
           type: 'warning',
           showCancelButton: true, 
           confirmButtonText: 'Si, estoy seguro',
           cancelButtonText: 'No',
           confirmButtonClass: "btn btn-success",
           cancelButtonClass: "btn btn-danger",
           buttonsStyling: false
       }).then(function() {
           $.ajax({
               type: "post",
               url: 'controller/productosController.php',
               data: {'id_producto_delete':id},
               success: function(result){
               $('tr[data-id="'+id+'"]').fadeOut('slow','swing');
               swal({
                   title: '¡Éxito!',
                   //text: result,
                   type: 'success',
                   confirmButtonClass: "btn btn-success",
                   buttonsStyling: false
               }).catch(swal.noop)
       }
           });
           
       }, function(dismiss) {
           // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
           if (dismiss === 'cancel') {
               swal({
                   title: 'Cancelado',
                   text: '',
                   type: 'info',
                   confirmButtonClass: "btn btn-info",
                   buttonsStyling: false
               }).catch(swal.noop)
           }
       })
   }

function newRecord(){
       $('#addRecord').modal();
   }
function updateRecord(id){
   $('#update').val(id);
   $('#update_name').val($("[data-id='"+id+"'] >.name").html() );
   $('#update_description').val($("[data-id='"+id+"'] >.description").html() );
   $('#updateRecord').modal();
}

function adminRelacionesProducto(id){
   //$('#update').val(id);
   $('#nombre_producto').html($("[data-id='"+id+"'] >.name").html() );
   //$('#update_description').val($("[data-id='"+id+"'] >.description").html() );
   $('#relaciones_producto').modal();
}
/* $('#cataloging').addClass("active");
$('#cataloging_examples').addClass("show");
$('#admin_cataloging').addClass("active"); */
