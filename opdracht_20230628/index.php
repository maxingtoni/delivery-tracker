<?php
if (session_status() === PHP_SESSION_NONE) session_start();

# Document root
$_SERVER['DOCUMENT_ROOT'] = 'C:\xampp\htdocs\opdracht_20230628';

require_once "{$_SERVER['DOCUMENT_ROOT']}/src/core/init.core.php";


if (!isset($_GET['page']) || empty($_GET['page'])) {
    Redirect::to('index.php?page=home');
    exit;
}

$pageRenderer = new PageRenderer;
$pageRenderer->renderPage($_GET['page']);


$_SESSION['ERROR'] = [];
// print_r($_SESSION);

?>
<img src="./media/gigacat.png" class="gigacat">
<script>
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((pos) => {
            const latitude = pos.coords.latitude;
            const longitude = pos.coords.longitude;

            const latDegrees = Math.floor(latitude);
            const latMinutes = Math.floor((latitude - latDegrees) * 60);
            const latSeconds = Math.floor(((latitude - latDegrees) * 60 - latMinutes) * 60);
            const latDirection = latitude >= 0 ? 'N' : 'S';

            const lonDegrees = Math.floor(longitude);
            const lonMinutes = Math.floor((longitude - lonDegrees) * 60);
            const lonSeconds = Math.floor(((longitude - lonDegrees) * 60 - lonMinutes) * 60);
            const lonDirection = longitude >= 0 ? 'E' : 'W';

            const formattedCoords = `${latDegrees}°${latMinutes}′${latSeconds}″${latDirection} ${lonDegrees}°${lonMinutes}′${lonSeconds}″${lonDirection}`;
            
            console.log(formattedCoords);
        });
    } else {
        console.log("Geolocation is not supported by this browser.");
    }
</script>
