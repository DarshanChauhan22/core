<?php $controllerCoreAction = new Controller_Core_Action(); ?>

  <?php 
    $messages = $this->getMessages();
    if($messages) {
        foreach ($messages as $key => $value) {
            echo $value;
        }
    } 
  ?>
  
  <form action="<?php echo $controllerCoreAction->getUrl('loginPost'); ?>" method="POST">
    <table border="1" width="100%">
      <tr>
        <th colspan="2">Login Here</th>
      </tr>
      <tr>
        <td>Email Address</td>
        <td><input type="email" name="admin[email]" required></td>
      </tr>
      <tr>
        <td>Password</td>
        <td><input type="password" name="admin[password]" required></td>
      </tr>
      <tr>
        <td width="15%">&nbsp;</td>
        <td><input type="submit" name="logBtn" value="Login"></td>
      </tr>
    </table>
  </form>
