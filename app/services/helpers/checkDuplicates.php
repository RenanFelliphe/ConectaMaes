<?php
require_once "../app/services/helpers/conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $attribute = $_POST['attribute'] ?? null;
    $value = $_POST['value'] ?? null;

    $allowedAttributes = ['email', 'telefone', 'nomeDeUsuario'];
    if ($attribute && $value && in_array($attribute, $allowedAttributes)) {
        $query = "SELECT COUNT(*) AS count FROM Usuario WHERE $attribute = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $value);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        echo json_encode(['exists' => $result['count'] > 0]);
    } else {
        echo json_encode(['error' => 'Parâmetros inválidos.']);
    }
    exit;
}
?>
