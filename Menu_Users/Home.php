<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prediksi Kualitas Susu</title>
  <style>
    body {
      text-align: justify;
    }

    /* Navbar tetap full‑width */
    header {
      background-color: #3f51b5;
      padding: 20px;
      text-align: center;
      color: white;
      border-radius: 10px;
    }
    header img {
      height: 40px;
      vertical-align: middle;
      margin-right: 10px;
    }
    h1 {
      font-size: 24px;
      display: inline;
    }

    /* Batasi lebar konten utama */
    main {
      max-width: 1700px;
      margin: 20px auto; /* jarak atas‑bawah 40px, auto kiri‑kanan */
      padding: 0 20px;
    }

    section {
      margin-bottom: 10px;
    }

    h2 {
      font-size: 20px;
      border-bottom: 3px solid #00bcd4;
      padding-bottom: 5px;
      margin-top: 2px;
      display: inline-block;
    }

    ul {
      padding-left: 20px;
    }

    p, li {
      font-size: 16px;
      line-height: 1.6;
      text-align: justify;
    }
  </style>
</head>
<body>

  <header>
    <h1>Prediksi Kesehatan Janin</h1>
  </header>

  <main>
  <section>
    <h2>Latar Belakang</h2>
    <p>
      Kesehatan janin merupakan faktor krusial yang menentukan kelangsungan hidup bayi serta kesejahteraan ibu selama masa kehamilan. Deteksi dini terhadap gangguan kesehatan janin sangat penting untuk intervensi medis yang tepat waktu. Salah satu metode yang digunakan untuk memantau kondisi janin adalah kardiotokografi (CTG), yang merekam aktivitas detak jantung janin dan kontraksi rahim ibu. Analisis data CTG ini dilakukan oleh tenaga medis untuk menilai kondisi janin apakah normal, mencurigakan, atau patologis. Namun, interpretasi manual dapat memakan waktu dan bersifat subjektif.
    </p>
    <p>
      Teknologi machine learning menawarkan solusi untuk meningkatkan akurasi dan efisiensi dalam analisis data CTG. Dengan melatih algoritma menggunakan dataset CTG, sistem berbasis machine learning dapat mengidentifikasi pola tersembunyi dan mengklasifikasikan kondisi kesehatan janin secara otomatis dan konsisten. Penelitian ini menggunakan dataset “Fetal Health Classification” dari Kaggle, yang terdiri dari lebih dari 2.126 data CTG dengan label klasifikasi (Normal, Suspect, Pathological).
    </p>
    <p>
      Penelitian ini membandingkan performa tiga algoritma machine learning: Naive Bayes, Decision Tree, dan Random Forest. Naive Bayes adalah algoritma probabilistik yang sederhana dan efisien, Decision Tree berbasis aturan yang mudah dianalisis, dan Random Forest adalah metode ansambel yang menggabungkan beberapa pohon keputusan untuk meningkatkan akurasi dan mengurangi overfitting. 
    </p>
  </section>


  <section>
    <h2>Rumusan Masalah</h2>
    <ul>
      <li>Bagaimana cara memanfaatkan dataset Fetal Health Classification untuk memprediksi tingkat kesehatan janin berdasarkan fitur-fitur hasil pemeriksaan kardiotokografi (CTG), seperti baseline fetal heart rate, akselerasi, deselerasi, dan kontraksi uterus?</li>
      <li>Seberapa akurat algoritma Naive Bayes, Decision Tree, dan Random Forest dalam mengklasifikasikan tingkat kesehatan janin ke dalam kategori Normal, Suspect, atau Pathological?</li>
      <li>Algoritma machine learning manakah yang memberikan performa terbaik dalam klasifikasi kesehatan janin berdasarkan evaluasi menggunakan metrik akurasi, precision, recall, dan F1-score?</li>
    </ul>
  </section>

  <section>
    <h2>Tujuan Penelitian</h2>
    <ul>
      <li>
        Memprediksi tingkat kesehatan janin berdasarkan fitur-fitur kardiotokografi (CTG) dalam dataset Fetal Health Classification, seperti detak jantung dasar, akselerasi, deselerasi, dan kontraksi uterus, guna memahami kondisi janin secara dini dan akurat.
      </li>
      <li>
        Menganalisis dan membandingkan efektivitas tiga algoritma machine learning yaitu Naive Bayes, Decision Tree, dan Random Forest dalam mengklasifikasikan tingkat kesehatan janin ke dalam kategori Normal, Suspect, dan Pathological, untuk menentukan algoritma yang paling optimal dalam mendukung pengambilan keputusan medis.
      </li>
    </ul>
  </section>


  <section>
    <h2>Manfaat Penelitian</h2>
    <ul>
      <li>
        Penelitian ini dapat membantu dalam pengembangan sistem deteksi dini yang lebih akurat untuk memantau kesehatan janin berdasarkan hasil pemeriksaan kardiotokografi (CTG), yang memungkinkan identifikasi potensi masalah kesehatan pada janin lebih awal.
      </li>
      <li>
        Dengan memanfaatkan algoritma machine learning untuk mengklasifikasikan tingkat kesehatan janin, penelitian ini dapat memberikan dukungan kepada tenaga medis dalam membuat keputusan yang lebih cepat dan tepat, sehingga mengurangi risiko komplikasi pada kehamilan dan melahirkan.
      </li>
      <li>
        Hasil dari penelitian ini dapat memberikan wawasan lebih dalam mengenai faktor-faktor yang mempengaruhi kesehatan janin, seperti pola detak jantung dan gerakan janin, serta membantu dokter dalam merancang perawatan yang lebih tepat sesuai dengan kondisi janin.
      </li>
    </ul>
  </section>

  </main>

</body>
</html>
