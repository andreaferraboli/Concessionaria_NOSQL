<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <link rel="stylesheet" href="../css/buycar.css">
</head>
<body>

<h3 class="title">Auto Modificata!</h3>
<?php
$brand = $_POST['brand'];
$id = $_POST['id'];
$modello = $_POST['modello'];
$condizione = $_POST['condizione'];
$kilometraggio = $_POST['kilometraggio'];
$cavalli = $_POST['cavalli'];
$prezzo = $_POST['prezzo'];
//creo la connessione al database
$conn = new mysqli('localhost', 'root', '', 'macchine_tpi');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//la query deve avere una stringa circondata dalle due virgolette
$brand1 = '"' . $brand . '"';
$modello1 = '"' . $modello . '"';
$condizione1 = '"' . $condizione . '"';
//creo la query
$sql = 'UPDATE macchine SET brand=' . $brand1 . ', modello=' . $modello1 . ', condizione=' . $condizione1 . ', kilometraggio=' . $kilometraggio . ', cavalli=' . $cavalli . ', prezzo=' . $prezzo . ' WHERE id_macchina=' . $id;
if ($conn->query($sql) === TRUE) {
    //creo la card
    $nameCar = $brand . "-" . $modello;
    echo '<div class="containerCard">';
    echo '<div class="columnBought">';
    echo '<div class="card">';
    echo '<h1 class="information"> ' . $brand . " " . $modello . "</h1>";
    echo '<img src="car/' . $modello . '.jpg" alt="' . $nameCar . '" style="width:100%">';
    echo '<p class="price" >' . $prezzo . " €</p>";
    echo '<p class="information">condizione:' . $condizione . "</p>";
    echo '<p class="information" >cavalli:' . $cavalli . "</p>";
    echo '<p class="information">kilometraggio:' . $kilometraggio . "</p>";
    echo '<button class="cardButton" >Macchina Aggiornata!</button>';
    echo "</div>";
    echo "</div>";
    echo "</div>";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();


?>
<div>
    <footer class="footer">
        <a href="../index.html" TARGET="_self" class="link-footer">home</a>
        <a href="../sellcar.html" TARGET="_self" class="link-footer">Vendi Auto</a>
        <a href="../buycar.html" TARGET="_self" class="link-footer">Compra Auto</a>
        <a href="../updatecar.html" TARGET="_self" class="link-footer">Aggiorna Auto</a>
    </footer>
</div>

</body>
</html>

