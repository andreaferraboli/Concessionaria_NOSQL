<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <link rel="stylesheet" href="css/buycar.css">
</head>
<body>

<h3 class="title">Compra la tua auto!</h3>
<?php
echo "<h2>sono dentro</h2>";
$brand = $_POST['brand'];
$modello = $_POST['modello'];
$condizione = $_POST['condizione'];
$kilometraggio = $_POST['kilometraggio'];
$cavalli = $_POST['cavalli'];
$prezzo_min = $_POST['price-min'];
$prezzo_max = $_POST['price-max'];
$conn = new mysqli('127.0.0.1', 'root', '', 'macchine_tpi');
if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed : " . $conn->connect_error);
} else {
    echo "<h2>sono passato</h2>";
    $sql = "SELECT * FROM macchine where " . createQuery($brand
            , $modello, $condizione, $kilometraggio, $cavalli, $prezzo_min, $prezzo_max);
    echo "<h2>$sql</h2>";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>ho dei risultati</h2>";
// output data of each row
        while ($row = $result->fetch_assoc()) {
            echo '<div class="card">';
            echo '<h2 class="lte-header" data-mh="title" style="height: 31.1875px">' . $row["brand"] . "-" . $row["modello"] . "</h2>";
            echo '<p class="lte-excerpt" data-mh="excerpt" style="height: 81.5625px"><strong>Condizione:</strong>:' . $row["condizione"] . "</p>";
            echo '<p class="lte-excerpt" data-mh="excerpt" style="height: 81.5625px"><strong>Cavalli:</strong>:' . $row["cavalli"] . "</p>";
            echo '<div class="lte-rental-footer">';
            echo '<div class="lte-price lte-price-full lte-price-bottom">' . $row["prezzo"] . "€</div>";
            echo '<div class="lte-mileage"><span>Chilometraggio:</span>' . $row["kilometraggio"] . " km</div>";
            echo '</div>';
            echo ' <a href="buyCar('. $row["id_macchina"] . '"") "'. 'class="btn btn-primary">Go somewhere</a>';
            echo '<a href="buyCar(" $conn","' . $row["id_macchina"] . '"") "' . 'class="lte-btn btn-lg">';
            echo '</div>';
        }
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
    <a href="index.html" TARGET="_self" class="link-footer">home</a>
</footer>
</body>
</html>
