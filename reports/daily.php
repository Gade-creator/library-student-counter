<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';
//redirectIfNotLoggedIn();

$currentPage = 'reports';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - <?= APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    
    
    <div class="container mt-4">
        <h1 class="mb-4">Library Reports</h1>
        
        <div class="row">
            <!-- Daily Reports Card -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                <i class="bi bi-calendar-day text-primary fs-2"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-0">Daily Reports</h5>
                                <p class="text-muted mb-0">Hourly usage statistics</p>
                            </div>
                        </div>
                        <p class="card-text">View detailed breakdown of library usage by hour for any given day.</p>
                        <a href="daily.php" class="btn btn-outline-primary">View Daily Reports</a>
                    </div>
                </div>
            </div>
            
            <!-- Weekly Reports Card -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                <i class="bi bi-calendar-week text-primary fs-2"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-0">Weekly Reports</h5>
                                <p class="text-muted mb-0">Day-by-day analysis</p>
                            </div>
                        </div>
                        <p class="card-text">Compare library usage patterns across days of the week.</p>
                        <a href="weekly.php" class="btn btn-outline-primary">View Weekly Reports</a>
                    </div>
                </div>
            </div>
            
            <!-- Monthly Reports Card -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                <i class="bi bi-calendar-month text-primary fs-2"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-0">Monthly Reports</h5>
                                <p class="text-muted mb-0">Long-term trends</p>
                            </div>
                        </div>
                        <p class="card-text">Analyze monthly usage patterns and compare across months.</p>
                        <a href="monthly.php" class="btn btn-outline-primary">View Monthly Reports</a>
                    </div>
                </div>
            </div>
            
            <!-- Resource Usage Card -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                <i class="bi bi-pc-display text-primary fs-2"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-0">Resource Usage</h5>
                                <p class="text-muted mb-0">Computers & study spaces</p>
                            </div>
                        </div>
                        <p class="card-text">View utilization rates for computers, dividers, and other resources.</p>
                        <a href="resources.php" class="btn btn-outline-primary">View Resource Reports</a>
                    </div>
                </div>
            </div>
            
            <!-- Department Analysis Card -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                <i class="bi bi-building text-primary fs-2"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-0">Department Analysis</h5>
                                <p class="text-muted mb-0">Usage by department</p>
                            </div>
                        </div>
                        <p class="card-text">See which departments use the library most and when.</p>
                        <a href="departments.php" class="btn btn-outline-primary">View Department Reports</a>
                    </div>
                </div>
            </div>
            
            <!-- Export Data Card -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                <i class="bi bi-download text-primary fs-2"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-0">Export Data</h5>
                                <p class="text-muted mb-0">Custom data exports</p>
                            </div>
                        </div>
                        <p class="card-text">Export raw data for further analysis in Excel or other tools.</p>
                        <a href="export.php" class="btn btn-outline-primary">Export Data</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

  

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>