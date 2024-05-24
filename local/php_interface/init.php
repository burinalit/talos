<?php
if (\Bitrix\Main\Config\Option::get('main', 'update_devsrv') === 'Y') {
    $APPLICATION->SetPageProperty('robots', 'noindex');
}
?>