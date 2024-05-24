<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$curPage = $APPLICATION->GetCurPage(true);
?>
<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width minimum-scale=1.0 maximum-scale=1.0 user-scalable=no" />
		<title><?$APPLICATION->ShowTitle();?></title>
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
		<?
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/owl.carousel.min.css");
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/fonts/Mont/stylesheet.css");
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/fonts/Xolonium/stylesheet.css");
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/styles.css");
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/mobile.css");
		
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/libs/slick/slick.css");
		$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/libs/slick/slick-theme.css");
		$APPLICATION->SetAdditionalCSS("https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css");
	
		$APPLICATION->AddHeadScript("https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js");
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/libs/mdl/mdl.css");	
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/libs/mdl/mdl.js");		
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/owl.carousel.min.js");
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/libs/slick/slick.min.js");
		$APPLICATION->AddHeadScript("https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js");
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.mousewheel.js");
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/custom.js");	
		$APPLICATION->ShowHead();
		?>
	</head>
<body>
<!--? $APPLICATION->ShowPanel(); ?-->
<header>
    <div class="container">
	<div class="header_block desktop">
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_DIR."include/header/logo.php"
			),
			false
		);?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_DIR."include/header/contacts.php"
			),
			false
		);?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_DIR."include/header/phone.php"
			),
			false
		);?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_DIR."include/header/buttons.php"
			),
			false
		);?>		
		<?
		$APPLICATION->IncludeComponent(
			"bitrix:search.title", 
			"cases", 
			array(
				"NUM_CATEGORIES" => "3",
				"TOP_COUNT" => "4",
				"ORDER" => "date",
				"USE_LANGUAGE_GUESS" => "Y",
				"CHECK_DATES" => "Y",
				"SHOW_OTHERS" => "N",
				"PAGE" => "/search",
				"CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS"),
				"CATEGORY_0" => array(
					0 => "no",
				),
				"CATEGORY_0_iblock_catalog" => array(
					0 => "all",
				),
				"SHOW_INPUT" => "Y",
				"INPUT_ID" => "title-search-input",
				"CONTAINER_ID" => "title-search",
				"COMPONENT_TEMPLATE" => "vepr",
				"TEMPLATE_THEME" => "blue",
				"PRICE_CODE" => array(
				),
				"PRICE_VAT_INCLUDE" => "Y",
				"PREVIEW_TRUNCATE_LEN" => "",
				"SHOW_PREVIEW" => "Y",
				"PREVIEW_WIDTH" => "75",
				"PREVIEW_HEIGHT" => "75",
				"CONVERT_CURRENCY" => "N"
			),
			false
		);?>
		<div class="nav_menu">
			<a class="header__menu-btn" href="#">Меню</a>
		</div>
	</div>
    </div>
</header>
<main class="main <?$APPLICATION->ShowProperty('main')?>">