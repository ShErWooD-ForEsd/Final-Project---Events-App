<?php
require_once __DIR__ . '/../data/functions.php';
$events = events_all();
?>

<?php if (count($events) > 0): ?>
    <?php foreach ($events as $rows): ?>
        <h2><?= htmlspecialchars($rows['title']) ?></h2>
        <h4><?= $date = date('F jS, Y', strtotime(htmlspecialchars($rows['event_date']))); ?> at <?= htmlspecialchars($rows['location']) ?> </h4>
        <p><?= htmlspecialchars($rows['description']) ?></p>
        <a href="?view=registration">Register</a>
        <hr></br>
    <?php endforeach; ?>
<?php endif; ?>