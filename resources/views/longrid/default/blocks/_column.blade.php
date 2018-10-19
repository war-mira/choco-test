<div class="grid__column">
  <?php foreach ($column->items as $item):?>
      <?= $item->getHtml();?>
  <?php endforeach;?>
</div>