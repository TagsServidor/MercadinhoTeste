 $(document).ready(function() {
 
	 $("#formproduto").submit(function(){
		 
		 
		 
		    var formData = new FormData(this);

		 
		$.ajax({
			url: 'alterar_produto',
			cache: false,
			data: formData,
			type: "POST",  
			enctype: 'multipart/form-data',
			processData: false, // impedir que o jQuery tranforma a "data" em querystring
            contentType: false, // desabilitar o cabeçalho "Content-Type"


			success: function(msg){
				
				$("#results").empty();
				$("#results").append(msg);
			}
			
		});
		 
		 return false;
	 });
 
 });
