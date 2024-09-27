<?php
// Configurações do banco de dados
$servername = "localhost"; // normalmente é localhost
$username = "root"; // usuário padrão do XAMPP
$password = ""; // senha padrão do XAMPP (geralmente vazia)
$dbname = "agendamentos"; // nome do banco de dados que você criou

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obter dados do formulário
$dia = $_POST['dia'];
$periodo = $_POST['periodo'];
$horario = $_POST['horario'];

// Preparar e vincular
$stmt = $conn->prepare("INSERT INTO agendamentos (dia, periodo, horario) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $dia, $periodo, $horario);

// Executar e verificar
if ($stmt->execute()) {
    // Mensagem de sucesso
    $message = "Agendamento realizado com sucesso!";
} else {
    // Mensagem de erro
    $message = "Erro: " . $stmt->error;
}

// Fechar conexão
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do Agendamento</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Resultado do Agendamento</h2>
        <p><?php echo $message; ?></p>
        <a href="index.php">Voltar para o formulário</a> <!-- Altere para o nome do seu arquivo HTML -->
    </div>
</body>
</html>