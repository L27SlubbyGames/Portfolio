<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="input_stylesheet" href="css/contact.min.css">
        <?php 
            require("../core/header.php");
            $firstname = '';
            $lastname = '';
            $email_from = '';
            $phone_number = '';
            $subject = '';
            $message = '';
            $error_message_1 = '';
            $error_message_2 = '';
            $error_message_3 = '';
            if(isset($_POST['send'])){
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $email_from = $_POST['email'];
                $phone_number = $_POST['phone_number'];
                $subject = $_POST['subject'];
                $message = $_POST['message'];
        
                $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
                $string_exp = "/^[A-Za-z .'-]+$/";
                if(!preg_match($email_exp,$email_from) || !preg_match($string_exp,$firstname) || !preg_match($string_exp,$lastname)){
                    if(!preg_match($string_exp,$firstname)) {
                        $error_message_1 = '<p id="error">The First Name you entered does not appear to be valid.</p><br />';
                    }
                    if(!preg_match($string_exp,$lastname)) {
                        $error_message_2 = '<p id="error">The Last Name you entered does not appear to be valid.</p><br />';
                    }
                    if(!preg_match($email_exp,$email_from)) {
                        $error_message_3 = '<p id="error">The Email Address you entered does not appear to be valid.</p><br />';
                    }
                }
                else{
                    $email_to = "contact@pascalhuberts.nl";
                    $email_subject = "Portfolio contact: ".$subject;
                    $headers = "From: ".$email_from;
                    $txt = "You have received an e-mail from ".$firstname." ".$lastname.".\n\n".$message."\n\nPhone number: ".$phone_number."\nE-mail: ".$email_from;
        
                    mail($email_to, $email_subject, $txt, $headers);
        
                    $contact = $connect->prepare("INSERT INTO contact (firstname, lastname, email, phone_number, subject_contact, message_contact) VALUE (?,?,?,?,?,?)");
                    $contact->execute(array($firstname, $lastname, $email_from, $phone_number, $subject, $message));
                    if($contact){
                        header("Refresh:0");
                    }
                }
            }
        ?>
    </head>
    <body>
        <header>
            <nav>
                <?php require("../core/nav-bar.php") ?>
            </nav>
        </header>
        <main id="contact_page">
            <div id="form">
                <form action="" method="post" name="contact" id="contact_form">
                    <h3 id="contact_form_title">CONTACT ME:</h3>
                    <div class="contact_from_box">
                        <h6 class="contact_from_subjects">First Name:</h6>
                        <input type="text" name="firstname" class="input_style" value="<?= $firstname ?>" placeholder="Firstname..." required>
                    </div>
                    <div class="contact_from_box">
                        <h6 class="contact_from_subjects">Last Name:</h6>
                        <input type="text" name="lastname" class="input_style" value="<?= $lastname ?>" placeholder="Lastname..." required>
                    </div>
                    <div class="contact_from_box">
                        <h6 class="contact_from_subjects">E-mail:</h6>
                        <input type="email" name="email" class="input_style" value="<?= $email_from ?>" placeholder="E-mail..." required>
                    </div>
                    <div class="contact_from_box">
                        <h6 class="contact_from_subjects">Phone Number:</h6>
                        <input type="text" name="phone_number" class="input_style" value="<?= $phone_number ?>" placeholder="Phone Number... (optional)">
                    </div>
                    <div class="contact_from_box">
                        <h6 class="contact_from_subjects">Subject:</h6>
                        <input type="text" name="subject" class="input_style" value="<?= $subject ?>" placeholder="subject..." required>
                    </div>
                    <div class="contact_from_box">
                        <h6 class="contact_from_subjects">Message:</h6>
                        <textarea name="message" class="input_style" id="textarea" placeholder="Youre message..." required><?= $message ?></textarea>
                    </div>
                    <div class="contact_from_box">
                        <input type="submit" name="send" id="contact_form_send" value="Send">
                    </div>
                    <div id="error">
                        <?php echo $error_message_1, $error_message_2, $error_message_3;?>
                    </div>
                </form>
                <div id="contact_button_center">
                    <h4 id="contact_button_title">YOU CAN  ALSO CONTACT ME ON:</h4>
                    <div class="contact_button_center_tabs">
                        <div class="tab" onclick=
                            "document.getElementById('card1').style.display='block';
                            document.getElementById('card2').style.display='none';
                            document.getElementById('card3').style.display='none';">
                            <h6 class="contact_button_text">Phone Number</h6>
                        </div>
                        <div class="tab" onclick=
                            "document.getElementById('card1').style.display='none';
                            document.getElementById('card2').style.display='block';
                            document.getElementById('card3').style.display='none';">
                            <h6 class="contact_button_text">Discord</h6>
                        </div>
                    </div>
                </div>
                <div class="cards" id="card1" style="display: none;">
                    <div class="cards_content">
                        <div onclick="document.getElementById('card1').style.display='none';">
                            <i class="far fa-window-close"></i>
                        </div>
                        <h6 class="contact_info">Sorry no yet</h6>
                    </div>
                </div>
                <div class="cards" id="card2" style="display: none;">
                    <div class="cards_content">
                        <div onclick="document.getElementById('card2').style.display='none';">
                            <i class="far fa-window-close"></i>
                        </div>
                        <h6 class="contact_info">L27_SlubbyGames#0157</h6>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <?php require("../core/footer.php") ?>
        </footer>
    </body>
</html>
