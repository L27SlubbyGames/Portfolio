<!DOCTYPE html>
<html>
    <head>
        <?php require("../core/header.php") ?>
    </head>
    <body id="overflow">
        <header>
            <nav>
                <?php require("../core/nav-bar.php") ?>
            </nav>
        </header>
        <main id="index_page">
            <div class="background_fog">
                <img src="img/fog-1.png" alt="fog_1" id="fog">
                <img src="img/fog-2.png" alt="fog_2" id="fog">
                <img src="img/fog-3.png" alt="fog_3" id="fog">
            </div>
            <div id="index_page_info">
                <h1 class="my_name">Pascal</h1>
                <h1 class="my_name"> Huberts</h1>
                <h2 id="name_category">PORTFOLIO</h2>
                <hr id="line_3">
                <hr id="line_4">
                <h4 id="functions">Application Developer /<br>Web-Designer.</h4>
                <div id="social_media">
                    <a class="social_media_link" href="https://github.com/L27SlubbyGames" target="_blank"><i class="fab fa-github"></i></a>
                    <a class="social_media_link" href="https://linkedin.com/in/pascal-huberts-b1a602179" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a class="social_media_link" href="https://twitter.com/L27_SlubbyGames?lang=nl&lang=nl" target="_blank"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </main>
        <footer>
            <?php require("../core/footer.php") ?>
        </footer>
    </body>
</html>