<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

// Get current library status
$currentCount = getCurrentCount();
$libraryStatus = getLibraryStatus();
$statusMessages = [
    'normal' => 'Available Space',
    'warning' => 'Approaching Capacity',
    'full' => 'Full - No Entry'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASTU Library User Counter System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="assets/images/image.png" alt="ASTU Logo" height="40" class="d-inline-block align-top me-2">
                Library User Counter
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="scan/">Entry Point</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="display/">Live Display</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin/login.php">Admin Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="row">
            <!-- System Status Card -->
            <div class="col-md-4 mb-4">
                <div class="card status-card <?= $libraryStatus ?>">
                    <div class="card-body text-center">
                        <h5 class="card-title">Current Library Status</h5>
                        <div class="status-count">
                            <span class="display-4"><?= $currentCount ?></span>
                            <span class="fs-5">/ <?= MAX_CAPACITY ?></span>
                        </div>
                        <p class="status-text"><?= $statusMessages[$libraryStatus] ?></p>
                        <a href="scan/" class="btn btn-primary">Go to Entry Point</a>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">System Access</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Entry/Exit Scanning</h5>
                                        <p class="card-text">Student ID scanning interface for tracking library entries and exits.</p>
                                        <a href="scan/" class="btn btn-outline-primary">Access Scanner</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Live Display</h5>
                                        <p class="card-text">Public display showing current library capacity and status.</p>
                                        <a href="display/" class="btn btn-outline-primary">View Display</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Reports</h5>
                                        <p class="card-text">View daily, weekly, and monthly usage statistics.</p>
                                        <a href="reports/" class="btn btn-outline-primary">View Reports</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Administration</h5>
                                        <p class="card-text">System configuration and management interface.</p>
                                        <a href="admin/login.php" class="btn btn-outline-primary">Admin Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Information -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">About the System</h5>
                    </div>
                    <div class="card-body">
                        <p>The ASTU Library User Counter System provides real-time monitoring of library occupancy and usage patterns. Key features include:</p>
                        <ul>
                            <li>Accurate student counting using ID card scanning</li>
                            <li>Real-time capacity monitoring and alerts</li>
                            <li>Comprehensive usage reporting</li>
                            <li>Resource utilization tracking (computers, study spaces)</li>
                            <li>Secure administration interface</li>
                        </ul>
                        <p class="mb-0">For assistance, please contact the Library IT Support team.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white mt-5 py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Adama Science and Technology University</h5>
                    <p>Central Library User Counter System</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">&copy; <?= date('Y') ?> ASTU Library. All rights reserved.</p>
                    <p class="mb-0">System Version 1.0</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-refresh status every 30 seconds
        setTimeout(function() {
            window.location.reload();
        }, 30000);
    </script>
</body>
</html>