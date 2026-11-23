<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';
exigirLogin();
$id = (int)($_GET['id'] ?? 0);
try {
    $sql = "SELECT COUNT(*) FROM consultas WHERE animal_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->fetchColumn() > 0) {
        echo "<script>
            alert('Não é possível excluir este animal, pois ele possui consultas cadastradas.');
            window.location.href = 'index.php';
        </script>";
        exit;
    }


    $sql = "DELETE FROM animais WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header('Location: index.php');
    exit;
} catch (PDOException $e) {
    echo "Erro ao excluir animal";
}
