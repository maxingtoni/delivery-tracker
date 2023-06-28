<?php

echo "
    <form action='src/inc/formHandler.inc.php' method='POST'>
        <input type='hidden' name='action' value='location-add'>
        <input type='hidden' name='user_id' value='{$_SESSION['user']['id']}'>
        <input type='hidden' name='coordinates' id='coordinates' value=''>
        <input type='submit' value='Add your current location'>
    </form>
";