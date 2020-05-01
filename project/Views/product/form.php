<?php $categories = $this->getCategories();
$product = $this->getProduct(); ?>
<form id="addProduct" action="<?php echo $this->getUrl('save',NULL,['id' => $product->id]) ?>" 
    method="POST">
    <div class="card-page">
    <div class="card border-secondary mb-3" style="width: 30rem">
        <div class="card-header">
            <div class="title-card">Product</div>
        </div>
        <div class="card-body text-info">
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" type="text" name="name" 
                    value="<?php echo $product->name ?>" required>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input class="form-control" type="text" name="price" 
                    value="<?php echo $product->price ?>" required>
            </div>
            <div class="form-group">
                <label>Stock</label>
                <input class="form-control" type="text" name="stock" 
                    value="<?php echo $product->stock ?>" required>
            </div>

            <div class="form-group">
                <label>Status</label>
                <Select class="form-control" name="status">
                    <?php foreach($product->getStatusOptions() as $key 
                        => $value) : ?> 
                    <option value="<?php echo $key ?>" 
                    <?php echo $key == $product->status 
                        ? 'selected' 
                        : '' ?>>
                    <?php echo $value; ?>
                    </option>
                <?php endforeach; ?>
                </Select>
            </div>
            <div class="form-group">
                <label>Stock Keeping Unit</label>
                <input class="form-control" type="text" name="sku" 
                    value="<?php echo $product->sku ?>" required>
            </div>

            <div class="form-group">
                <label>Category</label>
                <Select class="form-control" name="categoryId" required>
                    <option value="">Please Select</option>
                    <?php foreach($categories as $category) : ?> 
                    
                        <option value="<?php echo $category->id ?>" <?php  echo $product->getSelectedCategory() == $category->id ? 'selected' : ''; ?>>
                            <?php echo $category->getName(); ?>
                        </option>
                    <?php endforeach; ?>
                </Select>
            </div>
            <div class="form-group">
                <button class="btn btn-outline-secondary bp" 
                    type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('grid','product');?>'); ajax.load();">Back</button>
                <button class="btn btn-outline-secondary bp" 
                    type="button" onclick="addProduct.checkValidity() ? (ajax.setForm('addProduct'), ajax.saveForm()) : addProduct.reportValidity();">Save</button>
            </div>
            </div>
    </div>
    </div> 
</form>