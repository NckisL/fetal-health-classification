<?php
// Path ke file CSV
$file = 'assets/fetal_health.csv';

// Inisialisasi array
$rawRows = [];
$processedRows = [];
$seen = [];

// Membaca file CSV
if (($handle = fopen($file, 'r')) !== false) {
    // Ambil header
    $header = fgetcsv($handle, 1000, ",");

    // Membaca setiap baris CSV
    while (($row = fgetcsv($handle, 1000, ",")) !== false) {
        // Simpan baris asli
        $rawRows[] = $row;
    }
    fclose($handle);
}

// Kolom yang akan dihapus saat preprocessing
$columnsToRemove = [
    'mean_value_of_long_term_variability',
    'histogram_width',
    'histogram_min',
    'histogram_max',
    'histogram_number_of_peaks',
    'histogram_number_of_zeroes',
    'fetal_movement',
    'uterine_contractions ',
    'light_decelerations',
    'severe_decelerations',
    'histogram_tendency',
    'uterine_contractions'
];

// Cari indeks kolom yang akan dihapus
$removeIndexes = [];
foreach ($header as $index => $col) {
    if (in_array($col, $columnsToRemove)) {
        $removeIndexes[] = $index;
    }
}

// Header setelah preprocessing (hapus kolom yang ditentukan)
$processedHeader = [];
foreach ($header as $index => $col) {
    if (!in_array($index, $removeIndexes)) {
        $processedHeader[] = $col;
    }
}

// Proses penghapusan kolom pada setiap baris
$processedRows = array_map(function ($row) use ($removeIndexes) {
    return array_values(array_filter($row, function ($key) use ($removeIndexes) {
        return !in_array($key, $removeIndexes);
    }, ARRAY_FILTER_USE_KEY));
}, $rawRows); // Gunakan $rawRows sebelum duplikat untuk menghapus kolom terlebih dahulu

// Hapus data duplikat setelah penghapusan kolom
$seen = [];
$processedRows = array_filter($processedRows, function ($row) use (&$seen) {
    $sig = implode('|', $row);  // Gunakan tanda pemisah untuk membedakan setiap nilai
    if (isset($seen[$sig])) {
        return false; // Jika sudah ada, hapus
    }
    $seen[$sig] = true;
    return true; // Jika belum ada, simpan
});
$processedRows = array_values($processedRows); // Reset indeks array setelah filter

// Statistik
$rawCount = count($rawRows);
$processedCount = count($processedRows);
$rawColCount = count($header);
$processedColCount = count($processedHeader);
$duplicateCount = $rawCount - $processedCount; // Menghitung selisih data duplikat

?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dataset Kesehatan Janin</title>
  <style>
    body { font-family: Arial, sans-serif; text-align: center; margin: 0; padding: 0; }
    
    /* Styling untuk tab menu */
    .tabs { 
      display: flex; 
      justify-content: center; 
      gap: 10px; 
      margin-bottom: 20px;
      position: sticky;  /* Menetapkan menu tetap di atas */
      top: 0;  /* Tetap di atas halaman saat scroll */
      z-index: 1000;  /* Agar tetap di atas konten lainnya */
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);  /* Memberikan bayangan untuk efek */
    }

    .tabs button {
      padding: 10px 20px;
      background: #3f51b5;
      color: #fff;
      border: none;
      cursor: pointer;
      border-radius: 5px;
      transition: background 0.3s ease;
    }

    .tabs button.active {
      background: #2c3e50;
    }

    /* Styling untuk tab content */
    .tab-content { 
      display: none; 
      overflow-x: auto; /* Untuk scroll horizontal pada tabel */
    }

    .tab-content.active { 
      display: block; 
    }

    table {
      width: 100%;
      max-width: 1700px;
      margin: 0 auto;
      border-collapse: collapse;
      background: #111;
    }

    th, td {
      padding: 8px 12px;
      border: 1px solid #333;
      text-align: left;
    }

    th { 
      background: #3f51b5; 
      color: #fff; 
    }

    tr:nth-child(even) td { 
      background: #222; 
    }

    tr:nth-child(odd) td { 
      background: #333; 
    }

    .row-number { 
      text-align: center; 
      font-weight: bold; 
    }
  </style>
</head>
<body>

  <h1>Dataset Kesehatan Janin</h1>
  <p><strong>Jumlah Dataset Asli:</strong> <?= $rawCount ?> data</p>
  <p><strong>Jumlah Kolom Asli:</strong> <?= $rawColCount ?> kolom</p>
  <p><strong>Jumlah Dataset Setelah Preprocessing:</strong> <?= $processedCount ?> data</p>
  <p><strong>Jumlah Kolom Setelah Preprocessing:</strong> <?= $processedColCount ?> kolom</p>
  <p><strong>Jumlah Data Duplikat yang Dihapus:</strong> <?= $duplicateCount ?> data</p>

  <!-- Navigasi Tab -->
  <div class="tabs">
    <button class="active" data-target="content-raw">Dataset Asli</button>
    <button data-target="content-processed">Dataset Setelah Preprocessing</button>
  </div>

  <!-- Dataset Asli -->
  <div id="content-raw" class="tab-content active">
    <table>
      <thead>
        <tr>
          <th class="row-number">No.</th>
          <?php foreach ($header as $col): ?>
            <th><?= htmlspecialchars($col) ?></th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <?php $index = 1; foreach ($rawRows as $row): ?>
          <tr>
            <td class="row-number"><?= $index++ ?></td>
            <?php foreach ($row as $cell): ?>
              <td><?= htmlspecialchars($cell) ?></td>
            <?php endforeach; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Dataset Setelah Preprocessing -->
  <div id="content-processed" class="tab-content">
    <table>
      <thead>
        <tr>
          <th class="row-number">No.</th>
          <?php foreach ($processedHeader as $col): ?>
            <th><?= htmlspecialchars($col) ?></th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <?php $index = 1; foreach ($processedRows as $row): ?>
          <tr>
            <td class="row-number"><?= $index++ ?></td>
            <?php foreach ($row as $cell): ?>
              <td><?= htmlspecialchars($cell) ?></td>
            <?php endforeach; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Script Tab -->
  <script>
    const buttons = document.querySelectorAll('.tabs button');
    const contents = document.querySelectorAll('.tab-content');

    buttons.forEach(button => {
      button.addEventListener('click', function () {
        buttons.forEach(btn => btn.classList.remove('active'));
        contents.forEach(content => content.classList.remove('active'));

        this.classList.add('active');
        const target = this.getAttribute('data-target');
        document.getElementById(target).classList.add('active');
      });
    });
  </script>

</body>
</html>
