<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIKO AIS</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <script type="module" src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine-ie11.min.js" defer></script>
</head>

<body class="pb-5">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">VIKO AIS</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <?php $_user = $_SESSION["user"];?>
                        <?php if (isset($_user) && $_user !== null): ?>
                        <?php $_user = unserialize($_user);?>

                        <?php if ($_user->role === "Admin"): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/Admin/Users">Vartotojai</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Admin/Groups">Grupės</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Admin/Courses">Dalykai</a>
                        </li>
                        <?php endif;?>

                        <li class="nav-item">
                            <a class="nav-link" href="/Authentication/Logout">Atsijungti</a>
                        </li>

                        <?php else: ?>

                        <li class="nav-item">
                            <a class="nav-link" href="/Authentication/Login">Prisijungti</a>
                        </li>

                        <?php endif;?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-5">