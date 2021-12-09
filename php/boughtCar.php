<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="../css/buycar.css">
</head>
<body>

<h3 class="title">Auto Comprata</h3>
<?php
$id = array_key_exists('id1', $_GET) ? $_GET['id1'] : 5;
$brand = array_key_exists('brand1', $_GET) ? $_GET['brand1'] : '';
$modello = array_key_exists('modello1', $_GET) ? $_GET['modello1'] : '';
$condizione = array_key_exists('condizione1', $_GET) ? $_GET['condizione1'] : '';
$kilometraggio = array_key_exists('kilometraggio1', $_GET) ? $_GET['kilometraggio1'] : '';
$cavalli = array_key_exists('cavalli1', $_GET) ? $_GET['cavalli1'] : '';
$prezzo = array_key_exists('prezzo1', $_GET) ? $_GET['prezzo1'] : '';
$conn = new mysqli('localhost', 'root', '', 'macchine_tpi');
if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed : " . $conn->connect_error);
} else {
    $sql = "DELETE FROM macchine WHERE id_macchina=".$id;
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
        echo '<div class="containerCard">';
        $nameCar = $brand . "-" . $modello;
        echo '<div class="column">';
        echo '<div class="card">';
        echo '<h1 class="cardH1">' . $nameCar . "</h1>";
        echo '<img src="car/' . $modello . '.jpg" alt="' . $nameCar . '" style="width:100%">';
        echo '<p class="price">' . $prezzo . " €</p>";
        echo '<p class="information">condizione:' . $condizione . "</p>";
        echo '<p class="information">cavalli:' . $cavalli . "</p>";
        echo '<p class="information">kilometraggio:' . $kilometraggio . "</p>";
        echo '<button class="cardButton" >Macchina Comprata!</button>';
        echo "</div>";
        echo "</div>";

    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

?>

<footer class="footer">
    <a href="../index.html" TARGET="_self" class="link-footer">home</a>
    <a href="../sellcar.html" TARGET="_self" class="link-footer">Vendi Auto</a>
    <a href="../buycar.html" TARGET="_self" class="link-footer">Compra Auto</a>
</footer>
</body>
</html>
