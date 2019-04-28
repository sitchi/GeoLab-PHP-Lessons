<?php

$title = 'PHP - Lesson 1 - რეგისტრაცია';

require('head.php');
require('functions.php');

$func = new functions();

$name = empty($_SESSION["name"]) ? null : $_SESSION["name"];
$surname = empty($_SESSION["surname"]) ? null : $_SESSION["surname"];
$age = empty($_SESSION["age"]) ? null : $_SESSION["age"];
$gender = empty($_SESSION["gender"]) ? null : $_SESSION["gender"];

if (isset($_POST['save'])) {
    // შეყვანილი ინფორმაციის სესიაში შენახვა
    $_SESSION["name"] = $_POST['name'];
    $_SESSION["surname"] = $_POST['surname'];
    $_SESSION["age"] = $_POST['age'];
    $_SESSION["gender"] = $_POST['gender'];

    // ვამოწმებთ ყველა ველი შევსებული არის თუ არა
    $func->checkPost($_POST);
    // ვამოწმებთ ასაკს
    $func->checkAge($_POST['gender'], $_POST['age']);
    // ვინახავთ შეყვანილ ინფორმაციას ფაილში
    $func->saveRegData($_POST);
}

?>
<form action="" method="post">
    <p>სახელი</p>
    <input type="text" name="name" value="<?=$name?>">
    <p>გვარი</p>
    <input type="text" name="surname" value="<?=$surname?>">
    <p>ასაკი</p>
    <input type="number" name="age" value="<?=$age?>">
    <p>სქესი</p>
    <select name="gender">
        <option value="">აირჩიეთ სქესი</option>
        <option value="1" <?=$gender == '1' ? "selected" : null;?>>მამრობითი</option>
        <option value="2" <?=$gender == '2' ? "selected" : null;?>>მდედრობითი</option>
    </select>
    <p></p>
    <input type="submit" name="save" value="რეგისტრაცია">
</form>

<?php
$func->urlAll();

require('footer.php');

?>
