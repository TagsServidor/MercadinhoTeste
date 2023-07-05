 $(document).ready(function() {
 
	 $("#formdistribuicao").submit(function(){
		 
		  $('html,body').animate({
        scrollTop: $("#results2").offset().top},
        'slow');
		 
		 var dados = jQuery( this ).serialize();
		 
		$.ajax({
			url: 'produto_distribuicao',
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
