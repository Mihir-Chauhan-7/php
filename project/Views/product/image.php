<?php $imageList = $this->getImages()->displayImages();
    $product = $this->getProduct(); ?>
<div class="container-fluid">
<form id="imageForm" enctype="multipart/form-data" method="POST" 
    action="<?php echo $this
        ->getUrl('saveImage',null,[ 'id' => $product->id ] ) ?>">
    <div class="form-group row">
        <input class="form-control col-3" type="file" name="image">
        <input class="col-1 btn btn-outline-secondary bp" 
            type="button" onclick="ajax.setForm('imageForm').load();" 
            value="Upload">
    </div>
     
</form>
<form id="imageUpdate" action="<?php echo $this
    ->getUrl('updateGallery',null,[ 'id' => $product->id ])?>" 
    method="POST">

<table class="table-striped" width="100%">
    <thead>
    <tr>
    <th>Base</th>
    <th>Thumbnail</th>
    <th>Small</th>
    <th>Exclude</th>
    <th>Image</th>
    <th>Action</th>
    </tr>
    <tr>
    </thead>
    <tbody>
    <?php foreach($imageList as $image) : ?>
        <tr>
            <td>
                <input type="radio" name="product[base_image]" 
                    value="<?php echo $image['imageId']; ?>" 
                    <?php echo $image['imageId'] == $product->base_image 
                    ? 'checked' 
                    : ''; 
                    ?>>
            </td>
            <td>
                <input type="radio" name="product[thumbnail_image]" 
                    value="<?php echo $image['imageId']; ?>"
                    <?php echo $image['imageId'] == $product->thumbnail_image 
                    ? 'checked' 
                    : ''; ?>>
            </td>
            <td>
                <input type="radio" name="product[small_image]" 
                    value="<?php echo $image['imageId']; ?>"
                    <?php echo $image['imageId'] == $product->small_image 
                    ? 'checked' 
                    : ''; ?>>
            </td>
            <td>
                <input type="checkbox" name="exclude[]" 
                    value="<?php echo $image['imageId']; ?>" 
                    <?php echo $image['exclude'] == 1 
                    ? 'checked' 
                    : '' ?>>
            </td>
            <td>
                <img height="180" width="300px" 
                    src="<?php echo $this
                        ->getProduct()
                        ->getDirectory().$image['name']; ?>">
            </td>
            <td>
                <button class="btn btn-outline-secondary bp btn-sm" 
                    type="button" onclick="ajax.setUrl('<?php echo $this->getUrl('deleteImage',NULL,['id' => $image['imageId'],'pid' => $product->id]); ?>').load()">Delete</button>
            </td>
        </tr>
    <?php endforeach; ?>    
    </tr>
    </tbody>
</table>
    <input class="btn btn-outline-secondary bp" type="button" onclick="ajax.setForm('imageUpdate').load();" value="Update"> 
</form>
</div>