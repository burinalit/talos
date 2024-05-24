<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<?if (!empty($arResult)):?>
<ul class="menu">
    <?
    foreach($arResult as $arItem):
            if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
                    continue;
    ?>
            <?if($arItem["SELECTED"]):?>
                    <li><a class="black_blue selected" href="javascript:void(0);"class="font-light"><?=$arItem["TEXT"]?></a></li>
            <?else:?>
                    <li><a class="black_blue" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
            <?endif?>

    <?endforeach?>
    <div class="clear_both"></div>
</ul>
<?endif?>