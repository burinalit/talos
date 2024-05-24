<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
?><div class="bx-hdr-profile">
<?if (!$compositeStub && $arParams['SHOW_AUTHOR'] == 'Y'):?>
	<div class="bx-basket-block">

		<?if ($USER->IsAuthorized()):
			$name = trim($USER->GetFullName());
			if (! $name)
				$name = trim($USER->GetLogin());
			if (strlen($name) > 15)
				$name = substr($name, 0, 12).'...';
			?>
			<a href="<?=$arParams['PATH_TO_PROFILE']?>"><?=htmlspecialcharsbx($name)?></a>
			&nbsp;
			<a href="?logout=yes"><?=GetMessage('TSB1_LOGOUT')?></a>
		<?else:?>
			<a href="<?=$arParams['PATH_TO_REGISTER']?>?login=yes"><?=GetMessage('TSB1_LOGIN')?></a>
			&nbsp;
			<a href="<?=$arParams['PATH_TO_REGISTER']?>?register=yes"><?=GetMessage('TSB1_REGISTER')?></a>
		<?endif?>
	</div>
<?endif?>
	<div class="bx-basket-block"><?
		if (!$arResult["DISABLE_USE_BASKET"])
		{
			?></i>
			<a class="btn btn_green" href="<?=$arParams["PATH_TO_BASKET"]?>">
                            <i class="mdi mdi-cart"></i>
                <span class="txt"><?=GetMessage('TSB1_CART')?> </span><? echo $arResult['NUM_PRODUCTS'];?>
                        </a>
                        <?
		}
		
		if ($arParams['SHOW_PERSONAL_LINK'] == 'Y'):?>
			<div style="padding-top: 4px;">
			<span class="icon_info"></span>
			<a href="<?=$arParams['PATH_TO_PERSONAL']?>"><?=GetMessage('TSB1_PERSONAL')?></a>
			</div>
		<?endif?>
	</div>
</div>

