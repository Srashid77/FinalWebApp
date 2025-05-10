<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "health_data";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (isset($_POST['glucose_submit'])) {
            $glucose_level = $_POST['glucose_level'];
            $glucose_time = $_POST['glucose_time'];
            $glucose_notes = $_POST['glucose_notes'] ?: null;
            $systolic = $_POST['systolic'] ?: null;
            $diastolic = $_POST['diastolic'] ?: null;
            $pulse_rate = $_POST['pulse_rate'] ?: null;
            
            // Map dropdown values to TIME values
            $time_mapping = [
                'morning' => '08:00:00',
                'lunch' => '12:00:00',
                'afternoon' => '15:00:00',
                'night' => '20:00:00'
            ];
            $time_of_day = $time_mapping[$glucose_time] ?? null;
            
            $stmt = $conn->prepare("INSERT INTO healthinfo (blood_glucose_level, time_of_day, glucose_notes, systolic, diastolic, pulse_rate) VALUES (:glucose_level, :time_of_day, :glucose_notes, :systolic, :diastolic, :pulse_rate)");
            $stmt->execute([
                'glucose_level' => $glucose_level,
                'time_of_day' => $time_of_day,
                'glucose_notes' => $glucose_notes,
                'systolic' => $systolic,
                'diastolic' => $diastolic,
                'pulse_rate' => $pulse_rate
            ]);
        }
        
        if (isset($_POST['activity_submit'])) {
            $activity_type = $_POST['activity_type'];
            $activity_intensity = $_POST['activity_intensity'];
            $activity_duration = $_POST['activity_duration'];
            $activity_calories = $_POST['activity_calories'];
            
            $stmt = $conn->prepare("INSERT INTO healthinfo (activity_type, intensity, duration_minutes, calories_burned) VALUES (:activity_type, :intensity, :duration_minutes, :calories_burned)");
            $stmt->execute([
                'activity_type' => $activity_type,
                'intensity' => $activity_intensity,
                'duration_minutes' => $activity_duration,
                'calories_burned' => $activity_calories
            ]);
        }
        
        if (isset($_POST['symptom_submit'])) {
            $symptom_name = $_POST['symptom_name'];
            $symptom_severity = $_POST['symptom_severity'];
            $symptom_notes = $_POST['symptom_notes'] ?: null;
            
            $stmt = $conn->prepare("INSERT INTO healthinfo (symptom_name, severity, symptom_notes) VALUES (:symptom_name, :severity, :symptom_notes)");
            $stmt->execute([
                'symptom_name' => $symptom_name,
                'severity' => $symptom_severity,
                'symptom_notes' => $symptom_notes
            ]);
        }
        
        echo "<script>alert('Data saved successfully!');</script>";
    } catch(PDOException $e) {
        echo "<script>alert('Error saving data: " . addslashes($e->getMessage()) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiaHealth - Your Personal Health Companion</title>
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
           <li><a href="healthdata.php" class="active"><i>📝</i> Health Data Input</a></li>
           <li><a href="ai_analysis.php"><i>📈</i> AI Analysis</a></li>
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
    <div class="main-content">
        <h1 class="page-title">Health Data Input</h1>
        <div class="card">
            <h2 class="card-title">Log Your Health Data</h2>
            <p class="card-subtitle">Track your blood glucose, blood pressure, pulse rate, activities, and symptoms to get personalized health insights.</p>
            
            <div class="tabs">
                <div class="tab active" data-tab="glucose">Vital Signs</div>
                <div class="tab" data-tab="activities">Activities</div>
                <div class="tab" data-tab="symptoms">Symptoms</div>
            </div>
            
            <!-- Vital Signs Tab -->
            <form id="glucose-tab" class="tab-content active" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="glucose-level">Blood Glucose Level (80-140 mg/dL)</label>
                        <input type="number" step="0.1" id="glucose-level" name="glucose_level" class="form-control" placeholder="Enter your blood glucose reading" required>
                    </div>
                    <div class="form-group">
                        <label for="glucose-time">Time of Day</label>
                        <select id="glucose-time" name="glucose_time" class="dropdown" required>
                            <option value="morning">Morning</option>
                            <option value="lunch">Lunch</option>
                            <option value="afternoon">Afternoon</option>
                            <option value="night">Night</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="systolic">Systolic Blood Pressure (90-120 mmHg)</label>
                        <input type="number" id="systolic" name="systolic" class="form-control" placeholder="Enter systolic reading" required>
                    </div>
                    <div class="form-group">
                        <label for="diastolic">Diastolic Blood Pressure (80 or Below mmHg)</label>
                        <input type="number" id="diastolic" name="diastolic" class="form-control" placeholder="Enter diastolic reading" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="pulse-rate">Pulse Rate (60 to 100 bpm)</label>
                        <input type="number" id="pulse-rate" name="pulse_rate" class="form-control" placeholder="Enter pulse rate" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="glucose-notes">Notes (optional)</label>
                    <textarea id="glucose-notes" name="glucose_notes" class="form-control" placeholder="Add any notes about these readings (e.g., before/after meal, exercise, etc.)"></textarea>
                </div>
                <button type="submit" name="glucose_submit" class="btn btn-primary">Save Vital Signs</button>
            </form>
            
            <!-- Activities Tab -->
            <form id="activities-tab" class="tab-content" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="activity-type">Activity Type</label>
                        <input type="text" id="activity-type" name="activity_type" class="form-control" placeholder="Enter activity type (e.g., walking, swimming)" required>
                    </div>
                    <div class="form-group">
                        <label for="activity-intensity">Intensity</label>
                        <select id="activity-intensity" name="activity_intensity" class="dropdown" required>
                            <option value="Low">Low</option>
                            <option value="Moderate">Moderate</option>
                            <option value="High">High</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="activity-duration">Duration (minutes)</label>
                        <input type="number" id="activity-duration" name="activity_duration" class="form-control" placeholder="Duration in minutes" required>
                    </div>
                    <div class="form-group">
                        <label for="activity-calories">Calories Burned</label>
                        <input type="number" id="activity-calories" name="activity_calories" class="form-control" placeholder="Estimated calories burned" required>
                    </div>
                </div>
                <button type="submit" name="activity_submit" class="btn btn-primary">Save Activity</button>
            </form>
            
            <!-- Symptoms Tab -->
            <form id="symptoms-tab" class="tab-content" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="symptom-name">Symptom Name</label>
                        <input type="text" id="symptom-name" name="symptom_name" class="form-control" placeholder="Enter symptom name" required>
                    </div>
                    <div class="form-group">
                        <label for="symptom-severity">Severity</label>
                        <select id="symptom-severity" name="symptom_severity" class="dropdown" required>
                            <option value="Mild">Mild</option>
                            <option value="Moderate">Moderate</option>
                            <option value="Severe">Severe</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="symptom-notes">Notes (optional)</label>
                    <textarea id="symptom-notes" name="symptom_notes" class="form-control" placeholder="Add any additional information about this symptom"></textarea>
                </div>
                <button type="submit" name="symptom_submit" class="btn btn-primary">Save Symptom</button>
            </form>
        </div>
    </div>

    <script src="script1.js"></script>
</body>
</html>