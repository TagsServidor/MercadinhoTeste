<?php 

$a = 3.99;
$b = 6.49;
$total2 = ($b - $a);
$total = ($total2 / $b) * 100;
$total2 = ($b - $a);

?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <div id="termoTexto2">
            Custo: <input type="text" id="soma1" value="<?php echo $a ?>" name="">
            <p></p>
            <input id="soma2" type="text" autocomplete="off" autocomplete="off" value="<?php echo $b ?>" class="qtds_burgers" name="valortroco" placeholder="Digite o Valor" maxlength="6"><p></p>
            <p></p>
            <p></p>
            <input readonly id="result2" type="text" value="<?php echo ($total2) ?>"  autocomplete="off" autocomplete="off"  class="qtds_burgers" name="valortroco" placeholder="0,00" maxlength="6" ><p></p>
            <p></p>
            <span class="titulos_pgmnts">Lucro %:</span> <input readonly id="result" type="text" value="<?php echo round($total, 2) ?>"  autocomplete="off" autocomplete="off"  class="qtds_burgers" name="valortroco" placeholder="0,00" maxlength="6" >%<p></p>
            <p></p>
            <p></p>
        </div>
        <p></p>

    <script>
jQuery(document).ready(function(){
  jQuery('input').on('keyup',function(){
    if(jQuery(this).attr('name') === 'result'){
    return false;
    }

    /* ####### troca virgula por ponto ############# */
    $('input[type="text"]').each(function(){
        var val = $(this).val().replace('.','.');
        $(this).val(val);
    });
    /* ############################################# */
    
    var soma1 = (jQuery('#soma1').val() == '' ? 0 : jQuery('#soma1').val());
    var soma2 = (jQuery('#soma2').val() == '' ? 0 : jQuery('#soma2').val());

    // use prseFloat 
    var result = (parseFloat(soma2) / parseFloat(soma1) * 100 - 100);
    var result2 = (parseFloat(soma2) - parseFloat(soma1) );

/* ########################## Solução com toLocaleString() ################# */  
//com R$
//result = result.toLocaleString('us');

//sem R$
result = result.toFixed(2); 
result2 = result2.toFixed(2); 
   /* ######################################################################### */ 
    
    jQuery('#result').val(result);
    jQuery('#result2').val(result2);
  });
});

    </script>

    <?php
    $valor_base = 3.99;
    $valor = 6.49;
    $resultado = ($valor / $valor_base) * 100 - 100;

    var_dump ($resultado); // int(12.5)


    $vTotal =  ($b / $a) * 100 - 100; // 73.333333...
echo $vTotal = round($vTotal, 2); // 73.33
    ?>