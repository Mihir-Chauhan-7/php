<div>
    <div class="heading"><h4>Categories</h4></div>
    <hr> 
    <div>
        <ul style="box-shadow: 1px 1px 8px 1px #c4c5cc;" id="categories" class="list-group">
        <?php foreach($this->getCategories() as $category) : ?>
            <?php if($category->getProductCount() == 0):
                    continue; 
                  endif; ?>
            <li id="category_<?php echo $category->id?>" class="list-group-item" onclick="ajax.setUrl('<?php echo $this->getUrl('view','category_index',['id' => $category->id]) ?>'); ajax.load();"z>
            <?php echo $category->getName($category->path); ?>
                <span class="badge badge-secondary badge-pill count">
                    <?php echo $category->getProductCount(); ?>
                </span>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>   
</div>
