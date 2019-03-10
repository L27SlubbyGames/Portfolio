<!DOCTYPE html>
<html>
    <head>
        <?php 
            require("../core/header.php");
            $work = $connect->prepare("SELECT * FROM works");
            $work->execute();
            $rows = $work->fetchAll();
        ?>
    </head>
    <body>
        <header>
            <nav>
                <?php require("../core/nav-bar.php") ?>
            </nav>
        </header>
        <main id="my_work_page">
            <h3 id="work_title">MY WORK:</h3>
            <div id="work_center">
                <?php foreach($rows as $row): ?>
                <div id="work_box">
                    <img id="work_picture" src="img/work/<?= $row['picture'] ?>" alt="work_picture">
                    <h5 id="work_subtitle"><?= $row['title'] ?></h5>
                    <a id="work_link" href="<?= $row['link'] ?>" target="_blank"><h5 id="work_text"><i class="fab fa-github"></i>Github</h5></a>
                </div>
                <?php endforeach; ?>
            </div>
        </main>
        <footer>
            <?php require("../core/footer.php") ?>
        </footer>
    </body>
</html>