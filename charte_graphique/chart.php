<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
$graph_values = 0;
if(file_exists("pdo.php")){
   require_once("pdo.php");
    //$pdo = new PDO('mysql:host=localhost;dbname=securelogin', 'root', '');
    $sql = "SELECT * FROM graph_urbain_data";
    $stmt = $pdo->prepare($sql);
    $rows = $stmt->fetchAll();
      foreach ($rows as $row) {
        $graph_value = $row['ID'];
    }
    if($graph_value==0){
        echo"[GRAPH_PULGIN_URBAIN] FATAL ERROR (PDO_VAR) : Variables corrompues, merci de consulter le manuel ou de réinitialiser le plugin.<br>";
        exit;
    }}
    else    
    {
        echo"[GRAPH_PULGIN_URBAIN] FATAL ERROR (FILE_NO_EXIST) : Le Fichier PDO n'a pas éte trouvé sur le serveur .<br>";
        echo"[GRAPH_PULGIN_URBAIN] ERROR (PDO_ERR) : Impossible de se connecter à la base de données : vérifiez l'état du fichier <br>";
        exit;
    }
    ?>
    <html>
        <head>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"> </script>
            <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            // generate drawchart() function
            function drawchart(){
                //  generate data table
                var data = google.visualization.arrayToDataTable([
                    ['x', 'y'],
                 <?php
                $sql = "SELECT * FROM graph_urbain_data";
                foreach ($pdo->query($sql) as $row) {
                    echo "['".$row['y']."', ".$row['x']."],";
                }
                ?>
                ]);
                var options ={
                    title:'Moyen de ventes',
                    hAxis: {
                        title: 'Moyen de ventes',
                        titleTextStyle: {
                            color: '#333'
                        }
                    },
                    vAxis: {
                        minValue: 0
                    }
                };
                var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
                chart.draw(data, options); }
            </script>
        </head>
        <body>
            <div id="chart_div" style="width: 900px; height: 500px;"></div>
        </body>
    </html>
}
