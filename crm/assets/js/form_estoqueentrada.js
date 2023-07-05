 $(document).ready(function() {
 
	 $("#formestoqueentrada1").submit(function(){
		 
		  $('html,body').animate({
        scrollTop: $("#results2").offset().top},
        'slow');
		 
		 var dados = jQuery( this ).serialize();
		 
		$.ajax({
			url: 'estoque_entradas1',
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


 $(document).ready(function() {
 
	 $("#formestoqueentrada2").submit(function(){
		 
		  $('html,body').animate({
        scrollTop: $("#results2q").offset().top},
        'slow');
		 
		 var dados = jQuery( this ).serialize();
		 
		$.ajax({
			url: 'inserir_estoque_entrada',
			cache: false,
			data: dados,
			type: "POST",  

			success: function(msg){
				
				$("#resultsq").empty();
				$("#resultsq").append(msg);
			}
			
		});
		 
		 return false;
	 });
 
 });
