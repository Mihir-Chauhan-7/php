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
            <form id="product<?php echo $product->id ?>" action="<?php echo $this->getUrl('add','category_index');?>" method="POST">
            <div class="card" style="margin : 8px ;float: left">
                <div>
                    <img style="margin-top: 10px ;margin-left: 10px"  
                    width="180px" height="180px" 
                    src="<?php echo "media\catalog\product\\" .$this->getProductImage($product->thumbnail_image) ?>" >
                </div>
                <div class="card-body">
                    <div style="font-weight: bold;font-size: large"><?php echo $product->name; ?> 
                </div>
                    <div style="font-size: larger">&#8377;<?php echo $product->price; ?>
                        <input type="hidden" name="productId" value="<?php echo $product->id ?>">
                        <div>
                        <?php if(in_array($product->id,$selected)): ?>    
                            <?php $item = $this->getItemId($product->id); ?>
                            <input type="button" class="btn btn-danger" value="+" onclick="ajax.setUrl('<?php echo $this->getUrl('updateQuantity','category_index',['id' => $item->itemId,'flag' => 0 ]);?>').load()">
                            <input id="product_<?php echo $product->id ?>" type="button" value="<?php echo $item->quantity; ?>" class="btn btn-danger" disabled>
                            <input type="button" class="btn btn-danger" value="+" onclick="ajax.setUrl('<?php echo $this->getUrl('updateQuantity','category_index',['id' => $item->itemId,'flag' => 1 ]);?>').load()">
                        <?php else : ?>
                            <input id="product_<?php echo $product->id ?>" type="button" value="Add To Cart" class="btn btn-info" onclick="ajax.setForm('product<?php echo $product->id; ?>').load();">
                        <?php endif; ?> 
                        </div>
                    </div> 
                    </div>
                </div>
            </form>
            <?php endforeach; ?>
        </div>
        <?php else : ?>
                <h2 class="display-4">No Products...</h2>
        <?php endif; ?>
    </div>
</div>
