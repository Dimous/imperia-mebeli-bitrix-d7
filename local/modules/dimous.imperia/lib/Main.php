<?php
namespace Dimous\Imperia {
    use Bitrix\Main\Config\Option;

    class Main {
        public function log($aEvent) {
            $nUserId = $aEvent["USER_ID"];

            if (0 < $nUserId) {
                AuthLogTable::add(["USER_ID" => $nUserId]);
            }
        }
        //---

        public static function getListPageSize() {
            return Option::get("dimous.imperia", "per_page");
        }
        //---

        public static function getListLimit() {
            return min(AuthLogTable::getCount(), Option::get("dimous.imperia", "limit"));
        }
        //---

        public static function list($nLimit = 5, $nOffset = 0) {
            return array_map(
                function ($oItem) {
                    return [
                        "data" => [
                            "DATE" => FormatDate("d F Y, h:i:s", MakeTimeStamp($oItem["DATE"])),
                            "USER" => implode(" ", array_filter([$oItem["NAME"], $oItem["PATRONYMIC"], $oItem["SURNAME"]])),
                        ],
                        "actions" => [],
                    ];
                },
                AuthLogTable::getList([
                    "select" => [
                        "DATE",
                        "NAME" => "USER.NAME",
                        "SURNAME" => "USER.LAST_NAME",
                        "PATRONYMIC" => "USER.SECOND_NAME",
                    ],
                    "order" => [
                        "DATE" => "DESC"
                    ],
                    "limit" => $nLimit,
                    "offset" => $nOffset,
                ])->fetchAll()
            );
        }
    }
}