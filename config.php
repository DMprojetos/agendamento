<?php
// config.php

// Configurações do banco de dados
$servername = "srv1595.hstgr.io"; // Endereço do servidor MySQL
$username = "u870367221_Barber";  // Nome de usuário do banco de dados
$password = "Deividlps120@";     // Senha do banco de dados
$dbname = "u870367221_Barber";       // Nome do banco de dados

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se os dados foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $dia = $_POST['dia'];
    $periodo = $_POST['periodo'];
    $horario = $_POST['horario'];

    // Prepara a consulta SQL para inserir os dados
    $stmt = $conn->prepare("INSERT INTO agendamentos (dia, periodo, horario) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $dia, $periodo, $horario); // "sss" indica que todas as variáveis são strings

    // Executa a consulta
    if ($stmt->execute()) {
        echo "<div class='message'>Agendamento realizado com sucesso!</div>";
    } else {
        echo "<div class='message'>Erro: " . $stmt->error . "</div>";
    }

    // Fecha a declaração
    $stmt->close();
}

// Fecha a conexão
$conn->close();
?>
