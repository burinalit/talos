<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
<? 
$rs = new CDBResult;
  $rs->InitFromArray($arResult['SECTIONS']);
  $rs->NavStart(10);
  if($rs->IsNavPrint()){ ?>
  <div class="category-grid row row-cols-2"> 
  <?php
 while ($arSection = $rs->Fetch()):
  $db_list = CIBlockSection::GetList(Array($by=>$order),
  $arFilter = Array("IBLOCK_ID"=>$arSection["IBLOCK_ID"], "ID"=>$arSection["ID"]), true, $arSelect=Array("UF_STRANA")); ?>
  <div class="col-6 pb-3">
		<div class="card-prod">
			<div class="visible-card mask-bottom" style="background-image: url('<? echo $arSection['PICTURE']['SRC']; ?>')">
				<div>
					<h3><?= $arSection['NAME'] ?></h3>
					<p><?= $arSection['DESCRIPTION'] ?></p>
				</div>
			</div>
			<div class="hover-card mask-all">
				<div class="card-text">
					<h3><?= $arSection['NAME'] ?></h3>
					<p><?= $arSection['DESCRIPTION'] ?></p>
					<a href="<?= $arSection['SECTION_PAGE_URL'] ?>" class="btn"><?=GetMessage("K_DETAILS")?></a>
				</div>
				<div class="card-image" style="background-image: url('<? echo $arSection['PICTURE']['SRC']; ?>')"></div>
			</div>
		</div>
	</div>
<? endwhile; ?>
</div>
<?php
 $rs->NavPrint("Подразделы", false, "page-link", "/bitrix/templates/rostar/navprint.php");
}?>