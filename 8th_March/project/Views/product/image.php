<?php $imageList = $this->getImages()->displayImages(); ?>
<?php $product = $this->getProduct();?>
<!DOCTYPE html>

<head><title>Media Gallery</title></head>
<body>
    <form enctype="multipart/form-data" method="POST" 
        action="<?php echo $this->getUrl('saveImage',null,[ 'id' => $product->id ] ) ?>">
        <input type="file" name="image">
        <input type="submit" value="Upload"> 
    </form>
    <table border="1" width=100% align="center">
        <th>Base</th>
        <th>Thumbnail</th>
        <th>Small</th>
        <th>Exclude</th>
        <th>Image</th>
        <th>Action</th>
        <form action="<?php echo $this->getUrl('updateGallery',null,[ 'id' => $product->id ])?>" 
            method="POST">
            <?php foreach($imageList as $image) : ?>
                <tr>
                <td><input type="radio" name="product[base_image]" 
                        value="<?php echo $image['imageId']; ?>" 
                        <?php echo $image['imageId'] == $product->base_image 
                        ? 'checked' 
                        : ''; ?>>
                </td>
                <td><input type="radio" name="product[thumbnail_image]" 
                        value="<?php echo $image['imageId']; ?>"
                        <?php echo $image['imageId'] == $product->thumbnail_image 
                        ? 'checked' 
                        : ''; ?>>
                </td>
                <td><input type="radio" name="product[small_image]" 
                        value="<?php echo $image['imageId']; ?>"
                        <?php echo $image['imageId'] == $product->small_image 
                        ? 'checked' 
                        : ''; ?>>
                </td>
                <td><input type="checkbox" name="exclude[]" 
                        value="<?php echo $image['imageId']; ?>" 
                        <?php echo $image['exclude'] == 1 
                        ? 'checked' 
                        : '' ?>>
                </td>
                <td><img height="180" width="300px" src="<?php echo $this->getProduct()->
                        getDirectory().$image['name']; ?>">
                </td>
                <td><a href="<?php echo $this->
                        getUrl('deleteImage',NULL,['id' => $image['imageId'],
                        'pid' => $product->id]); ?>">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
            <input type="submit" value="Update">
    </form>
</body>
</html>
