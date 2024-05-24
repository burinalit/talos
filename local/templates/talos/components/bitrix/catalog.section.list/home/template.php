<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
$arFilter = Array("IBLOCK_ID" => 14, 'SECTION_ID' => false);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
$listElements = array();
while($ob = $res->GetNextElement())
{
	$razd = $ob->GetFields();
    $listElements[] = $razd['PROPERTY_155'];	
}
?>
<section class="services_home page_home">
<div class="container">
	<div class="prod-grid">
		<div class="row">
		<?php foreach($listElements as $key => $elems): if($key == 4) $class = 12; else $class = 6;?>
		    <? $res = CIBlockSection::GetByID($elems);
			if($ar_res = $res->GetNext()){
			  $title = $ar_res['NAME']; $link = $ar_res['SECTION_PAGE_URL']; $image = $ar_res['PICTURE']; $text = $ar_res['DESCRIPTION'];
			} ?>
			<div class="col-<?= $class?> pb-3">
				<div class="card-prod">
					<div class="visible-card mask-bottom" style="background-image: url('<?= CFile::GetPath($image)?>')">
						<div>
							<h3><?= $title?></h3>
							<a href="<?= $link?>" class="text-link"><?=GetMessage("K_DETAILS")?></a>
						</div>
					</div>
					<div class="hover-card mask-all">
						<div class="card-text">
							<h3><?= $title?></h3>
							<p><?= $text?></p>
							<a href="<?= $link?>" class="btn"><?=GetMessage("K_DETAILS")?></a>
						</div>
						<div class="card-image" style="background-image: url('<?= CFile::GetPath($image)?>')"></div>
					</div>
				</div>
			</div>			
		<?php endforeach; ?>		
		</div>
	</div>
</div>
</section>