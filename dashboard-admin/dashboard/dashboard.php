<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/dashboard.min.css">
        <?php
            require("../core/header.php");
            $about_me_db = $connect->prepare("SELECT info FROM about_me_info WHERE id=1");
            $about_me_db->execute();
            $about_me = $about_me_db->fetch();
            $skill_db = $connect->prepare("SELECT skill FROM about_me_skill");
            $skill_db->execute();
            $skill = $skill_db->fetchAll();
            $project_db = $connect->prepare("SELECT title FROM project");
            $project_db->execute();
            $project = $project_db->fetchAll();
            $my_work_db = $connect->prepare("SELECT title FROM works");
            $my_work_db->execute();
            $my_work = $my_work_db->fetchAll();
            $project_title = '';
            $project_subtitle = '';
            $project_link = '';
            $project_info ='';
            $select_project_title = '';
            $my_work_title = '';
            $my_work_link = '';
            $select_my_work_title = '';
            if(isset($_POST['update_about_me'])){
                $text_about_me = $_POST['text_about_me'];
                $text_about_me_db = $connect->prepare("UPDATE about_me_info SET info = ? WHERE ID = ?");
                $text_about_me_db->execute(array($text_about_me,'1'));
                if($text_about_me_db){
                    header("Refresh:0");
                }
            }
            if(isset($_POST['register_skill_about_me'])){
                $skill_about_me = $_POST['skill_about_me'];
                $skill_about_me_db = $connect->prepare("INSERT INTO about_me_skill (skill) VALUE (?)");
                $skill_about_me_db->execute(array($skill_about_me));
                if($skill_about_me_db){
                    header("Refresh:0");
                }
            }
            if(isset($_POST['register_project'])){
                $title_project = $_POST['title_project'];
                $subtitle_project = $_POST['subtitle_project'];
                $info_project = $_POST['info_project'];
                $link_project = $_POST['link_project'];
                $register_project_db = $connect->prepare("INSERT INTO project (title,subtitle,info,link) VALUE (?,?,?,?)");
                $register_project_db->execute(array($title_project,$subtitle_project,$info_project,$link_project));
                if($register_project_db){
                    header("Refresh:0");
                }
            }
            if (isset($_POST['select_project'])) {
                $select_project_title = $_POST['select_project_title'];
                $select_project_db = $connect->prepare("SELECT * FROM project WHERE title = ?");
                $select_project_db->execute(array($select_project_title));
                $select_project = $select_project_db->fetch();
                $project_title = $select_project['title'];
                $project_subtitle = $select_project['subtitle'];
                $project_info = $select_project['info'];
                $project_link = $select_project['link'];
            }
            if(isset($_POST['update_project'])) {
                $select_project_title = $_POST['select_project_title'];
                $title_project = $_POST['title_project'];
                $subtitle_project = $_POST['subtitle_project'];
                $info_project = $_POST['info_project'];
                $link_project = $_POST['link_project'];
                $update_project_db = $connect->prepare("UPDATE project SET title = ?, subtitle = ?, info = ?, link = ? WHERE title = ?");
                $update_project_db->execute(array($title_project, $subtitle_project, $info_project, $link_project, $select_project_title));
                if ($update_project_db) {
                    header("Refresh:0");
                }
            }
            if(isset($_POST['register_my_work'])){
                $title_my_work = $_POST['title_my_work'];
                $link_my_work = $_POST['link_my_work'];
                $picture_my_work = $_FILES['picture_my_work']['name'];
                $register_my_work_db = $connect->prepare("INSERT INTO works (picture,title,link) VALUE (?,?,?)");
                $register_my_work_db->execute(array($picture_my_work,$title_my_work,$link_my_work));
                if($register_my_work_db){
                    $target_dir = "../../dashboard-users/core/img/work/";
                    $target_file = $target_dir . basename($_FILES["picture_my_work"]["name"]);
                    move_uploaded_file($_FILES["picture_my_work"]["tmp_name"], $target_file);
                    header("Refresh:0");
                }
            }
            if (isset($_POST['select_my_work'])) {
                $select_my_work_title = $_POST['select_my_work_title'];
                $select_my_work_db = $connect->prepare("SELECT * FROM works WHERE title = ?");
                $select_my_work_db->execute(array($select_my_work_title));
                $select_my_work = $select_my_work_db->fetch();
                $my_work_title = $select_my_work['title'];
                $my_work_link = $select_my_work['link'];
            }
            if(isset($_POST['update_my_work'])) {
                $select_my_work_title = $_POST['select_my_work_title'];
                $title_my_work = $_POST['title_my_work'];
                $link_my_work = $_POST['link_my_work'];
                $picture_my_work = $_FILES['picture_my_work']['name'];
                if ($picture_my_work != '') {
                    $update_my_work_db = $connect->prepare("UPDATE works SET picture = ?, title = ?, link = ? WHERE title = ?");
                    $update_my_work_db->execute(array($picture_my_work, $title_my_work, $link_my_work, $select_my_work_title));
                    $target_dir = "../../dashboard-users/core/img/work/";
                    $target_file = $target_dir . basename($_FILES["picture_my_work"]["name"]);
                    move_uploaded_file($_FILES["picture_my_work"]["tmp_name"], $target_file);
                    if ($update_my_work_db){
                        header("Refresh:0");
                    }
                }
                else {
                    $update_my_work_db = $connect->prepare("UPDATE works SET title = ?, link = ? WHERE title = ?");
                    $update_my_work_db->execute(array($title_my_work, $link_my_work, $select_my_work_title));
                    if ($update_my_work_db) {
                        header("Refresh:0");
                    }
                }
            }
            ?>
    </head>
    <body>
        <nav>
            <?php require("../core/navbar.php") ?>
        </nav>
        <div class="bottom" id="info">.</div>
        <form method="post" name="about_me">
            <table cellpadding="5" cellspacing="0">
                <tr>
                    <td>
                        <textarea name="text_about_me"><?= $about_me['info'] ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Update" name="update_about_me">
                        <div class="bottom" id="skill">.</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="skill_about_me" placeholder="Skill...">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Register" name="register_skill_about_me">
                    </td>
                </tr>
                <tr>
                    <td>
                    <?php foreach ($skill as $row):?>
                        <input type="button" name="delete_skill_about_me" value="<?= $row['skill'] ?>">
                    <?php endforeach ?>
                    </td>
                </tr>
            </table>
        </form>
        <div class="bottom" id="project">.</div>
        <form method="post" name="Project">
            <table cellpadding="5" cellspacing="0">
                <tr>
                    <td>
                        <input type="text" name="title_project" placeholder="Title..." value="<?= $project_title ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="subtitle_project" placeholder="Subtile..." value="<?= $project_subtitle ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="link_project" placeholder="Link..." value="<?= $project_link ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <textarea name="info_project" placeholder="Info about project..."><?= $project_info ?></textarea>
                    </td>
                </tr>
                <tr class="table">
                    <td class="inline-table">
                        <input type="submit" value="Register" name="register_project">
                        <label>
                            <select name="select_project_title">
                                <option value="<?= $select_project_title ?>"><?= $select_project_title ?></option>
                                <?php foreach ($project as $row): ?>
                                    <option value="<?= $row['title'] ?>" ><?= $row['title'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </label>
                        <input type="submit" value="Select" name="select_project">
                        <input type="submit" value="Update" name="update_project">
                    </td>
                </tr>
                <tr>
                    <td>
                    <?php foreach ($project as $row): ?>
                        <input type="button" value="<?= $row['title'] ?>" name="<?= $row['title'] ?>">
                    <?php endforeach ?>
                    </td>
                </tr>
            </table>
        </form>
        <div class="bottom" id="my_work">.</div>
        <form method="post" name="my_work" enctype="multipart/form-data">
            <table cellpadding="5" cellspacing="0">
                <tr>
                    <td>
                        <input type="text" name="title_my_work" placeholder="Title..." value="<?= $my_work_title ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="link_my_work" placeholder="Link..." value="<?= $my_work_link ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="file" name="picture_my_work" accept="image/*">
                    </td>
                </tr>
                <tr class="table">
                    <td class="inline-table">
                        <input type="submit" value="Register" name="register_my_work">
                        <label>
                            <select name="select_my_work_title">
                                <option value="<?= $select_my_work_title ?>"><?= $select_my_work_title ?></option>
                                <?php foreach ($my_work as $row): ?>
                                    <option value="<?= $row['title'] ?>" ><?= $row['title'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </label>
                        <input type="submit" value="Select" name="select_my_work">
                        <input type="submit" value="Update" name="update_my_work">
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php foreach ($my_work as $row): ?>
                            <input type="button" value="<?= $row['title'] ?>" name="<?= $row['title'] ?>">
                        <?php endforeach ?>
                    </td>
                </tr>
            </table>
        </form>
    </body>
    <script>
        $(document).ready(function(){
            $("a").on('click', function(event) {
                if (this.hash !== "") {
                    event.preventDefault();
                    var hash = this.hash;
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 800, function(){
                        window.location.hash = hash;
                    });
                }
            });
        });
    </script>
</html>