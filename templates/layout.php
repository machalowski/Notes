<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link href="/public/style.css" rel="stylesheet">
    <title>Notes</title>
</head>

<body class="body">
    <div class="wrapper">
        <div class="header">
            <h1><i class="far fa-clipboard"></i>Moje notatki</h1>
        </div>

        <div class="container">
            <div class="menu">
                <ul>
                    <li><a href="/">Strona główna</a></li>
                    <li><a href="/?action=create">Nowa notatka</a></li>
                </ul>
            </div>

            <div class="page">
                <?php

                // $filename = "templates/pages/$page.php";

                // if (file_exists($filename)) {
                    require_once("templates/pages/$page.php");
                // } else header('Location: /'); 
                ?>
            </div>
        </div>

        <div class="footer">
            <p>Notatki - projekt w kursie PHP</p>
        </div>   
    </div>
</body>

</html>