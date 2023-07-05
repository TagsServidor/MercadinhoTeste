<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
?>
<style>
/* ============================================================== 
     # Preloader 
=================================================================== */
#preloader {
    position:fixed;
    top:0;
    left:0;
    right:0;
    bottom:0;
    background-color:#fff; /* cor do background que vai ocupar o body */
    z-index:999; /* z-index para jogar para frente e sobrepor tudo */
}
#preloader .inner {
    position: absolute;
    top: 50%; /* centralizar a parte interna do preload (onde fica a animação)*/
    left: 50%;
    transform: translate(-50%, -50%);  
}
.bolas > div {
  display: inline-block;
  background-color: #F27620;
  width: 25px;
  height: 25px;
  border-radius: 100%;
  margin: 3px;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
  animation-name: animarBola;
  animation-timing-function: linear;
  animation-iteration-count: infinite;
   
}
.bolas > div:nth-child(1) {
    animation-duration:0.75s ;
    animation-delay: 0;
}
.bolas > div:nth-child(2) {
    animation-duration: 0.75s ;
    animation-delay: 0.12s;
}
.bolas > div:nth-child(3) {
    animation-duration: 0.75s  ;
    animation-delay: 0.24s;
}
 
@keyframes animarBola {
  0% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
  }
  16% {
    -webkit-transform: scale(0.1);
    transform: scale(0.1);
    opacity: 0.7;
  }
  33% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1; 
  } 
}
/* end: Preloader */

</style>

<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>


<div id="preloader">
        <div class="inner">
           <!-- HTML DA ANIMAÇÃO MUITO LOUCA DO SEU PRELOADER! -->
           <div class="bolas">
              <div></div>
              <div></div>
              <div></div>                    
           </div>
        </div>
    </div>

<script>
	//<![CDATA[
$(window).on('load', function () {
    $('#preloader .inner').fadeOut();
    $('#preloader').delay(350).fadeOut('slow'); 
    $('body').delay(350).css({'overflow': 'visible'});
})
//]]>
</script>
<div class="blogapp-content">
						<div class="blogapp-detail-wrap">
							<header class="blog-header">
								<div class="d-flex align-items-center">
									<a class="blogapp-title link-dark" href="#">
										<h3>Retirada de Produtos</h3>
										<h6>Escolha unidade abaixo</h6>
									</a>
								</div>

												<div id="todo_collapse_1" class="collapse show">
													<div class="card-body">
														<ul id="todo_list" class="advance-list">
															
															
															<?php // LISTANDO OS EM ABERTO
														
$sqlos = "SELECT * FROM unidades order by unidade_nome asc  ";
$resultadoos = mysqli_query($conn, $sqlos);
$totalos = mysqli_num_rows($resultadoos);	
while($linhaos = mysqli_fetch_array($resultadoos)){
	
	
	?>
															<a href="retirada2/<?php echo $linhaos['id_unidade'] ?>"> 
															<li class="advance-list-item single-task-list ">
																<div class="d-flex align-items-center justify-content-between">
																	<div class="d-flex align-items-center">
																		
																		<div>	
																			<span class="todo-star marked"><span class="feather-icon"><i class="fa fa-home" aria-hidden="true" style="color: coral"></i>
</span></span>
																			
																			<span class="todo-text text-dark text-truncate"><?php echo $linhaos['unidade_nome'] ?></span>
																			
																			
																		</div>
																	</div>	
																	<div  class="d-flex flex-shrink-0 align-items-center ms-3">
																		
																
																		<div class="dropdown">
																			<button class="btn btn-icon btn-rounded btn-flush-light flush-soft-hover dropdown-toggle no-caret" aria-expanded="false" ><span class="icon"><span class="feather-icon"><i class="fa fa-eye" aria-hidden="true"></i>
</span></span></button>
																			
																		</div>
																	</div>
																</div>	
															</li>
																
															</a>
															<br>
															
															<?php } ?>
															
														</ul>
															
									</div>
								</div>
							</div>
						</div>
						<!-- /Edit Info -->
					</div>
				</div>
			</div>
			<!-- /Page Body -->
		</div>
		<!-- /Main Content -->
	</div>
    <!-- /Wrapper -->
