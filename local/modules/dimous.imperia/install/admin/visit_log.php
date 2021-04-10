<?php
use Bitrix\Main\{
    // Grid\Options,
    UI\PageNavigation,
};
use Dimous\Imperia\Main;

require_once $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php";

CModule::IncludeModule("dimous.imperia");

$APPLICATION->SetTitle("Список посещений");

require_once $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php";

$sKey = "visits";

// $oGridOptions = new Options($sKey);
// $oNavParams = $oGridOptions->GetNavParams();
// $oSorting = $oGridOptions->GetSorting(["sort" => ["ID" => "DESC"], "vars" => ["by" => "by", "order" => "order"]]);

$oPageNavigation = new PageNavigation($sKey);
$oPageNavigation->allowAllRecords(FALSE)->setRecordCount(Main::getListLimit())->setPageSize(Main::getListPageSize())->initFromUri();
?>

<?php
$APPLICATION->IncludeComponent("bitrix:main.ui.grid", "", [
    "ENABLE_LABEL" => TRUE,
    "GRID_ID" => $sKey,
    "COLUMNS" => [
        [
            "id" => "DATE",
            "name" => "Дата",
            "default" => TRUE,
        ],
        [
            "id" => "USER",
            "name" => "Пользователь",
            "default" => TRUE,
        ],
    ],
    "ROWS" => Main::list($oPageNavigation->getLimit(), $oPageNavigation->getOffset()),
]);
?>

<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php";
?>