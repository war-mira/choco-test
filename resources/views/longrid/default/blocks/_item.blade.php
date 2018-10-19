<?php foreach($items as $item):?>
    <?php if($item):?>
        <div class="grid__column--item <?=$item['type']?> fill <?= $item['class']??''?>">
            <?=$item['content']?>
        </div>
    <?php else:?>
        <div class="grid__column--item empty">
        </div>
    <?php endif;?>
<?php endforeach;?>