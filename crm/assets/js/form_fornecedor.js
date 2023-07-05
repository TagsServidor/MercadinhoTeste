 $(document).ready(function() {
 
	 $("#formfornecedor").submit(function(){
		 
		 
		 
		    var formData = new FormData(this);

		 
		$.ajax({
			url: 'inserir_fornecedores',
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
