<!DOCTYPE html>
<html lang="it">

<head>
    <script src="js/search.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        <?php echo $templateParams["title"]; ?>
    </title>

    <meta charset="UTF-8" />
    <link href="css/style.css" type="text/css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <header>
        <h1>Appartamenti</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Prenotazioni</a></li><li><a href="clienti.php">Clienti</a></li><li><a href="gruppi.php">Gruppi</a></li><li><a href="listino.php">Listino</a></li><li><a href="showData.php">Dati</a></li>
        </ul>
    </nav>
    <main>
        <?php require($templateParams["nome"]); ?>
    </main>
    <footer>
        <p>Tecnologie Web - A.A. 2022/2023</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/afc94b6b63.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</body>

</html>