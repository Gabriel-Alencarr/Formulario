<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "teste";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    $cpf = $_POST['cpf'];
    $creci = $_POST['creci'];
    $nome = $_POST['nome'];

    $sql = "INSERT INTO corretores (cpf, creci, nome) VALUES ('$cpf', '$creci', '$nome')";

    if ($conn->query($sql) === TRUE) {
 
        header("Location: formulario_corretor.php");
    } else {
        echo "Erro ao cadastrar o corretor: " . $conn->error;
    }

    $conn->close();
}
?>
