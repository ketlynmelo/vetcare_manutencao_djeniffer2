<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';
exigirLogin();
$id = (int)($_GET['id'] ?? 0);
try {
    $s = $pdo->prepare("DELETE FROM tutores WHERE id=?");
    $s->execute([$id]);
}  catch (PDOException $e) {
    echo "<script>
        alert('Não foi possível excluir. Este tutor possui animais cadastrados.');
        window.location.href = 'index.php';
    </script>";
    exit;
}
header('Location: index.php');
exit;
 