<ul >
    <?php foreach ($arResult as $aEntry): ?>
        <li ><?=$aEntry["data"]["DATE"]?> - <?=$aEntry["data"]["USER"]?></li>
    <?php endforeach ?>
</ul>