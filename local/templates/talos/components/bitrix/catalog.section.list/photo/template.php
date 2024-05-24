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
<div class="news-page">
	<div class="container">
		<div class="news-grid">
<?if (0 < $arResult["SECTIONS_COUNT"]){ ?>
<div class="row row-cols-4">
<? foreach ($arResult['SECTIONS'] as &$arSection){
	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

	if (false === $arSection['PICTURE'])
		$arSection['PICTURE'] = array(
			'SRC' => $arCurView['EMPTY_IMG'],
			'ALT' => (
				'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
				? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
				: $arSection["NAME"]
			),
			'TITLE' => (
				'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
				? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
				: $arSection["NAME"]
			)
		);
	?>
	<div class="item-news" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
		<div class="card-news">
			<div class="news-date"> <?echo $arSection["DISPLAY_ACTIVE_FROM"]?></div>
			<div class="news-image" style="background-image: url('<?=$arSection["PICTURE"]["SRC"]?>')">
				<div class="hover-news mask-all">
					<a href="<?= $arSection['SECTION_PAGE_URL']?>" class="btn">Подробнее</a>
				</div>
			</div>
			<div class="news-title"><?echo $arSection["NAME"]?></div>
			<?if($arSection["PREVIEW_TEXT"]):?>
				<div class="news-description"><?php echo mb_substr($arSection["PREVIEW_TEXT"] , 0, 127 )."...";?></div>
			<?endif;?>
		</div>
	</div>
<? } ?>
</div>
<? } ?>
        </div>
		<?=$arResult["NAV_STRING"]?>
	</div>
</div>