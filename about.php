<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Pakar Diagnosis Mata</title>
    <style>

        body {
            display: flex;
            flex-direction: column;
            background: url('/Diagnosis_mata/assets/img/putih.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .welcome {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            gap: 50px;
        }

        .text-welcome {
            border-radius: 10px;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .text-welcome h1 {
            font-family: "Lucida Console", "Courier New", monospace;
            margin-bottom: 10px;
            font-size: 40px;
        }

        .text-welcome h3 {
            font-weight: normal;
            font-size: 18px;
            color: #333;
        }

        .gambar {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .ada {
            margin:20px;
            border-radius:10px;
            padding:20px;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .gambar img {
            width: 120px;
            box-shadow: 0 0 10px rgba(1, 2, 2, 0.1);
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .gambar img:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .footer {
            background-color: rgba(0, 0, 0, 0.85);
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .welcome {
                flex-direction: column;
                text-align: center;
            }

            .gambar {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="welcome">
            <div class="text-welcome">
                <h1>SISTEM PAKAR</h1>
                <h3>Diagnosis penyakit pada mata menggunakan Metode Forward Chaining</h3>
            </div>
            <div class="gambar">
                <img src="/Diagnosis_mata/assets/img/eyes-removebg-preview.png" alt="Ilustrasi Mata">
                <img src="/Diagnosis_mata/assets/img/eyes-removebg-preview.png" alt="Ilustrasi Mata">
            </div>
        </div>
        <div class="ada">
            <p>Mata adalah salah satu indera paling vital dalam kehidupan manusia.
               Dengan mata, kita bisa melihat keindahan dunia, membaca, belajar, hingga berinteraksi dengan lingkungan sekitar.
               Namun, tidak semua orang menyadari pentingnya menjaga kesehatan mata.
               Banyak orang baru menyadari fungsinya ketika mata mulai mengalami gangguan atau penyakit.
            </p>
            <p>Penyakit mata dapat menyerang siapa saja, dari anak-anak hingga orang dewasa.
               Beberapa penyakit mata umum seperti rabun jauh (miopia), rabun dekat (hipermetropi), dan astigmatisme kerap dianggap sepele, padahal jika dibiarkan dapat memengaruhi kualitas hidup.
               Sementara itu, ada pula penyakit mata yang lebih serius seperti katarak, glaukoma, dan degenerasi makula yang dapat menyebabkan kebutaan permanen jika tidak ditangani dengan cepat dan tepat.
            </p>
        </div>
    </div>
</body>
</html>
