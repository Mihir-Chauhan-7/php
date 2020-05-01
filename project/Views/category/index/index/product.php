<?php 

$selected = $this->getSelectedProducts();?>

<div>
    <div class="path">
        <h4><?php echo $this->categoryModel->getName(); ?></h4>
    </div>
    <hr>
    <div>
        <?php if (!empty($this->getProducts())) : ?>
        <div>
            <?php foreach ($this->getProducts() as $product) : ?>    
            <div class="card" style="box-shadow: 1px 1px 8px 1px #c4c5cc;
                width: 195px;margin : 8px ;float: left">
                <div class="text-center m-2">
                    <img class="img" width="175px" height="150px" 

                        src="<?php echo $product->getImage(); ?>" >
                </div>
                <div>
                    <div style="width: 95%;color: #283593;text-align: center;font-size: large">
                        <?php echo strlen($product->name) > 30 
                            ? substr($product->name,0,30).".." 
                            : $product->name;  ?> 
                        <hr>
                    </div>
                <div style="margin: 10px;text-align: center;font-weight: bold;font-size: larger">
                    $<?php echo $product->price; ?>
                <div>
                        <?php if(in_array($product->id,$selected)): ?>    
                            <?php $item = $this->getItem($product->id); ?>
                            <input type="button" class="btn btn-outline-secondary bp btn-sm" value="-" onclick="ajax.setUrl('<?php echo $this->getUrl('updateQuantity','category_index',['productId' => $product->id,'flag' => 0 ]);?>').load()">
                            <input id="product_<?php echo $product->id ?>" class="btn btn-outline-secondary btn-sm" type="button" value="<?php echo $item->quantity; ?>" disabled>
                            <input type="button" class="btn btn-outline-secondary bp btn-sm" value="+" onclick="ajax.setUrl('<?php echo $this->getUrl('updateQuantity','category_index',['productId' => $product->id,'flag' => 1 ]);?>').load()">
                        <?php else : ?>
                            <button type="button" class="btn btn-outline-secondary bp btn-sm" onclick="ajax.setUrl('<?php echo $this->getUrl('add','category_index',['productId' => $product->id ]);?>'); ajax.load()">Add To Cart</button>
                        <?php endif; ?> 
                        </div>
                    </div> 
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php else : ?>
                <h2 class="display-4">No Products...</h2>
        <?php endif; ?>
    </div>
</div>
