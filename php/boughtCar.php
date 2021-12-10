<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="../css/buycar.css">
</head>
<body>

<h3 class="title">Auto Comprata</h3>
<?php
if (isset($_POST['submit2'])) {
    $id = $_POST['id_macchina'];
    $conn = new mysqli('localhost', 'root', '', 'macchine_tpi');
    $sql = "SELECT * FROM macchine where macchine.id_macchina=" . $id;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $brand = $row["brand"];
            $modello = $row["modello"];
            $condizione = $row["condizione"];
            $kilometraggio = $row["kilometraggio"];
            $cavalli = $row["cavalli"];
            $prezzo = $row["prezzo"];
        }
    } else {
        echo "id non trovato";
    }
    if ($conn->connect_error) {
        echo "$conn->connect_error";
        die("Connection Failed : " . $conn->connect_error);
    } else {
        $sql = "DELETE FROM macchine WHERE id_macchina=" . $id;
        if (mysqli_query($conn, $sql)) {
            echo '<div class="containerCard">';
            $nameCar = $brand . "-" . $modello;
            echo '<div class="columnBought">';
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
            echo "</div>";

        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
} else {
    echo "you don't have submited form 2";
}
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
