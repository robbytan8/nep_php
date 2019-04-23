<!DOCTYPE html>
<html>
<head>
    <title>PHP Programming</title>
    <link rel="stylesheet" href="styles/style.css" />
</head>
<body>
    <div class="page">
        <nav>
            <a href="?mn=home">Home</a>
            <a href="?mn=about">About</a>
        </nav>
        <main>
            <?php
            $menu = filter_input(INPUT_GET, 'mn');
            switch ($menu) {
                case 'home':
                    include_once 'home.php';
                    break;
                case 'about':
                    include_once 'about.php';
                    break;
                default:
                    include_once 'home.php';
                    break;
            }
            ?>
        </main>
        <footer>
            Created by ...
        </footer>
    </div>
</body>
</html>
