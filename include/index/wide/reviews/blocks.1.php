<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

use intec\core\collections\Arrays;
use intec\core\helpers\Html;
use intec\core\io\Path;

/**
 * @var Arrays $blocks
 * @var array $block
 * @var array $data
 * @var string $page
 * @var Path $path
 * @global CMain $APPLICATION
 */

?>
<?= Html::beginTag('div', ['style' => array (
  'background-color' => '#f8f9fb',
  'padding-top' => '50px',
  'padding-bottom' => '50px',
)]) ?>
<?php $APPLICATION->IncludeComponent('intec.universe:main.reviews', 'template.5', array (
  'IBLOCK_TYPE' => 'content',
  'IBLOCK_ID' => '30',
  'ELEMENTS_COUNT' => '4',
  'SECTIONS_MODE' => 'id',
  'SETTINGS_USE' => 'Y',
  'LAZYLOAD_USE' => 'N',
  'HEADER_SHOW' => 'Y',
  'HEADER_POSITION' => 'center',
  'HEADER_TEXT' => 'Отзывы',
  'DESCRIPTION_SHOW' => 'N',
  'COLUMNS' => 4,
  'LINK_USE' => 'N',
  'FOOTER_SHOW' => 'Y',
  'FOOTER_POSITION' => 'center',
  'FOOTER_BUTTON_SHOW' => 'Y',
  'FOOTER_BUTTON_TEXT' => 'Показать все',
  'LIST_PAGE_URL' => '/company/reviews/',
  'SECTION_URL' => '',
  'DETAIL_URL' => '',
  'CACHE_TYPE' => 'A',
  'CACHE_TIME' => 3600000,
  'SORT_BY' => 'SORT',
  'ORDER_BY' => 'ASC',
), false) ?>
<?= Html::endTag('div') ?>
