<?php
$brand = $_POST['brand'];
$modello = $_POST['modello'];
$condizione = $_POST['condizione'];
$kilometraggio = $_POST['kilometraggio'];
$cavalli = $_POST['cavalli'];
$prezzo = $_POST['prezzo'];
$conn = new mysqli('127.0.0.1', 'root', '', 'macchine_tpi');
if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed : " . $conn->connect_error);
} else {
    $stmt = $conn->prepare("insert into macchine ( brand, modello, condizione, kilometraggio, cavalli, prezzo) values(?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiii", $brand, $modello, $condizione, $kilometraggio, $cavalli, $prezzo);
    $execval = $stmt->execute();
    echo $execval;
    echo "Macchina Venduta,complimenti!";
    header('Location: ../sellcar.html');
    $stmt->close();
    $conn->close();
}
?>