<div id="chart_div" style="width: 900px; height: 500px;">

 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Recomenda��es', 'Suas Recomenda��es', 'M�dia das Recomenda��es dos Usu�rios'],
          ['Total de Recomenda��es',  <?php echo $tamRecomendacao ?>,<?php echo $tamMediaRecomendacaoTotal ?>]
          
        ]);

        var options = {
          title: 'Total de Recomenda��es',
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>

    
</div>

<div id="chart_div2" style="width: 900px; height: 500px;">
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Vendas', 'Anunciados', 'Vendidos'],
          ['Total de Vendas',  <?php echo $tamProdutosAnunciados ?>,  <?php echo $tamProdutosVendidos ?>]
          
        ]);

        var options = {
          title: 'Total de Vendas',
        };

        var chart2 = new google.visualization.ColumnChart(document.getElementById('chart_div2'));
        chart2.draw(data, options);
      }
    </script>
    </div>

<div id="chart_div3" style="width: 900px; height: 500px;">
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Recomenda��es', 'Suas Recomenda��es'],
          ['Recomenda��es Positivas',  <?php echo $tamRecomendacao ?>],
          ['Recomenda��es Negativas',  <?php echo $tamNaoRecomendacao ?>]
          
        ]);

        var options = {
          title: 'Suas Recomenda��es' ,
        };

        var chart3 = new google.visualization.PieChart(document.getElementById('chart_div3'));
        chart3.draw(data, options);
      }
    </script>
    </div>
