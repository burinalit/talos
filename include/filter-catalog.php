<?
$listElements = array();
$rsParentSection = CIBlockSection::GetList(
		Array('sort' => 'ASC'),
		Array('IBLOCK_ID' => 2, 'ACTIVE' => 'Y', 'SECTION_ID' => $GLOBALS['SECTION_FILTER_CATEGORY'])
	);	
while ($arParentSection = $rsParentSection->GetNext())
{
	if($arParentSection['DEPTH_LEVEL'] != 1)
	    $child_class = 'category_childs';
	$listElements[] = $arParentSection;
}
?>
<ul class="categories tab <?= $child_class ?>">
	<?php foreach($listElements as $key => $elem): if($key == 0) $first_elem = $elem['ID']; ?>
		<li class=""><a class="filter_category_id" data-filter-category-id="<?= $elem['ID']?>" href="#"><?= $elem['NAME']?></a></li>
	<?php endforeach; ?>	
	</ul>
	<script>
	$(function(){
		$(".filter_category_id").click(function(){
		  var modalNumber =  $(this).data("filter-category-id");
		  $(this).parent().addClass("active");
          window.location.href="?category="+modalNumber;			  
		});
	});
	</script>
	<?php  
	if($_GET['category']) $category = $_GET['category'];
	else $category = $first_elem;
	 ?>
	 <script>
	$('[data-filter-category-id=<?php echo $category; ?>]')
		.parent().addClass("active");
	</script>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.smart.filter",
	"params",
	Array(
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CONVERT_CURRENCY" => "N",
		"DISPLAY_ELEMENT_COUNT" => "Y",
		"FILTER_NAME" => "arrFilter",
		"FILTER_VIEW_MODE" => "horizontal",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "catalog",
		"PAGER_PARAMS_NAME" => "arrPager",
		"POPUP_POSITION" => "left",
		"PREFILTER_NAME" => "smartPreFilter",
		"PRICE_CODE" => array(),
		"SAVE_IN_SESSION" => "N",
		"SECTION_CODE" => "",
		"SECTION_CODE_PATH" => "",
		"SECTION_DESCRIPTION" => "-",
		"SECTION_ID" => $category,
		"SECTION_TITLE" => "-",
		"SEF_MODE" => "Y",
		"SEF_RULE" => "/catalog/#SECTION_CODE#/filter/#SMART_FILTER_PATH#/",
		"SMART_FILTER_PATH" => "",
		"TEMPLATE_THEME" => "blue",
		"XML_EXPORT" => "N"
	)
);?>