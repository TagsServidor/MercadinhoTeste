! function (t) {
	"use strict";

	function e() {}
	e.prototype.init = function () {
		t("#sa-basic").on("click", function () {
			Swal.fire({
				title: "Any fool can use a computer",
				confirmButtonColor: "#5b73e8"
			})
		}), t("#sa-title2").click(function () {
			Swal.fire({
				title: "Tudo certo",
				text: "Cadastro Central Realizado com Sucesso",
				icon: "success",
				confirmButtonColor: "#5b73e8"
			})
		}),
			
			
			
			
			
			t("#sa-success").click(function () {
			Swal.fire({
				title: "Good job!",
				text: "You clicked the button!",
				icon: "success",
				showCancelButton: !0,
				confirmButtonColor: "#5b73e8",
				cancelButtonColor: "#f46a6a"
			})
		}), 
			
			
			t("#sa-warning").click(function () {
			Swal.fire({
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				icon: "warning",
				showCancelButton: !0,
				confirmButtonColor: "#34c38f",
				cancelButtonColor: "#f46a6a",
				confirmButtonText: "Yes, delete it!"
			}).then(function (t) {
				window.location.href = "http://www.devmedia.com.br";

			})
		}), 
			
			
			t("#sa-central").click(function () {
			Swal.fire({
				title: "Tudo Certo!",
				text: "Central Cadastrada Com Sucesso",
				icon: "success",
				
				confirmButtonColor: "#34c38f",
				cancelButtonColor: "#f46a6a",
				confirmButtonText: "Ok"
			}).then(function (t) {
				window.location.href = "listar_centrais";

			})
		}),
			
			
			t("#sa-departamento").click(function () {
			Swal.fire({
				title: "Tudo Certo!",
				text: "Departamento Cadastrado Com Sucesso",
				icon: "success",
				
				confirmButtonColor: "#34c38f",
				cancelButtonColor: "#f46a6a",
				confirmButtonText: "Ok"
			}).then(function (t) {
				window.location.href = "listar_departamentos";

			})
		}),
			
			t("#sa-categoria").click(function () {
			Swal.fire({
				title: "Tudo Certo!",
				text: "Categoria Cadastrada Com Sucesso",
				icon: "success",
				
				confirmButtonColor: "#34c38f",
				cancelButtonColor: "#f46a6a",
				confirmButtonText: "Ok"
			}).then(function (t) {
				window.location.href = "listar_categorias2";

			})
		}),
				
			
				t("#sa-subcategoria").click(function () {
			Swal.fire({
				title: "Tudo Certo!",
				text: "Subcategoria Cadastrada Com Sucesso",
				icon: "success",
				
				confirmButtonColor: "#34c38f",
				cancelButtonColor: "#f46a6a",
				confirmButtonText: "Ok"
			}).then(function (t) {
				window.location.href = "listar_subcategorias2";

			})
		}),
					
			
			
		t("#sa-centrals").click(function () {
			Swal.fire({
				title: "Tudo Certo!",
				text: "Central Alterada Com Sucesso",
				icon: "success",
				
				confirmButtonColor: "#34c38f",
				cancelButtonColor: "#f46a6a",
				confirmButtonText: "Ok"
			}).then(function (t) {
				window.location.href = "listar_centrais";

			})
		}),
			
			t("#sa-fornecedor").click(function () {
			Swal.fire({
				title: "Tudo Certo!",
				text: "Fornecedor Cadastrado Com Sucesso",
				icon: "success",
				
				confirmButtonColor: "#34c38f",
				cancelButtonColor: "#f46a6a",
				confirmButtonText: "Ok"
			}).then(function (t) {
				window.location.href = "listar_fornecedores";

			})
		}),

		t("#sa-fornecedors").click(function () {
			Swal.fire({
				title: "Tudo Certo!",
				text: "Fornecedor Alterado Com Sucesso",
				icon: "success",
				
				confirmButtonColor: "#34c38f",
				cancelButtonColor: "#f46a6a",
				confirmButtonText: "Ok"
			}).then(function (t) {
				window.location.href = "listar_fornecedores";

			})
		}),
			
			
			t("#sa-produto").click(function () {
			Swal.fire({
				title: "Tudo Certo!",
				text: "Produto Cadastrado Com Sucesso",
				icon: "success",
				
				confirmButtonColor: "#34c38f",
				cancelButtonColor: "#f46a6a",
				confirmButtonText: "Ok"
			}).then(function (t) {
				window.location.href = "listar_produtos";

			})
		}),
			
			
			t("#sa-apagar").click(function () {
			Swal.fire({
				title: "Tudo Certo!",
				text: "Conta Cadastrada Com Sucesso",
				icon: "success",
				
				confirmButtonColor: "#34c38f",
				cancelButtonColor: "#f46a6a",
				confirmButtonText: "Ok"
			}).then(function (t) {
				window.location.href = "contas_a_pagar";

			})
		}),
			
			t("#sa-apagar2").click(function () {
			Swal.fire({
				title: "Tudo Certo!",
				text: "Confirmação de pagamento Cadastrada Com Sucesso",
				icon: "success",
				
				confirmButtonColor: "#34c38f",
				cancelButtonColor: "#f46a6a",
				confirmButtonText: "Ok"
			}).then(function (t) {
				window.location.href = "contas_a_pagar";

			})
		}),


		t("#sa-produtos").click(function () {
			Swal.fire({
				title: "Tudo Certo!",
				text: "Produto Alterado Com Sucesso",
				icon: "success",
				
				confirmButtonColor: "#34c38f",
				cancelButtonColor: "#f46a6a",
				confirmButtonText: "Ok"
			}).then(function (t) {
				window.location.href = "listar_produtos";

			})
		}),
			
			
			t("#sa-condominio").click(function () {
			Swal.fire({
				title: "Tudo Certo!",
				text: "Condomínio Cadastrado Com Sucesso",
				icon: "success",
				
				confirmButtonColor: "#34c38f",
				cancelButtonColor: "#f46a6a",
				confirmButtonText: "Ok"
			}).then(function (t) {
				window.location.href = "listar_condominios";

			})
		}),

		t("#sa-condominios").click(function () {
			Swal.fire({
				title: "Tudo Certo!",
				text: "Condomínio Alterado Com Sucesso",
				icon: "success",
				
				confirmButtonColor: "#34c38f",
				cancelButtonColor: "#f46a6a",
				confirmButtonText: "Ok"
			}).then(function (t) {
				window.location.href = "listar_condominios";

			})
		}),
			
			
			t("#sa-gerenciavel").click(function () {
			Swal.fire({
				title: "Tudo Certo!",
				text: "Colaborador Cadastrado Com Sucesso",
				icon: "success",
				
				confirmButtonColor: "#34c38f",
				cancelButtonColor: "#f46a6a",
				confirmButtonText: "Ok"
			}).then(function (t) {
				window.location.href = "colaboradores";

			})
		}),
			
			
				t("#sa-estoqueentrada").click(function () {
			Swal.fire({
				title: "Tudo Certo!",
				text: "Entrada Registrada Com Sucesso",
				icon: "success",
				
				confirmButtonColor: "#34c38f",
				cancelButtonColor: "#f46a6a",
				confirmButtonText: "Ok"
			}).then(function (t) {
				window.location.href = "listar_entradas";

			})
		}),
			
		
			
			
				t("#sa-estoqueentrada2").click(function () {
			Swal.fire({
				title: "Ops!",
				text: "Não foi possivel lançar essa entrada, já existe outro registro com mesmo lote.",
				icon: "danger",
				
				confirmButtonColor: "#34c38f",
				cancelButtonColor: "#f46a6a",
				confirmButtonText: "Ok"
			}).then(function (t) {
				window.location.href = "listar_entradas";

			})
		}),
			
			
			t("#sa-unidade").click(function () {
			Swal.fire({
				title: "Tudo Certo!",
				text: "Unidade (Ponto de Venda) Cadastrada Com Sucesso",
				icon: "success",
				
				confirmButtonColor: "#34c38f",
				cancelButtonColor: "#f46a6a",
				confirmButtonText: "Ok"
			}).then(function (t) {
				window.location.href = "listar_unidades";

			})
		}),

		t("#sa-unidades").click(function () {
			Swal.fire({
				title: "Tudo Certo!",
				text: "Unidade (Ponto de Venda) Alterada Com Sucesso",
				icon: "success",
				
				confirmButtonColor: "#34c38f",
				cancelButtonColor: "#f46a6a",
				confirmButtonText: "Ok"
			}).then(function (t) {
				window.location.href = "listar_unidades";

			})
		}),
			
			
			t("#sa-params").click(function () {
			Swal.fire({
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				icon: "warning",
				showCancelButton: !0,
				confirmButtonText: "Yes, delete it!",
				cancelButtonText: "No, cancel!",
				confirmButtonClass: "btn btn-success mt-2",
				cancelButtonClass: "btn btn-danger ms-2 mt-2",
				buttonsStyling: !1
			}).then(function (t) {
				t.value ? Swal.fire({
					title: "Deleted!",
					text: "Your file has been deleted.",
					icon: "success",
					confirmButtonColor: "#34c38f"
				}) : t.dismiss === Swal.DismissReason.cancel && Swal.fire({
					title: "Cancelled",
					text: "Your imaginary file is safe :)",
					icon: "error"
				})
			})
		}), t("#sa-image").click(function () {
			Swal.fire({
				title: "Sweet!",
				text: "Modal with a custom image.",
				imageUrl: "assets/images/logo-dark.png",
				imageHeight: 20,
				confirmButtonColor: "#5b73e8",
				animation: !1
			})
		}), t("#sa-close").click(function () {
			var t;
			Swal.fire({
				title: "Auto close alert!",
				html: "I will close in <strong></strong> seconds.",
				timer: 2e3,
				confirmButtonColor: "#5b73e8",
				onBeforeOpen: function () {
					Swal.showLoading(), t = setInterval(function () {
						Swal.getContent().querySelector("strong").textContent = Swal.getTimerLeft()
					}, 100)
				},
				onClose: function () {
					clearInterval(t)
				}
			}).then(function (t) {
				t.dismiss === Swal.DismissReason.timer && console.log("I was closed by the timer")
			})
		}), t("#custom-html-alert").click(function () {
			Swal.fire({
				title: "<i>HTML</i> <u>example</u>",
				icon: "info",
				html: 'You can use <b>bold text</b>, <a href="//Themesbrand.in/">links</a> and other HTML tags',
				showCloseButton: !0,
				showCancelButton: !0,
				confirmButtonClass: "btn btn-success",
				cancelButtonClass: "btn btn-danger ms-1",
				confirmButtonColor: "#47bd9a",
				cancelButtonColor: "#f46a6a",
				confirmButtonText: '<i class="fas fa-thumbs-up me-1"></i> Great!',
				cancelButtonText: '<i class="fas fa-thumbs-down"></i>'
			})
		}), t("#sa-position").click(function () {
			Swal.fire({
				position: "top-end",
				icon: "success",
				title: "Your work has been saved",
				showConfirmButton: !1,
				timer: 1500
			})
		}), t("#custom-padding-width-alert").click(function () {
			Swal.fire({
				title: "Custom width, padding, background.",
				width: 600,
				padding: 100,
				confirmButtonColor: "#5b73e8",
				background: "#fff url(//subtlepatterns2015.subtlepatterns.netdna-cdn.com/patterns/geometry.png)"
			})
		}), 
			
			
			t("#ajax-alert").click(function () {
			Swal.fire({
				title: "Quantidade que deseja enviar",
				input: "number",
				
				inputPlaceholder: "Quantidade",
				showCancelButton: !0,
				confirmButtonText: "Submit",
				showLoaderOnConfirm: !0,
				confirmButtonColor: "#5b73e8",
				cancelButtonColor: "#f46a6a",
				preConfirm: function (n) {
					return new Promise(function (t, e) {
						setTimeout(function () {
							"taken@example.com" === n ? e("This email is already taken.") : t()
						}, 2e3)
					})
				},
				allowOutsideClick: !1
			}).then(function (t) {
				Swal.fire({
					icon: "success",
					title: "Ajax request finished!",
					confirmButtonColor: "#34c38f",
					html: "Submitted email: " + t
				})
			})
		}), 
			
			
			
			
			t("#chaining-alert").click(function () {
			Swal.mixin({
				input: "text",
				confirmButtonText: "Next →",
				inputPlaceholder: "Quantidade",
				showCancelButton: !0,
				confirmButtonColor: "#5b73e8",
				cancelButtonColor: "#74788d",
				progressSteps: ["1", "2", "3"]
			}).queue([{
				title: "Quantidade que deseja enviar",
				text: "Quantidade"
			}, "Os", "Valor venda"]).then(function (t) {
				t.value && Swal.fire({
					title: "All done!",
					html: "Your answers: <pre><code>" + JSON.stringify(t.value) + "</code></pre>",
					confirmButtonText: "Lovely!",
					confirmButtonColor: "#34c38f"
				})
			})
		}), 
			
			
			
			t("#dynamic-alert").click(function () {
			swal.queue([{
				title: "Your public IP",
				confirmButtonColor: "#5b73e8",
				confirmButtonText: "Show my public IP",
				text: "Your public IP will be received via AJAX request",
				showLoaderOnConfirm: !0,
				preConfirm: function () {
					return new Promise(function (e) {
						t.get("https://api.ipify.org?format=json").done(function (t) {
							swal.insertQueueStep(t.ip), e()
						})
					})
				}
			}]).catch(swal.noop)
		})
	}, t.SweetAlert = new e, t.SweetAlert.Constructor = e
}(window.jQuery),
function () {
	"use strict";
	window.jQuery.SweetAlert.init()
}();