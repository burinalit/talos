<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="item">
		<a href="<?= $arItem["DETAIL_PICTURE"]['SRC']?>" data-fancybox="sertifs"><img src="<?= $arItem["DETAIL_PICTURE"]['SRC']?>" class="img-fluid"></a>
		<span><?= $arItem["NAME"]?></span>
	</div>
<?endforeach;?>