<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
global $APPLICATION;

$APPLICATION->IncludeComponent(
				"krayt:one.click",
				"none",
				Array(
					"ELEMENT_ID" => $arResult['ID'],
					"K_ONE_BNT_NAME" => "",
					"K_ONE_BTN_SEND" => "",
					"K_ONE_EVENT_TYPE" => "EMARKET_FEEDBACK_PROPD",
					"K_ONE_FORM_TITLE" => "",
					"K_ONE_TEXT_OK" => ""
				),
				$component
	);

$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.mousewheel.js");
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/iLightbox/ilightbox.js");
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/js/iLightbox/light-skin/skin.css");
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/js/iLightbox/ilightbox.css");
if (isset($templateData['JS_OBJ']))
{
?>
<script type="text/javascript">
BX.ready(
	BX.defer(function(){
		if (!!window.<? echo $templateData['JS_OBJ']; ?>)
		{
			window.<? echo $templateData['JS_OBJ']; ?>.allowViewedCount(true);
		}
	})
);
</script>
<?
}
?>