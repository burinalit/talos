<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="auth_form">  
    
<?
if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
	ShowMessage($arResult['ERROR_MESSAGE']);
?>

<?if($arResult["FORM_TYPE"] == "login"):?>
    
    <h1><?=GetMessage("TITLE_AUTH")?></h1>

<form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="/<?/*=$arResult["AUTH_URL"]?>*/?>">
<?if($arResult["BACKURL"] <> ''):?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?endif?>
<?foreach ($arResult["POST"] as $key => $value):?>
	<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
<?endforeach?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="AUTH" />	

			<div class="auth_item row"> 
                            <span class="col-xs-1"><?=GetMessage("AUTH_LOGIN")?>: </span>                            
                            <input class="col-xs-7" type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" size="17" />
                            <div class="clear_both"></div>
                        </div>	
		
			<div class="auth_item row">
                        <span class="col-xs-1"><?=GetMessage("AUTH_PASSWORD")?>:</span>
			<input class="col-xs-7" type="password" name="USER_PASSWORD" maxlength="50" size="17" autocomplete="off" />                       
                        
                        <?if($arResult["SECURE_AUTH"]):?>
                            <span class="bx-auth-secure" id="bx_auth_secure<?=$arResult["RND"]?>" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
                                <div class="bx-auth-secure-icon"></div>
                            </span>
                            <noscript>
                                <span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
                                    <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
                                </span>
                            </noscript>
                        <script type="text/javascript">
                        document.getElementById('bx_auth_secure<?=$arResult["RND"]?>').style.display = 'inline-block';
                        </script>
                        <?endif?>
                        
			</div>
		
<? /* if ($arResult["STORE_PASSWORD"] == "Y"):?>
		<div>
			<div valign="top"><input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" /></div>
			<div width="100%"><label for="USER_REMEMBER_frm" title="<?=GetMessage("AUTH_REMEMBER_ME")?>"><?echo GetMessage("AUTH_REMEMBER_SHORT")?></label></div>
		</div>
<?endif */?>
<?if ($arResult["CAPTCHA_CODE"]):?>
		<div>
                    <div>
			<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
			<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
			<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
			<input type="text" name="captcha_word" maxlength="50" value="" /></td>
                    </div>
<?endif?>
                <?
                ShowMessage($arParams["~AUTH_RESULT"]);
                ShowMessage($arResult['ERROR_MESSAGE']);
                ?>
		<div class="auth_item">

			<input class="btn btn_blue" type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" />
                        <span class="link" id="btn_forgot" href="<?/*=$arResult["AUTH_FORGOT_PASSWORD_URL"]*/?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></span>
		</div>
                <div class="clear_both"></div>
</form>
    
<?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>		
		<p><?=GetMessage("NO_ACCAUNT")?> <noindex><a class="link" href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a></noindex><br /></p>
<?endif?>
    
    <div id="forgotpass" class="row">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.forgotpasswd",
	"e-market_fogot_pas",
            Array(
                    "DATA" => $arResult
            )
        );?>
    </div>


<?
elseif($arResult["FORM_TYPE"] == "otp"):
?>

<form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
<?if($arResult["BACKURL"] <> ''):?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?endif?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="OTP" />
	<table width="95%">
		<tr>
			<td colspan="2">
			<?echo GetMessage("auth_form_comp_otp")?><br />
			<input type="text" name="USER_OTP" maxlength="50" value="" size="17" autocomplete="off" /></td>
		</tr>
<?if ($arResult["CAPTCHA_CODE"]):?>
		<tr>
			<td colspan="2">
			<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
			<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
			<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
			<input type="text" name="captcha_word" maxlength="50" value="" /></td>
		</tr>
<?endif?>
<?if ($arResult["REMEMBER_OTP"] == "Y"):?>
		<tr>
			<td valign="top"><input type="checkbox" id="OTP_REMEMBER_frm" name="OTP_REMEMBER" value="Y" /></td>
			<td width="100%"><label for="OTP_REMEMBER_frm" title="<?echo GetMessage("auth_form_comp_otp_remember_title")?>"><?echo GetMessage("auth_form_comp_otp_remember")?></label></td>
		</tr>
<?endif?>
		<tr>
			<td colspan="2"><input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" /></td>
		</tr>
		<tr>
			<td colspan="2"><noindex><a href="<?=$arResult["AUTH_LOGIN_URL"]?>" rel="nofollow"><?echo GetMessage("auth_form_comp_auth")?></a></noindex><br /></td>
		</tr>
	</table>
        
</form>
<?
else:
?>

<form action="<?=$arResult["AUTH_URL"]?>">
	<table width="95%">
		<tr>
			<td align="center">
				<?=$arResult["USER_NAME"]?><br />
				[<?=$arResult["USER_LOGIN"]?>]<br />
				<a href="<?=$arResult["PROFILE_URL"]?>" title="<?=GetMessage("AUTH_PROFILE")?>"><?=GetMessage("AUTH_PROFILE")?></a><br />
			</td>
		</tr>
		<tr>
			<td align="center">
			<?foreach ($arResult["GET"] as $key => $value):?>
				<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
			<?endforeach?>
			<input type="hidden" name="logout" value="yes" />
			<input type="submit" name="logout_butt" value="<?=GetMessage("AUTH_LOGOUT_BUTTON")?>" />
			</td>
		</tr>
	</table>
</form>

<?endif?>
</div>	      
       