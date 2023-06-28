<?php

echo "
    <form action='src/inc/formHandler.inc.php' method='POST'>
        <input type='hidden' name='action' value='user-login'>
        <input type='email' name='email' placeholder='Email here...'>
        <input type='password' name='password' placeholder='Password here...'>
        <input type='submit' value='Login'>
        <a href='index.php?page=signup'>Don't have an account yet?</a>
    </form>
";