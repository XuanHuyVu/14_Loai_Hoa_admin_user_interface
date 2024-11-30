<?php
session_start();

// Check if the mode is set in the session, if not, default to user mode
if (!isset($_SESSION['mode'])) {
    $_SESSION['mode'] = 'user'; // Default to user mode
}

// Toggle mode if a button is clicked
if (isset($_POST['toggleMode'])) {
    $_SESSION['mode'] = ($_SESSION['mode'] === 'user') ? 'admin' : 'user';
}

// Set the title based on the mode
$pageTitle = ($_SESSION['mode'] === 'admin') ? 'Danh sách hoa | Admin Mode' : 'Danh sách hoa';
?>