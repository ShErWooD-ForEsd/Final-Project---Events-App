<?php
require_once __DIR__ . '/data/functions.php';
// Starts the session for the login and requires a login for certain features, which is layed out in the switch area
session_start();

$view = filter_input(INPUT_GET, 'view') ?: 'events';
$action = filter_input(INPUT_POST, 'action');

function require_login(): void
{
    if (empty($_SESSION['username'])) {
        header('Location: ?view=login');
        exit;
    }
}

$public_views = ['login'];
$public_actions = ['login'];

if ($actions && !in_array($action, $public_actions, true)) {
    require_login();
}

if (!$action && !in_array($view, $public_views, true)) {
    require_login();
}

// The action to login in, making sure user inputs the correct info to be able to enter the system.
switch ($action) {
    case 'login':
        $username = trim((string)($_POST['username'] ?? ''));
        $password = (string)($_POST['password'] ?? '');

        if ($username && $password) {
            $user = user_find_by_username($username);
            if ($user && password_verify($password, $user['password_hash'])) {
                $_SESSION['user_id'] = (int)$user['id'];
                $_SESSION['name'] = $user['name'];
                $view = 'management';
            } else {
                $login_error = "Invalid username or password.";
                $view = 'login';
            }
        } else {
            $login_error = "Enter both fields.";
            $view = 'login';
        }
        break;
// Destroys the session
    case 'logout':
            $_SESSION = [];
            session_destroy();
            session_start();
            $view = 'login';
            break;    

// This is meant to filter the info the user puts in and allow them to register for events.
    case 'create':
        $name = trim((string)(filter_input(INPUT_POST, 'name') ?? ''));
        $email = trim((string)(filter_input(INPUT_POST, 'email') ?? ''));
        $event_id = (int)(filter_input(INPUT_POST, 'event_id') ?? 0);

        if ($name && $email && $event_id) {
            event_registration($name, $email, $event_id);
            $view = 'registered';
        } else {
            $view = 'registration';
        }
        break;
}

?>

<!-- ---------------------------------------------- -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <link rel="stylesheet" href="assets/styling.css">

</head>

<body>
<!-- attaches the navigation to the main page and puts in the various partials that the view could use.  -->
    <div>
        <h1>What's Going On, Springfield!</h1>
        <?php include __DIR__ . "/components/navigation.php"; ?><br><br>
        <?php
        if ($view === 'events')             include __DIR__ . '/partials/upcoming_events.php';
        elseif ($view === 'registration')   include __DIR__ . '/partials/registration_form.php';
        elseif ($view === 'registered')     include __DIR__ . '/partials/registered.php';
        elseif ($view === 'details')        include __DIR__ . '/partials/event_details.php';
        elseif ($view == 'login')           include __DIR__ . '/partials/login.php';
        elseif ($view == 'management')      include __DIR__ . '/partials/management.php';
        ?>
    </div>

</body>
<footer>&copy;<?php echo date('Y') ?>&nbsp;Elizabeth Sherwood</footer>

</html>