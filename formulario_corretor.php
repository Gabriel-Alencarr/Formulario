<?php

require_once("config.php");


if (isset($_GET['acao']) && $_GET['acao'] == 'excluir' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM corretores WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: formulario_corretor.php");
    } else {
        echo "Erro ao excluir o corretor: " . $conn->error;
    }
}

$sql = "SELECT * FROM corretores";
$result = $conn->query($sql);

$conn->close();
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Corretores</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  
  <div class="container mt-5">
    <h2>Cadastro de Corretores</h2>
    <form id="corretorForm" method="post" action="salvar_corretor.php">
      <div class="form-group">
       
        <input type="text" class="form-control" id="cpf" name="cpf" minlength="11" maxlength="11" required placeholder="Digite seu CPF">
        <div class="invalid-feedback">CPF deve ter 11 caracteres.</div>
      </div>
      <div class="form-group">
      
        <input type="text" class="form-control" id="creci" name="creci" minlength="2" required placeholder="Digite seu Creci">
        <div class="invalid-feedback">Creci deve ter pelo menos 2 caracteres.</div>
      </div>
      <div class="form-group">
     
        <input type="text" class="form-control" id="nome" name="nome" minlength="2" required placeholder="Digite seu Nome">
        <div class="invalid-feedback">Nome deve ter pelo menos 2 caracteres.</div>
      </div>
      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <h2 class="mt-5">Corretores Cadastrados</h2>
    <table class="table">
      <thead>
        <tr>
          <th>CPF</th>
          <th>Creci</th>
          <th>Nome</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody id="corretoresTable">
      <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["cpf"]."</td>";
                echo "<td>".$row["creci"]."</td>";
                echo "<td>".$row["nome"]."</td>";
                echo '<td>
                        <a href="editar_corretor.php?id='.$row["id"].'" class="btn btn-info btn-sm mr-1">Editar</a>
                        <a href="formulario_corretor.php?acao=excluir&id='.$row["id"].'" class="btn btn-danger btn-sm" onclick="return confirm(\'Tem certeza que deseja excluir este registro?\')">Excluir</a>
                      </td>';
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nenhum corretor cadastrado</td></tr>";
        }
        ?>
      </tbody>
    </table>
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
