<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="Skin\Admin\Css\Core\datatables.min.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Skin\Admin\Css\bootstrap.min.css">
    <link rel="stylesheet" href="Skin\Admin\Css\stylesheet.css">
    <script src="Skin\Admin\Js\Core\jquery-3.4.1.min.js"></script>
    <script src="Skin\Admin\Js\Core\jquery-3.4.1.min.js"></script>
    <script src="Skin\Admin\Js\Core\datatables.min.js"></script>
    <script src="Skin\Admin\Js\Core\popper.min.js"></script>
    <script src="Skin\Admin\Js\ajax.js"></script>
   
    <title></title>
</head>

<body>
    <div clas="row">
        <div id="header" class="header"><?php echo $this->getChild('header')->toHTML(); ?></div>
        <div><div id="message"></div></div>
        <div id="content" class="one-col-content col-md-12">
            <?php echo $this->getChild('content')->toHTML(); ?>
        </div>
        <div id="footer" class="footer">
            <?php echo $this->getChild('footer')->toHTML(); ?>
        </div>
</body>

</html>