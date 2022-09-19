<?php

function getAbsolutePath(){
    return "http://localhost:8090/to_mane";
}
function connect() {
    $DB_HOST = 'localhost';
    $DB_USER = 'root';
    $DB_PASS = '';
    $DB_PORT = '3308';
    $DB_NAME = 'learn_crud_mvc';
    //return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);

    try{
        $conn = new PDO('mysql:host='.$DB_HOST.'; port='.$DB_PORT.'; dbname='.$DB_NAME.';charset=utf8',$DB_USER,$DB_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
    catch(PDOException $e){
        echo "Connection error ".$e->getMessage(); 
        exit;
    }
}

function public_header($title = "Gestion des ressources", $url = "http://localhost:8090/to_mane/public", $burl = "http://localhost:8090/to_mane") {
    echo <<<EOT
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="">
            <title>$title</title>
            <link href="$url/css/bootstrap.min.css" rel="stylesheet">
            <link href="$url/css/style.css" rel="stylesheet">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        </head>
        <body>
        <header class="container py-2">
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" class="me-2" viewBox="0 0 118 94" role="img"><title>Bootstrap</title><path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z" fill="currentColor"></path></svg>
                <span class="fs-4">Gestion des ressources</span>
                </a>
        
                <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <a class="me-3 py-2 text-dark text-decoration-none" href="$burl/site/programme.php">Programme</a>
                <a class="me-3 py-2 text-dark text-decoration-none" href="#">Modules</a>
                <a class="me-3 py-2 text-dark text-decoration-none" href="#">Cours</a>
                <button type="button" class="btn btn-outline-primary">Connexion</button>
                
                </nav>
            </div>
            <section class="text-center">
                <div class="row">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Rechercher une ressource</h1>
                    <p>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Exemple: XML avancée" aria-label="Search">
                            <button class="btn btn-outline-primary" type="submit">Search</button>
                        </form>
                    </p>
                </div>
                </div>
            </section>
        </header>
    EOT;
}

function public_auth_header($title = "Gestion des ressources", $url = "http://localhost:8090/to_mane/public", $burl = "http://localhost:8090/to_mane") {
    echo <<<EOT
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="">
            <title>$title</title>
            <link href="$url/css/bootstrap.min.css" rel="stylesheet">
            <link href="$url/css/style.css" rel="stylesheet">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        </head>
        <body>
        <header class="container py-2">
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" class="me-2" viewBox="0 0 118 94" role="img"><title>Bootstrap</title><path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z" fill="currentColor"></path></svg>
                <span class="fs-4">Gestion des ressources</span>
                </a>
        
                <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <a class="me-3 py-2 text-dark text-decoration-none" href="$burl/site/programme.php">Programme</a>
                <a class="me-3 py-2 text-dark text-decoration-none" href="#">Modules</a>
                <a class="me-3 py-2 text-dark text-decoration-none" href="#">Cours</a>
                <button type="button" class="btn btn-outline-primary">Connexion</button>
                
                </nav>
            </div>
            <section class="text-center">
                <div class="row">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Rechercher une ressource</h1>
                    <p>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Exemple: XML avancée" aria-label="Search">
                            <button class="btn btn-outline-primary" type="submit">Search</button>
                        </form>
                    </p>
                </div>
                </div>
            </section>
        </header>
    EOT;
}

function template_footer($url = "http://localhost:8090/to_mane/public") {
    echo <<<EOT
    <footer class="text-muted py-1">
    <div class="container">
        <p class="float-end mb-0">
            <a href="#">Revenir en haut</a>
        </p>
        <p class="mb-0">Gestion des ressources &copy;</p>
    </div>
    </footer>
    <script src="$url/js/bootstrap.bundle.min.js"></script>
        </body>
    </html>
    EOT;
}