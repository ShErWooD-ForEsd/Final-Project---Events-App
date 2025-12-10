<?php
require_once __DIR__ . '/../data/functions.php';
$events = events_all();


?>


    <h2>
        We can't wait to see you, <?php echo $_GET["name"]; ?>!<br><hr>

        You're registered for <?php echo $_GET["genre_id"]; ?>
    </h2>


