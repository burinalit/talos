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
<div class="section_serv_info">
<h1 class="section_title">Сервисное обслуживание электростанций и генераторов</h1>
<div class="section_serv_info_content">
<?foreach($arResult["ITEMS"] as $arItem):?>
    <div class="section_home_serv" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<img class="serv_icon" src="<?=CFile::GetPath($arItem["PROPERTIES"]['SERV_ICON']["VALUE"])?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<p class="title"><?echo $arItem["NAME"]?></p>
		<?endif;?>
	</div>
<?endforeach;?>
</div>
<a class="btn" href="/about/">Подробнее</a>
</div>