$(document).ready(function() {
  $.extend( $.fn.dataTable.defaults, {
    'language': {
       "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
    },
  	'pagingType': 'full',
    retrieve: true,
  } ); 
  
  $('#plagas').dataTable( {
    "orden" : [[1, "desc" ]],
	'bProcessing': true,
	'bServerSide': true,
	'sAjaxSource': 'plagas.php'
  } );
} );