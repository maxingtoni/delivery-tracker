<?php

echo "
    <form action='src/inc/formHandler.inc.php' method='POST'>
        <input type='hidden' name='action' value='user-signup'>
        <input type='email' name='email' placeholder='Email here...'>
        <input type='password' name='password' placeholder='Password here...'>
        <input type='password' name='password-conf' placeholder='Password confirmation here...'>
        <input type='submit' value='Signup'>
        <a href='index.php?page=login'>Already have an account?</a>
    </form>
";