 $(document).ready(function() {
 
	 $("#formunidades").submit(function(){
		 
		  $('html,body').animate({
        scrollTop: $("#results2").offset().top},
        'slow');
		 
		 var dados = jQuery( this ).serialize();
		 
		$.ajax({
			url: 'inserir_unidades',
			cache: false,
			data: dados,
			type: "POST",  

			success: function(msg){
				
				$("#results").empty();
				$("#results").append(msg);
			}
			
		});
		 
		 return false;
	 });
 
 });
