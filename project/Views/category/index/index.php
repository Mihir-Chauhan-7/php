<div class="container-fluid">
    <div class="row">
        <div class="col-auto p-0 m-1 category category-index-left">
            <?php echo $this->getChild('category')->toHtml(); ?>
        </div>
        <div class="col-auto p-0 m-1 product category-index-center" id="productList">
            <?php echo $this->getChild('product')->toHtml(); ?>
        </div>
        <div class="col-auto p-0 m-1 category-index-right" id="cart">
            <?php echo $this->getChild('cart')->toHtml(); ?>
        </div>
    </div>
</div>