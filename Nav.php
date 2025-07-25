<?php
    $current_page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
        <img src="assets/logo.png" alt="Logo" width="80" height="80" class="d-inline-block align-text-top">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page === 'home' ? 'active' : ''; ?>"
                            aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page === 'Da' ? 'active' : ''; ?>"
                            href="index.php?page=Da">Dataset</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page === 'Pd' ? 'active' : ''; ?>"
                            href="index.php?page=Pd">Prediksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $current_page === 'Pr' ? 'active' : ''; ?>"
                            href="index.php?page=Pr">Profile</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>

