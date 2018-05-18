<?php
/**
 * Created by PhpStorm.
 * User: ruslan
 * Date: 18.05.2018
 * Time: 22:24
 */

echo "<h4><a href='index.php'>Перейти на главную страницу</a></h4>";

$city = $_POST['city'];
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Быстрый старт. Размещение интерактивной карты на странице</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript">
    </script>
    <script type="text/javascript">
        ymaps.ready(init);
        var myMap,
            myPlacemark;

        function init(){
            myMap = new ymaps.Map("map", {
                center: [<?php echo $city; ?>],
                zoom: 7
            });

            myPlacemark = new ymaps.Placemark([<?php echo $city; ?>], {
                hintContent: 'Геолокация по Вашему запросу'
            });

            myMap.geoObjects.add(myPlacemark);
        }
    </script>
</head>

<body>
<div id="map" style="width: 800px; height: 600px"></div>
</body>

</html>
