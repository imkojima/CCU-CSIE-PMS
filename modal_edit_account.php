<?php
	require_once('auth.php');
	require_once('libs/users.php');
?>
<form id="editForm" class="form-horizontal" method="post" action="user_account.php">
  <fieldset>
     <div class="control-group">
        <label class="control-label">帳號</label>
        <div class="controls">
          <input class="input-medium" type="text" id="user_id" name="u_acc" value="<?php echo $_SESSION['ccupms_acc'];?>" readonly="true">
        </div>
    </div> 
    <div class="control-group">
        <label class="control-label">姓名</label>
        <div class="controls">
          <input class="input-medium required" type="text" id="user_name" name="user_name" value="<?php echo getUserName($_SESSION['ccupms_acc']);?>" <?php if(getUserName($_SESSION['ccupms_acc'])!="") echo "readonly=\"true\"";?>>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">聯絡電話</label>
        <div class="controls">
          <input class="input-medium required" type="text" id="phone" name="phone" value="<?php echo getUserPhone($_SESSION['ccupms_acc']);?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">電子信箱</label>
        <div class="controls">
          <input class="input-medium required email" type="text" id="email" name="email" value="<?php echo getUserMail($_SESSION['ccupms_acc']);?>">
        </div>
    </div>
  </fieldset>
  <div style="text-align:center;">
    <div class="btn-group">
      <button class="btn btn-primary" type="submit">確認</button>
      <button class="btn" data-dismiss="modal">取消</button>
    </div>
  </div>
  <input class="hidden" value="done" name="action">
</form>
