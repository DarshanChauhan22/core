<?php 
$collection = $this->getCollection('collection');
$actions = $this->getAction('actions');
$columns = $this->getColumns();
$c = Ccc::getFront()->getRequest()->getRequest('c'); 
?>
<?php $perPageCount = $this->getPager()->getPerPageCount(); ?>

<script type="text/javascript">
    function url(ele) 
    {
        var page = ele.value;
        var pageUrl = "<?php echo $this->getUrl('grid',null,['p' => $this->getPager()->getStart()],false) ?>&ppr="+ele.value;
        window.open(pageUrl,"_self");   
    }
</script>
        
<select name="page" id="page" onchange="url(this)">
    <?php foreach ($this->getPager()->getPerPageCountOptions() as $perPage): ?>
        <?php if($perPageCount == $perPage): ?>
        <option selected='selected' value="<?php echo $perPage; ?>"> 
            <?php echo $perPage; ?> 
            </option>
        <?php else:?>
            <option value="<?php echo $perPage; ?>"> 
            <?php echo $perPage; ?> 
            </option>
        <?php endif; ?>
    <?php endforeach; ?>
</select>

<?php if($this->getPager()->getPrev() == null):?>
<button name='Start' disabled ><a>Start</a></button>
<?php else: ?>
<button name='Start'><a href="<?php echo $this->getUrl('grid',null,['p' => $this->getPager()->getStart()]) ?>">Start</a></button>
<?php endif;?>

<?php if($this->getPager()->getPrev() == null):?>
<button name='Prev' disabled ><a>Previous</a></button>
<?php else: ?>
<button name='Previous'><a href="<?php echo $this->getUrl('grid',null,['p' => $this->getPager()->getPrev()]) ?>">Previous</a></button>
<?php endif;?>

<button name='Current'><a href="<?php echo $this->getUrl('grid',null,['p' => $this->getPager()->getCurrent()]) ?>">Current</a></button>

<?php if($this->getPager()->getNext() == null):?>
<button name='next' disabled ><a>Next</a></button>
<?php else: ?>
<button name='Next'><a href="<?php echo $this->getUrl('grid',null,['p' => $this->getPager()->getNext()]) ?>">Next</a></button>
<?php endif;?>

<?php if($this->getPager()->getNext() == null):?>
<button name='end' disabled ><a>End</a></button>
<?php else: ?>
<button name='End'><a href="<?php echo $this->getUrl('grid',null,['p' => $this->getPager()->getEnd()]) ?>">End</a></button>
<?php endif;?>

<div class='container text-center'>
    <h1><?php echo ucfirst($c); ?> Details </h1> 
    <form action="<?php echo  $this->getUrl('add');?>" method="POST">
            <button type="submit" name="Add" class="btn btn-primary"> Add New </button>
    </form>

    <div class="container w-100 my-3">
        <table  border="1" width="100%" cellspacing="4">
            <tr>
                <?php foreach($columns as $column): ?>
                    <th><?php echo $column['title'] ?></th>
                <?php endforeach; ?>
                <th>Action</th>
            </tr>
            <?php if($collection['0']): ?>
            <?php foreach ($collection['0'] as $row): ?>
                <tr>
                    <?php foreach($columns as $key => $column):?>
                        <td><?php echo $this->getColumnValue($row, $key, $column); ?></td>
                    <?php endforeach; ?> 
                    <td>
                    <?php foreach($actions as $action): ?>
                        <?php $method = $action['method'];?>
                        <a href="<?php echo  $this->$method($row);?>"><?php echo $action['title']; ?></a>
                    <?php endforeach; ?>
                    </td>
                </tr>
            <?php endforeach;?>
        <?php else:?>
            <tr><td colspan='10'>No Record Available</td></tr>          
        <?php endif; ?>
        </table>    
    </div>
</div>

