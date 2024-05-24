<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(!empty($arResult["CATEGORIES"])):?>
	<div class="search-result_header">
		<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
			<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
			<div class="item">
				<?if($category_id === "all"):?>
					<div class="title-search-all">
                                            <a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a>
                                        </div>
				<?elseif(isset($arItem["ICON"])):?>
					<div class="title-search-item">
                                            <a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a>
                                        </div>
				<?endif;?>
			</div>
			<?endforeach;?>
		<?endforeach;?>

	</div><div class="title-search-fader"></div>
<?endif;
?>