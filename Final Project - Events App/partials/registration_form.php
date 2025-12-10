<?php
require_once __DIR__ . '/../data/functions.php';
$events = events_all();
?>

<form method="post">
    <h2>Events Registration Form</h2>
    <hr>
    <label>Name</label>
    <input name="name" id="name" type="text" required></br></br>


    <label>Email</label>
    <input type="email" id="email" name="email" required></br></br>

    <label>Events</label>
    <select name="genre_id" class="form-select" required>
        <option value="">Select...</option>
        <?php foreach ($events as $e): ?>
            <option value="<?= (int)$e['id'] ?>"><?= htmlspecialchars($e['title']) ?></option>
        <?php endforeach; ?>
        
    </select></br></br>
    <hr>

    <input type="hidden" name="action" value="register">

    <button>Register</button>

</form>