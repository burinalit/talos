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
$containerId = "catalog-compare-list".$this->randString();
?>
<div class="emarket-compare-list" id="<?echo $containerId?>">
	<?$frame = $this->createFrame($containerId)->begin('');?>
    <div class="btn">
	<a href="javascript:void(0);"
		class="ico <?if(count($arResult) <= 0) echo 'deactivated';?>" 
		name="compare_list"
		title="<?if(count($arResult) <= 0) echo GetMessage('CATALOG_COMPARE_EMPTY');?>"
	>
            <i class="mdi mdi-poll"></i>
        <span class="txt"><?=GetMessage("COMPARE")?></span>
        <?if(count($arResult) > 0) echo count($arResult);?>
        <?if(count($arResult) == 0) echo 0;?>
	
        </a>
    </div>    
	
    
    <?
    $arSection = array();
    foreach($arResult as $item)
      {
        $arSection[$item['IBLOCK_SECTION_ID']][] = $item;
      }          
    ?>
    <?if(count($arResult) > 0):?>    
    <div  style='display:none;' class="bx_catalog_compare_form">
        <?
		$arIds = array();
		foreach($arSection as $key=>$sect):?>

             <ul>
             <?foreach($sect as $item):
				$arIds[] = $item['ID'];
                $img = "";
                if($item['PREVIEW_PICTURE'])
                {
                    $img = CFile::ShowImage($item['PREVIEW_PICTURE'], 65, 65, "border=0", "", false);
 
                }
                elseif($item['DETAIL_PICTURE'])
                {                  
                    $img = CFile::ShowImage($item['DETAIL_PICTURE'], 65, 65, "border=0", "", false);
                }                                              
             ?>
                <li>
					<div class="bx-basket-item-list-item-remove mdi mdi-close" onclick="delCompareList(<?=$item['ID']?>);return false;" title="<?=GetMessage("CATALOG_DELETE")?>"></div>
                    <a href="<?=$item['DETAIL_PAGE_URL']?>">
                    <div class="compare_item_img">
                        <?=$img?>
                    </div>
                    <div class="compare-prod-name">
                        <?=$item['NAME']?>                    
                    </div>
                    <div class="clear_both"></div>
                    </a>
                </li>
            <?endforeach;?> 
                <?if(count($sect) > 1):?>
                <li class="btn-item">
                    <a class="link-compare em_button" title="<?=GetMessage("CATALOG_COMPARE")?>" href="<?=SITE_DIR?>catalog/compare.php?SECTION=<?=$key?>"><?=GetMessage("CATALOG_COMPARE")?></a>
                </li>
                <?else:?>
                <li class="btn-item">
                    <a class="link-compare em_button disabled" title="<?=GetMessage("CATALOG_COMPARE")?>" href="#"><?=GetMessage("CATALOG_COMPARE")?></a>
                </li>
                <?endif;?>       
            </ul>
        <?endforeach;?>

    </div>
    <?endif;?>
	<script>
		$(function(){
			setCompareProd(<?=CUtil::PhpToJSObject($arIds)?>);
		});
	</script>
<?$frame->end();?>
</div>