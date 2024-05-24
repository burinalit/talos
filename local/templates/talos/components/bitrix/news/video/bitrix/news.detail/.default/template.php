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
				<div class="video-des">
					<div class="cross-desc">
						<div class="title"><?=$arResult["NAME"]?></div>
						<div class="data"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></div>
					</div>
					<div class="cross-text"><p><?echo $arResult["DETAIL_TEXT"];?></p></div>
					<div class="cross-row">
					<?php foreach($arResult['PROPERTIES']['VIDEO_GALLERY']['VALUE'] as $key => $elem):?>
						<a data-fancybox data-src="#video-section<?= $key ?>" href="javascript:;" class="video">
							<div class="video-block ">
								<img src="<?=SITE_TEMPLATE_PATH?>/images/play.svg" class="play">
								<div class="video-img ">
									<img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" alt=" ">
								</div>
								<p><?=$arResult["NAME"]?></p>
							</div>
						</a>
						<div id="video-section<?= $key ?>" class="video-section" style="display:none">
							<div class="video-popup">
								<iframe src="<?= $elem; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
								<div class="video-bottom">
									<div class="title"><?=$arResult["NAME"]?></div>
									<p><?echo $arResult["DETAIL_TEXT"];?></p>
								</div>
							</div>
						</div>
					<?php endforeach; ?>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


        