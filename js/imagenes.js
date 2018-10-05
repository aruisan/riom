


/*$('#file-select').click(
function(){

	$('body').css('background-color','orange');
});*/



$(function(){
//____________________________incio

$('#preview').hover(
	function(){
		$(this).find('input').fadeIn();
		$(this).find('a').fadeIn();	
			
	}, function(){
		$(this).find('input').fadeOut();
		$(this).find('a').fadeOut();
		

	});

//______________________________________________


	$('#file-select').on('click', function(e){
		e.preventDefault();
			$('#file').click();
		

});



//____________________________________________

$('#file').change(function(){
	var file = (this.files[0].name).toString();
	var reader = new FileReader();

	$('#file-info').text('');
	$('#file-info').text(file);

	reader.onload = function(e){
		$('#preview img').attr('src', e.target.result);
	}
		reader.readAsDataURL(this.files[0]);
});




/**---------------------------------------------------------
_______________formulario editar____________________________
------------------------------------------------------------*/


/*

$('#previewe').hover(
	function(){
		$(this).find('a').fadeIn();	
	}, function(){
		$(this).find('a').fadeOut();

	});

//______________________________________________


	$('#file-selecte').on('click', function(e){
		e.preventDefault();
			$('#filee').click();
		

});



//____________________________________________

$('#filee').change(function(){
	var file = (this.files[0].name).toString();
	var reader = new FileReader();

	$('#file-infoe').text('');
	$('#file-infoe').text(file);

	reader.onload = function(e){
		$('#previewe img').attr('src', e.target.result);
	}
		reader.readAsDataURL(this.files[0]);
});

*/
//_____________________________fin	
});