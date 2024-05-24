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

$arViewModeList = $arResult['VIEW_MODE_LIST'];

$arViewStyles = array(
	'LIST' => array(
		'CONT' => 'bx_sitemap',
		'TITLE' => 'bx_sitemap_title',
		'LIST' => 'bx_sitemap_ul',
	),
	'LINE' => array(
		'CONT' => 'bx_catalog_line',
		'TITLE' => 'bx_catalog_line_category_title',
		'LIST' => 'bx_catalog_line_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/line-empty.png'
	),
	'TEXT' => array(
		'CONT' => 'bx_catalog_text',
		'TITLE' => 'bx_catalog_text_category_title',
		'LIST' => 'bx_catalog_text_ul'
	),
	'TILE' => array(
		'CONT' => 'bx_catalog_tile',
		'TITLE' => 'bx_catalog_tile_category_title',
		'LIST' => 'bx_catalog_tile_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/tile-empty.png'
	)
);
$arCurView = $arViewStyles[$arParams['VIEW_MODE']];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

?>
<div class="carusel_tenders_list owl-carousel">
<? if (0 < $arResult["SECTIONS_COUNT"]): 
    $intCurrentDepth = 1;
	$boolFirst = true;
	foreach ($arResult['SECTIONS'] as &$arSection){ 
	    if($arSection['RELATIVE_DEPTH_LEVEL'] == 1):
		    $rsResult = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" =>$arSection["ID"]), false, array("UF_*")); 
			if($amSection = $rsResult -> GetNext()){ 
				$arSection["UF_CATEGORY_IMAGE"] = $amSection["UF_CATEGORY_IMAGE"];
				$arSection["UF_CATEGORY_IMAGE_HOVER"] = $amSection["UF_CATEGORY_IMAGE_HOVER"]; 
			} ?>
			<div class="section_tenders_list_item" onclick="location.href='<?= $arSection['SECTION_PAGE_URL'] ?>'">
			    <div class="title_items">  
					<h2><? echo $arSection["NAME"];?></h2>
			    </div>	
				<img src="<?= CFile::GetPath($arSection["UF_CATEGORY_IMAGE"]) ?>" class="image_items" alt="<? echo $arSection["NAME"];?>" />
				<img src="<?= CFile::GetPath($arSection["UF_CATEGORY_IMAGE_HOVER"]) ?>" class="image_items_hover" alt="<? echo $arSection["NAME"];?>" />
			</div>
		<?php endif; 
	}
	unset($arSection);
endif; ?>
</div>