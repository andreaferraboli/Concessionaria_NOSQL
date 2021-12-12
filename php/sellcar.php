<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <link rel="stylesheet" href="../css/sellcar.css">
</head>
<body>

<h3 class="title">Auto venduta!</h3>
<?php
$brand = $_POST['brand'];
$modello = $_POST['modello'];
$condizione = $_POST['condizione'];
$kilometraggio = $_POST['kilometraggio'];
$cavalli = $_POST['cavalli'];
$prezzo = $_POST['prezzo'];
$conn = new mysqli('localhost', 'root', '', 'macchine_tpi');
if ($conn->connect_error) {
    die("Connection Failed : " . $conn->connect_error);
} else {
    //creo la query per eseguire un insert al database
    $stmt = $conn->prepare("insert into macchine ( brand, modello, condizione, kilometraggio, cavalli, prezzo) values(?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiii", $brand, $modello, $condizione, $kilometraggio, $cavalli, $prezzo);
    $execval = $stmt->execute();
    $stmt->close();
    $conn->close();
    //creo la card della macchina venduta
    $nameCar = $brand . "-" . $modello;
    echo '<div class="column container">';
    echo '<div class="card">';
    echo '<h1 class="cardH1" ' . $brand . " " . $modello . "</h1>";
    echo '<h1 class="cardH1" ></h1>';
    echo '<img src="car/' . $modello . '.jpg" alt="' . $nameCar . '" style="width:100%">';
    echo '<p class="price" >' . $prezzo . " €</p>";
    echo '<p class="information">condizione:' . $condizione . "</p>";
    echo '<p class="information" >cavalli:' . $cavalli . "</p>";
    echo '<p class="information">kilometraggio:' . $kilometraggio . "</p>";
    echo '<button class="cardButton" >Macchina Venduta!</button>';
    echo "</div>";
    echo "</div>";
}

?>
<footer class="footer">
    <a href="../index.html" TARGET="_self" class="link-footer">home</a>
    <a href="../sellcar.html" TARGET="_self" class="link-footer">Vendi Auto</a>
    <a href="../buycar.html" TARGET="_self" class="link-footer">Compra Auto</a>
    <a href="../updatecar.html" TARGET="_self" class="link-footer">Aggiorna Auto</a>
</footer>
</body>
</html>

