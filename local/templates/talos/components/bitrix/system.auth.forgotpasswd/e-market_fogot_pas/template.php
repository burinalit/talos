<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */

//one css for all system.auth.* forms
$APPLICATION->SetAdditionalCSS("/bitrix/css/main/system.auth/flat/style.css");
?>

<div class="forgot_pass col-xs-8">

<?
if(!empty($arParams["~AUTH_RESULT"])):
	$text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
?>
	<div class="alert <?=($arParams["~AUTH_RESULT"]["TYPE"] == "OK"? "alert-success":"alert-danger")?>"><?=nl2br(htmlspecialcharsbx($text))?></div>
<?endif?>

	<h3 class="bx-title"><?=GetMessage("AUTH_GET_CHECK_STRING")?></h3>

	<?
        ShowMessage($arParams["~AUTH_RESULT"]);
        ?>

	<form name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
<?if($arResult["BACKURL"] <> ''):?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?endif?>
		<input type="hidden" name="AUTH_FORM" value="Y">
		<input type="hidden" name="TYPE" value="SEND_PWD">


			<!-- <div class="bx-authform-label-container"><?echo GetMessage("AUTH_LOGIN_EMAIL")?></div>  !-->
			<div class="auth_item">
				<input type="hidden" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" />
				<input class="col-xs-10" type="text" name="USER_EMAIL" />
                                <input class="col-xs-2 btn btn_blue" type="submit" name="send_account_info" value="<?=GetMessage("AUTH_SEND")?>" />
			</div>
                 <span><?=GetMessage("AUTH_FORGOT_PASSWORD_1")?></span>
                 <div class="clear_both"></div>


	</form>
<?echo '<pre>'; print_r($arResult); echo '</pre>';?>

</div>

<script type="text/javascript">
document.bform.onsubmit = function(){document.bform.USER_EMAIL.value = document.bform.USER_LOGIN.value;};
document.bform.USER_LOGIN.focus();
</script>
