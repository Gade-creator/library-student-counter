<?php
require_once 'config.php';

// Basic security functions
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Authentication functions
function isLoggedIn() {
    return isset($_SESSION['admin_id']);
}

function redirectIfNotLoggedIn() {
    if (!isLoggedIn()) {
        header("Location: /admin/login.php");
        exit;
    }
}

// Library specific functions
function getCurrentCount() {
    global $pdo;
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM entries WHERE exit_time IS NULL");
    return $stmt->fetch()['count'];
}

function getLibraryStatus() {
    global $pdo;
    $stmt = $pdo->query("SELECT max_capacity, warning_threshold FROM settings LIMIT 1");
    $settings = $stmt->fetch();
    $current = getCurrentCount();
    
    if ($current >= $settings['max_capacity']) {
        return 'full';
    } elseif ($current >= $settings['warning_threshold']) {
        return 'warning';
    } else {
        return 'normal';
    }
}
?>