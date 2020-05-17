<?php
require_once('Samochod.php');
require_once('Samochody.php');


$samochody = new Samochody();
$wszysktie = $samochody->wszystkie();

if (isset($_POST['submit'])) {
    $samochod = new Samochod($_POST['marka'], $_POST['model'], $_POST['rok'], $_POST['cena'], $_POST['waga'], $_POST['silnik']);
    $czyZapisal = $samochod->zapisz();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dodaj</title>
    <meta charset="utf-8">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"></script>
</head>
<div class="container-fluid">
    <body>
    <?php if ($czyZapisal): ?>
        <p class="alert-success">Zapisano!</p>
    <?php endif; ?>


    <table>
        <thead>
        <th>Marka</th>
        <th>Model</th>
        <th>Rok</th>
        <th>Cena</th>
        <th>Silnik</th>
        <th>Waga</th>
        </thead>
        <tbody>
        <?php foreach ($wszysktie as $pobrany): ?>
            <tr>
                <td><?= $pobrany->marka ?></td>
                <td><?= $pobrany->model ?></td>
                <td><?= $pobrany->rok ?></td>
                <td><?= $pobrany->cena ?></td>
                <td><?= $pobrany->silnik ?></td>
                <td><?= $pobrany->waga ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>


    <form method="post">
        <div class="form-group">
            <label for="marka">Marka</label>
            <input type="text" class="form-control" name="marka" id="marka">
        </div>
        <div class="form-group">
            <label for="model">Model</label>
            <input type="text" class="form-control" name="model" id="model">
        </div>
        <div class="form-group">
            <label for="rok">Rok</label>
            <input type="text" class="form-control" name="rok" id="rok">
        </div>
        <div class="form-group">
            <label for="cena">Cena</label>
            <input type="text" class="form-control" name="cena" id="cena">
        </div>
        <div class="form-group">
            <label for="silnik">Silnik</label>
            <input type="text" class="form-control" name="silnik" id="silnik">
        </div>
        <div class="form-group">
            <label for="waga">Waga</label>
            <input type="text" class="form-control" name="waga" id="waga">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
