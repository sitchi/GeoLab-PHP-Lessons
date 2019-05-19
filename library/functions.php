<?php

class functions
{

    // Remove all characters except digits, plus and minus sign.
    public function int($value)
    {
        return filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }

    // Get File Extension
    public function getFileExtension($filename)
    {
        return pathinfo($filename, PATHINFO_EXTENSION);
    }

    // Get Short Text
    public function getShortText($text, $length = 50)
    {
        $result = mb_strlen($text) > $length ? mb_substr($text, 0, $length) . '...' : $text;
        return $result;
    }

    // create token
    public function createToken()
    {
        $token = md5(uniqid(microtime(), true));
        $_SESSION['token'] = $token;
        return $token;
    }

    // check token
    public function checkToken($token)
    {
        if ($token === $_SESSION['token']) {
            return true;
        }
        return false;
    }

    // redirect page
    public function redirect($page = null)
    {
        header("Location: /$page");
        exit;
    }
}
