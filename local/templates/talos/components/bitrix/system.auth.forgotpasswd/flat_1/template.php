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

<?$this->SetViewTarget("forgot_pass");//дальше контент который буферизируется?>

<div class="bx-authform col-xs-12">

<?
if(!empty($arParams["~AUTH_RESULT"])):
	$text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
?>
	<div class="alert <?=($arParams["~AUTH_RESULT"]["TYPE"] == "OK"? "alert-success":"alert-danger")?>"><?=nl2br(htmlspecialcharsbx($text))?></div>
<?endif?>

	<h3 class="bx-title"><?=GetMessage("AUTH_GET_CHECK_STRING")?></h3>


	<p class="bx-authform-content-container"><?=GetMessage("AUTH_FORGOT_PASSWORD_1")?></p>

	<form name="bform" id="enter__forgotpsw-form" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
<?if($arResult["BACKURL"] <> ''):?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?endif?>
		<input type="hidden" name="AUTH_FORM" value="Y">
		<input type="hidden" name="TYPE" value="SEND_PWD">

		<div class="auth_item bx-authform-formgroup-container">
			<p class="bx-authform-label-container"><?echo GetMessage("AUTH_LOGIN_EMAIL")?></p>

				<input class="col-xs-10" type="text" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" />
				<input type="hidden" name="USER_EMAIL" />
                                <input type="submit" class="col-xs-2 btn btn_blue" name="send_account_info" value="<?=GetMessage("AUTH_SEND")?>" />

		</div>

	</form>
</div>

<?$this->EndViewTarget();//конец буферизации?>

<script type="text/javascript">
document.bform.onsubmit = function(){document.bform.USER_EMAIL.value = document.bform.USER_LOGIN.value;};
document.bform.USER_LOGIN.focus();
</script>
