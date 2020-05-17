<?php


class Samochody
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=orm', 'root', 'szota520');
    }


    public function wszystkie()
    {
        $query = $this->pdo->prepare("SELECT * FROM samochody");
        $query->execute();
        $result = $query->fetchAll();
        $array = [];
        foreach ($result as $item) {
            array_push($array,  new Samochod($item['marka'], $item['model'], $item['rok'], $item['cena'], $item['waga'], $item['silnik']));
        }
        return $array;
    }
}