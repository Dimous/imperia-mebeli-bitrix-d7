<?php
use Bitrix\Main\Loader;
use Dimous\Imperia\Main;

class VisitList extends CBitrixComponent {
    public function executeComponent() {
        $this->arResult = Loader::includeModule("dimous.imperia") ? Main::list() : [];

        $this->includeComponentTemplate();
    }
}
