
<?php $message = $this->getMessage();?>
<?php if($message): 
        foreach($message['message'] as $type => $value): ?>
            <div style="text-align: center;" class="<?php echo $type; ?>"><?php echo $value; ?></div>
<?php endforeach; endif; ?>