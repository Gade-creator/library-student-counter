<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

$currentCount = getCurrentCount();
$libraryStatus = getLibraryStatus();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentId = sanitizeInput($_POST['student_id']);
    
    // Validate student ID format (example: UGR/12345/15)
    if (!preg_match('/^UGR\/\d{5}\/1[0-7]$/', $studentId)) {
        $error = "Invalid student ID format";
    } else {
        // Check if student exists
        $stmt = $pdo->prepare("SELECT id FROM students WHERE id = ?");
        $stmt->execute([$studentId]);
        $student = $stmt->fetch();
        
        if (!$student) {
            // Register new student (in a real system, this would verify against university DB)
            $stmt = $pdo->prepare("INSERT INTO students (id) VALUES (?)");
            $stmt->execute([$studentId]);
        }
        
        // Check if student is already inside
        $stmt = $pdo->prepare("SELECT entry_id FROM entries 
                              WHERE student_id = ? AND exit_time IS NULL");
        $stmt->execute([$studentId]);
        
        if ($stmt->rowCount() > 0) {
            // Student is already inside - process exit
            $entry = $stmt->fetch();
            $pdo->prepare("UPDATE entries SET exit_time = NOW() WHERE entry_id = ?")
                ->execute([$entry['entry_id']]);
            
            // With this dynamic count approach:
            $currentCount = $pdo->query("SELECT COUNT(*) FROM entries WHERE exit_time IS NULL")->fetchColumn();
            $message = "Exit recorded successfully";
        } else {
            // Process entry
            if ($currentCount >= MAX_CAPACITY) {
                $error = "Library is at full capacity";
            } else {
                $pdo->prepare("INSERT INTO entries (student_id) VALUES (?)")
                    ->execute([$studentId]);
                
                $pdo->exec("UPDATE settings SET current_count = current_count ");
                $message = "Entry recorded successfully";
            }
        }
        // Process entry
        if ($currentCount >= MAX_CAPACITY) {
            $error = "Library is at full capacity";
        } else {
            $pdo->prepare("INSERT INTO entries (student_id) VALUES (?)")
                ->execute([$studentId]);
            
            // No longer need to update settings.current_count
            $message = "Entry recorded successfully";
            
            // Get updated count for display
            $currentCount = $pdo->query("SELECT COUNT(*) FROM entries WHERE exit_time IS NULL")->fetchColumn();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Entry - <?= APP_NAME ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="scan-container">
        <h1>ASTU Library</h1>
        <div class="status-indicator status-<?= $libraryStatus ?>">
            Current Count: <?= $currentCount ?> / <?= MAX_CAPACITY ?>
        </div>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php elseif (isset($message)): ?>
            <div class="alert alert-success"><?= $message ?></div>
        <?php endif; ?>
        
        <form method="POST" autocomplete="off">
            <div class="form-group">
                <label for="student_id">Student ID</label>
                <input type="text" id="student_id" name="student_id" 
                       pattern="UGR\/\d{5}\/1[0-7]" 
                       title="Format: UGR/12345/15"
                       required autofocus>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        
        <div class="instructions">
            <h3>Instructions:</h3>
            <ol>
                <li>Scan your student ID card or enter your ID manually</li>
                <li>Press Submit or Enter key</li>
                <li>Scan again when leaving the library</li>
            </ol>
        </div>
    </div>
    
    <script>
        // Auto-submit when scanner sends Enter key
        document.getElementById('student_id').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.form.submit();
            }
        });
        
        // Focus on input after submission
        window.addEventListener('load', function() {
            document.getElementById('student_id').focus();
        });
    </script>
</body>
</html>