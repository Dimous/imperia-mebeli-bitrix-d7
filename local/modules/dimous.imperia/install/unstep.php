<?php if ($errorException = $APPLICATION->GetException()): ?>
    <?=CAdminMessage::ShowMessage($errorException->GetString())?>
<?php else: ?>
    <?=CAdminMessage::ShowNote("Удаление модуля успешно завершено")?>
<?php endif ?> 
 
<form action="<?=$APPLICATION->GetCurPage()?>"><input type="hidden" name="lang" value="<?=LANG?>" /><input type="submit" value="Вернуться в список" /></form>