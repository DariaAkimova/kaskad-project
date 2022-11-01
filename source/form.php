<?
$reg_ex_phone = '/^[\d\+][\d\(\)\ -]{4,14}\d$/';
$reg_ex_email = '/^[\w-\.]+@[\w-]+\.[a-z]{2,4}$/i';

$mysql= new mysqli('localhost', '#', '#', 'bd');

$mail_subject = 'Новая сообщение с сайта';
$mail_to = 'aec-kaskad@yandex.ru';

if (isset($_POST['user-name']) && isset($_POST['phone']) && isset($_POST['email'])) {
    $name = trim(htmlspecialchars($_POST['user-name']));
    $phone = trim(htmlspecialchars($_POST['phone']));
    $email = trim(htmlspecialchars($_POST['email']));
    $comment = trim(htmlspecialchars($_POST['comments']));
    $time = date('Y-m-d H:i:s');

    $mail_message = $time . "\n" . 'От:' . ' ' . $name . "\n" . 'Телефон:' . ' ' . $phone . "\n" . 'email:' . ' ' . $email . "\n" . 'Сообщение:' . ' ' . $comment . "\n";

    $mysql->query("SET NAMES 'utf8'");
   $mysql_error = $mysql->connect_error;
    if ($mysql_error) {
                $sqlErrorFile = fopen('sql-error.txt', 'a');
        fwrite($sqlErrorFile, $time. ' ' . $mysql_error . "\n");
        fclose($sqlerrorFile);
    } else {
    $mysql->query("INSERT INTO users (name, email, phone, user_comments) VALUES('$name', '$email', '$phone', '$comment')");
    }
    $mysql->close();

    mail($mail_to, $mail_subject, $mail_message);

    if ((preg_match($reg_ex_phone, $phone)) && (preg_match($reg_ex_email, $email))) {
        $dataFile = fopen('users.txt', 'a');
        fwrite($dataFile, $time . ' ' . 'Name:' . ' ' . $name . ' ' . 'Phone:' . ' ' . $phone . ' ' . 'email:' . ' ' . $email . ' ' . 'comments:' . ' ' . $comment . "\n");
        fclose($dataFile);
        echo "Спасибо, ваша заявка принята. Вы можете <a href=\"index.html\"> вернуться на сайт </a>."; /* на случай проблем с js*/
    } else {
        $errorFile = fopen('error.txt', 'a');
        fwrite($errorFile, $time . ' ' . 'Name:' . ' ' . $name . ' ' . 'Phone:' . ' ' . $phone . ' ' . 'email:' . ' ' . $email . ' ' . $comment . "\n");
        fclose($errorFile);
        echo " <a href=\"index.html\">Вернитесь на сайт </a> и введите корректные данные! Таже вы можете написать мне по указанным контактам."; /* на случай проблем с js */
    }
} else {
    $emptyFile = fopen('no-data.txt', 'a');
    fwrite($emptyFile, $time . ' ' . 'Name:' . ' ' . $name . ' ' . 'Phone:' . ' ' . $phone . ' ' . 'email:' . ' ' . $email . ' ' . $comment . "\n");
    fclose($emptyFile);
    echo "<a href=\"index.html\">Вернитесь на сайт </a> и введите данные! Таже вы можете написать мне по указанным контактам."; /* на случай проблем с js*/
}
