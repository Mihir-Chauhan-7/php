<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="Skin\Admin\Css\stylesheet.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="Skin\Admin\Js\Core\jquery-3.4.1.min.js"></script>
    <script src="Skin\Admin\Js\ajax.js"></script>
    <title></title>
</head>

<body>
    <table border="1" width="100%">
        <tr class="header" colspan="100%" height="100px">
            <td><?php echo $this->getChild('header')->toHTML(); ?></td>
        </tr>
        <tr>
            <td><div id="message"></div></td>
        </tr>
        <tr height="474px" colspan="100%">
            <td><?php echo $this->getChild('content')->toHTML(); ?></td>
        </tr>
        <tr class="header" colspan="100%">
            <td><?php echo $this->getChild('footer')->toHTML(); ?></td>
        </tr>
    </table>
</body>

</html>