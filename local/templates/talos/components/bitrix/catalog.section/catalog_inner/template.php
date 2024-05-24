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

foreach ($arResult['ITEMS'] as $key => $arItem) {  
    ?>
    <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <div class="item col-xs-3" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
    	<div class="">
            <a href="<? echo $arItem["DETAIL_PAGE_URL"]; ?>">
                <div class="product_img" style="background-image: url('<? echo $arItem['PREVIEW_PICTURE']['SRC']; ?>')">
                </div>
                <div class="rating"> 					
                    <?	
			$rating = intval($arItem['PROPERTIES']['EMARKET_RATING']['VALUE']);
			for($i=1; $i<=10; $i++)
			{
                            if(($i == $rating) && ($i%2)) 
                            {
				echo '<div class="star half"></div>';
				$i++;
				continue;
                            }
                            if(!($i%2))
                            {
                                if($i < $rating)
                                {
                                    echo '<div class="star"></div>';
                                }
                                elseif($i == $rating)
                                {
                                    echo '<div class="star"></div>';
                                }
                                elseif($i > $rating)
                                {
                                    echo '<div class="star empty"></div>';
                                }
                            }
			}
                    ?>
                    </div>
                <h3 title="<? echo $arItem['NAME']; ?>"> <? echo $arItem['NAME']; ?> </h3>
                    
                <div class="price"><?
    			if (!empty($arItem['MIN_PRICE']))
    			{
    				if ('N' == $arParams['PRODUCT_DISPLAY_MODE'] && isset($arItem['OFFERS']) && !empty($arItem['OFFERS']))
    				{
    					echo GetMessage(
    						'CT_BCS_TPL_MESS_PRICE_SIMPLE_MODE',
    						array(
    							'#PRICE#' => $arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE'],
    							'#MEASURE#' => GetMessage(
    								'CT_BCS_TPL_MESS_MEASURE_SIMPLE_MODE',
    								array(
    									'#VALUE#' => $arItem['MIN_PRICE']['CATALOG_MEASURE_RATIO'],
    									'#UNIT#' => $arItem['MIN_PRICE']['CATALOG_MEASURE_NAME']
    								)
    							)
    						)
    					);
    				}
    				else
    				{
    					echo $arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE'];
    				}
    				if ('Y' == $arParams['SHOW_OLD_PRICE'] && $arItem['MIN_PRICE']['DISCOUNT_VALUE'] < $arItem['MIN_PRICE']['VALUE'])
    				{
    					?> <span><? echo $arItem['MIN_PRICE']['PRINT_VALUE']; ?></span><?
    				}
    			}
    			?>
    			</div>
                
                <?if (0 < $arItem['MIN_PRICE']['DISCOUNT_DIFF']):?>
                    <div class="product_sale"> <?=GetMessage("SALE")?>
                    </div>
                <?endif;?>  
                
                  <?if(!empty($arItem["PROPERTIES"]["EMARKET_NEW"]["VALUE"])):?>                
                    <div class="product_new"> <?=GetMessage("NEW")?>                    
                    </div>
                <?endif;?>
                <?if(!empty($arItem["PROPERTIES"]["EMARKET_HIT"]["VALUE"])):?>                
                    <div class="product_hit"> <?=GetMessage("HIT")?>                    
                    </div>
                <?endif;?>
            </a>    
    	</div>
    </div>
<? 

} ?>
<?

?>