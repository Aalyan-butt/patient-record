<?php
function getDB() {
    static $pdo = null;
    if ($pdo !== null) return $pdo;

    try {
        // Connect without selecting a DB so we can create it if needed
        $pdo = new PDO(
            'mysql:host=localhost;charset=utf8mb4',
            'root', '',
            [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]
        );

        $pdo->exec("CREATE DATABASE IF NOT EXISTS `patient_record`
                    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        $pdo->exec("USE `patient_record`");

        $pdo->exec("CREATE TABLE IF NOT EXISTS `patient_records` (
            `id`           INT AUTO_INCREMENT PRIMARY KEY,
            `unique_id`    VARCHAR(10)               NOT NULL,
            `date`         DATE                      NOT NULL,
            `time`         TIME                      NOT NULL,
            `visit_number` INT                       NOT NULL DEFAULT 1,
            `name`         VARCHAR(255)              NOT NULL,
            `parentage`    VARCHAR(255)              DEFAULT '',
            `age`          TINYINT UNSIGNED          DEFAULT NULL,
            `gender`       ENUM('Male','Female','Other') DEFAULT NULL,
            `weight`       DECIMAL(5,2)              DEFAULT NULL,
            `phone`        VARCHAR(30)               DEFAULT '',
            `address`      TEXT                      DEFAULT NULL,
            `allergy`      TEXT                      DEFAULT NULL,
            `symptoms`     TEXT                      DEFAULT NULL,
            `findings`     TEXT                      DEFAULT NULL,
            `treatment`    TEXT                      DEFAULT NULL,
            `created_at`   TIMESTAMP                 DEFAULT CURRENT_TIMESTAMP,
            INDEX idx_uid  (`unique_id`),
            INDEX idx_date (`date`),
            INDEX idx_name (`name`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    } catch (PDOException $e) {
        http_response_code(500);
        die(json_encode(['error' => 'DB Error: ' . $e->getMessage()]));
    }

    return $pdo;
}
