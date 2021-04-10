<?php
use Bitrix\Main\{
    Application,
    EventManager,
    ModuleManager,
    Config\Option,
};

class dimous_imperia extends CModule {
    public function __construct() {
        $this->PARTNER_NAME = "dimous";
        $this->MODULE_VERSION = "0.0.1";
        $this->MODULE_NAME = "Visit logger";
        $this->MODULE_DESCRIPTION = "Логирует авторизации";
        $this->MODULE_ID = str_replace("_", ".", get_class($this));
    }
    //---

    public function InstallDB() {
        global $DB;

        $DB->Query("CREATE TABLE IF NOT EXISTS `auth_log` (`ID` int not null auto_increment, `USER_ID` int not null, `DATE` datetime, PRIMARY KEY (`ID`))");
    }
    //---

    public function UnInstallDB() {
        global $DB;

        $DB->Query("DROP TABLE `auth_log`");
    }
    //---

    public function InstallFiles() {
        $sDocRoot = Application::getDocumentRoot();

        CopyDirFiles(__DIR__ . "/admin", "{$sDocRoot}/bitrix/admin", FALSE);
        CopyDirFiles(__DIR__ . "/components", "{$sDocRoot}/bitrix/components", TRUE, TRUE);
    }
    //---

    public function UnInstallFiles() {
        $sDocRoot = Application::getDocumentRoot();

        DeleteDirFiles(__DIR__ . "/admin", "{$sDocRoot}/bitrix/admin");
        DeleteDirFiles(__DIR__ . "/components", "{$sDocRoot}/bitrix/components");
    }
    //---

    public function InstallEvents() {
        EventManager::getInstance()->registerEventHandler("main", "OnAfterUserLogin", $this->MODULE_ID, "Dimous\Imperia\Main", "log");
    }
    //---

    public function UnInstallEvents() {
        EventManager::getInstance()->unRegisterEventHandler("main", "OnAfterUserLogin", $this->MODULE_ID, "Dimous\Imperia\Main", "log");
    }
    //---

    public function DoInstall() {
        global $APPLICATION;

        $this->InstallDB();
        $this->InstallFiles();
        $this->InstallEvents();

        ModuleManager::registerModule($this->MODULE_ID);

        $APPLICATION->IncludeAdminFile("Установка модуля {$this->MODULE_NAME}", __DIR__ . "/step.php");
    }
    //---

    public function DoUninstall() {
        global $APPLICATION;

        ModuleManager::unRegisterModule($this->MODULE_ID);

        $this->UnInstallDB();
        $this->UnInstallFiles();
        $this->UnInstallEvents();

        Option::delete($this->MODULE_ID);

        $APPLICATION->IncludeAdminFile("Удаление модуля {$this->MODULE_NAME}", __DIR__ . "/unstep.php");
    }
}
