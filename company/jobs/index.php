<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Вакансии");

?>
<?php $APPLICATION->IncludeComponent(
	"bitrix:news",
	"vacancies.1",
	array(
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "31",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => 36000000,
		"ADD_ELEMENT_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CHECK_DATES" => "Y",
		"CONSENT_URL" => "/company/consent/",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_MENU_SHOW" => "N",
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DETAIL_SUMMARY_FORM_SHOW" => "Y",
		"DETAIL_TEMPLATE" => "detail.1",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_MENU_SHOW" => "N",
		"LIST_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_SALARY_SHOW" => "Y",
		"LIST_TEMPLATE" => "list.1",
		"MENU_CHILD" => "",
		"MENU_LEVEL" => "",
		"MENU_ROOT" => "",
		"MENU_TEMPLATE" => "",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CITY" => "CITY",
		"PROPERTY_SALARY" => "WAGE",
		"PROPERTY_SKILL" => "EXPERIENCE",
		"PROPERTY_TYPE_EMPLOYMENT" => "EMPLOYMENT_TYPE",
		"SEF_FOLDER" => "/company/jobs/",
		"SEF_MODE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"USE_SHARE" => "N",
		"LIST_CONTACT_PERSON_SHOW" => "Y",
		"LIST_SUMMARY_FORM_SHOW" => "Y",
		"LIST_SUMMARY_FORM_TEMPLATE" => ".default",
		"LIST_SUMMARY_FORM_TITLE" => "Отправить резюме",
		"LIST_SUMMARY_FORM_ID" => "11",
		"LIST_SUMMARY_FORM_VACANCY" => "form_text_45",
		"LIST_SUMMARY_CONSENT_URL" => "",
		"LIST_DETAIL_PAGE_USE" => "Y",
		"LIST_CONTACT_PERSON_IBLOCK_TYPE" => "content",
		"LIST_CONTACT_PERSON_IBLOCK_ID" => "32",
		"LIST_CONTACT_PERSON_IBLOCK_ELEMENT" => "529",
		"LIST_CONTACT_PERSON_FORM_SHOW" => "Y",
		"LIST_PROPERTY_CONTACT_PERSON_EMAIL" => "EMAIL",
		"LIST_PROPERTY_CONTACT_PERSON_PHONE" => "PHONE",
		"LIST_LINK_BLANK" => "Y",
		"DETAIL_SUMMARY_FORM_TEMPLATE" => ".default",
		"DETAIL_SUMMARY_FORM_TITLE" => "Отправить резюме",
		"DETAIL_SUMMARY_FORM_ID" => "11",
		"DETAIL_SUMMARY_FORM_VACANCY" => "form_text_45",
		"SETTINGS_USE" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"SEF_URL_TEMPLATES" => array(
			"news" => "/company/jobs/",
			"section" => "",
			"detail" => "#ELEMENT_ID#/",
		)
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
