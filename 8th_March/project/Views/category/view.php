<?php

use Block\Core\Message;

echo (new Message())->toHTML(); 

?>
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
                <form action="<?php echo $this->getUrl('delete')?>" 
                    method="POST">
                <input type="submit" value="Delete">
                <?php foreach($this->getCategories() as $row) :?>
                    <tr>
                    <td>
                        <input type="checkbox" name="check[]" 
                        value="<?php echo $row->id ?>">
                    </td>
                        <td><?php echo $row->id ?></td>
                        <td><?php echo $row->name ?></td>
                        <td><?php echo $row->description ?></td>
                        <td><?php echo $row->parent_id ?></td>
                        <td><a href=<?php echo $this->
                            getUrl('edit',NULL,['id' => $row->id]) ?>>Edit</a></td>
                        <td><a href=<?php echo $this->
                            getUrl('delete',NULL,['id' => $row->id]) ?>>Delete</a></td>
                    </tr>
                <?php endforeach ?>
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