<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="about-section sevices-section grid_services_block">
	<div class="container">
		<div class="category-grid row row-cols-1">
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>
			<div class="services-item">
				<div class="card-about">
				    <div class="services-image_mobile" style="background-image: url('<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>')"></div>
					<div class="about-text">
						<h3><?echo $arItem["NAME"]?></h3>
						<p><?echo $arItem["PREVIEW_TEXT"];?></p>
						<a href="<?= $arItem["DETAIL_PAGE_URL"]?>" class="btn">Подробнее</a>
					</div>
					<div class="services-image" style="background-image: url('<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>')"></div>
				</div>
			</div>
		<?endforeach;?>
		</div>
		<?=$arResult["NAV_STRING"]?>
    </div>
</div>