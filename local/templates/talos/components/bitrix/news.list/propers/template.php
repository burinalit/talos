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

$fSections = CIBlockSection::GetList(false, Array("IBLOCK_ID" => 50, "ID" => 98, "ACTIVE"=>"Y", "GLOBAL_ACTIVE"=>"Y", "SECTION_ACTIVE" => "Y"),
    false, Array("UF_PROPERS_NAME", "UF_PROPERS_PROT_NAME", "UF_PROPERS_PROT_DESC", "UF_PROPERS_TEMP_NAME", "UF_PROPERS_TEMP_DESC", "UF_PROPERS_HEI_NAME", "UF_PROPERS_HEI_DESC"), false);
$flSections = $fSections->Fetch();

CModule::IncludeModule("iblock");
$res = CIBlockSection::GetByID(98);
if($arSection = $res->GetNext()){
  $cat_text = $arSection["DESCRIPTION"];
}
$cat_title = $flSections['UF_PROPERS_NAME'];
$cat_prot_name = $flSections['UF_PROPERS_PROT_NAME'];
$cat_prot_desc = $flSections['UF_PROPERS_PROT_DESC'];
$cat_temp_name = $flSections['UF_PROPERS_TEMP_NAME'];
$cat_temp_desc = $flSections['UF_PROPERS_TEMP_DESC'];
$cat_hei_name = $flSections['UF_PROPERS_HEI_NAME'];
$cat_hei_desc = $flSections['UF_PROPERS_HEI_DESC'];
?>
<section class="page_block propers_section">
    <div class="container">
	    <div class="title_section">
		    <div class="title_block"><?= $cat_title ?></div>
			<div class="desc_block"><?= $cat_text ?></div>
		</div>
		<div class="propers_content">
		    <div class="propers_info">
			    <div class="elem">
				    <span class="name"><?= $cat_prot_name ?></span>
					<span class="text"><?= $cat_prot_desc ?></span>
				</div>
				<div class="elem">
				    <span class="name"><?= $cat_temp_name ?></span>
					<span class="text"><?= $cat_temp_desc ?></span>
				</div>
				<div class="elem">
				    <span class="name"><?= $cat_hei_name ?></span>
					<span class="text"><?= $cat_hei_desc ?></span>
				</div>
			</div>
			<div class="propers_elems">
			    <? foreach($arResult["ITEMS"] as $key => $arItem): 
				$top = $arItem['PROPERTIES']['COORDS_TOP']['VALUE'];
				$left = $arItem['PROPERTIES']['COORDS_LEFT']['VALUE'];
				?>
					<div class="prop_elem" style="top: <?= $top ?>; left: <?= $left ?>;">
					    <div class="prop_content">
						    <div class="prop_img" style="background-image:url(<?=$arItem["DETAIL_PICTURE"]['SRC']?>);"></div>
							<div class="prop_title_section">
							    <span class="name"><?= $arItem['PROPERTIES']['PROP_NAME']['VALUE']?></span>
					            <span class="text"><?= $arItem['PROPERTIES']['PROP_DESC']['VALUE']?></span>
							</div>
						</div>
					</div>
				<? endforeach; ?>
			</div>
		</div>
	</div>
</section>