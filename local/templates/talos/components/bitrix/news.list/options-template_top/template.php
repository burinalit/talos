<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<section class="company_advantages">
    <div class="row">
    <div class="col-xs-12">
        <h2><?=$arResult['NAME']?></h2>
        <div class="list_option">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="item col-xs-6 col-sm-4" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="wrp" style="background-image: url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>);">
                <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
                   <!-- <div class="advantages_img">
                                        <img
                        src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                        width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
                        height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
                        alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                        title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                        />
                                    </div>!-->
                <?endif?>

                <?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
                    <p><?echo $arItem["NAME"]?></p>
                <?endif;?>
            </div>
		</div>
	<?endforeach;?>
        </div>
	<div style="clear:both;"></div>
    </div> 
    </div> 
</section>
