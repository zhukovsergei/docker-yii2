<div class="panel" id="fullTreeCats">
  <div class="panel-heading">
    <h3 class="panel-title">Current tree</h3>
  </div>
  <div class="panel-body">
    <?$depth=0?>
    <?foreach($categories as $n => $category):?>
  <?if($category->depth == $depth):?>
    </li>
  <?else:?>
    <?if($category->depth > $depth):?>
      <ul>
    <?else:?>
      </li>
      <?for($i=$depth-$category->depth;$i;$i--):?>
        </ul>
        </li>
      <?endfor;?>
    <?endif;?>
  <?endif;?>
    <li>
      <?=$category->name?> <a href="#" class="delTreeNode" data-id="<?=$category->id?>">[x]</a>
      <?$depth=$category->depth;?>
      <?endforeach;?>

      <?for($i=$depth;$i;$i--):?>
    </li>
    </ul>
  <?endfor;?>
  </div>

</div>