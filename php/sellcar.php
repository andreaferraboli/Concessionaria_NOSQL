<?php

include 'db_connection.php';
$conn = OpenCon();
echo "Connected Successfullydd";
CloseCon($conn);



// get the post records
//$marca = $_POST['marca'];
//$modello = $_POST['modello'];
//$condizione = $_POST['condizione'];
//$kilometraggio = $_POST['kilometraggio'];
//$cavalli = $_POST['cavalli'];
//$prezzo = $_POST['prezzo'];
$marca = "Audi";
$modello = "Q8";
$condizione = "usata";
$kilometraggio = 10000;
$cavalli = 320;
$prezzo = 100000;
// database insert SQL code
$sql = "INSERT INTO Macchine (marca,modello,condizione,kilometraggio,cavalli,prezzo) VALUES ($marca,$modello,$condizione,$kilometraggio,$cavalli,$prezzo)";

// insert in database
$rs = mysqli_query($con, $sql);

if($rs)
{
       echo "Contact Records Inserted";
}
else{
    echo "connessione non avvenuta";
}

?>