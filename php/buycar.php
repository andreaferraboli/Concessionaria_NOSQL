<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.88.1">

        <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/album/">



        <!-- Bootstrap core CSS -->
        <link href="/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <!-- Favicons -->

        <meta name="theme-color" content="#7952b3">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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
$conn = new mysqli('127.0.0.1', 'root', '', 'macchine_tpi');
if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed : " . $conn->connect_error);
} else {
    $sql = "SELECT * FROM macchine where " . createQuery($brand, $modello, $condizione, $kilometraggio, $cavalli, $prezzo_min, $prezzo_max);
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
// output data of each row
        $numberElements=0;
        echo '<div class="container">';
        while ($row = $result->fetch_assoc()) {
            $nameCar = $row["brand"] . "-" . $row["modello"];
            if ($numberElements % 3==0)
                echo '<div class="row ">';
            echo '<div class="carCard">';
            echo "<h1>" . $nameCar . "</h1>";
            echo '<img src="car/' . $row["modello"] . '.jpg" alt="' . $nameCar . '" style="width:100%">';
            echo '<p class="price">' . $row["prezzo"] . " €</p>";
            echo '<p class="information">condizione:' . $row["condizione"] . "</p>";
            echo '<p class="information">cavalli:' . $row["cavalli"] . "</p>";
            echo '<p class="information">kilometraggio:' . $row["kilometraggio"] . "</p>";
            echo '<button class="btn-primary btn" onclick="">Compra Macchina</button>';
            echo "</div>";
            if ($numberElements % 3==2)
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
