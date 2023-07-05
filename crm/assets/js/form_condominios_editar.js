
 $(document).ready(function() {
 
	 $("#formcondominioeditar").submit(function(){
		
		 
		 var dados = jQuery( this ).serialize();
		 
		$.ajax({
			url: 'alterar_condominio.php',
			cache: false,
			data: dados,
			type: "POST",  

			success: function(msg){
				
				$("#results3").empty();
				$("#results3").append(msg);
			}
			
		});
		 
		 return false;
	 });
 
 });
