<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news-grid">
	<div class="row row-cols-4">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))); ?>
		<div class="item-news" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="card-news">
				<div class="news-date"> <?echo $arItem["DISPLAY_ACTIVE_FROM"]?></div>
				<div class="news-image" style="background-image: url('<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>')">
					<div class="hover-news mask-all">
						<a href="<?= $arItem["DETAIL_PAGE_URL"]?>" class="btn">Подробнее</a>
					</div>
				</div>
				<div class="news-title"><?echo $arItem["NAME"]?></div>
				<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
					<div class="news-description"><?php echo mb_substr($arItem["PREVIEW_TEXT"] , 0, 127 )."...";?></div>
				<?endif;?>
			</div>
		</div>
	<?endforeach;?>
	</div>
	<p>&nbsp;</p>
</div>