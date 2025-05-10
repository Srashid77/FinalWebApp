<?php
// Start session
session_start();

// Debugging: Log session data
file_put_contents('debug.log', "Dashboard.php - Session ID: " . session_id() . ", Session Data: " . print_r($_SESSION, true) . "\n", FILE_APPEND);

// Check if user is logged in
if (!isset($_SESSION['name'])) {
    file_put_contents('debug.log', "Dashboard.php - No session name, redirecting to login\n", FILE_APPEND);
    header("Location: login.php");
    exit();
}

// Include database connection
include "db_connect.php";

// Fetch user health data for table
$username = $_SESSION['name'];
$sql_health = "SELECT h.id, h.blood_glucose_level, h.time_of_day, h.activity_type, h.symptom_name 
               FROM healthinfo h 
               JOIN users u ON h.user_id = u.id 
               WHERE u.username = ? 
               ORDER BY h.time_of_day DESC LIMIT 5";
$stmt_health = $conn->prepare($sql_health);
if (!$stmt_health) {
    die("Database error: Unable to prepare health statement.");
}
$stmt_health->bind_param("s", $username);
$stmt_health->execute();
$health_result = $stmt_health->get_result();

// Fetch health data for graph (last 7 entries)
$sql_health_graph = "SELECT h.blood_glucose_level, DATE(h.time_of_day) as date
                     FROM healthinfo h 
                     JOIN users u ON h.user_id = u.id 
                     WHERE u.username = ? 
                     ORDER BY h.time_of_day DESC LIMIT 7";
$stmt_health_graph = $conn->prepare($sql_health_graph);
$stmt_health_graph->bind_param("s", $username);
$stmt_health_graph->execute();
$health_graph_result = $stmt_health_graph->get_result();

$glucose_data = [];
$glucose_dates = [];
while($row = $health_graph_result->fetch_assoc()) {
    $glucose_data[] = $row['blood_glucose_level'];
    $glucose_dates[] = date('M j', strtotime($row['date']));
}
// Reverse to show chronological order
$glucose_data = array_reverse($glucose_data);
$glucose_dates = array_reverse($glucose_dates);

// Fetch meal data for table
$sql_meal = "SELECT id, meal_type, food_item, portion_size, calories, carbs 
             FROM diet 
             ORDER BY id DESC LIMIT 5";
$stmt_meal = $conn->prepare($sql_meal);
if (!$stmt_meal) {
    die("Database error: Unable to prepare meal statement.");
}
$stmt_meal->execute();
$meal_result = $stmt_meal->get_result();

// Fetch meal data for graph (last 7 entries)
$sql_meal_graph = "SELECT SUM(calories) as daily_calories
                   FROM diet 
                   ORDER BY id DESC LIMIT 7";
$stmt_meal_graph = $conn->prepare($sql_meal_graph);
$stmt_meal_graph->execute();
$meal_graph_result = $stmt_meal_graph->get_result();

$calorie_data = [];
$calorie_dates = [];
$counter = 0;
while($row = $meal_graph_result->fetch_assoc()) {
    $calorie_data[] = $row['daily_calories'];
    // Create artificial dates (today - counter days)
    $calorie_dates[] = date('M j', strtotime("-$counter days"));
    $counter++;
}
// Reverse to show chronological order
$calorie_data = array_reverse($calorie_data);
$calorie_dates = array_reverse($calorie_dates);

// Fetch summary data
$sql_summary = "SELECT AVG(h.blood_glucose_level) as avg_glucose 
                FROM healthinfo h 
                JOIN users u ON h.user_id = u.id 
                WHERE u.username = ?";
$stmt_summary = $conn->prepare($sql_summary);
if (!$stmt_summary) {
    die("Database error: Unable to prepare summary statement.");
}
$stmt_summary->bind_param("s", $username);
$stmt_summary->execute();
$summary_result = $stmt_summary->get_result();
$summary = $summary_result->fetch_assoc();

// Fetch total calories from diet
$sql_calories = "SELECT SUM(calories) as total_calories FROM diet";
$result_calories = $conn->query($sql_calories);
$calories = $result_calories->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | DialHealth</title>
    <link rel="stylesheet" href="styles1.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="sidebar">
        <h1>DialHealth</h1>
        <div class="nav-header">MAIN NAVIGATION</div>
        <ul class="nav-links">
        <li><a href="dashboard.php" class="active"><i>📊</i> Dashboard</a></li>
        <li><a href="healthdata.php"><i>📝</i> Health Data Input</a></li>
        <li><a href="ai_analysis.php"><i>📈</i> AI Analysis</a></li>
        <li><a href="meal.php"><i>❤️</i> Meal</a></li>
        <li><a href="educational.php" ><i>📚</i> Education</a></li>
        <li><a href="index.php"><i>🚪</i> Logout</a></li>
    </ul>
        <div class="footer">
            DialHealth AI Guide © 2025<br>
            Your Personal Health Companion
        </div>
    </div>

    <div class="main-content">
        <section class="description-block">
            <strong>Welcome <?php 
                if(isset($_SESSION['firstname']) && isset($_SESSION['lastname'])) {
                    echo htmlspecialchars($_SESSION['firstname'] . ' ' . $_SESSION['lastname']);
                } else {
                    echo htmlspecialchars($_SESSION['name']); 
                }
            ?>!</strong>
            View a summary of your health and meal data, and monitor your progress.
        </section>

        <h1>Your Health Dashboard</h1>
        
        <!-- Graphs Section -->
        <section id="graphs-section">
            <h2>Health Trends</h2>
            <div class="graphs-container">
                <div class="graph-wrapper">
                    <div class="graph-title">Blood Glucose Trends (Last 7 Days)</div>
                    <canvas id="glucoseChart"></canvas>
                </div>
                <div class="graph-wrapper">
                    <div class="graph-title">Recent Calorie Intake (Last 7 Entries)</div>
                    <canvas id="calorieChart"></canvas>
                </div>
            </div>
        </section>
        
        <section id="health-data-section">
            <h2>Your Recent Health Data</h2>
            <p><strong>Note:</strong> Showing latest 5 entries.</p>
            <table class="diet-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Blood Glucose (mg/dL)</th>
                        <th>Time of Day</th>
                        <th>Activity Type</th>
                        <th>Symptom Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($health_result && $health_result->num_rows > 0) {
                        while($row = $health_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["blood_glucose_level"] ?? "N/A") . "</td>";
                            echo "<td>" . htmlspecialchars($row["time_of_day"] ?? "N/A") . "</td>";
                            echo "<td>" . htmlspecialchars($row["activity_type"] ?? "N/A") . "</td>";
                            echo "<td>" . htmlspecialchars($row["symptom_name"] ?? "N/A") . "</td>";
                            echo "<td>
                                <button class='action-btn edit-btn' onclick='editRecord(" . $row["id"] . ")'>Edit</button>
                                <button class='action-btn delete-btn' onclick='deleteRecord(" . $row["id"] . ")'>Delete</button>
                            </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No health data available</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <section id="meal-data-section">
            <h2>Your Recent Meal Data</h2>
            <p><strong>Note:</strong> Showing latest 5 entries.</p>
            <table class="diet-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Meal Type</th>
                        <th>Food Item</th>
                        <th>Portion Size</th>
                        <th>Calories</th>
                        <th>Carbs (g)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($meal_result && $meal_result->num_rows > 0) {
                        while($row = $meal_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                            echo "<td>" . htmlspecialchars(ucfirst($row["meal_type"])) . "</td>";
                            echo "<td>" . htmlspecialchars($row["food_item"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["portion_size"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["calories"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["carbs"]) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No meal data available</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <section id="summary-section">
            <h2>Health & Meal Summary</h2>
            <div id="summary-content">
                <?php
                if ($summary['avg_glucose'] !== null) {
                    echo "<p><strong>Average Blood Glucose:</strong> " . round($summary['avg_glucose'], 1) . " mg/dL</p>";
                } else {
                    echo "<p><strong>Average Blood Glucose:</strong> No data available</p>";
                }
                if ($calories['total_calories'] !== null) {
                    echo "<p><strong>Total Calories Consumed:</strong> " . round($calories['total_calories']) . " kcal</p>";
                } else {
                    echo "<p><strong>Total Calories Consumed:</strong> No data available</p>";
                }
                ?>
                <p>Track more data to get personalized insights!</p>
            </div>
        </section>

        <section id="quick-actions">
            <h2>Quick Actions</h2>
            <div class="button-center">
                <a href="healthdata.php" class="submit-btn">Add New Health Data</a>
                <a href="meal.php" class="submit-btn">Add New Meal Data</a>
                <a href="ai_analysis.php" class="submit-btn">Analyze My Health</a>
            </div>
        </section>
    </div>

    <script>
        // Initialize charts when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Blood Glucose Chart
            const glucoseCtx = document.getElementById('glucoseChart').getContext('2d');
            const glucoseChart = new Chart(glucoseCtx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($glucose_dates); ?>,
                    datasets: [{
                        label: 'Blood Glucose (mg/dL)',
                        data: <?php echo json_encode($glucose_data); ?>,
                        borderColor: 'rgb(255, 99, 132)',
                        backgroundColor: 'rgba(255, 99, 132, 0.1)',
                        borderWidth: 2,
                        tension: 0.1,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.raw + ' mg/dL';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false,
                            title: {
                                display: true,
                                text: 'mg/dL'
                            }
                        }
                    }
                }
            });
            
            // Calorie Intake Chart
            const calorieCtx = document.getElementById('calorieChart').getContext('2d');
            const calorieChart = new Chart(calorieCtx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($calorie_dates); ?>,
                    datasets: [{
                        label: 'Calories',
                        data: <?php echo json_encode($calorie_data); ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.raw + ' kcal';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Calories'
                            }
                        }
                    }
                }
            });
        });

        function editRecord(id) {
            window.location.href = "edit_health_data.php?id=" + id;
        }
        
        function deleteRecord(id) {
            if(confirm("Are you sure you want to delete this record?")) {
                window.location.href = "delete_health_data.php?id=" + id;
            }
        }
    </script>
</body>
</html>
<?php
$stmt_health->close();
$stmt_meal->close();
$stmt_summary->close();
$conn->close();
?>