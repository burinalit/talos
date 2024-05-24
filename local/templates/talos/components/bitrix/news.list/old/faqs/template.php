<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="card">
		<div class="card-header" id="heading<?=$this->GetEditAreaId($arItem['ID']);?>">
			<h2 class="mb-0">
				<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse<?=$this->GetEditAreaId($arItem['ID']);?>" aria-expanded="true" aria-controls="collapse<?=$this->GetEditAreaId($arItem['ID']);?>">
					<?= $arItem["PROPERTIES"]['FAQS_QUEST']['VALUE'];?>
			</button>
			</h2>
		</div>
		<div id="collapse<?=$this->GetEditAreaId($arItem['ID']);?>" class="collapse" aria-labelledby="heading<?=$this->GetEditAreaId($arItem['ID']);?>" data-parent="#accordeonFAQ">
			<div class="card-body">
			    <?=htmlspecialcharsBack($arItem["PROPERTIES"]['FAQS_ANSWER']['VALUE']['TEXT'])?>
			</div>
		</div>
	</div>
<?endforeach;?>