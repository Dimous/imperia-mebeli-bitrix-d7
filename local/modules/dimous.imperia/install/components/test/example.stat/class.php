<?php
use Dimous\Imperia\Main;

class VisitList extends CBitrixComponent {
    public function executeComponent() {
        if (CModule::IncludeModule("dimous.imperia")) {
            $this->arResult = Main::list();
        }

        $this->includeComponentTemplate();
    }
}