<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="../css/buycar.css">
</head>
<body>

<h3 class="title">Compra la tua auto!</h3>
<?php
$brand = $_POST['brand'];
$modello = $_POST['modello'];
$condizione = $_POST['condizione'];
$kilometraggio = $_POST['kilometraggio'];
$cavalli = $_POST['cavalli'];
$prezzo_min = $_POST['price-min'];
$prezzo_max = $_POST['price-max'];
$conn = new mysqli('localhost', 'root', '', 'macchine_tpi');
if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed : " . $conn->connect_error);
} else {
    $sql = "SELECT * FROM macchine where " . createQuery($brand, $modello, $condizione, $kilometraggio, $cavalli, $prezzo_min, $prezzo_max);
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
// output data of each row
        $numberElements = 0;
        echo '<div class="containerCard">';

        while ($row = $result->fetch_assoc()) {
            $nameCar = $row["brand"] . "-" . $row["modello"];
            if ($numberElements % 3 == 0)
                echo '<div class="row">';
            echo '<div class="column">';
            echo '<div class="card">';
            echo '<form method="get" action="boughtCar.php" >';
            echo '<h1 class="cardH1" name="id1" id="id1">' . $row["id_macchina"] . "</h1>";
            echo '<h1 class="cardH1" name="brand1" id="brand1">' . $row["brand"] . "</h1>";
            echo '<h1 class="cardH1" name="modello1" id="modello1">' . $row["modello"] . "</h1>";
            echo '<img src="car/' . $row["modello"] . '.jpg" alt="' . $nameCar . '" style="width:100%">';
            echo '<p class="price" name="prezzo1" id="prezzo1">' . $row["prezzo"] . " €</p>";
            echo '<p class="information" name="condizione1" id="condizione1">condizione:' . $row["condizione"] . "</p>";
            echo '<p class="information" name="cavalli1" id="cavalli1">cavalli:' . $row["cavalli"] . "</p>";
            echo '<p class="information" name="kilometraggio1" id="kilometraggio1">kilometraggio:' . $row["kilometraggio"] . "</p>";
            echo '<input type="submit" value="Compra Macchina" class="cardButton" ></input>';
//            echo '<button class="cardButton" />Compra Macchina</button>';
            echo "</form>";
            echo "</div>";
            echo "</div>";
            if ($numberElements % 3 == 2)
                echo "</div>";
            $numberElements++;
        }
        echo "</div>";
    } else {
        echo "0 results";
    }
}
function buyCar($id)
{
    $sql = "DELETE FROM macchine WHERE macchine.id_macchina=" . $id;
    //$result = $conn->query($sql);
}

function createQuery($brand, $modello, $condizione, $kilometraggio, $cavalli, $prezzo_min, $prezzo_max): string
{
    $query = "";
    $first = false;
    if ($brand != "qualsiasi") {
        $query .= "macchine.brand=" . '"' . $brand . '"';
        $first = true;
    }

    if ($modello != "qualsiasi") {
        if ($first)
            $query .= " and ";
        $query .= "macchine.modello=" . '"' . $modello . '"';
        $first = true;
    }
    if ($condizione != "qualsiasi") {
        if ($first)
            $query .= " and ";
        $query .= "macchine.condizione=" . '"' . $condizione . '"';
        $first = true;
    }
    if ($kilometraggio != "qualsiasi") {
        if ($first)
            $query .= " and ";
        $query .= "macchine.kilometraggio=" . $kilometraggio;
        $first = true;
    }
    if ($cavalli != "qualsiasi") {
        if ($first)
            $query .= " and ";
        $query .= "macchine.cavalli=" . $cavalli;
        $first = true;
    }
    if ($prezzo_min != "qualsiasi" and $prezzo_max != "qualsiasi") {
        if ($first)
            $query .= " and ";
        $query .= "macchine.prezzo BETWEEN " . $prezzo_min . " AND " . $prezzo_max;
    }
    return $query;

}

?>

<footer class="footer">
    <a href="../index.html" TARGET="_self" class="link-footer">home</a>
    <a href="../sellcar.html" TARGET="_self" class="link-footer">Vendi Auto</a>
    <a href="../buycar.html" TARGET="_self" class="link-footer">Compra Auto</a>
</footer>
</body>
</html>
