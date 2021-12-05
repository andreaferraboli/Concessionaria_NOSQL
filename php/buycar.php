<?php
// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');

$con = mysqli_connect('localhost', 'root', '', 'macchine_tpi');

// get the post records
$marca = $_POST['marca'];
$modello = $_POST['modello'];
$condizione = $_POST['condizione'];
$kilometraggio = $_POST['kilometraggio'];
$cavalli = $_POST['cavalli'];
$prezzo = $_POST['prezzo'];

// database insert SQL code
$sql = "INSERT INTO Macchine (marca,modello,condizione,kilometraggio,cavalli,prezzo) VALUES ($marca,$modello,$condizione,$kilometraggio,$cavalli,$prezzo)";

// insert in database
$rs = mysqli_query($con, $sql);

if ($rs) {
    echo "Contact Records Inserted";
}

?>