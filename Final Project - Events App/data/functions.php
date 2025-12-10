<?php

require_once __DIR__ . "/database.php";

function esc_html(string $text): string
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function events_all(): array
{
    $pdo = get_pdo();
    $stmt = $pdo->prepare("SELECT * FROM events WHERE event_date >= CURRENT_DATE ORDER BY event_date ASC;");
    $stmt->execute();
    return $stmt->fetchAll();
}

function event_registration(int $event_id, string $name, string $email) {
    $pdo = get_pdo();
        
    $stmt = $pdo->prepare("
    INSERT INTO registrations (event_id, name, email)
    VALUES (:event_id, :name, :email);
    ");

    $stmt->execute([
        ':event_id'     => $event_id,
        ':name'         => $name,
        ':email'        => $email,
    ]);
}

function user_find_by_username(string $username): ?array {
    $pdo = get_pdo();
    $stmt = $pdo->prepare("SELECT * FROM `admins` WHERE username = :u");
    $stmt->execute([':u'=>$username]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ?: null;
}