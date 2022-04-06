
<div class="content-wrapper">
<?php $tabs = $this->getTabs(); ?>
<?php foreach($tabs as $key => $tab): ?>
    <button type="button" class="changeTab btn btn-primary" value="<?php echo $tab['url'] ?> " <?php echo ($this->getCurrentTab() == $key) ? 'style ="color:black";' : 'style ="color:white";' ; ?>><?php echo $tab['title'];?></button>
<?php endforeach;?>
</div>

<script>
    jQuery(".changeTab").click(function(){
        admin.setUrl($(this).val());
        //alert(admin.getUrl());
        admin.load();
    });
</script>