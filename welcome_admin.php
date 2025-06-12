<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Pakar Diagnosis Mata</title>
    <style>
        body {
            background: url('/Diagnosis_mata/assets/img/putih.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .welcome {
            display: flex;
            gap: 5%;
            margin: 50px;
            padding: 20px;
            align-items: center;
            justify-content: center;
        }

        .admin {
            padding: 40px;
            box-shadow: 2px 1px 2px 1px #888888;
        }

        #typewriter {
            font-size: 32px;
            font-weight: bold;
            white-space: nowrap;
            overflow: hidden;
            border-right: 3px solid black;
            width: fit-content;
        }

        @keyframes blink {
            0%, 100% { border-color: black; }
            50% { border-color: transparent; }
        }

        .gambar {
            padding: 20px;
            border-radius: 10px;
            gap: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .eyes {
            width: 40%;
            transition: transform 0.5s;
        }

        .eyes:hover {
            transform: scale(1.2);
        }

        @media (max-width: 768px) {
            .welcome {
                margin: 20px;
                flex-direction: column;
            }

            .eyes {
                width: 60%;
            }

            .admin {
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            .eyes {
                width: 80%;
            }
        }
    </style>
</head>
<body>
    <div class="welcome">
        <div class="admin">
            <h1 id="typewriter"></h1>
        </div>
        <div class="gambar">
            <img class="eyes" src="/Diagnosis_mata/assets/img/eyes-removebg-preview.png" alt="Ilustrasi Mata">
            <img class="eyes" src="/Diagnosis_mata/assets/img/eyes-removebg-preview.png" alt="Ilustrasi Mata">
        </div>
    </div>

    <script>
        const text = "WELCOME HOME, Admin";
        let i = 0;

        function typeWriter() {
            if (i < text.length) {
                document.getElementById("typewriter").innerHTML += text.charAt(i);
                i++;
                setTimeout(typeWriter, 100); // 100 ms per huruf
            } else {
                document.getElementById("typewriter").style.animation = "blink 0.75s step-end infinite";
            }
        }

        window.onload = typeWriter;
    </script>
</body>
</html>
