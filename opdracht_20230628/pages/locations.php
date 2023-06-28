<?php

if (!isset($_SESSION['user'])) {
    Redirect::to();
}

Dbh::createPdo();
$location = new Location(Dbh::getPdo());

$locations = $location->getUserLocations($_SESSION['user']['id']);

echo "
    <form action='src/inc/formHandler.inc.php' method='POST'>
        <input type='hidden' name='action' value='location-add'>
        <input type='hidden' name='user_id' value='{$_SESSION['user']['id']}'>
        <input type='hidden' name='coordinates' id='coordinates' value=''>
        <input type='submit' value='Add your current location'>
    </form>
";
echo "<div id='locations'>";
foreach ($locations as $locat) {
    echo "
        <div class='location'>
            <p id='region'>{$locat['region']}</p>
            <p id='coordinates'>{$locat['coordinates']}</p>
            <iframe width='600' height='500' id='gmap_canvas' src='https://maps.google.com/maps?q={$locat['coordinates']}&t=&z=13&ie=UTF8&iwloc=&output=embed' frameborder='0' scrolling='no' marginheight='0' marginwidth='0'></iframe>
        </div>
    ";
}
echo "</div>";
echo "
    <script>
        const coordinates = document.getElementById('coordinates');

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

                const formattedCoords = `\${latDegrees}°\${latMinutes}′\${latSeconds}″\${latDirection} \${lonDegrees}°\${lonMinutes}′\${lonSeconds}″\${lonDirection}`;
                
                console.log(formattedCoords);
                coordinates.value = formattedCoords;
            });
        } else {
            console.log('Geolocation is not supported by this browser.');
        }
    </script>
";
