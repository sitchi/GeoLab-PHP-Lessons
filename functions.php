<?php

class functions
{

    // წარმატებული მოქმედების გამოტანა
    private function success($text)
    {
        echo '<font color="green">'.$text.'</font></br>';
    }

    // შეცდომების გამოტანა
    private function error($text)
    {
        echo '<font color="red">'.$text.'</font></br>';
    }

    // გამოგვაქ რეგისტრაციის და მთავარი გვერდის ლინკები
    public function urlAll()
    {
        echo '<hr>';
        echo '<a href="registration.php">რეგისტრაცია</a></br>';
        echo '<a href="index.php">მთავარი</a></br>';
    }

    // გამოგვაქ რეგისტრაციის ლინკი
    public function urlReg()
    {
        echo '<hr>';
        echo '<a href="registration.php">რეგისტრაცია</a></br>';
    }

    // ვამოწმებთ გვაქ თუ არა ფაილზე ჩაწერის უფლება
    public function checkWritable($file)
    {
        if (!is_writable($file)) {
            $text = $file.' - ფაილზე ჩაწერა შეუძლებელია!!!';
            die($this->error($text));
        }
    }

    // ფაილში შემთხვევითი ციფრების ჩაწერა
    public function writeRandomNumber($file, $quantity = 50)
    {
        $file = fopen($file, "w");
        for ($i=0; $i <= $quantity ; $i++) {
            fwrite($file, rand(1, 100)."\n");
        }
        fclose($file);
    }

    // ფაილიდან გამოგვაქ ჩანაწერები
    public function readFileArray($file)
    {
        $file = fopen($file, "r");
        $result = [];
        while (!feof($file)) {
            $result[] = fgets($file);
        }
        return $result;
    }

    // გამოგვაქ ლუწი რიცხვები
    public function getEvenNumber($data)
    {
        $result = [];
        for ($i = 0; $i < count($data); $i++) {
            $number = str_replace("\n", "", $data[$i]);
            if (is_numeric($number) and $number % 2 == 0) {
                $result[] = $data[$i];
            }
        }
        return $result;
    }

    // ვამოწმებთ ყველა ველი შევსებული არის თუ არა
    public function checkPOST($data)
    {
        $empty = false;
        foreach ($data as $key => $value) {
            if (empty($value)) {
                $empty = true;
            }
        }
        if ($empty) {
            $this->error('ყველა ველი არ არის შევსებული!');
            $this->urlAll();
            exit;
        }
    }

    // ვამოწმებთ ასაკს
    public function checkAge($gender, $age)
    {
        if ($gender == 1 && $age <18) {
            $this->error('თქვენ უნდა იყოთ მინიმუმ 18 წლის!');
            $this->urlAll();
            exit;
        } elseif ($gender == 2 && $age <20) {
            $this->error('თქვენ უნდა იყოთ მინიმუმ 20 წლის!');
            $this->urlAll();
            exit;
        }
    }

    // ვინახავთ შეყვანილ ინფორმაციას ფაილში
    public function saveRegData($data)
    {
        $file = 'storage/registrations/'.date("Y-m-d_H:i:s").'_'.$data['name'].'.txt';
        $file = fopen($file, "w");

        fwrite($file, 'სახელი: '.$data['name']."\n");
        fwrite($file, 'გვარი:  '.$data['surname']."\n");
        fwrite($file, 'ასაკი:  '.$data['age']."\n");
        fwrite($file, 'სქესი:  '.$gender = $data['gender'] == 1 ? 'მამრობითი' : 'მდედრობითი'."\n");

        fclose($file);

        $this->success('თქვენ წარმატებით გაიარეთ რეგისტრაცია!');

        // ვასუფთავებთ სესიას
        session_unset();

        $this->urlAll();
        exit;
    }
}
