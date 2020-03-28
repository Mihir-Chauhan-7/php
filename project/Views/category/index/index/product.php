<?php $selected = $this->getSelectedProducts();?>

<div>
    <div class="path">
        <h4><?php echo $this->categoryModel->getName(); ?></h4>
    </div>
    <hr>
    <div>
        <?php if (!empty($this->getProducts())) : ?>
        <div>
            <?php foreach ($this->getProducts() as $product) : ?>     
            <div class="card border-info" style="margin : 8px ;float: left">
                <div style="margin: 10px">
                    <img width="175px" height="180px" 
                        src="<?php echo "media\catalog\product\\" .$this->getProductImage($product->thumbnail_image) ?>" >
                </div>
                <div>
                    <div style="text-align: center; font-weight: bold;font-size: large">
                        <?php echo $product->name; ?> 
                        <hr>
                    </div>
                <div style="margin: 10px;text-align: center;font-weight: bold;font-size: larger">&#8377;
                    <?php echo $product->price; ?>
                    <input type="hidden" name="productId" value="<?php echo $product->id ?>">
                <div>
                        <?php if(in_array($product->id,$selected)): ?>    
                            <?php $item = $this->getItemId($product->id); ?>
                            <input type="button" class="btn btn-outline-primary btn-sm" value="-" onclick="ajax.setUrl('<?php echo $this->getUrl('updateQuantity','category_index',['id' => $item->itemId,'flag' => 0 ]);?>').load()">
                            <input id="product_<?php echo $product->id ?>" class="btn btn-outline-secondary btn-sm" type="button" value="<?php echo $item->quantity; ?>" disabled>
                            <input type="button" class="btn btn-outline-primary btn-sm" value="+" onclick="ajax.setUrl('<?php echo $this->getUrl('updateQuantity','category_index',['id' => $item->itemId,'flag' => 1 ]);?>').load()">
                        <?php else : ?>
                            <button type="button" class="btn btn-outline-info btn-sm" onclick="ajax.setUrl('<?php echo $this->getUrl('add','category_index',['productId' => $product->id ]);?>'); ajax.load()">Add To Cart</button>
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
