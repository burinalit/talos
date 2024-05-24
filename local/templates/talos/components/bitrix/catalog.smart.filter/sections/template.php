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

use Bitrix\Iblock\SectionPropertyTable;

$this->setFrameMode(true);

$category = $arParams['SECTION_ID'];
$class_sect = 'filter-parameters'.$category;
if($category == 7 || $category == 9)
	$predtext = 'Подбор кейсов по внутренним размерам, мм';
else
	$predtext = 'Подбор рэкового кейса-контейнера по высоте (U)';

$parameters = array();
foreach($arResult["ITEMS"] as $key=>$arItem){
	if(($category == 7 || $category == 9) && ($arItem["CODE"] == 'CASE_VN_DLINA' || $arItem["CODE"] == 'CASE_VN_SHIR' || $arItem["CODE"] == 'CASE_VN_VUS'))
		$parameters[] = $arItem;
	if($category == 11 && $arItem["CODE"] == 'CASE_RAK_VUS')
		$parameters[] = $arItem;	
}
$fSections = CIBlockSection::GetList(Array("ID" => "ASC"), Array("IBLOCK_ID" => 2, "ACTIVE" => "Y"), false, Array('ID', 'NAME', 'CODE', 'UF_SECT_SMALL_NAME')); 

$arFilter = array("IBLOCK_ID"=>2, "ID" => $category);
$arSelect =  array("ID", "UF_SECT_IMSEARCH");
$rsResult = CIBlockSection::GetList(array("SORT"=>"ASC"), $arFilter, false, $arSelect);
while($ob = $rsResult->GetNext()) {
     $sect_act_id = $ob["ID"];
     $sect_img = $ob["UF_SECT_IMSEARCH"];
} 
?>
<div class="bx-filter section_slider">
	<div class="container">
		<div class="section_slider_block">
			<section class="left_block">
			<ul class="filter-nav">
			<?php while($flSections = $fSections->GetNext()):
			    if($flSections['ID'] == $category) $class_el = 'active'; else $class_el = ''; ?>
				<li class="<?= $class_el ?>"><span><? echo $flSections['UF_SECT_SMALL_NAME']; ?></span></li>
			<?php endwhile; ?>	
			</ul>		
			<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
				<?foreach($arResult["HIDDEN"] as $arItem):?>
				<input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
				<?endforeach;?>
				<div class="predtext"><?= $predtext ?></div>
				<div class="columns">
					<? foreach($parameters as $key=>$arItem){
						if(empty($arItem["VALUES"]) || isset($arItem["PRICE"])) continue;
						if ($arItem["DISPLAY_TYPE"] === SectionPropertyTable::NUMBERS_WITH_SLIDER && ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0))
							continue;
						?>
						<div class="bx-filter-parameters-box <?= $class_sect ?>">
							<div class="bx-filter-block" data-role="bx_filter_block">
								<div class="row bx-filter-parameters-box-container">
								<? $arCur = current($arItem["VALUES"]);
								switch ($arItem["DISPLAY_TYPE"]){
									case SectionPropertyTable::NUMBERS_WITH_SLIDER: //NUMBERS_WITH_SLIDER ?>
										<div class="bx-filter-parameters-box-container-block bx-left">
											<div class="bx-filter-input-container">
												<input placeholder="<?echo $arItem["NAME"]?>" class="min-price" type="text" name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>" value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>" size="5" onkeyup="smartFilter.keyup(this)"/>
											</div>
										</div>
									<? break;
									case SectionPropertyTable::DROPDOWN: //DROPDOWN
										$checkedItemExist = false; ?>
										<div class="bx-filter-parameters-box-container-block parametr_select">
											<div class="bx-filter-select-container">
												<div class="bx-filter-select-block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
													<div class="bx-filter-select-text" data-role="currentOption">
														<? foreach ($arItem["VALUES"] as $val => $ar){
															if ($ar["CHECKED"]){
																echo $ar["VALUE"];
																$checkedItemExist = true;
															}
														}if (!$checkedItemExist){
															echo GetMessage("CT_BCSF_FILTER_ALL");
														}?>
													</div>
													<div class="bx-filter-select-arrow"></div>
													<input
														style="display: none"
														type="radio"
														name="<?=$arCur["CONTROL_NAME_ALT"]?>"
														id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
														value=""
													/>
													<?foreach ($arItem["VALUES"] as $val => $ar):?>
														<input
															style="display: none"
															type="radio"
															name="<?=$ar["CONTROL_NAME_ALT"]?>"
															id="<?=$ar["CONTROL_ID"]?>"
															value="<? echo $ar["HTML_VALUE_ALT"] ?>"
															<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
														/>
													<?endforeach?>
													<div class="bx-filter-select-popup" data-role="dropdownContent" style="display: none;">
														<ul>
															<li>
																<label for="<?="all_".$arCur["CONTROL_ID"]?>" class="bx-filter-param-label" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
																	<? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
																</label>
															</li>
														<?
														foreach ($arItem["VALUES"] as $val => $ar):
															$class = "";
															if ($ar["CHECKED"])
																$class.= " selected";
															if ($ar["DISABLED"])
																$class.= " disabled";
														?>
															<li>
																<label for="<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label<?=$class?>" data-role="label_<?=$ar["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')"><?=$ar["VALUE"]?></label>
															</li>
														<?endforeach?>
														</ul>
													</div>
												</div>
											</div>
										</div>
									<? break;
								} ?>
								</div>
							</div>
						</div>
					<? } ?>
				</div>
				<div class="buttons">
					<div class="bx-filter-button-box">
						<div class="bx-filter-block">
							<div class="bx-filter-parameters-box-container">
								<input class="btn btn-themes" type="submit" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>"/>
								<div class="bx-filter-popup-result" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?> style="display: inline-block;">
									<?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.(int)($arResult["ELEMENT_COUNT"] ?? 0).'</span>'));?>
									<a href="<?echo $arResult["FILTER_URL"]?>" target=""><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
			</section>
			<section class="right_block">
			    <img src="<?= CFile::GetPath($sect_img)?>" />
			</section>
		</div>
	</div>
</div>
<script type="text/javascript">
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>