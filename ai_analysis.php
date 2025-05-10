<?php
// Database connection
$servername = "localhost";
$username = "root"; // Adjust as needed
$password = ""; // Adjust as needed
$dbname = "health_data";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from healthinfo table
$sql = "SELECT blood_glucose_level, time_of_day, glucose_notes, systolic, diastolic, pulse_rate, 
               activity_type, intensity, duration_minutes, calories_burned, 
               symptom_name, severity, symptom_notes 
        FROM healthinfo";
$result = $conn->query($sql);

// Categorize data
$glucoseData = [];
$activityData = [];
$symptomData = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if (!is_null($row['blood_glucose_level'])) {
            $glucoseData[] = $row;
        } elseif (!is_null($row['activity_type'])) {
            $activityData[] = $row;
        } elseif (!is_null($row['symptom_name'])) {
            $symptomData[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Analysis - DiaHealth</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles1.css">
</head>
<body>
<div class="sidebar">
    <div class="logo">
        <div class="logo-icon">
            <span class="heart-icon">♡</span>
        </div>
        DiaHealth
    </div>
    <div class="nav-header">Main Navigation</div>
    <ul class="nav-links">
        <li><a href="dashboard.php"><i>📊</i> Dashboard</a></li>
        <li><a href="healthdata.php"><i>📝</i> Health Data Input</a></li>
        <li><a href="ai_analysis.php" class="active"><i>📈</i> AI Analysis</a></li>
        <li><a href="meal.php"><i>❤️</i> Meal</a></li>
        <li><a href="educational.php"><i>📚</i> Education</a></li>
        <li><a href="index.php"><i>🚪</i> Logout</a></li>
    </ul>
    <div class="footer">
        DiaHealth AI Guide © 2025<br>
        Your Personal Health Companion
    </div>
</div>

    </div>
      </div>
        <main class="main-content">
            <h1 class="page-title">AI Analysis</h1>
            <div class="card">
                <h2 class="card-title">Blood Glucose Data</h2>
                <p class="card-subtitle">Select a record to analyze blood glucose levels.</p>
                <table id="glucose-table" class="health-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Blood Glucose Level (mg/dL)</th>
                            <th>Time of Day</th>
                            <th>Systolic (mmHg)</th>
                            <th>Diastolic (mmHg)</th>
                            <th>Pulse Rate (bpm)</th>
                            <th>Notes (optional)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($glucoseData)) {
                            foreach ($glucoseData as $index => $row) {
                                $glucose_level = htmlspecialchars($row['blood_glucose_level'] ?? '');
                                $time_of_day = htmlspecialchars($row['time_of_day'] ?? '');
                                $systolic = htmlspecialchars($row['systolic'] ?? '');
                                $diastolic = htmlspecialchars($row['diastolic'] ?? '');
                                $pulse_rate = htmlspecialchars($row['pulse_rate'] ?? '');
                                $glucose_notes = htmlspecialchars($row['glucose_notes'] ?? '');
                                echo "<tr data-index='$index' 
                                        data-blood-glucose-level='$glucose_level' 
                                        data-time-of-day='$time_of_day' 
                                        data-systolic='$systolic'
                                        data-diastolic='$diastolic'
                                        data-pulse-rate='$pulse_rate'
                                        data-glucose-notes='$glucose_notes'>";
                                echo "<td><input type='radio' name='glucose-row' value='$index' onclick='selectRow(this)'></td>";
                                echo "<td>$glucose_level</td>";
                                echo "<td>$time_of_day</td>";
                                echo "<td>$systolic</td>";
                                echo "<td>$diastolic</td>";
                                echo "<td>$pulse_rate</td>";
                                echo "<td>$glucose_notes</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No blood glucose data available</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="card">
                <h2 class="card-title">Activity Data</h2>
                <p class="card-subtitle">Select a record to analyze activity metrics.</p>
                <table id="activity-table" class="health-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Activity Type</th>
                            <th>Intensity</th>
                            <th>Duration (minutes)</th>
                            <th>Calories Burned</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($activityData)) {
                            foreach ($activityData as $index => $row) {
                                $activity_type = htmlspecialchars($row['activity_type'] ?? '');
                                $intensity = htmlspecialchars($row['intensity'] ?? '');
                                $duration = htmlspecialchars($row['duration_minutes'] ?? '');
                                $calories = htmlspecialchars($row['calories_burned'] ?? '');
                                echo "<tr data-index='$index' 
                                        data-activity-type='$activity_type' 
                                        data-intensity='$intensity' 
                                        data-duration-minutes='$duration' 
                                        data-calories-burned='$calories'>";
                                echo "<td><input type='radio' name='activity-row' value='$index' onclick='selectRow(this)'></td>";
                                echo "<td>$activity_type</td>";
                                echo "<td>$intensity</td>";
                                echo "<td>$duration</td>";
                                echo "<td>$calories</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No activity data available</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="card">
                <h2 class="card-title">Symptom Data</h2>
                <p class="card-subtitle">Select a record to analyze symptoms.</p>
                <table id="symptom-table" class="health-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Symptom Name</th>
                            <th>Severity</th>
                            <th>Notes (optional)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($symptomData)) {
                            foreach ($symptomData as $index => $row) {
                                $symptom_name = htmlspecialchars($row['symptom_name'] ?? '');
                                $severity = htmlspecialchars($row['severity'] ?? '');
                                $symptom_notes = htmlspecialchars($row['symptom_notes'] ?? '');
                                echo "<tr data-index='$index' 
                                        data-symptom-name='$symptom_name' 
                                        data-severity='$severity' 
                                        data-symptom-notes='$symptom_notes'>";
                                echo "<td><input type='radio' name='symptom-row' value='$index' onclick='selectRow(this)'></td>";
                                echo "<td>$symptom_name</td>";
                                echo "<td>$severity</td>";
                                echo "<td>$symptom_notes</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No symptom data available</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <button id="analyze-btn" class="btn btn-primary" disabled>Analyze</button>
            </div>

            <div class="card" id="analysis-result" style="display: none;">
                <h2 class="card-title">AI Analysis Feedback</h2>
                <textarea id="feedback-text" class="form-control" readonly placeholder="Analysis feedback will appear here..."></textarea>
            </div>
        </main>
    </div>

    <script src="script1.js"></script>
</body>
</html>

<?php
$conn->close();
?>