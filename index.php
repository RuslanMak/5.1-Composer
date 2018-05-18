<?php
/**
 * Created by PhpStorm.
 * User: ruslan
 * Date: 18.05.2018
 * Time: 19:22
 */

require __DIR__ . '/vendor/autoload.php';
$api = new \Yandex\Geo\Api();
if (!empty($_POST['address'])) {
    $api->setQuery($_POST['address']);
}
$api
    ->setLimit(60)// кол-во результатов
    ->setLang(\Yandex\Geo\Api::LANG_RU)// локаль ответа
    ->load();
$response = $api->getResponse();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title>API yandex/geo</title>
    <meta charset="utf-8">
    <style>
        table {
            border-spacing: 0;
            border-collapse: collapse;
        }
        table td, table th {
            border: 3px solid #c0ccb4;
            padding: 10px;
        }
        table th {
            background: #ddeed5;
        }
    </style>
</head>
<body>
<h2>Поиск города</h2>
<form method="POST">
    <input type="text" name="address" placeholder="Введите адрес">
    <input type="submit" name="search" value="Найти">
</form>
<?php if(!empty($_POST['address'])) { ?>
    <table>
        <tr>
            <th>По запросу <?php echo $response->getQuery(); ?> найдено адресов: <?php echo $response->getFoundCount(); ?></th>
            <th>Координаты</th>
        </tr>
        <form method="post" action="map.php">
        <?php
        $collection = $response->getList();
        foreach ($collection as $item) { ?>
            <tr>
                <td><label><input type="radio" name="city" value="<?php echo $item->getLatitude().", ".$item->getLongitude(); ?>" required> <?php echo $item->getAddress(); ?></label><input type="submit" value="Посмотреть на карте"></td>
                <td><?php echo $item->getLatitude()." ".$item->getLongitude(); ?></td>
            </tr>
        <?php } ?>
        </form>
    </table>
<?php } ?>
</body>
</html>