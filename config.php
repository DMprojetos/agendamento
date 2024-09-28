<?php
// Conectar ao banco de dados
$host = "srv1595.hstgr.io"; // Altere conforme necessário
$dbname = "agendamento";
$username = "u870367221_Barber"; // Altere conforme necessário
$password = "Deividlps120@"; // Altere conforme necessário

$conn = new mysqli($host, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coletar os dados do formulário
    $dia = $_POST['dia'];
    $periodo = $_POST['periodo'];
    $horario = $_POST['horario'];

    // Preparar e executar a inserção no banco de dados
    $stmt = $conn->prepare("INSERT INTO agendamentos (dia, periodo, horario) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $dia, $periodo, $horario);

    if ($stmt->execute()) {
        echo "Agendamento realizado com sucesso!";
    } else {
        echo "Erro ao agendar: " . $stmt->error;
    }

    // Fechar a conexão
    $stmt->close();
    $conn->close();
}
?>
