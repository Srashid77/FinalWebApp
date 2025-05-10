document.addEventListener('DOMContentLoaded', function() {
  const tabs = document.querySelectorAll('.tab');
  const tabContents = document.querySelectorAll('.tab-content');
  
  tabs.forEach(tab => {
      tab.addEventListener('click', function() {
          // Remove active class from all tabs and contents
          tabs.forEach(t => t.classList.remove('active'));
          tabContents.forEach(content => content.classList.remove('active'));
          
          // Add active class to clicked tab
          this.classList.add('active');
          
          // Show corresponding content
          const tabId = this.getAttribute('data-tab');
          document.getElementById(tabId + '-tab').classList.add('active');
      });
  });
});

/*deit*/

document.addEventListener('DOMContentLoaded', () => {
  const tabs = document.querySelectorAll('.tab');
  const tabContents = document.querySelectorAll('.tab-content');

  tabs.forEach(tab => {
      tab.addEventListener('click', () => {
          // Remove active class from all tabs and contents
          tabs.forEach(t => t.classList.remove('active'));
          tabContents.forEach(content => content.classList.remove('active'));

          // Add active class to clicked tab and corresponding content
          tab.classList.add('active');
          const tabId = tab.getAttribute('data-tab');
          document.getElementById(`${tabId}-tab`).classList.add('active');
      });
  });
});

/*ai*/
function selectRow(radio) {
  const glucoseSelected = document.querySelector('input[name="glucose-row"]:checked');
  const activitySelected = document.querySelector('input[name="activity-row"]:checked');
  const symptomSelected = document.querySelector('input[name="symptom-row"]:checked');
  const analyzeBtn = document.getElementById('analyze-btn');

  // Enable Analyze button only if one record is selected from each table
  if (glucoseSelected && activitySelected && symptomSelected) {
      analyzeBtn.disabled = false;
  } else {
      analyzeBtn.disabled = true;
  }
}

document.getElementById('analyze-btn').addEventListener('click', function() {
  const glucoseRow = document.querySelector('input[name="glucose-row"]:checked').closest('tr');
  const activityRow = document.querySelector('input[name="activity-row"]:checked').closest('tr');
  const symptomRow = document.querySelector('input[name="symptom-row"]:checked').closest('tr');

  // Collect selected data
  const data = {
      blood_glucose_level: glucoseRow.dataset.bloodGlucoseLevel,
      time_of_day: glucoseRow.dataset.timeOfDay,
      glucose_notes: glucoseRow.dataset.glucoseNotes,
      activity_type: activityRow.dataset.activityType,
      intensity: activityRow.dataset.intensity,
      duration_minutes: activityRow.dataset.durationMinutes,
      symptom_name: symptomRow.dataset.symptomName,
      severity: symptomRow.dataset.severity,
      symptom_notes: symptomRow.dataset.symptomNotes
  };

  // Simulate Grok's analysis (replace with API call if available)
  const analysis = analyzeDiabetesRisk(data);

  // Display result
  const feedbackText = document.getElementById('feedback-text');
  const analysisResult = document.getElementById('analysis-result');
  feedbackText.value = analysis;
  analysisResult.style.display = 'block';
});

function analyzeDiabetesRisk(data) {
  let analysis = "Diabetes Risk Analysis:\n\n";
  let riskFactors = [];

  // Blood Glucose Analysis
  const glucoseLevel = parseFloat(data.blood_glucose_level);
  if (data.time_of_day.includes('08:00:00') && glucoseLevel >= 126) {
      riskFactors.push(`High fasting blood glucose (${glucoseLevel} mg/dL) suggests possible diabetes. Normal fasting range is 70-99 mg/dL.`);
  } else if (glucoseLevel >= 200) {
      riskFactors.push(`Very high blood glucose (${glucoseLevel} mg/dL) indicates potential diabetes, especially if random measurement.`);
  } else if (glucoseLevel >= 100 && data.time_of_day.includes('08:00:00')) {
      riskFactors.push(`Elevated fasting blood glucose (${glucoseLevel} mg/dL) may indicate prediabetes.`);
  }

  // Activity Analysis
  const duration = parseInt(data.duration_minutes);
  if (data.intensity === 'Low' || duration < 30) {
      riskFactors.push(`Low physical activity (${data.activity_type}, ${data.intensity}, ${duration} minutes) may increase diabetes risk. Aim for at least 150 minutes of moderate activity per week.`);
  }

  // Symptom Analysis
  const diabetesSymptoms = ['Fatigue', 'Thirst', 'Polyphagia', 'Frequent Urination', 'Blurred Vision'];
  if (diabetesSymptoms.includes(data.symptom_name) && data.severity === 'High') {
      riskFactors.push(`Severe symptom (${data.symptom_name}) is associated with diabetes.`);
  }

  // Generate conclusion
  if (riskFactors.length >= 2) {
      analysis += "High Risk: Multiple indicators suggest a significant risk of diabetes. Please consult a healthcare provider for further testing (e.g., A1C, OGTT).\n\n";
  } else if (riskFactors.length === 1) {
      analysis += "Moderate Risk: One indicator suggests a possible risk of diabetes. Monitor symptoms and glucose levels closely.\n\n";
  } else {
      analysis += "Low Risk: No strong indicators of diabetes based on the provided data. Continue healthy lifestyle practices.\n\n";
  }

  // Add details
  analysis += "Details:\n";
  if (riskFactors.length > 0) {
      riskFactors.forEach((factor, index) => {
          analysis += `${index + 1}. ${factor}\n`;
      });
  } else {
      analysis += "- No significant risk factors identified.\n";
  }

  return analysis;
}

/*dashbosrd*/