
$(function(){


	
	$('#nuevo-producto').on('click',function(){
		$('#pro').val('Registro');
		$('#edi').hide();
		$('#edit').hide();
		$('#reg').show();
		$('#regt').show();
		$('#formulario-producto').modal({
			show:true,
			backdrop:'static'
		});
	});
	
	
});

/*function agregaRegistro(){
	var url = 'php/agrega_producto.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario').serialize(),
		success: function(registro){
			if ($('#pro').val() == 'Registro'){
			$('#formulario')[0].reset();
			$('#mensaje').addClass('bien').html('Registro completado con exito').show(200).delay(2500).hide(200);
			$('#registros').html(registro);
			return false;
			}else{
			$('#mensaje').addClass('bien').html('Edicion completada con exito').show(200).delay(2500).hide(200);
			$('#registros').html(registro);
			return false;
			}
		}
	});
	return false;
}*/

function eliminarProducto(id){
	var url = 'php/eliminar.php';
	var pregunta = confirm('¿Esta seguro de eliminar este Producto?');
	if(pregunta==true){
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id
	});
	return false;
	}else{
		return false;
	}
}

function editarProducto(id){
	$('#formulario')[0].reset();
	var url = 'php/editar.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(valores){
				var datos = eval(valores);
				$('#reg').hide();
				$('#edi').show();
				$('#regt').hide();
				$('#edit').show();
				$('#pro').val('Edicion');
				$('#cc').val(id);
				$('#archivo').val(datos[0]);
				$('#nom').val(datos[1]);
				$('#ape').val(datos[2]);
			  //  $('#tipo option[value="datos[2]"]').attr("selected",true); 
			    $('#edad').val(datos[3]); 
				$('#sexo').val(datos[4]);
				$('#tel').val(datos[5]); 
				$('#dir').val(datos[6]);
				$('#cargo').val(datos[7]);
				$('#formulario-producto').modal({
					show:true,
					backdrop:'static'
				});
		}
	});
	return false;
}


//---------fin de eliminar editar y registrar producto-----------//

$(function () {
  $('[data-toggle="popover"]').popover()
})
