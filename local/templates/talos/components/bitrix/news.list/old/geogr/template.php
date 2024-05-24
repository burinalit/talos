<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<script>
ymaps.ready(init);
function init() {
    var map = new ymaps.Map('map', {
        center: [70, 100],
        zoom: 2.4,
        type: null,
		maxWidth: [695],
        controls: []
    },{
		avoidFractionalZoom: false
    }),
	myPoints = [
		<?php foreach($arResult["ITEMS"] as $item){ ?>
		{ coords: [<?php echo $item["PROPERTIES"]["GEOGR_COORDS"]["VALUE"]; ?>]},
		<?php } ?>
	];
	<?php foreach($arResult["ITEMS"] as $item){ ?>		
		map.geoObjects
			.add(new ymaps.Placemark([<?php echo $item["PROPERTIES"]["GEOGR_COORDS"]["VALUE"]; ?>], {
				balloonContent: ''
			}, {
				iconLayout: 'default#image',
				iconImageHref: '<?= SITE_TEMPLATE_PATH ?>/images/geogr_icon.svg',
				iconImageSize: [15, 18]
			}));
	<?php } ?>	
    // Добавим заливку цветом.
    var pane = new ymaps.pane.StaticPane(map, {
        zIndex: 100, css: {
            width: '100%', height: '100%', backgroundColor: '#ffffff'
        }
    });
    map.panes.append('white', pane);
	map.behaviors.disable('scrollZoom');
    // Создадим балун.
    var districtBalloon = new ymaps.Balloon(map);
    districtBalloon.options.setParent(map.options);
    // Загрузим регионы.
    ymaps.borders.load('RU', {
        lang: 'ru',
        quality: 2
    }).then(function (result) {
        // Создадим объект, в котором будут храниться коллекции с нашими регионами.
        var districtCollections = {};	
        for (var district in districtByIso) {
            districtCollections[district] = new ymaps.GeoObjectCollection(null, {
				fillColor: '#E53533',
                strokeColor: '#FFFFFF',
                strokeOpacity: 0.3,
                fillOpacity: 1,
                hintCloseTimeout: 0,
                hintOpenTimeout: 0
            });
            districtCollections[district].properties.districts = [];
        }
		
        result.features.forEach(function (feature) {
            var iso = feature.properties.iso3166;
            var name = feature.properties.name;
            var district = districtByIso[iso];
            districtCollections[iso].add(new ymaps.GeoObject(feature));
        });		
		
        var highlightedDistrict;
        for (var districtName in districtCollections) {	
            if(districtName == 'RU-SA'){
				districtCollections[districtName].options.set({
					fillImageHref: '<?= SITE_TEMPLATE_PATH ?>/images/regions/'+districtName+'.jpg',
					fillColor: '#E53533'
				});
			}
            else{
				districtCollections[districtName].options.set({
					fillImageHref: null,
					fillColor: '#E53533'
				});
			}			
            map.geoObjects.add(districtCollections[districtName]);
            districtCollections[districtName].events.add('mouseenter', function (event) {
                var district = event.get('target');
                district.options.set({fillColor: '#C10200'});
            });
            districtCollections[districtName].events.add('mouseleave', function (event) {
                var district = event.get('target');
                if (district !== highlightedDistrict) {
                    district.options.set({fillColor: '#E53533'});
                }
            });

            districtCollections[districtName].events.add('click', function (event) {
                var district = event.get('target');
				if (highlightedDistrict) {
                    highlightedDistrict.options.set({fillColor: '#E53533'})
                }
				highlightedDistrict = district;	
            });
        }
    })
}
</script>
<div id="map"></div>