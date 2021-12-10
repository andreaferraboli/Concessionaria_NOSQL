<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="../css/buycar.css">
</head>
<body>

<h3 class="title">Compra la tua auto!</h3>
<?php
$default = [
    'id_macchina' => '',
    // Qui aggiungerai tutti gli altri valori di default
];

$_POST = array_replace( $default, $_POST );
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
            echo '<form name="buyform" method="post" action="boughtCar.php">';
            echo '<select id="id_macchina" name="id_macchina" >';
            echo '<option value="'.$row["id_macchina"].'" selected>'.$row["id_macchina"]."</option>";
            echo'</select>';
            echo '<h1 class="cardH1" >' . $row["brand"] . "</h1>";
            echo '<h1 class="cardH1">' . $row["modello"] . "</h1>";
            echo '<img src="car/' . $row["modello"] . '.jpg" alt="' . $nameCar . '" style="width:100%">';
            echo '<p class="price" >' . $row["prezzo"] . " €</p>";
            echo '<p class="information" >condizione:' . $row["condizione"] . "</p>";
            echo '<p class="information" >cavalli:' . $row["cavalli"] . "</p>";
            echo '<p class="information" >kilometraggio:' . $row["kilometraggio"] . "</p>";
            echo '<input type="submit" value="Compra Macchina" class="cardButton" name="submit2" >'.'</input>';
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
<!--<script type="text/javascript">-->
<!--    function setId(id){-->
<!--        document.cookie = "id="+id++ "; path=/; domain=..";-->
<!--    }-->
<!--</script>-->
<footer class="footer">
    <a href="../index.html" TARGET="_self" class="link-footer">home</a>
    <a href="../sellcar.html" TARGET="_self" class="link-footer">Vendi Auto</a>
    <a href="../buycar.html" TARGET="_self" class="link-footer">Compra Auto</a>
    <a href="../updatecar.html" TARGET="_self" class="link-footer">Aggiorna Auto</a>
</footer>
</body>
</html>
