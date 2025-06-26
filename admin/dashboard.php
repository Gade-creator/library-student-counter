<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';
//redirectIfNotLoggedIn();

$currentCount = getCurrentCount();
$libraryStatus = getLibraryStatus();
$statusMessages = [
    'normal' => 'Library has available space',
    'warning' => 'Library approaching capacity',
    'full' => 'Library is at full capacity'
];

// Get today's stats
$stmt = $pdo->query("SELECT 
    COUNT(*) as total_entries,
    SUM(CASE WHEN exit_time IS NULL THEN 1 ELSE 0 END) as current_inside
    FROM entries 
    WHERE DATE(entry_time) = CURDATE()");
$todayStats = $stmt->fetch();

// Get recent entries
$stmt = $pdo->query("SELECT e.*, s.name 
    FROM entries e
    JOIN students s ON e.student_id = s.id
    ORDER BY e.entry_time DESC LIMIT 10");
$recentEntries = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - <?= APP_NAME ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            background-color:rgb(248, 248, 248);
        }
        .card {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background: rgb(164, 197, 230);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
        }
        .container {
            text-align: center;
            margin-bottom: 30px;
        }
        .recent-entries{
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background: rgb(164, 197, 230);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);

        }

    </style>
</head>
<body>
    <?php include('admin-header.php'); ?>
    
    <div class="container">
        <h1>Dashboard</h1>
        
        <div class="status-cards">
            <div class="card card-<?= $libraryStatus ?>">
                <h2>Current Status</h2>
                <div class="stat"><?= $currentCount ?> / <?= MAX_CAPACITY ?></div>
                <p><?= $statusMessages[$libraryStatus] ?></p>
            </div>
            
            <div class="card">
                <h2>Today's Entries</h2>
                <div class="stat"><?= $todayStats['total_entries'] ?></div>
                <p>Currently inside: <?= $todayStats['current_inside'] ?></p>
            </div>
        </div>
        
        <div class="recent-entries">
            <h2>Recent Entries</h2>
            <table>
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Entry Time</th>
                        <th>Exit Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentEntries as $entry): ?>
                    <tr>
                        <td><?= htmlspecialchars($entry['student_id']) ?></td>
                        <td><?= htmlspecialchars($entry['name']) ?></td>
                        <td><?= date('H:i', strtotime($entry['entry_time'])) ?></td>
                        <td><?= $entry['exit_time'] ? date('H:i', strtotime($entry['exit_time'])) : 'Inside' ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
   
</body>
</html>