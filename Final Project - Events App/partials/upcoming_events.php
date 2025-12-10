<?php
require_once __DIR__ . '/../data/functions.php';
$events = events_all();
?>

<!-- This is the basic list of upcoming events. Date was converted to something more easily read. -->
<h2>Upcoming Events</h2>
<table>
    <tr>
        <th>Event</th>
        <th>Date</th>
        <th>Location</th>
    </tr>
    <tbody>
        <?php if (count($events) > 0): ?>
            <?php foreach ($events as $rows): ?>
                <tr>
                    <td><a href="?view=details"><?= htmlspecialchars($rows['title']) ?><a></td>
                    <td><?= $date = date('F jS, Y', strtotime(htmlspecialchars($rows['event_date']))); ?></td>
                    <td><?= htmlspecialchars($rows['location']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>