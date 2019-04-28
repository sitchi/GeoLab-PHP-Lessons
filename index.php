<?php

$title = 'PHP - Lesson 1';

require('head.php');
require('functions.php');

$func = new functions();

$file = 'storage/data.txt';

// ვამოწმებთ გვაქ თუ არა ფაილზე ჩაწერის უფლება
$func->checkWritable($file);

// ფაილში შემთხვევითი ციფრების ჩაწერა
$func->writeRandomNumber($file, 100);

echo '<p><b>1. წაიკითხეთ ფაილიდან თითო ხაზი და ჩაწერეთ მასივში, შემდეგ ამოღებული მნიშვნელობები გამოიტანეთ ეკრანზე (echo)-ს დახმარებით.</b></p>';

// ფაილიდან გამოგვაქ ჩანაწერები
$fileData = $func->readFileArray($file);

foreach ($fileData as $key => $value) {
    echo $value;
}

echo '<hr>';
echo '<p><b>2. დაითვალეთ მასივში არსებული ლუწი რიცხვების ჯამი. (მასივი შეავსეთ თქვენ თვითონ შემთხვევითი რიცხვებით). </b></p>';

// გამოგვაქ ლუწი რიცხვები
$evenNumbers = $func->getEvenNumber($fileData);
foreach ($evenNumbers as $key => $value) {
    echo $value;
}

echo '<p>ლუწი რიცხვების ჯამი: '.count($evenNumbers).'</p>';

echo '<hr>';
echo '<p><b>3. გააკეთეთ ფორმა, რომელსაც ექნება 4 ველი: სახელი, გვარი, ასაკი, სქესი(0 - მამრობითი,1 - მდედრობითი)… პირობა: დასაბმითების შემდეგ, შეინახეთ შეყვანილი მნიშვნელობები txt ფაილში, (ფაილს დაარქვით ის სახელი რასაც მომხმარებელი შეიყვანს, გამოიყენეთ w mode ჩაწერის.). </b></p>';
echo '<a href="registration.php">რეგისტრაცია</a></br>';

require('footer.php');
