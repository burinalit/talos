<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class=" gallery-page">
	<div class="container">
		<div class="content-gallery">
		    <div class="sidebar-left link">
				<div class="anchors">
					<?$APPLICATION->IncludeComponent("bitrix:menu", "solutions-menu", array(
						"ROOT_MENU_TYPE" => "photo",
						"MENU_CACHE_TYPE" => "N",
						"MENU_CACHE_TIME" => "3600",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS" => array(
						),
						"MAX_LEVEL" => "3",
						"CHILD_MENU_TYPE" => "photo",
						"USE_EXT" => "Y",
						"DELAY" => "N",
						"ALLOW_MULTI_SELECT" => "Y"
						),
						false
					);?>
				</div>
			</div>
			<div class="grid-galleries col-8">
				<div class="card-gallery">
					<div class="gallery-block">
					    <div class="product-slider_photo">
							<?php if($arResult['PROPERTIES']['PHOTO_GALLERY']):?>
								 <?php foreach($arResult['PROPERTIES']['PHOTO_GALLERY']['VALUE'] as $elem):?>
									<img data-fancybox="photo" src="<?= CFile::GetPath($elem) ?>" alt="" width=" 90 " height=" 60 " />
								 <?php endforeach; ?>
							<?php endif; ?>
						</div>
						<div class="product_thumb-slider_photo">
							<?php if($arResult['PROPERTIES']['PHOTO_GALLERY']):?>
								 <?php foreach($arResult['PROPERTIES']['PHOTO_GALLERY']['VALUE'] as $elem):?>
									<img src="<?= CFile::GetPath($elem) ?>" alt="" width=" 90 " height=" 60 " />
								 <?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="sub-title-gallery">
						<h3><?=$arResult["NAME"]?></h3>
						<span><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
					</div>
					<p><?echo $arResult["DETAIL_TEXT"];?></p>
				</div>
			</div>
		</div>
	</div>
</div>