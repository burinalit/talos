<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->SetTitle($arResult["NAME"]);
$APPLICATION->AddChainItem($arResult["NAME"], "/");
?>
<div class="about-section niokr-stage-section">
<div class="container">
<div class="grid_services_element">
	<div class="container_small">
		<div class="setup">
			<div class="setup-row">
				<div class="setup-info">
					<div class="title"><?=$arResult["NAME"]?></div>
					<div class="text"><?=htmlspecialcharsBack($arResult["PROPERTIES"]['SERV_KRDESC']['VALUE']['TEXT'])?></div>
					<?php if($arResult["PROPERTIES"]['SERV_CHARACT']['VALUE']): ?>
					<div class="type-list">
					    <ul>
					    <?php foreach($arResult["PROPERTIES"]['SERV_CHARACT']['VALUE'] as $key => $item): ?>
							<li><?= $arResult["PROPERTIES"]['SERV_CHARACT']['DESCRIPTION'][$key]; ?>: <span><?= $item; ?></span></li>
						<?php endforeach; ?>
						</ul>
					</div>
					<?php endif; ?>
				</div>
				<div class="setup-img" style="background-image: url(<?=$arResult["DETAIL_PICTURE"]["SRC"]?>);"></div>
			</div>
			<div class="setup-desc">
			<h3>Требования к автомобилю</h3>
			<?=$arResult["DETAIL_TEXT"]?></div>
			<div class="tabs setup-tab">
			<? foreach($arResult["PROPERTIES"]['SERV_LIST']['VALUE'] as $key => $item):
				$db_list = CIBlockSection::GetList(Array(), $arFilter = Array("IBLOCK_ID"=>7, "ID"=>$item), true, Array("ID", "IBLOCK_ID", "NAME"));
                $props_array = $db_list->GetNext(); $key++;?>
				<input type="radio" name="tab-btn" id="tab-btn-<?= $key ?>" value="" <?php if($props_array['ELEMENT_CNT'] > 0):?> checked <?php endif; ?>>
				<label for="tab-btn-<?= $key ?>"><?= $props_array['NAME'] ?></label>
			<?php endforeach; ?>
			
			<? foreach($arResult["PROPERTIES"]['SERV_LIST']['VALUE'] as $key => $elem):
			    $key++;
				$arOrder = Array("SORT"=>"ASC");
				$arSelect = Array("ID", "NAME", "IBLOCK_ID", "DETAIL_PICTURE" ,"PROPERTY_*", "CATALOG_GROUP_1");
				$arFilter = Array("IBLOCK_ID" => 7, 'SECTION_ID'=>$elem, "ACTIVE"=>"Y");
				$res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
				$listElements = array();
				while($ob = $res->GetNextElement()) $listElements[] = $ob->GetFields();
			?>
			    <div class="tabs-content" id="content-<?= $key ?>">
				<div class="layer">
					<table style="width: 100%;" class="setup-table blueTable">
						<div class="title"><?=$arResult["PROPERTIES"]['SERV_SUBTITLE']['VALUE']?></div>
						<thead>
							<tr class="title-table">
							    <th class="table_title_number">№</th>
								<th class="table_title_name">Модель</th>
								<th>Номер детали</th>
								<th>Цена</th>
							</tr>
						</thead>
                        <tbody>						
							<?php foreach($listElements as $k => $item): $k++;?>
							<tr>
							    <td><?= $k ?></td>
								<td><?= $item['NAME'] ?></td>
								<td class="table_text_131">
								<p>
									<img src="<?= CFile::GetPath($item['DETAIL_PICTURE']) ?>" class="resize_thumb" alt="">
									<span><img src="<?= CFile::GetPath($item['DETAIL_PICTURE']) ?>" class="resize_big" alt=""></span>
									<?= $item['PROPERTY_131'] ?>
								</p>	
								</td>
								<td><?= $item['CATALOG_PRICE_1'] ?> р.</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
				</div>
			<?php endforeach; ?>
			</div>
			<div class="setup-progres">
				<div class="title">
					Процесс монтажа
				</div>
				<div class="setup-progres-row">
				<? 	$arOrder = Array("SORT"=>"ASC");
					$arSelect = Array("ID", "NAME", "IBLOCK_ID", "DETAIL_PICTURE", "PROPERTY_*");
					$arFilter = Array("IBLOCK_ID" => 13, 'SECTION_ID' => $arResult["PROPERTIES"]['SERV_MONT']['VALUE'], "ACTIVE"=>"Y");
					$res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
					$listMontazh = array();
					while($ob = $res->GetNextElement()) $listMontazh[] = $ob->GetFields();
				?>
				<?php foreach($listMontazh as $elem):?>
					<div class="item">
						<a href="<?= $elem['PROPERTY_171'] ?>">
							<div class="item-img">
								<img src="<?= CFile::GetPath($elem['DETAIL_PICTURE']) ?>" alt="">
							</div>
							<div class="name"><?= $elem['NAME'] ?></div>
						</a>
					</div>
                <?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>