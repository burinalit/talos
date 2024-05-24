<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul>
<? $previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>
		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li class="<?if ($arItem["SELECTED"]):?>active<?endif?>"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
				<ul class="submenu">
		<?else:?>
			<li><a href="<?=$arItem["LINK"]?>" class="parent"><?=$arItem["TEXT"]?></a>
				<ul class="submenu">
		<?endif?>
	<?else:?>
		<?if ($arItem["PERMISSION"] > "D"):?>
			<?if ($arItem["DEPTH_LEVEL"] == 1):?>				
				<li class="<?if ($arItem["SELECTED"]):?>active<?endif?>"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>selected<?endif?>"><span class="menu_title"><?=$arItem["TEXT"]?></span></a></li>
			<?else:?>
				<li>
				    <a href="<?=$arItem["LINK"]?>">
						<?php if(intval($arItem["PARAMS"]["PICTURE"])>0): 
							$img = CFile::ResizeImageGet($arItem["PARAMS"]["PICTURE"], array('width'=>30, 'height'=>30), BX_RESIZE_IMAGE_PROPORTIONAL, false); ?>
						<img alt="<?=$arItem["TEXT"]?>" src="<?=$img['src']?>" />
						<?php endif; ?>
				        <span class="menu_title"><?=$arItem["TEXT"]?></span>
				    </a>
				</li>
			<?endif?>

		<?else:?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li class="<?if ($arItem["SELECTED"]):?>active<?endif?>"><a href="" class="<?if ($arItem["SELECTED"]):?>selected<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>
		<?endif?>
	<?endif?>
	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
<?endforeach?>

<?if ($previousLevel > 1):?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
<div class="menu-clear-left"></div>
<?endif?>