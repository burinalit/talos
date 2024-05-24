<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//echo '<pre>'; print_r($arResult); echo '</pre>';?>

<section class="news_main">
    <div class="row">
        <div class="col-xs-12">
            <h2><?=$arResult['NAME']?></h2>
            <div>
            <?foreach($arResult["ITEMS"] as $arItem):?>
                        <?
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                <div class="item col-xs-12 col-sm-6" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <a class="news_img col-xs-4" href="<?echo $arItem["DETAIL_PAGE_URL"]?>" style="background-image: url(<?echo $arItem["PREVIEW_PICTURE"]["SRC"]?>)">                

                    </a>

                    <!-- <a class="news_img col-xs-4" href="<?echo $arItem["DETAIL_PAGE_URL"]?>">                
                        <?
                            $renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array("width" => 170, "height" => 135), BX_RESIZE_IMAGE_EXACT, false);
                            echo '<img alt="'.$arItem["NAME"].'" src="'.$renderImage["src"].'" />';
                        ?>
                    </a> !-->
                    <div class="news_content col-xs-8">
                        <span><?echo $arItem["ACTIVE_FROM"]?></span>
                        <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">
                            <h3><?echo $arItem["NAME"]?></h3>
                        </a>
                        <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
                            <p><?echo $arItem["PREVIEW_TEXT"];?></p>
                        <?endif;?>
                    </div>
                </div>    
            <?endforeach;?>
            <div class="clear_both"></div>
            </div>
        </div>
    </div>
</section>