<!DOCTYPE html>
<head>
    <title>Categories</title>
    <body>
        <table border="1" width=100% cellspacing="4">
            <tr><td><h2>Category List<h2></td></tr>
            <a href="<?php echo $this->getUrl('add')?>">Add Category</a>
            <table border="1" width=100% cellspacing="5" cellpadding="5">
                <th><input onclick="selectAll(this)" type="checkbox"></th>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Parent ID</th>
                <th colspan="2">Actions</th>
                <form action="<?php echo $this->getUrl('delete')?>" method="POST">
                <input type="submit" value="Delete">
                <?php 
                foreach($this->categoryModel->displayCategories() as $category): ?>
                    <tr>
                    <td>
                        <input type="checkbox" name="check[]" 
                        value="<?php echo $category['id'] ?>">
                    </td>
                    <?php foreach($category as $value): ?>

                        <td><?php echo $value ?></td>
                    <?php endforeach; ?>
                        <td><a href=<?php echo $this->
                            getUrl('edit',NULL,['id' => $category['id']]) ?>>Edit</a></td>
                        <td><a href=<?php echo $this->
                            getUrl('delete',NULL,['id' => $category['id']]) ?>>Delete</a></td>
                    </tr>
                <?php endforeach; ?>
        </table>
        
        </form>
        <script>
            function selectAll(el){
                var boxes = document.getElementsByName('check[]');
                if(el.checked){
                    for(i=0;i<boxes.length;i++){
                        boxes[i].checked=true;
                    }
                }
                else{
                    for(i=0;i<boxes.length;i++){
                        boxes[i].checked=false;
                    }
                }
            }
        </script>
    </body>
</head>
</html>