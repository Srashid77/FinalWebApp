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
  </head>
  <body>
    <!-- Header -->
    <header>
      <div class="logo-container">
        <div class="logo">
          <span class="heart-icon">♡</span>
        </div>
        <span class="logo-text">DiaHealth</span>
      </div>
      <nav>
        <ul>
          <li>
            <a href="index.php">Home</a>
          </li>
          <li>
            <a href="about_diabetes.php" class="active">About Diabetes</a>
          </li>
          <li>
            <a href="faq.php">FAQ</a>
          </li>
        </ul>
      </nav>
      <div class="cta-button">
        <a href="login.php" class="btn btn-primary">Get Started</a>
      </div>
    </header>
    <!-- Main Content -->
    <main>
      <section class="hero">
        <div class="hero-content">
          <h1>Warning <span class="highlight">Signs</span> and Symptoms </h1>
          <p>Know the warning signs and symptoms of diabetes and diabetes complications so that you can take action to improve your health.</p>
        </div>
        <div class="hero-image">
          <img src="picture/test.jpg" alt="Diabetes Management" />
        </div>
      </section>
      <!-- Overview Section -->
      <section class="overview-section">
        <h2>Overview of Diabetes</h2>
        <div class="overview-content">
          <div class="overview-text">
            <p>Diabetes is a chronic health condition that affects how your body turns food into energy. When you eat, your body breaks down carbohydrates into glucose, a type of sugar that serves as a primary source of energy. Insulin, a hormone produced by the pancreas, helps glucose enter your cells to be used for energy. In diabetes, this process doesn't work properly, leading to elevated blood sugar levels that can cause serious health problems over time if not managed effectively.</p>
            <p>There are several types of diabetes, each with distinct causes and management strategies. The condition can lead to complications affecting various organs, including the heart, kidneys, eyes, and nerves. Managing diabetes involves a combination of lifestyle changes, medication, and regular monitoring of blood sugar levels. Understanding the condition is crucial for those diagnosed and their families to maintain a good quality of life and prevent complications.</p>
            <p>Globally, diabetes is a growing concern, with millions of people affected. Advances in medical research and technology have improved the ability to manage diabetes, offering tools like continuous glucose monitors and insulin pumps. Education and awareness are key to early diagnosis and effective management, helping individuals lead healthier, more active lives despite the condition.</p>
          </div>
          <div class="overview-video">
            <iframe width="100%" height="315" src="https://www.youtube.com/embed/wZAxLAA6lQQ" title="Understanding Diabetes" poster="picture/insuline.jpg" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <img src="picture/diabetes-video-poster.jpg" alt="Diabetes Overview Fallback" class="video-fallback" style="display: none;" />
          </div>
        </div>
      </section>
      <!-- Types of Diabetes Section -->
      <section class="types-section">
        <h2>What Are the Types of Diabetes?</h2>
        <p>The main types of diabetes are Type 1, Type 2, and gestational diabetes, each with unique characteristics and causes. Type 1 diabetes is an autoimmune condition where the body's immune system attacks insulin-producing cells in the pancreas, leading to little or no insulin production. It typically develops in children or young adults and requires lifelong insulin therapy.</p>
        <p>Type 2 diabetes, the most common form, occurs when the body becomes resistant to insulin or doesn't produce enough insulin to maintain normal glucose levels. It is often linked to lifestyle factors like obesity, physical inactivity, and genetics, and is more common in adults, though increasingly seen in younger populations. Management includes lifestyle changes, oral medications, and sometimes insulin.</p>
        <p>Gestational diabetes develops during pregnancy and usually resolves after childbirth, but it increases the risk of developing Type 2 diabetes later in life. Other rare forms, such as monogenic diabetes and secondary diabetes caused by other medical conditions, also exist but are less common. Understanding these types helps in tailoring treatment and prevention strategies.</p>
      </section>
      <!-- Symptoms and Causes Section -->
      <section class="symptoms-section">
        <div class="symptoms-banner">
          <h2>SYMPTOMS AND CAUSES</h2>
          <p>What are the symptoms and causes of.</p>
          <h3>Type 2 Diabetes?</h3>
        </div>
        <div class="symptoms-container">
          <div class="symptom-card">
            <div class="symptom-title">Frequent Urination</div>
            <p class="symptom-description"> High blood sugar levels force kidneys to work harder, leading to frequent urination, especially at night. This is often accompanied by increased thirst as the body tries to replace lost fluids. </p>
            <a href="https://www.mayoclinic.org/symptoms/frequent-urination/basics/causes/sym-20050712" class="know-more-link" target="_blank">Learn More →</a>
            <div class="symptom-number">01.</div>
          </div>
          <div class="symptom-card">
            <div class="symptom-title">Fatigue</div>
            <p class="symptom-description"> When glucose can't enter cells effectively due to insulin resistance, the body lacks energy, causing persistent tiredness and weakness, even with adequate rest. </p>
            <a href="https://www.healthline.com/health/fatigue" class="know-more-link" target="_blank">Learn More →</a>
            <div class="symptom-number">02.</div>
          </div>
          <div class="symptom-card">
            <div class="symptom-title">Unexpected Weight Loss</div>
            <p class="symptom-description"> Inability to use glucose for energy can lead the body to break down fat and muscle, causing unintentional weight loss despite increased appetite. </p>
            <a href="https://my.clevelandclinic.org/health/symptoms/unexplained-weight-loss" class="know-more-link" target="_blank">Learn More →</a>
            <div class="symptom-number">03.</div>
          </div>
          <div class="symptom-card">
            <div class="symptom-title">Blurred Vision</div>
            <p class="symptom-description"> Elevated blood sugar can cause swelling in the eye's lens, leading to blurred vision or difficulty focusing, which may be an early warning sign of diabetes. </p>
            <a href="https://www.webmd.com/eye-health/why-is-my-vision-blurry" class="know-more-link" target="_blank">Learn More →</a>
            <div class="symptom-number">04.</div>
          </div>
        </div>
      </section>
    </main>
    <!-- Footer -->
    <footer>
      <div class="footer-container">
        <div class="footer-about">
          <div class="footer-logo">
            <div class="logo">♡</div>
            <span>Diabetic Health Monitor</span>
          </div>
          <p class="footer-description"> Take control of your diabetes management with our comprehensive monitoring tools and personalized insights. </p>
        </div>
        <div class="footer-links">
          <h3 class="footer-heading">Quick Links</h3>
          <ul class="footer-links">
            <li>
              <a href="index.php">Home</a>
            </li>
            <li>
              <a href="login.php">Dashboard</a>
            </li>
            <li>
              <a href="login.php">Learning Resources</a>
            </li>
          </ul>
        </div>
        <div class="footer-contact">
          <h3 class="footer-heading">Contact</h3>
          <p>Questions or feedback? Reach out to our support team.</p>
          <p>support@diabeticmonitor.com</p>
        </div>
      </div>
      <div class="copyright">
        <p>© <?php echo date("Y"); ?> DiabetesMonitor. All rights reserved. </p>
      </div>
    </footer>
  </body>
</html>