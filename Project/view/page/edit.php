<?php $page = $this->getPage(); ?>
<?php $controllerCoreAction = new Controller_Core_Action(); ?>



<html>
<head>
</head>
<body>
  <form action="<?php echo $controllerCoreAction->getUrl('save','page',null,true) ?>" method="POST">
  <table border="1" width="100%" cellspacing="4">
    <tr>
      <td width="10%">Name</td>
      <td><input type="text" name="page[name]" value="<?php echo $page->name ?>"></td>
    </tr>
    <tr>
      <td width="10%">Code</td>
      <td><input type="text" name="page[code]" value="<?php echo $page->code ?>"></td>
    </tr>
    <tr>
      <td width="10%">Password</td>
      <td><input type="text" name="page[content]" value="<?php echo $page->content ?>"></td>
    </tr>
    
    <tr>
      <td width="10%">Status</td>
      <td>
        <select name="page[status]">

          <?php if($page->status == 2): ?>
              <option value='2'>InActive</option>
              <option value='1'>Active</option>
          <?php else: ?>
              <option value='1'>Active</option>
              <option value='2'>InActive</option>
          <?php endif;?>
        </select>
      </td>
    </tr>
    <tr>
      <td width="25%">&nbsp;</td>
      <input type="hidden" name="page[pageId]" value="<?php echo $page->pageId ?>">
      <td>
        <button type="submit" name="submit" class="Registerbtn">Update </button>
        <a href="<?php echo $controllerCoreAction->getUrl('grid','page',null,true) ?>"><button type="button" class="cancelbtn">Cancel</button></a>
      </td>
    </tr>    
  </table>  
</form>
</body>
  </html>