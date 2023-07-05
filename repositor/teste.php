
Deveria ter <input id="txt1" type="number" value="9" onfocus="calcular()"/>
Repoz <input id="txt2" type="number" value="0"  required  onblur="calcular()"/>
A mais <input id="txt6" type="number" value="0"  required  onblur="calcular()"/>
Vencidos <input id="txt3" type="number" value="0" required  onblur="calcular()"/>
Extraviados <input id="txt4" type="number" value="0" required  onblur="calcular()"/>
Perdas <input id="txt5" type="number" value="0" required  onblur="calcular()"/>



Sobrou <input id="result" type="number" required/>
    <script type="text/javascript">
        function calcular(){
    var valor1 = parseInt(document.getElementById('txt1').value, 10);
    var valor2 = parseInt(document.getElementById('txt2').value, 10);
    var valor3 = parseInt(document.getElementById('txt3').value, 10);
    var valor4 = parseInt(document.getElementById('txt4').value, 10);
    var valor5 = parseInt(document.getElementById('txt5').value, 10);
    var valor6 = parseInt(document.getElementById('txt6').value, 10);

    
    document.getElementById('result').value = valor1 + valor2 + valor6 - valor3  - valor4  - valor5;
}
    </script>
