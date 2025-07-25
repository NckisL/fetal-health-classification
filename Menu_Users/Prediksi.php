<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Prediksi Kesehatan Janin</title>
  <style>
    body { font-family: Arial, sans-serif;}
    .form-box, #result-box { background:#333; padding:30px; border-radius:8px; max-width:600px; margin:0 auto }
    label { display:block; margin-top:12px }
    input { width:100%; padding:8px; border-radius:5px; background:#000; color:#fff; border:1px solid #999; font-size:1em }
    button { background: #2196F3; color:#fff; border:none; padding:10px 20px; border-radius:5px; font-size:16px; margin-top:20px; cursor:pointer }
    button:hover { background:#0b7dda; }
    #result-box { display:none; margin-top:20px; text-align:center }
    table { width:100%; border-collapse: collapse; color:#fff; margin-top:20px }
    th, td { padding:8px; border:1px solid #777 }
    th { background:#555 }
    #reset-button { background: #f44336; }
    #reset-button:hover { background: #e53935; }
    .description { font-size: 0.85em; color: #ccc; margin-bottom: 6px; }
  </style>
</head>
<body>

<div class="form-box">
  <h2>Input Parameter Kesehatan Janin</h2>
  <form id="fetal-form">
    <div id="input-container"></div>
    <button type="submit">Prediksi</button>
  </form>
</div>

<div id="result-box">
  <h3>Hasil Prediksi</h3>
  <p id="prediction" style="font-size:1.2em; font-weight:bold;"></p>
  <p id="accuracy"></p>
  <div id="note-container"></div>
  <table>
    <thead><tr><th>Model</th><th>Status</th><th>Akurasi</th></tr></thead>
    <tbody id="model-results"></tbody>
  </table>
  <table>
    <thead><tr><th>Parameter</th><th>Nilai</th></tr></thead>
    <tbody id="result-table"></tbody>
  </table>
  <button id="reset-button" onclick="resetForm()">Ulangi</button>
</div>

<script>
 window.onload = () => {
  fetch("http://localhost:5000/features")
    .then(res => res.json())
    .then(data => {
      const container = document.getElementById('input-container');

      const placeholders = {
        "baseline value": "110-160 bpm",
        "accelerations": "0-0.02",
        "prolongued decelerations": "0-0.01",
        "abnormal short term variability": "12-87 (%)",
        "mean value of short term variability": "3-6",
        "percentage of time with abnormal long term variability": "0-20 (%)",
        "histogram mode": "120-150",
        "histogram mean": "110-150",
        "histogram median": "110-140",
        "histogram variance": "0-20 (%)"
      };

      const descriptions = {
        "baseline value": "Detak jantung rata-rata janin saat istirahat. Normal: 110-160 bpm. Di bawah 110 atau di atas 160 bisa menandakan masalah.",
        "accelerations": "Frekuensi peningkatan sementara detak jantung janin. Normal: 0.001-0.02. Semakin tinggi, semakin baik respons janin.",
        "prolongued decelerations": "Penurunan detak jantung yang berlangsung lama. Normal: 0-0.005. Nilai di atas 0.01 bisa berisiko.",
        "abnormal short term variability": "Persentase waktu detak jantung janin menunjukkan variasi tidak normal dalam jangka pendek. Normal: 12-87%.",
        "mean value of short term variability": "Rata-rata variasi detak jantung dalam jangka pendek. Normal: 3-6. Semakin rendah bisa menandakan kondisi tidak stabil.",
        "percentage of time with abnormal long term variability": "Persentase waktu variasi detak jantung jangka panjang yang tidak normal. Normal: 0-20% (Waspada jika > 40%). Nilai tinggi bisa mengindikasikan stres janin.",
        "histogram mode": "Nilai yang paling sering muncul dalam histogram detak jantung janin. Normal: 120 - 150 bpm. Nilai ekstrem bisa menandakan anomali pola detak jantung.",
        "histogram mean": "Rata-rata detak jantung janin selama pemantauan. Normal: 110 - 150 bpm. Nilai di luar rentang normal bisa menunjukkan hipoksia atau stres janin.",
        "histogram median": "Titik tengah distribusi detak jantung janin. Normal: 110 - 140 bpm. Median sering digunakan untuk menilai keseimbangan data yang mungkin mengandung outlier.",
        "histogram variance": "Mengukur seberapa besar fluktuasi detak jantung janin dari waktu ke waktu. Normal: 5 - 20 (>30 patut diwaspadai). Variansi tinggi bisa menandakan ketidakstabilan janin."
      };

      data.selected_features.forEach(feature => {
        const readableName = feature.replace(/_/g, " ");
        const placeholderText = placeholders[readableName] || "Masukkan nilai";
        const descriptionText = descriptions[readableName] || "Deskripsi tidak tersedia";

        const wrapper = document.createElement("div");
        wrapper.style.marginBottom = "16px";

        const label = document.createElement("label");
        label.textContent = readableName;

        const smallText = document.createElement("small");
        smallText.textContent = descriptionText;
        smallText.style.display = "block";
        smallText.style.marginBottom = "4px";
        smallText.style.color = "#888";

        const input = document.createElement("input");
        input.type = "number";
        input.name = feature;
        input.step = "any";
        input.required = true;
        input.placeholder = placeholderText;

        wrapper.appendChild(label);
        wrapper.appendChild(smallText);  // ⬅️ Deskripsi di atas input
        wrapper.appendChild(input);
        container.appendChild(wrapper);
      });
    });
};


  document.getElementById('fetal-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const input = {};
    [...this.elements].forEach(el => {
      if (el.name && el.type === "number") input[el.name] = parseFloat(el.value);
    });

    fetch("http://localhost:5000/predict", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(input)
    })
    .then(res => res.json())
    .then(data => {
      if (data.error) {
        alert("Error: " + data.error);
        return;
      }

      const tableBody = document.getElementById("model-results");
      tableBody.innerHTML = "";

      const notes = {
        Normal: 'Janin dalam kondisi sehat.',
        Suspect: 'Ada tanda yang perlu diawasi. Konsultasikan ke dokter.',
        Pathological: 'Kemungkinan ada masalah serius. Segera periksa ke dokter.'
      };
      const bgColor = {
        Normal: "#ccc", Suspect: "#ffeb3b", Pathological: "#f44336"
      };

      data.results.forEach(result => {
        const row = `<tr><td>${result.model.replace(/_/g, " ")}</td><td>${result.label}</td><td>${result.accuracy}%</td></tr>`;
        tableBody.innerHTML += row;
      });

      const best = data.results.reduce((a, b) => (a.accuracy > b.accuracy ? a : b));
      document.getElementById('prediction').textContent = `Status Janin (terakurat: ${best.model.replace(/_/g, " ")}): ${best.label}`;
      document.getElementById('accuracy').textContent = `Akurasi terbaik: ${best.accuracy}%`;
      document.getElementById('note-container').innerHTML =
        `<div style="background:${bgColor[best.label]}; color:#000; padding:10px; margin-top:10px; border-radius:5px;">${notes[best.label]}</div>`;

      const paramTable = document.getElementById('result-table');
      paramTable.innerHTML = '';
      for (let key in input) {
        paramTable.innerHTML += `<tr><td>${key.replace(/_/g, ' ')}</td><td>${input[key]}</td></tr>`;
      }

      document.getElementById('result-box').style.display = 'block';
    })
    .catch(err => {
      alert("Gagal memproses prediksi.");
      console.error(err);
    });
  });

  function resetForm() {
    document.getElementById('fetal-form').reset();
    document.getElementById('result-box').style.display = 'none';
  }
</script>

</body>
</html>