


        function atendido(id){
           
             var url = 'atendido.php';
    $.ajax({
    type:'POST',
    url:url,
    data:'id='+id,
    success: function(data){
      $("#cuadro-servicio").show("low").html(data);
       
      /*$('#n'+datos[0]).removeClass("btn-danger").addClass("btn-success").text("SI");
        $('.c'+id).addClass('atendido');*/
    }
  });
  return false;

         };
   //      _______________________________________
    function repetir(id){
             
             var url = 'php/repetir.php';
    $.ajax({
    type:'POST',
    url:url,
    data:'id='+id,
    success: function(valores){
        $('#repetir_servicios').html(valores).show(500);
    }
  });
  return false;

         };
  //___________________________________
 function copyff(id){   
          
     
        
      
          var v1 =  $("#la"+id).text();
        $("body").append("<input type='text' id='tempa'>"); 
        $("#tempa").val(v1).select(); 
        document.execCommand("copy"); 
        $("#tempa").remove();
        $("#tdff"+id).removeClass('atendido');
   };
  //___________________________________
   function copycc(id){   
          
     
        
      
          var v2 =  $("#lb"+id).text();
        $("body").append("<input type='text' id='tempb'>"); 
        $("#tempb").val(v2).select(); 
        document.execCommand("copy"); 
        $("#tempb").remove();
         $("#tdcc"+id).removeClass('atendido');
   };
  //___________________________________
    function copynm(id){   
          
     
        
      
          var v3 =  $("#lc"+id).text();
        $("body").append("<input type='text' id='tempc'>"); 
        $("#tempc").val(v3).select(); 
        document.execCommand("copy"); 
        $("#tempc").remove();
        $("#tdnm"+id).removeClass('atendido');
   };
  //___________________________________
    function copyage(id){   
          
     
        
      
          var v4 =  $("#ld"+id).text();
        $("body").append("<input type='text' id='tempd'>"); 
        $("#tempd").val(v4).select(); 
        document.execCommand("copy"); 
        $("#tempd").remove();
         $("#tdage"+id).removeClass('atendido');
   };
  //___________________________________
    function copydoc(id){   
          
     
        
      
          var v4 =  $("#le"+id).text();
        $("body").append("<input type='text' id='tempe'>"); 
        $("#tempe").val(v4).select(); 
        document.execCommand("copy"); 
        $("#tempe").remove();
         $("#tddoc"+id).removeClass('atendido');
   };
  //___________________________________
   $(document).ready(function(){
        $("#ocultar").click(function(){
            $('#repetir_servicios').text("si sirve");

});
        $("#buscar").keyup(function(){
                  $("#citas").html("<p class='loading'><img src='buscar.gif'/><br>Cargando..</p>");
                  var url = 'php/buscar.php';
                  var buscar = $("#buscar").val();
          $.ajax({
          type:'POST',
          url:url,
          data:'buscar='+buscar,
          success: function(valores){
              $('#citas').html(valores);
    }
  });
return false;
        });
  //___________________________________

        $("#filtro").change(function(){

          var url = 'php/filtro.php';
                  var filtro = $("#filtro").val();
          $.ajax({
          type:'POST',
          url:url,
          data:'filtro='+filtro,
          success: function(valores){
              $('#citas').html(valores);
}
        });
           });
//___________________________________
         });
   //___________________________________
