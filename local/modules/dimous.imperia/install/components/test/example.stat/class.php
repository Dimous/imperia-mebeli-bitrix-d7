<?php
use Dimous\Imperia\Main;

class VisitList extends CBitrixComponent {
    public function executeComponent() {
        $this->arResult = CModule::IncludeModule("dimous.imperia") ? Main::list() : [];

        $this->includeComponentTemplate();
    }
}