<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
if(empty($arResult))
	return "";

$strReturn = ''; ?>
<?php
$itemSize = count($arResult);
$strReturn .= '<nav aria-label="breadcrumb" class="breadcrumbs">
<ol class="breadcrumb">';
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$arrow = ($index > 0? '' : '');

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .=  $arrow.'
			<li class="breadcrumb-item"><a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="item">'.$title.'</a><span class="divider">|</span></li>';
	}
	else
	{
		$strReturn .= $arrow.'
			<li class="breadcrumb-item active" aria-current="page"><a title="'.$title.'" itemprop="item">'.$title.'</a></li>';
	}
}

$strReturn .= '</ol>
</nav>';
return $strReturn;
?>
