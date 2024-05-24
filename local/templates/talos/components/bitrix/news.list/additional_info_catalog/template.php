<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//echo '<pre>'; print_r($arResult); echo '</pre>';?>

<div class="additional_info">
            <?foreach($arResult["ITEMS"] as $arItem):?>
                        <?
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                <div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <h3><?echo $arItem["NAME"]?>
                        <i class="mdi mdi-plus"></i>
                    </h3>
                    <div class="item_content">                            
                        <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
                           <?echo $arItem["PREVIEW_TEXT"];?>
                        <?endif;?>
                    </div>
                </div>    
            <?endforeach;?>
</div>
