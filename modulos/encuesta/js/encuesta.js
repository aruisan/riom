$(document).ready(function(){
	modalInicial();
});

function modalInicial()
{
	$('#questionOne').modal({backdrop: 'static', keyboard: false})
}

//btn siguiente
$('#siguienteQuestionOne').click(function(){
	valor = $('#questionOne input:radio[name=questionOne]:checked').val();
	$('form input:hidden[name=questionOne]').val(valor);

	$('#questionOne').modal('hide')
	if(valor == 1 || valor == 2)
	{
		$('#flujo1').modal({backdrop: 'static', keyboard: false})
	}else{
		$('form input:hidden[name=flujo1]').val('');
		$('#questionTwo').modal({backdrop: 'static', keyboard: false})
	}
});

$('#siguienteFlujo1').click(function(){
	valor = $('#textFlujo1').val();
	$('form input:hidden[name=flujo1]').val(valor);
	$('#flujo1').modal('hide')
	$('#questionTwo').modal({backdrop: 'static', keyboard: false})
});


$('#siguienteQuestionTwo').click(function(){
	valor = $('#questionTwo input:radio[name=questionTwo]:checked').val();
	$('form input:hidden[name=questionTwo]').val(valor);

	$('#questionTwo').modal('hide')
	if(valor == 1 || valor == 2)
	{
		$('#flujo2').modal({backdrop: 'static', keyboard: false})
	}else{
		$('form input:text[name=flujo2]').val('');
		$('#questionThree').modal({backdrop: 'static', keyboard: false})
	}
});

$('#siguienteFlujo2').click(function(){
	valor = $('#textFlujo2').val();
	$('form input:hidden[name=flujo2]').val(valor);
	$('#flujo2').modal('hide')
	$('#questionThree').modal({backdrop: 'static', keyboard: false})
});

$('#siguienteQuestionThree').click(function(){
	valor = $('#questionThree input:radio[name=questionThree]:checked').val();
	$('form input:hidden[name=questionThree]').val(valor);

	$('#questionThree').modal('hide')
	$('#questionFour').modal({backdrop: 'static', keyboard: false});
});

$('#siguienteQuestionFour').click(function(){
	valor = $('#questionFour input:radio[name=questionFour]:checked').val();
	$('form input:hidden[name=questionFour]').val(valor);

	datos = $('form').serialize();
	$.post( "php/encuesta.php",datos,  function( data ) {

	}).done(function(){
		$('#questionFour').modal('hide')
		$('#resp').modal({backdrop: 'static', keyboard: false});
    	setTimeout(function(){ location.reload(); }, 5000);
  	});
	//$( "form" ).submit();
});

//btn atras
$('#atrasFlujo1').click(function(){
	$('#flujo1').modal('hide')
	$('#questionOne').modal({backdrop: 'static', keyboard: false})
});

$('#atrasQuestionTwo').click(function(){
	$('#questionTwo').modal('hide')
	$('#questionOne').modal({backdrop: 'static', keyboard: false})
});

$('#atrasFlujo2').click(function(){
	$('#flujo2').modal('hide')
	$('#questionTwo').modal({backdrop: 'static', keyboard: false})
});

$('#atrasQuestionThree').click(function(){
	$('#questionThree').modal('hide')
	$('#questionTwo').modal({backdrop: 'static', keyboard: false})
});

$('#atrasQuestionFour').click(function(){
	$('#questionFour').modal('hide')
	$('#questionThree').modal({backdrop: 'static', keyboard: false})
});



