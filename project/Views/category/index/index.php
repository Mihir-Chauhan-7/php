<div style="width: 1330px">
    <div class="row">
        <div class="col-lg-3">
            <?php echo $this->getChild('category')->toHtml(); ?>
        </div>
        <div class="col-lg-6" id="productList">
            <?php echo $this->getChild('product')->toHtml(); ?>
        </div>
        <div class="col-lg-3" id="cart">
            <?php echo $this->getChild('cart')->toHtml(); ?>
        </div>
    </div>
</div>

<!-- <table>
    <tr>
        <td width="250px" style="background-color: cyan"><?php //echo $this->getChild('category')->toHtml(); ?></td>
        <td width="780px" style="background-color: red"><div id="productList"></div></td>
        <td width="180px" style="background-color: lightpink"><div id="cart"></div></td>
    </tr>
</table> -->