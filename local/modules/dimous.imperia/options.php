<?php
use Bitrix\Main\Application;

$oRequest = Application::getInstance()->getContext()->getRequest();
$sId = $oRequest["mid"];
$sUrl = $oRequest->getDecodedUri();
$aTabs = [
    [
        "DIV" => "settings",
        "TAB" => "Настройки",
        "TITLE" => "Настройка параметров модуля",
    ]
];
$aOptions = [
    ["limit", "Записей всего", "100", ["text"]],
    ["per_page", "Записей на страницу", "10", ["text"]],
];
$oTabControl = new CAdminTabControl("main", $aTabs);

$oTabControl->begin();
?>

<form action="<?=$sUrl?>" method="post">
    <?=bitrix_sessid_post()?>

    <?php $oTabControl->beginNextTab() ?>

    <?php __AdmSettingsDrawList($sId, $aOptions) ?>

	<?php $oTabControl->buttons([]) ?>
</form>

<?php
$oTabControl->end();

if ($oRequest->isPost() && check_bitrix_sessid()) {
    __AdmSettingsSaveOptions($sId, $aOptions);

    LocalRedirect($sUrl);
}
?>