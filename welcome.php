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
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .welcome {
            flex: 1;
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
            font-size: 28px;
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
            padding: 20px 10px;
            text-align: center;
            font-size: 14px;
            margin-top: auto;
            width: 100%;
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

        <footer class="footer">
            <div class="footer-container">
                <p>&copy; 2025 Sistem Pakar Diagnosis Penyakit Mata. All rights reserved.</p>
                <p>Dikembangkan oleh Yoshua Gichara Eliazar</p>
            </div>
        </footer>
    </div>
</body>
</html>
