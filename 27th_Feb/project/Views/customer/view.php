<!DOCTYPE html>
<head>
    <title>Customer</title>
    <body>
        <table border="1" width=100% cellspacing="4">
            <tr><td><h2>Customer List<h2></td></tr>
            <a href="<?php echo $this->getUrl('add')?>">Add Customer</a>
            <table border="1" width=100% cellspacing="5" cellpadding="5">
                <th><input onclick="selectAll(this)" type="checkbox"></th>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Address Line 1</th>
                <th>Address Line 2</th>
                <th>City</th>
                <th>State</th>
                <th>Country</th>
                <th colspan="2">Actions</th>
                <form action="<?php echo $this->getUrl('delete')?>" method="POST">
                <input type="submit" value="Delete">
                <?php foreach($this->customerModel->displayCustomers() as $customer): ?>
                    <tr>
                    <td>
                        <input type="checkbox" name="check[]" value="<?php $customer['id'] ?>">
                    </td>
                    <?php foreach($customer as $value): ?>
                        <td><?php echo $value ?></td>
                    <?php endforeach; ?>
                        <td><a href=<?php echo $this->getUrl('edit',NULL,['id' => $customer['id']]) ?>>Edit</a></td>
                        <td><a href=<?php echo $this->getUrl('delete',NULL,['id' => $customer['id']]) ?>>Delete</a></td>
                    </tr>
                <?php endforeach; ?>
                </form>
        </table>
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