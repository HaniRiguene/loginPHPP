<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>plus2net.com : Pie chart using data from MySQL table</title>
</head>
<body >
<?Php
require "config-pdo.php";// Database connection
$query="SELECT language, nos FROM chart_data";
$step=$dbo->prepare($query);
if($step->execute()){
$php_data_array=$step->fetchAll();
//print_r($php_data_array);
//echo json_encode($php_data_array);
echo "<script>
var my_2d=".json_encode($php_data_array)."
</script>";
//Transfor PHP array to JavaScript two dimensional array
}else{
   print_r($step->errorInfo());
}
?>


<div id="chart_div"></div>
<br><br>
<a href=https://www.plus2net.com/php_tutorial/chart-database.php>Pie Chart from MySQL database</a>
</body>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
 google.charts.load('current', {'packages':['corechart']});
     // Draw the pie chart when Charts is loaded.
      google.charts.setOnLoadCallback(draw_my_chart);
      // Callback that draws the pie chart
      function draw_my_chart() {
        // Create the data table .
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'language');
        data.addColumn('number', 'Nos');
for(i=0;i<my_2d.length;i++)
data.addRow([my_2d[i][0],parseInt(my_2d[i][1])]);

// above row adds the JavaScript two dimensional array data into required chart format
    var options = {title:'plus2net.com :Nos of tutorials',
           width:500,
           height:500,
		   legend:'left',
           is3D:true};

        // Instantiate and draw the chart
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
</script>
</html>
