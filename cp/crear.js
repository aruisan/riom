$(function(){
	//__________________________ingresar_____________________________
	var contador = 1; 
	// Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
	$("#agregar").on('click', function(){
		$("form fieldset div:eq(5)").clone().removeClass("fila-base").appendTo("form fieldset");
		contador = contador + 1; 
		var ocultar = contador+1;
		var btn1 = document.getElementById("agregar"); 
		btn1.value = "+(" + contador + ")"; 
		var btn2 = document.getElementById("ocultar"); 
		btn2.value =  + ocultar ; 


	});


 //______________________________________________________________________________________
	// Evento que selecciona la fila y la elimina 
	$(document).on("click",".eliminar",function(){
		var parent = $(this).parents().get(0);
		$(parent).remove();
		 contador =contador-1;
		 ocultar = contador+1;
		var btn1 = document.getElementById("agregar"); 
		btn1.value = "+(" + contador + ")"; 
		var btn2 = document.getElementById("ocultar"); 
		btn2.value = + ocultar  ; 


	});
	//___________________________________adicionar_________________________________________-

	// Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
	var contador = 1;
	$("#adicionar").on('click', function(){
		$("form fieldset .primero center:eq(1)").clone().removeClass("fila-base").appendTo(".primero ");
		contador = contador + 1; 
		var ocultar = contador+1;
		var btn1 = document.getElementById("adicionar"); 
		btn1.value = "+(" + contador + ")"; 
		var btn2 = document.getElementById("ocultar"); 
		btn2.value =  + ocultar ; 


	});
//_____________________________eliminar adicionar____________________________

	$(document).on("click",".restar",function(){
		var parent = $(this).parents().get(0);
		$(parent).remove();
		 contador =contador-1;
		 ocultar = contador+1;
		var btn1 = document.getElementById("adicionar"); 
		btn1.value = "+(" + contador + ")"; 
		var btn2 = document.getElementById("ocultar"); 
		btn2.value = + ocultar  ; 


	});

//__________________________******************************_____________________________
});
 