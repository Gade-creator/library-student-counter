<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

$currentCount = getCurrentCount();
$libraryStatus = getLibraryStatus();
$statusMessages = [
    'normal' => 'Available Space',
    'warning' => 'Almost Full',
    'full' => 'FULL - No Entry'
];

// Get settings for opening hours
$stmt = $pdo->query("SELECT opening_time, closing_time FROM settings LIMIT 1");
$settings = $stmt->fetch();

// Check if library is open
$currentTime = date('H:i:s');
$isOpen = ($currentTime >= $settings['opening_time'] && $currentTime <= $settings['closing_time']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Status - <?= APP_NAME ?></title>
    <link rel="stylesheet" href="../assets/css/display.css">
</head>
<body class="status-<?= $libraryStatus ?>">
    <div class="display-container">
        <header>
            <h1>Adama Science and Technology University</h1>
            <h2>Central Library</h2>
        </header>
        
        <div class="status-box">
            <div class="current-count">
                <span class="count"><?= $currentCount ?></span>
                <span class="capacity">/ <?= MAX_CAPACITY ?></span>
            </div>
            <div class="status-message"><?= $statusMessages[$libraryStatus] ?></div>
        </div>
        
        <div class="library-hours">
            <div class="time <?= $isOpen ? 'open' : 'closed' ?>">
                <?= $isOpen ? 'OPEN' : 'CLOSED' ?>
            </div>
            <div class="hours">
                <?= date('h:i A', strtotime($settings['opening_time'])) ?> - 
                <?= date('h:i A', strtotime($settings['closing_time'])) ?>
            </div>
        </div>
        
        <div class="last-updated">
            Last updated: <?= date('h:i A') ?>
        </div>
    </div>
    
    <script>
        // Auto-refresh every 30 seconds
        setTimeout(function() {
            location.reload();
        }, 30000);
        
        // Display current time
        function updateClock() {
            const now = new Date();
            document.querySelector('.last-updated').textContent = 
                'Last updated: ' + now.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        }
        
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</body>
</html>