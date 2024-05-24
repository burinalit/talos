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

$fSections = CIBlockSection::GetList(false, Array("IBLOCK_ID" => 47, "ID" => 95, "ACTIVE"=>"Y", "GLOBAL_ACTIVE"=>"Y", "SECTION_ACTIVE" => "Y"),
    false, Array("UF_CATPROD_NAME", "UF_CATPROD_FILE"), false);
$flSections = $fSections->Fetch();

CModule::IncludeModule("iblock");
$res = CIBlockSection::GetByID(95);
if($arSection = $res->GetNext()){
  $cat_text = $arSection["DESCRIPTION"];
}
$cat_title = $flSections['UF_CATPROD_NAME'];
$cat_file = $flSections['UF_CATPROD_FILE'];

$rsFile = CFile::GetByID($cat_file);
$arsFile = $rsFile->Fetch();  
$cat_file_size = CFile::FormatSize($arsFile['FILE_SIZE'], 1);   
?>
<section class="page_block catprods_block">
    <div class="container">
	    <div class="title_section">		
	        <div class="title_block"><?= $cat_title ?></div>
			<div class="file_block"><a href="<?= CFile::GetPath($cat_file)?>">Скачать каталог, <span class="size"><?= $cat_file_size ?></span></a></div>
		</div>
		<div class="subtitle_section">		
	        <?= $cat_text ?>
		</div>
		<div class="razd_section">
		    <? foreach($arResult["ITEMS"] as $key => $arItem): 
			if($arItem['PROPERTIES']['TYPE_EL']['VALUE_XML_ID'] == 'TYPE_EL_RAZD'): 
				$res = CIBlockSection::GetByID($arItem['PROPERTIES']['LINK_EL']['VALUE']);
				if($ar_res = $res->GetNext()) $link = $ar_res['SECTION_PAGE_URL']; ?>
				<div class="item" id="catprods_<?= $key ?>">
				    <div class="title_sect">
						<div class="title_item"><?=$arItem['NAME']?></div>
						<div class="desc_item"><?=$arItem['DETAIL_TEXT']?></div>
					</div>
					<a href="<?= $link ?>" class="btn btn_details">Подробнее</a>
					<img src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arItem["DETAIL_PICTURE"]["ALT"]?>" title="<?=$arItem["DETAIL_PICTURE"]["TITLE"]?>"/>
				</div>
			<? endif; 
			endforeach; ?>
		</div>
		<div class="cases_section">
		    <? foreach($arResult["ITEMS"] as $key => $arItem): 
			if($arItem['PROPERTIES']['TYPE_EL']['VALUE_XML_ID'] == 'TYPE_EL_CASE'): 
			    $link = $arItem['PROPERTIES']['LINK_EL1']['VALUE']; ?>
				<a href="<?= $link ?>" class="item" id="catprods_<?=$this->GetEditAreaId($arItem['ID']);?>">
				    <div class="btn btn_slider"><span>Каталог</span></div>
					<div class="image_item" style="background-image: url('<?=$arItem["DETAIL_PICTURE"]["SRC"]?>');"></div>
				    <div class="title_item">
					    <span class="subname"><?= $arItem['PROPERTIES']['PODNAME_EL']['VALUE']?></span>
						<span class="name"><?=$arItem['NAME']?></span>
					</div>
				</a>
			<? endif; 
			endforeach; ?>
		</div>
	</div>
</section>