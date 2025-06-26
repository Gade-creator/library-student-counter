<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';
//redirectIfNotLoggedIn();

// Only allow superadmins to access settings
/*if ($_SESSION['role'] !== 'superadmin') {
    header("Location: dashboard.php");
    exit;
}
*/

// Get current settings
$stmt = $pdo->query("SELECT * FROM settings LIMIT 1");
$settings = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $maxCapacity = (int)$_POST['max_capacity'];
    $warningThreshold = (int)$_POST['warning_threshold'];
    $openingTime = $_POST['opening_time'];
    $closingTime = $_POST['closing_time'];
    
    // Validate inputs
    if ($maxCapacity <= 0 || $warningThreshold <= 0 || $warningThreshold >= $maxCapacity) {
        $error = "Invalid capacity settings";
    } else {
        $stmt = $pdo->prepare("UPDATE settings SET 
            max_capacity = ?,
            warning_threshold = ?,
            opening_time = ?,
            closing_time = ?
            WHERE setting_id = ?");
        
        $stmt->execute([
            $maxCapacity,
            $warningThreshold,
            $openingTime,
            $closingTime,
            $settings['setting_id']
        ]);
        
        $success = "Settings updated successfully";
        
        // Refresh settings
        $stmt = $pdo->query("SELECT * FROM settings LIMIT 1");
        $settings = $stmt->fetch();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Settings - <?= APP_NAME ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include ('admin-header.php'); ?>
    
    <div class="container">
        <h1>System Settings</h1>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php elseif (isset($success)): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="max_capacity">Maximum Capacity</label>
                <input type="number" id="max_capacity" name="max_capacity" 
                       value="<?= $settings['max_capacity'] ?>" required>
            </div>
            
            <div class="form-group">
                <label for="warning_threshold">Warning Threshold</label>
                <input type="number" id="warning_threshold" name="warning_threshold" 
                       value="<?= $settings['warning_threshold'] ?>" required>
                <small>System will show warning when count reaches this number</small>
            </div>
            
            <div class="form-group">
                <label for="opening_time">Opening Time</label>
                <input type="time" id="opening_time" name="opening_time" 
                       value="<?= $settings['opening_time'] ?>" required>
            </div>
            
            <div class="form-group">
                <label for="closing_time">Closing Time</label>
                <input type="time" id="closing_time" name="closing_time" 
                       value="<?= $settings['closing_time'] ?>" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Save Settings</button>
        </form>
    </div>
   
</body>
</html>