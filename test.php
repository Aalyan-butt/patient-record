<!DOCTYPE html>
<html>
<head><title>DB Test</title>
<style>body{font-family:monospace;padding:20px} table{border-collapse:collapse;width:100%} td,th{border:1px solid #ccc;padding:6px 10px;font-size:12px} th{background:#1e3a5f;color:#fff}</style>
</head>
<body>
<?php
require_once 'db.php';
try {
    $pdo = getDB();
    echo "<h3 style='color:green'>✓ Database connected</h3>";

    $count = (int)$pdo->query("SELECT COUNT(*) FROM patient_records")->fetchColumn();
    echo "<p>Total records in table: <strong>$count</strong></p>";

    $rows = $pdo->query("SELECT id,unique_id,date,name,visit_number FROM patient_records LIMIT 10")->fetchAll(PDO::FETCH_ASSOC);

    if (empty($rows)) {
        echo "<p style='color:orange'>Table is empty — no records found.</p>";
    } else {
        echo "<table><tr>";
        foreach (array_keys($rows[0]) as $col) echo "<th>$col</th>";
        echo "</tr>";
        foreach ($rows as $row) {
            echo "<tr>";
            foreach ($row as $val) echo "<td>" . htmlspecialchars((string)$val) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    echo "<hr><h4>Raw API response preview:</h4>";
    echo "<pre style='background:#f5f5f5;padding:10px;overflow:auto'>";
    $_GET['action'] = 'get_records'; $_GET['limit'] = '5'; $_GET['page'] = '1'; $_GET['search'] = '';
    ob_start(); require 'api.php'; $out = ob_get_clean();
    $decoded = json_decode($out, true);
    echo htmlspecialchars(json_encode($decoded, JSON_PRETTY_PRINT));
    echo "</pre>";

} catch (Exception $e) {
    echo "<h3 style='color:red'>✗ Error: " . htmlspecialchars($e->getMessage()) . "</h3>";
}
?>
</body>
</html>
