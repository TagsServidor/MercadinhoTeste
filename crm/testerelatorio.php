<?php
include "bd/conexao.php";
?>


<?php 
$sql = "SELECT *FROM unidades ";
$resultado = mysqli_query($conn, $sql);
$total = mysqli_num_rows($resultado);
$dados = "";
$id = "";
while ($linha = mysqli_fetch_array($resultado)) {
$unidades = $linha[unidade_nome] . ',' ;
$registro = $linha[id_unidade] . ',' ;	
  $dados .= $unidades." ";
  $id .= $registro." ";

	
}


$seq = "$dados";
$explode_seq = explode(',', $seq);
$n = array();
foreach ($explode_seq as $num){
     $n[] = "'" . $num . "'";
}
$result = implode(" , ", $n);
?>

<?php

 
?>

    <style>
      
        #chart {
      max-width: auto;
      margin: 35px auto;
    }
      
    </style>

    

    
    <script src="apexcharts.js"></script>
    

   <script>
      // Replace Math.random() with a pseudo-random number generator to get reproducible results in e2e tests
      // Based on https://gist.github.com/blixt/f17b47c62508be59987b
      var _seed = 42;
      Math.random = function() {
        _seed = _seed * 16807 % 2147483647;
        return (_seed - 1) / 2147483646;
      };
    </script>

    
  </head>

  <body>
     <div id="chart"></div>

    <script>
      
        var options = {
          series: [{
          data: [<?php echo $id ?>]
			  
        }],
          chart: {
          type: 'bar',
			  
			  
        },
        plotOptions: {
          bar: {
            borderRadius: 4,
            horizontal: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        xaxis: {
        categories: [<?php echo $result ?>],
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
      
      
    </script>

    
  </body>
</html>
