<?php

require_once("config.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $cpf = $_POST['cpf'];
    $creci = $_POST['creci'];
    $nome = $_POST['nome'];

    $sql = "UPDATE corretores SET cpf='$cpf', creci='$creci', nome='$nome' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: formulario_corretor.php");
    } else {
        echo "Erro ao atualizar o corretor: " . $conn->error;
    }
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $sql = "SELECT * FROM corretores WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $cpf = $row['cpf'];
        $creci = $row['creci'];
        $nome = $row['nome'];
    } else {
        echo "Corretor não encontrado.";
        exit;
    }

    $conn->close();
} else {
    echo "ID do corretor não fornecido.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Corretor</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h2>Editar Corretor</h2>
    <form id="corretorForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <div class="form-group">
        <label for="cpf">CPF:</label>
        <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo $cpf; ?>" maxlength="11" required>
        <div class="invalid-feedback">CPF deve ter 11 caracteres.</div>
      </div>
      <div class="form-group">
        <label for="creci">Creci:</label>
        <input type="text" class="form-control" id="creci" name="creci" value="<?php echo $creci; ?>" minlength="2" required>
        <div class="invalid-feedback">Creci deve ter pelo menos 2 caracteres.</div>
      </div>
      <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome; ?>" minlength="2" required>
        <div class="invalid-feedback">Nome deve ter pelo menos 2 caracteres.</div>
      </div>
      <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
  </div>


  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>

    (function() {
      'use strict';
      var forms = document.querySelectorAll('.needs-validation');
      Array.prototype.slice.call(forms)
        .forEach(function(form) {
          form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
    })();
  </script>
</body>
</html>
