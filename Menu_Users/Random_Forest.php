<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Prediksi Kesehatan Janin</title>
  <style>
    body { 
      font-family: Arial, sans-serif;  
    }
    .form-box { 
      background:#333; 
      padding:30px; 
      border-radius:8px; 
      max-width:600px; 
      margin:0 auto }
    label { 
      display:block; 
      margin-top:12px }
    input {
      width:100%; 
      padding:8px; 
      border-radius:5px;
      background:#000; 
      color:#fff; 
      border:1px solid #999; 
      font-size:1em;
    }
    button {
      background: #2196F3; 
      color:#fff; 
      border:none; 
      padding:10px 20px;
      border-radius:5px; 
      font-size:16px; 
      margin-top:20px; 
      cursor:pointer;
    }
    button:hover { 
      background:#0b7dda; }
    #result-box {
      display:none; 
      background:#444; 
      padding:20px; 
      border-radius:8px;
      max-width:600px; 
      margin:20px auto; 
      text-align:center;
    }
    table { 
      width:100%; 
      border-collapse: collapse; 
      color:#fff; 
      margin-top:20px }
    th, td { 
      padding:8px; 
      border:1px solid #777 }
    th { 
      background:#555 }

    /* Tombol Ulangi yang berwarna merah */
    button#reset-button {
      background: #f44336; /* Warna merah */
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      font-size: 16px;
      margin-top: 20px;
      cursor: pointer;
    }

    button#reset-button:hover {
      background: #e53935; /* Warna merah lebih gelap ketika hover */
    }
  </style>
</head>
<body>

<div class="form-box">
  <h2>Input Parameter Kesehatan Janin</h2>
  <form id="fetal-form">
    <label for="baseline_value">Baseline Value</label>
    <input type="text" id="baseline_value" placeholder="Detak jantung rata-rata janin (bpm)" required>

    <label for="accelerations">Accelerations</label>
    <input type="text" id="accelerations" placeholder="Jumlah percepatan detak jantung per detik" required>

    <label for="fetal_movement">Fetal Movement</label>
    <input type="text" id="fetal_movement" placeholder="Jumlah gerakan janin terdeteksi" required>

    <label for="uterine_contractions">Uterine Contractions</label>
    <input type="text" id="uterine_contractions" placeholder="Frekuensi kontraksi rahim" required>

    <label for="light_decelerations">Light Decelerations</label>
    <input type="text" id="light_decelerations" placeholder="Penurunan ringan detak jantung janin" required>

    <label for="severe_decelerations">Severe Decelerations</label>
    <input type="text" id="severe_decelerations" placeholder="Penurunan tajam detak jantung janin" required>

    <label for="prolongued_decelerations">Prolongued Decelerations</label>
    <input type="text" id="prolongued_decelerations" placeholder="Penurunan detak jantung yang berkepanjangan" required>

    <label for="abnormal_short_term_variability">Abnormal Short-Term Variability</label>
    <input type="text" id="abnormal_short_term_variability" placeholder="% waktu variabilitas jangka pendek yang abnormal" required>

    <label for="mean_value_of_short_term_variability">Mean Short-Term Variability</label>
    <input type="text" id="mean_value_of_short_term_variability" placeholder="Rata-rata variabilitas jangka pendek" required>

    <label for="percentage_of_time_with_abnormal_long_term_variability">% Time with Abnormal Long-Term Variability</label>
    <input type="text" id="percentage_of_time_with_abnormal_long_term_variability" placeholder="% waktu variabilitas jangka panjang yang abnormal" required>

    <button type="submit">Prediksi</button>
  </form>
</div>



<div id="result-box">
  <h3>Hasil Prediksi</h3>
  <p id="prediction" style="font-size:1.2em; font-weight:bold;"></p>
  <p id="accuracy" style="margin-bottom:15px;"></p>
  <table>
    <thead>
      <tr><th>Parameter</th><th>Nilai</th></tr>
    </thead>
    <tbody id="result-table"></tbody>
  </table>
  <!-- Tombol Ulangi untuk reset input -->
  <button id="reset-button" onclick="resetForm()">Ulangi</button>
</div>

<script>
  document.getElementById('fetal-form').addEventListener('submit', function(e) {
    e.preventDefault();

    // Validate input to ensure it's a valid number
    const input = {
      baseline_value: parseFloat(this.baseline_value.value),
      accelerations: parseFloat(this.accelerations.value),
      fetal_movement: parseFloat(this.fetal_movement.value),
      uterine_contractions: parseFloat(this.uterine_contractions.value),
      light_decelerations: parseFloat(this.light_decelerations.value),
      severe_decelerations: parseFloat(this.severe_decelerations.value),
      prolongued_decelerations: parseFloat(this.prolongued_decelerations.value),
      abnormal_short_term_variability: parseFloat(this.abnormal_short_term_variability.value),
      mean_value_of_short_term_variability: parseFloat(this.mean_value_of_short_term_variability.value),
      percentage_of_time_with_abnormal_long_term_variability: parseFloat(this.percentage_of_time_with_abnormal_long_term_variability.value)
    };

    // Check if all input values are valid numbers
    for (const key in input) {
      if (isNaN(input[key])) {
        alert('Mohon masukkan nilai numerik yang valid');
        return;
      }
    }

    fetch("http://localhost:5000/predict", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(input)
    })
    .then(res => res.json())
    .then(data => {
      const labelMap = {
        1: 'Normal',
        2: 'Suspect',
        3: 'Pathological'
      };

      document.getElementById('prediction').textContent = "Status Janin: " + (labelMap[data.prediction] || data.prediction);
      document.getElementById('accuracy').textContent = "Akurasi Model: " + data.accuracy + "%";

      const resultTable = document.getElementById('result-table');
      resultTable.innerHTML = '';
      for (const key in input) {
        resultTable.innerHTML += `<tr><td>${key.replace(/_/g, ' ')}</td><td>${input[key]}</td></tr>`;
      }

      document.getElementById('result-box').style.display = 'block';
    })
    .catch(error => {
      alert("Terjadi kesalahan saat prediksi.");
      console.error(error);
    });
  });

  // Fungsi untuk mereset form input
  function resetForm() {
    document.getElementById('fetal-form').reset();
    document.getElementById('result-box').style.display = 'none';
  }
</script>

</body>
</html>
