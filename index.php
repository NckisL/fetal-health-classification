<?php
session_start();
$current_page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="assets/logo.png">
    <?php include('bootstrap/bootstrap.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        window.onload = function() {
            <?php if (isset($_SESSION['pesan'])): ?>
                alert("<?php echo $_SESSION['pesan']; ?>");
                <?php unset($_SESSION['pesan']); 
                ?>
            <?php endif; ?>
        }
    </script>
    <title>Prediksi Kesehatan Janin</title>
    <style>
    html, body {
        height: 100%;
        font-family: Arial, sans-serif;
        background: rgb(0, 0, 0);
        color: white;
        margin: 0;
        padding: 0;
    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    main {
        flex: 1;
        padding: 20px; /* Jarak kanan-kiri dan atas-bawah */
    }

    footer {
        background-color:rgb(92, 93, 94);
        text-align: center;
        padding: 10px 0;
        font-size: 20px;
        margin-top: 50px;
    }

    .navbar .nav-link {
        color: black !important;
        font-size: 18px;
    }

    .navbar .nav-link.active {
        color:rgb(0, 70, 248) !important;
        font-weight: bold;
    }
</style>

</head>
<body>
    <nav>
        <?php include "nav.php"; ?>
    </nav>
    <main>
        <section>
            <?php
            $content = "Users/home.php"; // Default content
            $mod = "";
            if (isset($_GET['page'])) {
                $mod = $_GET['page'];
            }

            switch ($mod) {
                case "Da":
                    $content = "Menu_Users/Dataset.php";
                    break;
                case "Pd":
                    $content = "Menu_Users/prediksi.php";
                    break;
                case "Pr":
                    $content = "Menu_Users/Profile.php";
                    break;
                default:
                    $content = "Menu_Users/home.php";
            }
            include($content);
            ?>
        </section>
        </main>
    <footer>
        <div>&copy; 2025 Prediksi Kesehatan Janin. All rights reserved.</div>
    </footer>
</body>
</html>