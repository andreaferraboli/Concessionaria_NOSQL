<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
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
        $stmt->close();
        $conn->close();
}

?>
<footer class="footer">
    <a href="../index.html" TARGET="_self" class="link-footer">home</a>
    <a href="../sellcar.html" TARGET="_self" class="link-footer">Vendi Auto</a>
    <a href="../buycar.html" TARGET="_self" class="link-footer">Compra Auto</a>
</footer>
</body>
</html>

