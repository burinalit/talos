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

//bxslider plugin
$this->setFrameMode(true);
?>
<div class="row">  
    <div class="col-xs-12">
        <div class="owl-carousel">
            <?foreach($arResult["ITEMS"] as $arItem):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <div class="item col-xs-12" style="background-image: url(<?echo $arItem["DETAIL_PICTURE"]["SRC"]?>);" >
                         <div class="content">
                            <h1 style="color: <?echo $arItem["PROPERTIES"]["COLOR_TXT"]["VALUE"]?>;"><?echo $arItem["NAME"]?></h1>
                                                       
                            <?if(!empty($arItem["PREVIEW_TEXT"])):?>     
                                <p style="color: <?echo $arItem["PROPERTIES"]["COLOR_TXT"]["VALUE"]?>;"> <?echo $arItem["PREVIEW_TEXT"]?> </p>                            
                            <?endif;?>                            
                            
                            <?if(!empty($arItem["PROPERTIES"]["LINK"]["VALUE"])):?>     
                                <a class="btn btn_blue" href="<?echo $arItem["PROPERTIES"]["LINK"]["VALUE"]?>"><?=GetMessage('K_MORE_TEXT')?></a>
                            <?endif;?>
                            
                        </div>
                    </div>
                </div>
            <?endforeach;?>
        </div>  
    </div>    
</div>