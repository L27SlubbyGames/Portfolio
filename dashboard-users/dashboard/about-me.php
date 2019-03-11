<!DOCTYPE html>
<html>
    <head>
        <?php 
            require("../core/header.php");
            $about_me_db = $connect->prepare("SELECT info FROM about_me_info WHERE id=1");
            $about_me_db->execute();
            $about_me = $about_me_db->fetch();
            $skill_db = $connect->prepare("SELECT skill FROM about_me_skill");
            $skill_db->execute();
            $skill = $skill_db->fetchAll();
            $project_db = $connect->prepare("SELECT * FROM project");
            $project_db->execute();
            $project = $project_db->fetchAll();
        ?>
    </head>
    <body id="overflow">
        <header>
            <nav>
                <?php require("../core/nav-bar.php") ?>
            </nav>
        </header>
        <main id="about_me_page">
            <div class="background_fog">
                <img src="img/fog-4.png" alt="fog_4" id="fog">
                <img src="img/fog-3.png" alt="fog_3" id="fog">
            </div>
            <div id="about_me_box">
                <div id="about_me">
                    <div id="my_picture"></div>
                    <h3 id="title_about_me">About Me:</h3>
                </div>
                <hr id="line_5">
                <div id="my_text_box">
                    <p id="my_info"><?= $about_me['info'] ?></p>
                    <h6 id="my_skill">
                        SKILLS:<br>
                    <?php foreach($skill as $row): ?>
                        - <?= $row['skill'] ?><br>
                    <?php endforeach?>
                    </h6>
                </div>
                <?php foreach($project as $row): ?>
                <div id="project">
                    <h5 id="project_title"><?= $row['title'] ?><a id="project_link" href="<?= $row['link'] ?>" target="_blank">CLICK HERE</a></h5>
                    <h6 id="project_subtitle"><?= $row['subtitle'] ?></h6>
                    <p id="project_title_text"><?= $row['info'] ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </main>
        <footer>
            <?php require("../core/footer.php") ?>
        </footer>
    </body>
</html>