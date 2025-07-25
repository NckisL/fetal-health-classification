<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>prediksi Kesehatan janin</title>
    <style>
        .title {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 20px;
            font-size: 2.5em;
            font-weight: bold;
        }
        .card {
            background: #007BFF; /* Biru yang lebih terang */
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            margin-bottom: 25px;
            padding: 25px;
            color: white;
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px); /* Efek hover pada kartu */
        }
        h2 {
            color: #FFD700;
            margin-top: 0;
            font-size: 1.8em;
            text-align: center;
        }
        .Paragraf {
            margin: 10px 0;
            line-height: 1.8;
            font-size: 1.1em;
            text-align: justify;
        }
        .creator-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .creator {
            display: flex;
            align-items: center;
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            color: #333;
            transition: transform 0.2s;
        }
        .creator:hover {
            transform: scale(1.03); /* Efek hover pada pembuat */
        }
        .creator img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-right: 15px;
            border: 2px solid #4682B4;
        }
        .creator-info {
            display: flex;
            flex-direction: column;
        }
        .creator-info strong {
            font-size: 1.2em;
            color: #007BFF; /* Warna nama pembuat */
        }
        .creator-info span {
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="title">Prediksi Kesehatan Janin</h1>

    <div class="card">
        <h2>About</h2>
        <div class="Paragraf">
        Aplikasi ini merupakan sistem berbasis web yang menggunakan algoritma machine learning Random Forest untuk memprediksi kesehatan janin. Prediksi dilakukan berdasarkan sejumlah parameter medis seperti nilai detak jantung dasar, percepatan detak jantung, gerakan janin, kontraksi rahim, serta variabilitas jangka pendek dan panjang.
        </div>
        <div class="Paragraf">
        Algoritma Random Forest bekerja dengan menggabungkan banyak pohon keputusan untuk menghasilkan hasil prediksi yang lebih akurat dan stabil. Setiap pohon memberikan prediksi, dan sistem akan menentukan hasil akhir berdasarkan mayoritas dari seluruh pohon tersebut.
        </div>
        <div class="Paragraf">
        Tujuan dari aplikasi ini adalah untuk membantu tenaga medis dan orang tua dalam memantau kondisi janin secara dini, sehingga potensi risiko dapat diketahui lebih cepat dan penanganan yang tepat bisa segera diberikan.
        </div>
    </div>
    
    <div class="card">
        <h2>Pembuat Website</h2>
        <div class="creator-section">
            <div class="creator">
                <img src="assets/Pembuat 1.png" alt="Pencipta 1">
                <div class="creator-info">
                    <strong>Yohanes Saputra</strong>
                    <span>412022009</span>
                </div>
            </div>
            <div class="creator">
                <img src="assets/Pembuat 2.png" alt="Pencipta 2">
                <div class="creator-info">
                    <strong>Henokh Eleazar</strong>
                    <span>412022015</span>
                </div>
            </div>
            <div class="creator">
                <img src="assets/Pembuat 3.jpg" alt="Pencipta 3">
                <div class="creator-info">
                    <strong>Nicholas Agustinus</strong>
                    <span>412022014</span>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
