<?php
include "db_connect.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - DiabetesMonitor</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo-container">
            <div class="logo">
                <span class="logo-letter">D</span>
            </div>
            <span class="logo-text">DiabetesMonitor</span>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about_diabetes.php">About Diabetes</a></li>
                <li><a href="faq.php" class="active">FAQ</a></li>
            </ul>
        </nav>
        <div class="cta-button">
            <a href="login.php" class="btn btn-primary">Get Started</a>
        </div>
    </header>

    <!-- Main Content: FAQ Section -->
    <main>
        <section class="faq-hero">
            <div class="container">
                <h1>Frequently Asked Questions</h1>
                <p>Find answers to common questions about diabetes and how DiabetesMonitor can help you manage your health.</p>
            </div>
        </section>

        <section class="faq-content">
            <div class="container">
                <div class="faq-grid">
                    <!-- Left Column: FAQ Items -->
                    <div class="faq-items">
                        <h2>General Questions</h2>
                        <details class="faq-item">
                            <summary>What is diabetes?</summary>
                            <p>Diabetes is a chronic condition where the body cannot properly regulate blood sugar levels due to issues with insulin production or usage. There are several types, including Type 1, Type 2, and gestational diabetes.</p>
                        </details>
                        <details class="faq-item">
                            <summary>What are the common symptoms of diabetes?</summary>
                            <p>Common symptoms include frequent urination, excessive thirst, extreme fatigue, blurry vision, slow-healing cuts, and unintended weight loss (especially in Type 1).</p>
                        </details>
                        <details class="faq-item">
                            <summary>Who is at risk for diabetes?</summary>
                            <p>Risk factors include family history, obesity, lack of physical activity, poor diet, age (over 45), and certain ethnic backgrounds. Gestational diabetes also increases risk for Type 2 diabetes later in life.</p>
                        </details>
                        <details class="faq-item">
                            <summary>How is diabetes diagnosed?</summary>
                            <p>Diabetes is diagnosed through blood tests such as fasting blood sugar, A1C, or oral glucose tolerance tests. Your healthcare provider will interpret the results based on standard criteria.</p>
                        </details>
                        <details class="faq-item">
                            <summary>Can diabetes be prevented?</summary>
                            <p>Type 2 diabetes can often be prevented or delayed with lifestyle changes like maintaining a healthy weight, eating a balanced diet, and staying physically active. Type 1 diabetes cannot be prevented.</p>
                        </details>

                        <h2>About DiabetesMonitor</h2>
                        <details class="faq-item">
                            <summary>What is DiabetesMonitor?</summary>
                            <p>DiabetesMonitor is a platform designed to help individuals track their blood sugar levels, manage their diet, and stay informed about their condition with personalized insights and resources.</p>
                        </details>
                        <details class="faq-item">
                            <summary>How can DiabetesMonitor help me manage my diabetes?</summary>
                            <p>Our platform offers tools to log your blood glucose readings, track your meals, set reminders for medication, and access educational content to better understand and manage your condition.</p>
                        </details>
                        <details class="faq-item">
                            <summary>Is my data safe with DiabetesMonitor?</summary>
                            <p>Yes, we prioritize your privacy and use advanced encryption to protect your data. We comply with all relevant data protection regulations.</p>
                        </details>
                        <details class="faq-item">
                            <summary>Can I use DiabetesMonitor on my mobile device?</summary>
                            <p>Yes, DiabetesMonitor is optimized for mobile use. You can access it through your mobile browser or download our dedicated app from the App Store or Google Play.</p>
                        </details>
                        <details class="faq-item">
                            <summary>Does DiabetesMonitor integrate with other health devices?</summary>
                            <p>DiabetesMonitor supports integration with select glucose meters and fitness trackers. Check our compatibility list in the app or website for supported devices.</p>
                        </details>

                        <h2>Managing Diabetes</h2>
                        <details class="faq-item">
                            <summary>How often should I check my blood sugar?</summary>
                            <p>The frequency of blood sugar monitoring depends on your type of diabetes and treatment plan. Type 1 patients may need to check 4-10 times daily, while Type 2 patients may need less frequent checks. Consult your doctor for personalized advice.</p>
                        </details>
                        <details class="faq-item">
                            <summary>What foods should I avoid with diabetes?</summary>
                            <p>Limit foods high in refined sugars, processed carbs, and saturated fats, such as sugary drinks, white bread, and fried foods. Focus on whole grains, vegetables, lean proteins, and healthy fats.</p>
                        </details>
                        <details class="faq-item">
                            <summary>How does exercise affect blood sugar levels?</summary>
                            <p>Exercise generally lowers blood sugar by increasing insulin sensitivity and glucose uptake by muscles. However, intense exercise can temporarily raise levels. Monitor your levels before and after exercise to understand your body’s response.</p>
                        </details>
                        <details class="faq-item">
                            <summary>What should I do if I experience low blood sugar?</summary>
                            <p>For low blood sugar (hypoglycemia), consume 15 grams of fast-acting carbs, such as glucose tablets, juice, or candy. Recheck your levels after 15 minutes and repeat if needed. Seek medical help if symptoms persist.</p>
                        </details>
                        <details class="faq-item">
                            <summary>Can stress affect my diabetes?</summary>
                            <p>Yes, stress can raise blood sugar levels by triggering hormones like cortisol and adrenaline. Managing stress through relaxation techniques, exercise, or counseling can help stabilize your levels.</p>
                        </details>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer Section -->
    <footer>
        <div class="container">
            <p>© 2025 DiabetesMonitor. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>