<?php

class db
{
    protected $pdo;

    public function __construct()
    {
        $config = parse_ini_file('config.ini');
        // check the developer configuration
        if (is_readable('config.dev.ini')) {
            $config = parse_ini_file('config.dev.ini');
        }
        try {
            $this->pdo = new PDO("mysql:host=$config[host];dbname=$config[dbname]", $config['username'], $config['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function insert($sql, $data)
    {
        $this->pdo->prepare($sql)->execute($data);
    }

    public function update($sql, $data)
    {
        $this->pdo->prepare($sql)->execute($data);
    }

    // get single row
    public function fetch($sql)
    {
        return $this->pdo->query($sql)->fetch();
    }

    // fetch all
    public function fetchAll($sql)
    {
        return $this->pdo->query($sql)->fetchAll();
    }

    public function delete($sql, $data, $file = null)
    {
        $this->pdo->prepare($sql)->execute($data);
        if ($file) {
            unlink($file); // remove file
        }
    }

    public function __destruct()
    {
        $this->pdo = null;
    }
}
