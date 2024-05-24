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

$items = array();
$vn_params = array();
foreach($arResult["ITEMS"] as $key=>$arItem){
	if($arItem['CODE'] == 'CASE_VN_DLINA' || $arItem['CODE'] == 'CASE_VN_SHIR' || $arItem['CODE'] == 'CASE_VN_VUS')
		$vn_params[] = $arItem;
	else
		$items[] = $arItem;
}
?>
<div class="bx_filter">
	<div class="bx_filter_section">
		<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
			<?foreach($arResult["HIDDEN"] as $arItem):?>
			<input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
			<?endforeach; ?>
				<div class="bx_filter_parameters_box active">
					<span class="bx_filter_container_modef"></span>
					<div class="bx_filter_parameters_box_title" onclick="smartFilter.hideFilterProps(this)">Внутренние габариты (мм)</div>
					<div class="bx_filter_block">
						<div class="bx_filter_parameters_box_container">
						<?php foreach($vn_params as $key => $arItem){
							if($arItem["DISPLAY_TYPE"] == "A" && ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)) continue;
							$arCur = current($arItem["VALUES"]); ?>
							<div class="bx_filter_parameters_box_elem_title"><?=$arItem["NAME"]?></div>
							<div class="bx_filter_parameters_box_container_list">
								<div class="bx_filter_parameters_box_container_block">
									<div class="bx_filter_input_container">
										<input placeholder="от <?= $arItem["VALUES"]["MIN"]["VALUE"] ?>" class="min-price" type="text"
											name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
											id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
											value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>" size="5" onkeyup="smartFilter.keyup(this)"/>
									</div>
								</div>
								<div class="bx_filter_parameters_box_container_line">-</div>
								<div class="bx_filter_parameters_box_container_block">
									<div class="bx_filter_input_container">
										<input placeholder="до <?= $arItem["VALUES"]["MAX"]["VALUE"] ?>" class="max-price" type="text"
											name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
											id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
											value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>" size="5" onkeyup="smartFilter.keyup(this)"/>
									</div>
								</div>
							</div>	
							<div style="clear: both;"></div>
							<div class="bx_ui_slider_track" id="drag_track_<?=$key?>">
								<?
								$value1 = $arItem["VALUES"]["MIN"]["VALUE"];
								$value5 = $arItem["VALUES"]["MAX"]["VALUE"];
								?>
								<div class="bx_ui_slider_part p1"><span><?=$value1?></span></div>
								<div class="bx_ui_slider_part p5"><span><?=$value5?></span></div>

								<div class="bx_ui_slider_pricebar_VD" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
								<div class="bx_ui_slider_pricebar_VN" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
								<div class="bx_ui_slider_pricebar_V"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
								<div class="bx_ui_slider_range" 	id="drag_tracker_<?=$key?>"  style="left: 0;right: 0;">
									<a class="bx_ui_slider_handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
									<a class="bx_ui_slider_handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
								</div>
							</div>
							<?
							$arJsParams = array(
								"leftSlider" => 'left_slider_'.$key,
								"rightSlider" => 'right_slider_'.$key,
								"tracker" => "drag_tracker_".$key,
								"trackerWrap" => "drag_track_".$key,
								"minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
								"maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
								"minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
								"maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
								"curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
								"curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
								"fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
								"fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
								"precision" => $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0,
								"colorUnavailableActive" => 'colorUnavailableActive_'.$key,
								"colorAvailableActive" => 'colorAvailableActive_'.$key,
								"colorAvailableInactive" => 'colorAvailableInactive_'.$key,
							);
							?>
							<script type="text/javascript">
								BX.ready(function(){
									window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
								});
							</script>
								
							<? } ?>	
						</div>
					</div>
				</div>
			
			<?php foreach($items as $key => $arItem){
				if(empty($arItem["VALUES"]) || isset($arItem["PRICE"])) continue;
				if($arItem["DISPLAY_TYPE"] == "A" && ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)) continue; ?>
				<div class="bx_filter_parameters_box param_box_<?=mb_strtolower($arItem["CODE"])?> <?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?>active<?endif?>">
					<span class="bx_filter_container_modef"></span>
					<?php if($arItem["CODE"] == 'CASE_WEIGHT_EMPTY'):?>
					    <div class="bx_filter_parameters_box_title" onclick="smartFilter.hideFilterProps(this)">Вес пустого кейса (кг)</div>
					<?php elseif($arItem["CODE"] == 'CASE_VOLUME_IN'): ?>
					    <div class="bx_filter_parameters_box_title" onclick="smartFilter.hideFilterProps(this)">Внутренний объем (л)</div>
					<?php elseif($arItem["CODE"] == 'CASE_KOLESA' || $arItem["CODE"] == 'CASE_RUCHK'): ?>
					
					<?php else: ?>
					    <div class="bx_filter_parameters_box_title" onclick="smartFilter.hideFilterProps(this)"><?=$arItem["NAME"]?></div>
					<?php endif; ?>					
					<div class="bx_filter_block">
						<div class="bx_filter_parameters_box_container">
						<?
						$arCur = current($arItem["VALUES"]);
						switch ($arItem["DISPLAY_TYPE"])
						{
							case "A"://NUMBERS_WITH_SLIDER ?>
							<div class="bx_filter_parameters_box_container_list">
								<div class="bx_filter_parameters_box_container_block">
									<div class="bx_filter_input_container">
										<input placeholder="от <?= $arItem["VALUES"]["MIN"]["VALUE"] ?>" class="min-price"
											type="text"
											name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
											id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
											value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
											size="5"
											onkeyup="smartFilter.keyup(this)"
										/>
									</div>
								</div>
								<div class="bx_filter_parameters_box_container_line">-</div>
								<div class="bx_filter_parameters_box_container_block">
									<div class="bx_filter_input_container">
										<input placeholder="до <?= $arItem["VALUES"]["MAX"]["VALUE"] ?>" class="max-price"
											type="text"
											name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
											id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
											value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
											size="5"
											onkeyup="smartFilter.keyup(this)"
										/>
									</div>
								</div>
							</div>	
								<div style="clear: both;"></div>

								<div class="bx_ui_slider_track" id="drag_track_0<?=$key?>">
									<?
									$value1 = $arItem["VALUES"]["MIN"]["VALUE"];
									$value5 = $arItem["VALUES"]["MAX"]["VALUE"];
									?>
									<div class="bx_ui_slider_part p1"><span><?=$value1?></span></div>
									<div class="bx_ui_slider_part p5"><span><?=$value5?></span></div>

									<div class="bx_ui_slider_pricebar_VD" style="left: 0;right: 0;" id="colorUnavailableActive_0<?=$key?>"></div>
									<div class="bx_ui_slider_pricebar_VN" style="left: 0;right: 0;" id="colorAvailableInactive_0<?=$key?>"></div>
									<div class="bx_ui_slider_pricebar_V"  style="left: 0;right: 0;" id="colorAvailableActive_0<?=$key?>"></div>
									<div class="bx_ui_slider_range" 	id="drag_tracker_0<?=$key?>"  style="left: 0;right: 0;">
										<a class="bx_ui_slider_handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_0<?=$key?>"></a>
										<a class="bx_ui_slider_handle right" style="right:0;" href="javascript:void(0)" id="right_slider_0<?=$key?>"></a>
									</div>
								</div>
								<?
								$arJsParams = array(
									"leftSlider" => 'left_slider_0'.$key,
									"rightSlider" => 'right_slider_0'.$key,
									"tracker" => "drag_tracker_0".$key,
									"trackerWrap" => "drag_track_0".$key,
									"minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
									"maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
									"minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
									"maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
									"curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
									"curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
									"fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
									"fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
									"precision" => 2,
									"colorUnavailableActive" => 'colorUnavailableActive_0'.$key,
									"colorAvailableActive" => 'colorAvailableActive_0'.$key,
									"colorAvailableInactive" => 'colorAvailableInactive_0'.$key,
								);
								?>
								<script type="text/javascript">
									BX.ready(function(){
										window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
									});
								</script>
								<?
								break;
							case "B"://NUMBERS
								?>
								<div class="bx_filter_parameters_box_container_block"><div class="bx_filter_input_container">
									<input
										class="min-price"
										type="text"
										name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
										id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
										value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
										size="5"
										onkeyup="smartFilter.keyup(this)"
										/>
								</div></div>
								<div class="bx_filter_parameters_box_container_block"><div class="bx_filter_input_container">
									<input
										class="max-price"
										type="text"
										name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
										id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
										value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
										size="5"
										onkeyup="smartFilter.keyup(this)"
										/>
								</div></div>
								<?
								break;
							case "G"://CHECKBOXES_WITH_PICTURES
								?>
								<?foreach ($arItem["VALUES"] as $val => $ar):?>
									<input
										style="display: none"
										type="checkbox"
										name="<?=$ar["CONTROL_NAME"]?>"
										id="<?=$ar["CONTROL_ID"]?>"
										value="<?=$ar["HTML_VALUE"]?>"
										<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
									/>
									<?
									$class = "";
									if ($ar["CHECKED"])
										$class.= " active";
									if ($ar["DISABLED"])
										$class.= " disabled";
									?>
									<label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label dib<?=$class?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'active');">
										<span class="bx_filter_param_btn bx_color_sl">
											<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
											<span class="bx_filter_btn_color_icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
											<?endif?>
										</span>
									</label>
								<?endforeach?>
								<?
								break;
							case "H"://CHECKBOXES_WITH_PICTURES_AND_LABELS
								?>
								<?foreach ($arItem["VALUES"] as $val => $ar):?>
									<input
										style="display: none"
										type="checkbox"
										name="<?=$ar["CONTROL_NAME"]?>"
										id="<?=$ar["CONTROL_ID"]?>"
										value="<?=$ar["HTML_VALUE"]?>"
										<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
									/>
									<?
									$class = "";
									if ($ar["CHECKED"])
										$class.= " active";
									if ($ar["DISABLED"])
										$class.= " disabled";
									?>
									<label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label<?=$class?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'active');">
										<span class="bx_filter_param_btn bx_color_sl">
											<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
												<span class="bx_filter_btn_color_icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
											<?endif?>
										</span>
										<span class="bx_filter_param_text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
										if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
											?> (<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
										endif;?></span>
									</label>
								<?endforeach?>
								<?
								break;
							case "K"://RADIO_BUTTONS
								?>
								<?php if($arItem["CODE"] == 'CASE_KOLESA' || $arItem["CODE"] == 'CASE_RUCHK'): ?>
								<div class="alter_radio">
								<?php if($arItem["CODE"] == 'CASE_KOLESA'): ?>
								    <div class="alter_radio_title">Колеса</div>
								<?php elseif($arItem["CODE"] == 'CASE_RUCHK'): ?>
								    <div class="alter_radio_title">Выдвижная ручка</div>
								<?php endif; ?>	
									<div class="switch">
										<?foreach($arItem["VALUES"] as $key => $ar): ?>
											<input id="<? echo $ar["CONTROL_ID"] ?>" class="radio_<?= $key ?>" type="radio" name="<? echo $ar["CONTROL_NAME_ALT"] ?>" value="<? echo $ar["HTML_VALUE_ALT"] ?>" 
											<?php if($ar["CHECKED"] || $key == 109 || $key == 111) echo 'checked="checked"'; else echo ''; ?> 
											<? echo $ar["CHECKED"]? 'checked="checked"': '' ?> onclick="smartFilter.click(this)"/>
											<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label" for="<? echo $ar["CONTROL_ID"] ?>"><?=$ar["VALUE"];?></label>
										<?endforeach;?>
									</div>
								</div>
								<script>
								document.querySelectorAll('.switch input').forEach(radio => {
									radio.addEventListener('change', () => {
										document.body.dataset.switch = radio.value;		
									})
								})
								</script>								
								<?php else: ?>
									<?foreach($arItem["VALUES"] as $val => $ar):?>
									<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label" for="<? echo $ar["CONTROL_ID"] ?>">
										<span class="bx_filter_input_checkbox <? echo $ar["DISABLED"] ? 'disabled': '' ?>">
											<input
												type="radio"
												value="<? echo $ar["HTML_VALUE_ALT"] ?>"
												name="<? echo $ar["CONTROL_NAME_ALT"] ?>"
												id="<? echo $ar["CONTROL_ID"] ?>"
												<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
												onclick="smartFilter.click(this)"
											/>
											<span class="bx_filter_param_text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
											if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
												?> (<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
											endif;?></span>
										</span>
									</label>
								   <?endforeach;?>
								<?php endif; ?>	
								<?
								break;
							default://CHECKBOXES
								?>
								<?foreach($arItem["VALUES"] as $val => $ar):?>
									<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label <? echo $ar["DISABLED"] ? 'disabled': '' ?>" for="<? echo $ar["CONTROL_ID"] ?>">
										<span class="bx_filter_input_checkbox">
											<input
												type="checkbox"
												value="<? echo $ar["HTML_VALUE"] ?>"
												name="<? echo $ar["CONTROL_NAME"] ?>"
												id="<? echo $ar["CONTROL_ID"] ?>"
												<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
												onclick="smartFilter.click(this)"
											/>
											<span class="bx_filter_param_text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
											if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
												?> (<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
											endif;?></span>
										</span>
									</label>
								<?endforeach;?>
						<? } ?>
						</div>
						<div class="clb"></div>
					</div>
				</div>
			<? } ?>
			<div class="clb"></div>
			<div class="bx_filter_button_box active">
				<div class="bx_filter_block">
					<div class="bx_filter_parameters_box_container">
						<input class="btn bx_filter_search_button" type="submit" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>" />
						<div class="bx_filter_popup_result <?=$arParams["POPUP_POSITION"]?>" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?> style="display: inline-block;">
							<span class="arrow"></span>
							<a href="<?echo $arResult["FILTER_URL"]?>">Показать <span id="modef_num"> <?= intval($arResult["ELEMENT_COUNT"]) ?></span> позиций</a>
						</div>
					</div>
				</div>
			</div>
		</form>
		<div style="clear: both;"></div>
	</div>
</div>
<script>
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', 'vertical');
</script>