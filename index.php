<?php
include_once 'db_function/func_org.php';
include_once 'db_function/func_peg.php';
include_once 'util/DBUtil.php';

session_start();
if (!isset($_SESSION['user_abc'])) {
    $_SESSION['user_abc'] = FALSE;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP Programming</title>
    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.18/datatables.min.css"/>
    <script src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.18/datatables.min.js"></script>
    <script type="text/javascript" src="js/my.js"></script>
</head>
<body>
    <div class="page">
        <?php
        if (!$_SESSION['user_abc']) {
            include_once 'login.php';
        } else {
        ?>
        <nav>
            <a href="?mn=home">Home</a>
            <a href="?mn=org">Kelola Organisasi</a>
            <a href="?mn=peg">Kelola Pegawai</a>
            <a href="?mn=about">About</a>
            <a href="?mn=logout">Logout</a>
        </nav>
        <main>
            <?php
            $menu = filter_input(INPUT_GET, 'mn');
            switch ($menu) {
                case 'home':
                    include_once 'home.php';
                    break;
                case 'org':
                    include_once 'manage_org.php';
                    break;
                case 'orgu':
                    include_once 'update_org.php';
                    break;
                case 'peg':
                    include_once 'manage_pegawai.php';
                    break;
                case 'pegu':
                    include_once 'update_peg.php';
                    break;
                case 'about':
                    include_once 'about.php';
                    break;
                case 'logout':
                    session_unset();
                    session_destroy();
                    header("location:index.php");
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
        <?php
        }
        ?>
    </div>
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    } );
    </script>
</body>
</html>
