<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title><?= ucfirst($_GET['page']) ?> - Web app</title>
</head>
<body>
<header>
    <div id='logo'><a href="index.php?page=home">Logo</a></div>
    <nav>
        <ul>
            <li class='hover'><a href="index.php?page=locations">Locations</a></li>
            <li class='hover'><a href="#">List item</a></li>
            <li class='hover'><a href="#">List item</a></li>
        </ul>
    </nav>
    <div id='options'>
        <?php if (empty($_SESSION['user'])): ?>
        <li class='hover'><a href="index.php?page=login">Login</a></li>
        <li class='hover'><a href="index.php?page=signup">Signup</a></li>
        <?php else: ?>
        <li class='hover'><a href="index.php?page=logout">Logout</a></li>
        <?php endif; ?>
    </div>
</header>
<main>