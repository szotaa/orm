<?php


class Samochod
{
    public $pdo;
    public $marka;
    public $model;
    public $rok;
    public $cena;
    public $waga;
    public $silnik;

    public function __construct($marka, $model, $rok, $cena, $waga, $silnik) {
        $this->marka = $marka;
        $this->model = $model;
        $this->rok = $rok;
        $this->cena = $cena;
        $this->waga = $waga;
        $this->silnik = $silnik;
        $this->pdo = new PDO('mysql:host=localhost;dbname=orm', 'root', 'szota520');
    }

    public function zapisz() {
        $stmt = $this->pdo->prepare("INSERT INTO samochody (marka, model, rok, cena, waga, silnik) VALUES (:marka, :model, :rok, :cena, :waga, :silnik)");
        $wynik = $stmt->execute([
            'marka' => $this->marka,
            'model' => $this->model,
            'rok' => $this->rok,
            'cena' => $this->cena,
            'waga' => $this->waga,
            'silnik' => $this->silnik
        ]);

        return $wynik;
    }
}