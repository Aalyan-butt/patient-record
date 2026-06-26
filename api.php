<?php
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');
require_once 'db.php';

$action = $_REQUEST['action'] ?? '';

switch ($action) {
    case 'get_records':    getRecords();    break;
    case 'get_record':     getRecord();     break;
    case 'add_record':     addRecord();     break;
    case 'update_record':  updateRecord();  break;
    case 'delete_record':  deleteRecord();  break;
    case 'next_unique_id':      nextUniqueId();      break;
    case 'get_patient_by_uid': getPatientByUID();   break;
    default: echo json_encode(['error' => 'Unknown action']);
}

// ─── READ ─────────────────────────────────────────────────────────────────────

function getRecords() {
    $pdo    = getDB();
    $search = trim($_GET['search'] ?? '');
    $limit  = (int)($_GET['limit']  ?? 25);
    $page   = max(1, (int)($_GET['page'] ?? 1));
    $offset = ($page - 1) * max($limit, 0);

    $where  = '';
    $params = [];

    if ($search !== '') {
        $like   = "%$search%";
        $where  = "WHERE unique_id LIKE ? OR name LIKE ? OR parentage LIKE ?
                      OR phone LIKE ? OR address LIKE ? OR allergy LIKE ?
                      OR symptoms LIKE ? OR findings LIKE ? OR treatment LIKE ?
                      OR gender LIKE ? OR CAST(age AS CHAR) LIKE ?
                      OR CAST(weight AS CHAR) LIKE ?
                      OR CAST(visit_number AS CHAR) LIKE ?
                      OR DATE_FORMAT(date,'%d/%m/%Y') LIKE ?
                      OR DATE_FORMAT(date,'%Y-%m-%d') LIKE ?";
        $params = array_fill(0, 15, $like);
    }

    // Total count
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM patient_records $where");
    $stmt->execute($params);
    $total = (int)$stmt->fetchColumn();

    // Rows
    $lim  = $limit > 0 ? "LIMIT $limit OFFSET $offset" : '';
    $stmt = $pdo->prepare("SELECT * FROM patient_records $where
                           ORDER BY date DESC, time DESC, id DESC $lim");
    $stmt->execute($params);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'records'     => $rows,
        'total'       => $total,
        'page'        => $page,
        'limit'       => $limit,
        'total_pages' => $limit > 0 ? (int)ceil($total / max($limit, 1)) : 1,
    ]);
}

function getRecord() {
    $pdo  = getDB();
    $id   = (int)($_GET['id'] ?? 0);
    $stmt = $pdo->prepare("SELECT * FROM patient_records WHERE id = ?");
    $stmt->execute([$id]);
    $row  = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($row ?: ['error' => 'Not found']);
}

// ─── CREATE ───────────────────────────────────────────────────────────────────

function addRecord() {
    $pdo  = getDB();
    $data = json_decode(file_get_contents('php://input'), true) ?: $_POST;

    $uid  = trim($data['unique_id'] ?? '');
    $name = trim($data['name']      ?? '');
    if ($uid  === '') { echo json_encode(['error' => 'Unique ID is required']); return; }
    if ($name === '') { echo json_encode(['error' => 'Name is required']);      return; }

    // Auto visit number
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM patient_records WHERE unique_id = ?");
    $stmt->execute([$uid]);
    $visitNumber = (int)$stmt->fetchColumn() + 1;

    $date      = $data['date']      ?? date('Y-m-d');
    $time      = $data['time']      ?: date('H:i:s');
    $parentage = $data['parentage'] ?? '';
    $age       = (isset($data['age'])    && $data['age']    !== '') ? (int)$data['age']    : null;
    $gender    = ($data['gender']   ?? '') ?: null;
    $weight    = (isset($data['weight']) && $data['weight'] !== '') ? (float)$data['weight'] : null;
    $phone     = $data['phone']     ?? '';
    $address   = $data['address']   ?? '';
    $allergy   = $data['allergy']   ?? '';
    $symptoms  = $data['symptoms']  ?? '';
    $findings  = $data['findings']  ?? '';
    $treatment = $data['treatment'] ?? '';

    $stmt = $pdo->prepare("
        INSERT INTO patient_records
            (unique_id,date,time,visit_number,name,parentage,age,gender,
             weight,phone,address,allergy,symptoms,findings,treatment)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
    ");
    $stmt->execute([
        $uid,$date,$time,$visitNumber,$name,$parentage,
        $age,$gender,$weight,$phone,$address,$allergy,
        $symptoms,$findings,$treatment
    ]);

    echo json_encode(['success' => true, 'id' => (int)$pdo->lastInsertId(), 'visit_number' => $visitNumber]);
}

// ─── UPDATE ───────────────────────────────────────────────────────────────────

function updateRecord() {
    $pdo  = getDB();
    $data = json_decode(file_get_contents('php://input'), true) ?: $_POST;

    $id        = (int)($data['id']           ?? 0);
    $uid       = trim($data['unique_id']     ?? '');
    $name      = trim($data['name']          ?? '');
    $date      = $data['date']               ?? date('Y-m-d');
    $time      = $data['time']               ?: date('H:i:s');
    $visitNum  = (int)($data['visit_number'] ?? 1);
    $parentage = $data['parentage']          ?? '';
    $age       = (isset($data['age'])    && $data['age']    !== '') ? (int)$data['age']    : null;
    $gender    = ($data['gender']   ?? '') ?: null;
    $weight    = (isset($data['weight']) && $data['weight'] !== '') ? (float)$data['weight'] : null;
    $phone     = $data['phone']              ?? '';
    $address   = $data['address']            ?? '';
    $allergy   = $data['allergy']            ?? '';
    $symptoms  = $data['symptoms']           ?? '';
    $findings  = $data['findings']           ?? '';
    $treatment = $data['treatment']          ?? '';

    if ($id === 0 || $uid === '' || $name === '') {
        echo json_encode(['error' => 'ID, Unique ID and Name are required']); return;
    }

    $stmt = $pdo->prepare("
        UPDATE patient_records SET
            unique_id=?,date=?,time=?,visit_number=?,name=?,parentage=?,
            age=?,gender=?,weight=?,phone=?,address=?,allergy=?,
            symptoms=?,findings=?,treatment=?
        WHERE id=?
    ");
    $stmt->execute([
        $uid,$date,$time,$visitNum,$name,$parentage,
        $age,$gender,$weight,$phone,$address,$allergy,
        $symptoms,$findings,$treatment,$id
    ]);

    echo json_encode(['success' => true]);
}

// ─── DELETE ───────────────────────────────────────────────────────────────────

function deleteRecord() {
    $pdo  = getDB();
    $data = json_decode(file_get_contents('php://input'), true) ?: $_POST;
    $id   = (int)($data['id'] ?? 0);

    if ($id === 0) { echo json_encode(['error' => 'ID required']); return; }

    $stmt = $pdo->prepare("DELETE FROM patient_records WHERE id = ?");
    $stmt->execute([$id]);
    echo json_encode(['success' => true]);
}

// ─── NEXT UNIQUE ID ───────────────────────────────────────────────────────────

function nextUniqueId() {
    $pdo  = getDB();
    $stmt = $pdo->prepare("SELECT MAX(CAST(unique_id AS UNSIGNED)) FROM patient_records");
    $stmt->execute();
    $max  = (int)$stmt->fetchColumn();
    echo json_encode(['next_id' => str_pad($max + 1, 4, '0', STR_PAD_LEFT)]);
}

// ─── PATIENT LOOKUP BY UID ────────────────────────────────────────────────────

function getPatientByUID() {
    $pdo = getDB();
    $uid = trim($_GET['uid'] ?? '');
    if ($uid === '') { echo json_encode(['found' => false]); return; }

    // Most recent record for this UID
    $stmt = $pdo->prepare(
        "SELECT name,parentage,age,gender,phone,address,allergy
         FROM patient_records WHERE unique_id = ? ORDER BY id DESC LIMIT 1"
    );
    $stmt->execute([$uid]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) { echo json_encode(['found' => false]); return; }

    // Next visit number
    $stmt2 = $pdo->prepare("SELECT COUNT(*) FROM patient_records WHERE unique_id = ?");
    $stmt2->execute([$uid]);
    $count = (int)$stmt2->fetchColumn();

    echo json_encode([
        'found'      => true,
        'next_visit' => $count + 1,
        'name'       => $row['name'],
        'parentage'  => $row['parentage'],
        'age'        => $row['age'],
        'gender'     => $row['gender'],
        'phone'      => $row['phone'],
        'address'    => $row['address'],
        'allergy'    => $row['allergy'],
    ]);
}
