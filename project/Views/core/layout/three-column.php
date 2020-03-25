<!DOCTYPE html>
<html>

<head>
    <script src="Skin\Admin\Js\Core\jquery-3.4.1.min.js"></script>
    <script src="Skin\Admin\Js\ajax.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Home Three Column</title>
</head>
<body>
    <table width="100%">
        <tr><td style="background-color: #283593" height="100px" colspan="3"><?php echo $this->getChild('header')->toHTML(); ?></td></tr>
        <tr><div id="message"></div></tr>
        <tr>
            <td height="420px" width="80px" style="background-color: #536DFE"><?php echo $this->getChild('left')->toHTML(); ?></td>
            <td height="479px" style="background-color: #EEEEEE"><?php echo $this->getChild('content')->toHTML(); ?></td>
            <td height="420px" width="80px" style="background-color: #536DFE"><?php echo $this->getChild('right')->toHTML(); ?></td>
        </tr>
        <tr><td style="background-color: #283593" height="50px" colspan="3"><?php echo $this->getChild('footer')->toHTML(); ?></td></tr>
    </table>
</body>
</html>