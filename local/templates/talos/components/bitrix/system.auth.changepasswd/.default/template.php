<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="bx-auth">

<h1><?=GetMessage("AUTH_CHANGE_PASSWORD")?></h1>

<?
ShowMessage($arParams["~AUTH_RESULT"]);
?>
<form method="post" action="<?=$arResult["AUTH_FORM"]?>" name="bform">
	<?if (strlen($arResult["BACKURL"]) > 0): ?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
	<? endif ?>
	<input type="hidden" name="AUTH_FORM" value="Y">
	<input type="hidden" name="TYPE" value="CHANGE_PWD">
	<table class="data-table bx-changepass-table row">
		<tbody>
			<tr>
				<td class="bx-auth-label col-xs-4"><span><?=GetMessage("AUTH_LOGIN")?><i class="starrequired">*</i></span></td>
				<td><input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" class="bx-auth-input col-xs-8" /></td>
			</tr>
			<tr>
				<td class="bx-auth-label col-xs-4"><span><?=GetMessage("AUTH_CHECKWORD")?><i class="starrequired">*</i></span></td>
				<td><input type="text" name="USER_CHECKWORD" maxlength="50" value="<?=$arResult["USER_CHECKWORD"]?>" class="bx-auth-input col-xs-8" /></td>
			</tr>
			<tr>
				<td class="bx-auth-label col-xs-4"><span><?=GetMessage("AUTH_NEW_PASSWORD_REQ")?><i class="starrequired">*</i></span></td>
				<td><input type="password" name="USER_PASSWORD" maxlength="50" value="<?=$arResult["USER_PASSWORD"]?>" class="bx-auth-input col-xs-8" autocomplete="off" />
<?if($arResult["SECURE_AUTH"]):?>
				<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
				<noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
<script type="text/javascript">
document.getElementById('bx_auth_secure').style.display = 'inline-block';
</script>
<?endif?>
				</td>
			</tr>
			<tr>
				<td class="bx-auth-label col-xs-4"><span><?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?><i class="starrequired">*</i></span></td>
				<td><input type="password" name="USER_CONFIRM_PASSWORD" maxlength="50" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" class="bx-auth-input col-xs-8" autocomplete="off" /></td>
			</tr>
		</tbody>
	</table>

<div class="register_info">
	<p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
	<p><span class="starrequired">*</span><?=GetMessage("AUTH_REQ")?></p>
	<input class="btn btn_blue" type="submit" name="change_pwd" value="<?=GetMessage("AUTH_CHANGE")?>" /></td>
</div>


<p class="auth_link">
<a href="<?=$arResult["AUTH_AUTH_URL"]?>"><?=GetMessage("AUTH_AUTH")?></a>
</p>

</form>

<script type="text/javascript">
document.bform.USER_LOGIN.focus();
</script>
</div>