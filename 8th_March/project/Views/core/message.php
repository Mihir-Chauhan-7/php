<style>
    .Success{
        background-color: lightgreen;
        color: lightslategray;
    }

    .Failed{
        background-color: red;
        color: lightslategray;
    }

    .Notice{
        background-color: lightyellow;
        color: lightslategray;
    }
</style>
<?php $message = $this->getMessage();?>

<?php if($message): 
        foreach($message['message'] as $type => $value): ?>
            <div class="<?php echo $type; ?>"><?php echo $value; ?></div>
<?php endforeach; endif; ?>