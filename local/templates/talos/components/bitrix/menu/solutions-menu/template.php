<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<div class="accordion left" id="accordeonAir">
<? $previousLevel = 0;
foreach($arResult as $arItem):?>
	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul>
					</div>
				</div>
		    </div>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
		    <div class="card">
				<div class="card-header" id="heading<?php echo $arItem["ITEM_INDEX"]; ?>">
					<h2 class="mb-0">
						<a href="<?=$arItem["LINK"]?>" class="btn btn-link btn-block text-left collapsed <?if($arItem["SELECTED"]):?> active<?endif?>" type="button" data-toggle="collapse" data-target="#collapse<?php echo $arItem["ITEM_INDEX"]; ?>" aria-expanded="true" aria-controls="collapse<?php echo $arItem["ITEM_INDEX"]; ?>">
							<?=$arItem["TEXT"]?>
					</a>
					</h2>	
				</div>
				<div id="collapse<?php echo $arItem["ITEM_INDEX"]; ?>" class="collapse" aria-labelledby="heading<?php echo $arItem["ITEM_INDEX"]; ?>" data-parent="#accordeonAir">
					<div class="card-body">
						<ul>	
		<?else:?>
			<li class="2"><a href="<?=$arItem["LINK"]?>" class="parent<?if ($arItem["SELECTED"]):?> active<?endif?>"><?=$arItem["TEXT"]?></a>
				<ul class="lvl-3">
		<?endif?>

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<div class="card">
				    <div class="card-header">
						<h2 class="mb-0">
							<a href="<?=$arItem["LINK"]?>" class="btn btn-link btn-block text-left nocat <?if ($arItem["SELECTED"]):?> active<?endif?>" type="button">
								<?=$arItem["TEXT"]?>
						    </a>
						</h2>
					</div>
				</div>
			<?else:?>
				<li><a href="<?=$arItem["LINK"]?>" <?if ($arItem["SELECTED"]):?> class="active"<?endif?>><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?else:?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li class="5"><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li class="6"><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
    
<?endforeach?>

<?if ($previousLevel > 1): ?>
	<?=str_repeat("</ul>
					</div>
				</div>
		    </div>", ($previousLevel-1) );?>
<?endif?>
</div>
<?endif?>