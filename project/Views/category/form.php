<?php $category = $this->getCategory(); ?>
<div class="card-page">
<div class="card border-secondary mb-3" style="width: 30rem">
    <form id="addCategory" action="<?php echo $this
        ->getUrl('save',NULL,['id' => $category->id]) ?>" method="POST">
    <div class="card-header">
        <div class="title-card">Category</div>
    </div>
    <div class="card-body text-info">
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" 
                value="<?php echo $category->name ?>" required>
        </div>
        <div class="form-group">
            <label>Description</label>
            <input class="form-control" type="text" name="description" 
                value="<?php echo $category->description ?>">
        </div>
        <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="status" required>
                <?php foreach($category->getStatusOptions() as $key => $value) : ?> 
                <option value="<?php echo $key ?>" 
                    <?php echo $key == $category->status 
                    ? 'selected' 
                    : '' ?>>
                    
                    <?php echo $value; ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php $childList = $category->getChildId() ?>
        <div class="form-group">
            <label>Parent</label>
            <select class="form-control" name="parent_id" required>
                <option value="">Select Parent</option>
                <option value="0">No Parent</option>
                <?php foreach($this->getCategories() as $singleCategory): ?>
                <option value="<?php echo $singleCategory->id ?>" 
                    <?php echo $category->parent_id == $singleCategory->id 
                        ? 'selected' 
                        : ''; ?>
                    <?php echo ($category->id == $singleCategory->id) || in_array($singleCategory->id,$childList) 
                        ? 'disabled' 
                        : ''; ?>>
                    <?php echo $singleCategory->getName($singleCategory->path) ?>
                </option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <button class="btn btn-outline-secondary bp" 
                type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('grid','category');?>'); ajax.load();">Back</button>
        
            <button class="btn btn-outline-secondary bp" 
                type="button" onclick="addCategory.checkValidity() ? (ajax.setForm('addCategory'), ajax.saveForm()) : addCategory.reportValidity();">Save</button>
        </div>
    </div>
    </form>
</div>
</div>