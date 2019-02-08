<!doctype html>
    <head>
        <link href="/assets/css/stylesheet.css" rel="stylesheet">
        <script src="/assets/js/script.js" type="text/javascript"></script>
    </head>
    <body>
        <main role="main" class="container">
            <div class="view">
                <div class="heading">
                    <h1>HardwareInfo - Artikelen en reacties</h1>
                    <div class="navigation-bar">
                        <?php if ( isset($_SESSION['account']) && $_SESSION['account']['loggedIn'] === true ) { ?>
                            <div><p>Ingelogd als <?= $_SESSION['account']['name']; ?>. <a href="/Account/logout">Log uit</a></p></div>
                        <?php } else { ?>
                            <div><p>Momenteel niet ingelogd. <a href="/Account/login/1">Login als Bryan</a></p></div>
                        <?php }
                            // When content_for_layout is set, homepage isn't being viewed.
                            if ( $_SERVER['REQUEST_URI'] !== '/' ) { ?>
                            <a class="button nav-back" href="/">Terug naar het artikeloverzicht</a>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <?= $content_for_layout; ?>
            </div>
        </main>
    </body>
</html>
