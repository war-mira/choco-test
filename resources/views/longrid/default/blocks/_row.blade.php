<div class="grid__row">
    <div class="grid__row--container <?=$container->type?>">
        <?php foreach ($container->columns as $column):?>
            <?= $column->getHtmlBlock() ?>
        <?php endforeach;?>
    </div>
    <?php if($container->additionalRow):?>
        <div class="grid__row--container <?=$container->additionalRowType?>">
            <div class="grid__column">
                <?=$container->additionalRowContent?>
            </div>
        </div>
    <?php endif;?>
</div>