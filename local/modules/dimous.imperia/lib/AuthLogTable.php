<?php
namespace Dimous\Imperia {
    use Bitrix\Main\{
        Type,
        UserTable,
    };
    use Bitrix\Main\ORM\{
        Fields,
        Query\Join,
        Data\DataManager,
    };

    class AuthLogTable extends DataManager {
        public static function getTableName() {
            return "auth_log";
        }
        //---

        public static function getMap() {
            return [
                new Fields\IntegerField("ID", [
                    "primary" => TRUE,
                    "autocomplete" => TRUE,
                ]),

                new Fields\DatetimeField("DATE", [
                    "default_value" => function () {
                        return new Type\DateTime();
                    }
                ]),

                new Fields\IntegerField("USER_ID", [
                    "required" => TRUE,
                ]),

                new Fields\Relations\Reference("USER", UserTable::class, Join::on("this.USER_ID", "ref.ID")),

                // с джоинами не работает? почему-то пустота
                // new Fields\ExpressionField("USER_FULL_NAME", "CONCAT(%s, ' ', %s, ' ', %s)", ["USER.LAST_NAME", "USER.NAME", "USER.SECOND_NAME"]),
            ];
        }
    }
}