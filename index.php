<?php
include "db_connect.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiabetesMonitor - Smart Diabetes Monitoring Made Simple</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo-container">
            <div class="logo">
               <span class="heart-icon">♡</span>
            </div>
            <span class="logo-text">DiaHealth</span>
        </div>
        <nav>
            <ul>
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="about_diabetes.php">About Diabetes</a></li>
                <li><a href="faq.php">FAQ</a></li>
            </ul>
        </nav>
        <div class="cta-button">
            <a href="login.php" class="btn btn-primary">Get Started</a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>
                <span class="dark">Smart Diabetes</span><br>
                <span class="highlight">Monitoring</span><br>
                <span class="dark">Made Simple</span>
            </h1>
            <p>Take control of your health with our comprehensive diabetes management platform. Track, analyze, and improve your health metrics with AI-powered insights.</p>
            <div class="hero-buttons">
                <a href="login.php" class="btn btn-primary">Start Your Journey</a>
            </div>
        </div>
        <div class="hero-image">
            <img src="picture/insulin.jpg" alt="Health Dashboard Preview">
        </div>
    </section>
    <!-- CTA Banner -->
    <section class="cta-banner">
        <div class="cta-content">
            <h2>Ready to Transform Your Diabetes Management?</h2>
            <p>Join thousands of users who have taken control of their health with our comprehensive diabetes monitoring platform.</p>
        </div>
    </section>
    <!-- Three Step Process -->
    <section class="process-section">
        <div class="container">
            <h2 class="section-title">Our simple three-step process helps you stay on top of your diabetes management journey.</h2>
            <div class="process-steps">
                <div class="step">
                    <div class="step-icon">1</div>
                    <h3>Track Your Data</h3>
                    <p>Log your glucose readings, medications, meals, and activities through our intuitive interface.</p>
                </div>
                <div class="step">
                    <div class="step-icon">2</div>
                    <h3>Get Insights</h3>
                    <p>Our AI analyzes your data to provide personalized insights and recommendations for better management.</p>
                </div>
                <div class="step">
                    <div class="step-icon">3</div>
                    <h3>Improve Health</h3>
                    <p>Follow your customized plans and watch as your diabetes management improves over time.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="features">
                <div class="feature">
                    <div class="feature-icon heart">
                        <i class="far fa-heart"></i>
                    </div>
                    <h3>Diet Recommendations</h3>
                    <p>Get tailored meal plans and nutritional guidance based on your blood sugar patterns and dietary preferences.</p>
                </div>
                <div class="feature">
                    <div class="feature-icon book">
                        <i class="fas fa-book"></i>
                    </div>
                    <h3>Educational Resources</h3>
                    <p>Access a wealth of credible information on diabetes management, lifestyle tips, and the latest research.</p>
                </div>
                <div class="feature">
                    <div class="feature-icon bell">
                        <i class="far fa-bell"></i>
                    </div>
                    <h3>Smart Notifications</h3>
                    <p>Receive timely alerts for critical health changes, upcoming appointments, and medication schedules.</p>
                </div>
            </div>
            <h2 class="section-title dark-title">How It Works</h2>
        </div>
    </section>

    <!-- Comprehensive Management Section -->
    <section class="comprehensive-section">
        <div class="container">
            <h2 class="section-title">Comprehensive Diabetes Management</h2>
            <p class="section-subtitle">Our platform offers a complete suite of tools designed to help you monitor, analyze, and improve your health.</p>
            <div class="management-features">
                <div class="management-feature">
                    <div class="feature-icon heartbeat">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h3>Health Data Tracking</h3>
                    <p>Easily log and monitor your blood sugar levels, medications, meals, and physical activities all in one place.</p>
                </div>
                <div class="management-feature">
                    <div class="feature-icon chart">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h3>AI-Powered Analysis</h3>
                    <p>Receive personalized insights and risk assessments based on your health data through our advanced AI algorithms.</p>
                </div>
                <div class="management-feature">
                    <div class="feature-icon calendar">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                    <h3>Medication Management</h3>
                    <p>Never miss a dose with customizable medication reminders and detailed tracking of your treatment plan.</p>
                </div>
            </div>
        </div>
    </section>
     <!-- Quick Links Section -->
    <section class="quick-links-section">
        <div class="container">
            <div class="column">
                <h3>Diabetic Health Monitor</h3>
                <p>Take control of your diabetes management with our comprehensive monitoring tools and personalized insights.</p>
            </div>
            <div class="column">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="login.php">Dashboard</a></li>
                    <li><a href="login.php">Learning Resources</a></li>
                </ul>
            </div>
            <div class="column">
                <h3>Contact</h3>
                <p>Questions or feedback? Reach out to our support team.</p>
                <a href="mailto:support@diabeticmonitor.com">support@diabeticmonitor.com</a>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 DiabetesMonitor. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>