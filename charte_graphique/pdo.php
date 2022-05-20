<!-- generate PDO connection to the database -->
<?php
try{
    $pdo = new PDO('mysql:host=localhost;dbname=graph_urbain_data', 'root', '');
}catch(Exception $e)
{
die("[GRAPH_PULGIN_URBAIN] ERROR (PDO_ERR)");
exit;
}
?>