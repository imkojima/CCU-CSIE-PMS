<?php
  require_once("auth.php");
  require_once("libs/property.php");
  $p_id = htmlspecialchars(addslashes($_GET['p_id']));
?>

<form id="reserveForm" class="form-horizontal" method="post" action="list.php">
  <fieldset>
  <input class="hidden" name="p_id" value=<?php echo "\"".$p_id."\""; ?>>
  <input class="hidden" name="u_id" value=<?php echo "\"".$_SESSION['ccupms_acc']."\""; ?>>
  <div class="control-group">
    <label class="control-label" for="item_name">借用物品</label>
    <div class="controls">
      <input class="input-medium" type="text" id="item_name" readonly="true" name="p_name" value=<?php echo "\"".getPropertyName($p_id)."(".$p_id.")\""; ?>>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="item_name">描述</label>
    <div class="controls">
      <input class="input-large" type="text" id="item_name" readonly="true" name="note" value=<?php echo "\"".getPropertyModel($p_id)."\""; ?>>
    </div>
  </div>
  <div class="control-group">
      <label class="control-label" for="expired_day">預約時限</label>
      <div class="controls">
        <input class="input-mini daylimits" type="text" id="expired_day" name="expired_days" placeholder="1-15">天
		<span class="help-block">預約必須在此有效期內通過審核。</span>
      </div>
  </div>
  <div class="control-group">
    <label class="control-label">借用原因</label>
    <div class="controls">
      <textarea class="span3 required" rows="3" name="reason" placeholder="請填寫申請借用的目的、原因"></textarea>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn btn-primary">送出</button>
      <button type="button" class="btn" data-dismiss="modal">取消</button>
    </div>
  </div>
  <input name="action" value="done" class="hidden">
  </fieldset>
</form>
