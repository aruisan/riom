
$(document).ready(function(){
    verlistado()
    menu()
    me()
    encabezado()
    formulario()
 
 
   
    //CARGAMOS EL ARCHIVO QUE NOS LISTA LOS REGISTROS, CUANDO EL DOCUMENTO ESTA LISTO


})
function verlistado(){ //FUNCION PARA MOSTRAR EL LISTADO EN EL INDEX POR JQUERY
              var randomnumber=Math.random()*11;
            $.post("etiquetas/contenido.php", {
                randomnumber:randomnumber
            }, function(data){
              $("#contenido").html(data);
            });
}


function menu(){ //FUNCION PARA MOSTRAR EL LISTADO EN EL INDEX POR JQUERY
            $.post("etiquetas/menu.php", function(data){
              $("#menu").html(data);
            });

}

function me(){ //FUNCION PARA MOSTRAR EL LISTADO EN EL INDEX POR JQUERY
            $.post("etiquetas/informe.php", function(data){
              $("#informe").html(data);
            });

}


function encabezado(){ //FUNCION PARA MOSTRAR EL LISTADO EN EL INDEX POR JQUERY
            $.post("etiquetas/encabezado.php", function(data){
              $("#encabezado").html(data);
            });

}


function formulario(){ //FUNCION PARA MOSTRAR EL LISTADO EN EL INDEX POR JQUERY
            $.post("etiquetas/formulario.php", function(data){
              $("#caja-formulario").html(data);
            });


}
//_____________________________________________________________________________________
