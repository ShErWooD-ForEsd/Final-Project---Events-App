<?php

require_once __DIR__ . "/database.php"; //connects the database page here so I can call upon the function there easily with these functions below

function esc_html(string $text): string
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function events_all(): array //calls on the database for all the info from events so I can insert the info into the pages
{
    $pdo = get_pdo();
    $stmt = $pdo->prepare("SELECT * FROM events WHERE event_date >= CURRENT_DATE ORDER BY event_date ASC;");
    $stmt->execute();
    return $stmt->fetchAll();
}

function event_registration(int $event_id, string $name, string $email) { //function calls up the database so users can register for specific events, inserting the new registration into the database/table
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

function user_find_by_username(string $username): ?array { //function that calls up the database to find the specific user to sign in - here it will be the admin
    $pdo = get_pdo();
    $stmt = $pdo->prepare("SELECT * FROM `admins` WHERE username = :u");
    $stmt->execute([':u'=>$username]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ?: null;
}