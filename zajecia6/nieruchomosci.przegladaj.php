<?php
require_once 'bootstrap.php';
require_once 'header.php';

$query = $em->getRepository('Entity\Mieszkanie')->pobierzWszystko($_GET);
$strona = !empty($_GET['strona']) ? (int) $_GET['strona'] : 0;

$stronicowanie = new Model\Stronicowanie($query, $strona, 5);
$mieszkania = $stronicowanie->pobierzDane();
$linki = $stronicowanie->pobierzLinki();

$miasta = $em->getRepository('Entity\Miasto')->pobierzSlownik();
$typyOfert = ['S' => 'sprzedaż', 'W' => 'wynajem'];
?>

<form action="" method="get">
    <table class="table table-stripped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Typ</th>
                <th>Miasto</th>
                <th>Powierzchnia od</th>
                <th>Powierzchnia do</th>
                <th>Cena od</th>
                <th>Cena do</th>
                <th>Piętro</th>
                <th>Rok budowy</th>
                <th>Komunikacja</th>
                <th></th>
            </tr>
            <tr class="szukaj">
                <th></th>
                <th>
                    <select name="typ_oferty" class="form-control form-control-sm">
                        <?php foreach ($typyOfert as $id => $nazwa) : ?>
                            <option value="<?= $id ?>" <?= ($_GET['typ_oferty'] ?? '') == $id ? 'selected' : '' ?>><?= $nazwa ?></option>
                        <?php endforeach; ?>
                    </select>
                </th>
                <th>
                    <select name="miasto" class="form-control form-control-sm">
                        <option value="">-</option>
                        <?php foreach ($miasta as $id => $nazwa) : ?>
                            <option value="<?= $id ?>" <?= ($_GET['miasto'] ?? '') == $id ? 'selected' : '' ?>><?= $nazwa ?></option>
                        <?php endforeach; ?>
                    </select>
                </th>
                <th>
                    <input type="text" name="powierzchnia-od" value="<?= $_GET['powierzchnia-od'] ?? '' ?>" style="width: 90px;" class="form-control form-control-sm" />
                </th>
                <th>
                    <input type="text" name="powierzchnia-do" value="<?= $_GET['powierzchnia-do'] ?? '' ?>" style="width: 90px;" class="form-control form-control-sm" />
                </th>
                <th>
                    <input type="text" name="cena-od" value="<?= $_GET['cena-od'] ?? '' ?>" style="width: 90px;" class="form-control form-control-sm" />
                </th>
                <th>
                    <input type="text" name="cena-do" value="<?= $_GET['cena-do'] ?? '' ?>" style="width: 90px;" class="form-control form-control-sm" />
                </th>
                <th>
                    <input type="text" name="rok_budowy" value="<?= $_GET['rok_budowy'] ?? '' ?>" style="width: 90px;" class="form-control form-control-sm" />
                </th>
                <th></th>
                <th><input type="submit" name="szukaj" value="Szukaj" class="btn btn-sm btn-primary" /></th>
            </tr>

        </thead>
        <tbody>
            <?php foreach ($mieszkania as $miesz) : ?>
                <tr>
                    <td><?= $miesz->getNieruchomosc()->getId() ?></td>
                    <td><?= $miesz->getNieruchomosc()->getTypOferty() ?></td>
                    <td><?= $miesz->getNieruchomosc()->getMiasto()->getNazwa() ?></td>
                    <td><?= $miesz->getNieruchomosc()->getPowierzchnia() ?></td>
                    <td><?= $miesz->getNieruchomosc()->getCena() ?></td>
                    <td><?= $miesz->getPietro() ?>/<?= $miesz->getLiczbaPieter() ?></td>
                    <td><?= $miesz->getRokBudowy() ?></td>
                    <td><?= $miesz->getNieruchomosc()->pobierzKomunikacje() ?></td>
                    <td>
                        <a href="nieruchomosci.szczegoly.php?id=<?= $miesz->getNieruchomosc()->getId() ?>">szczegóły</a> |
                        <a href="nieruchomosci.edycja.php?id=<?= $miesz->getNieruchomosc()->getId() ?>">edycja</a> |
                        <a href="nieruchomosci.usun.php?id=<?= $miesz->getNieruchomosc()->getId() ?>">usuń</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="9"><?= $linki ?></td>
            </tr>
        </tfoot>
    </table>
</form>

<p><?=$liczbaRekordow?></p>

<? require_once 'footer.php'; ?>