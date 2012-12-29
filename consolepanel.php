<?php
require_once('include/bittorrent.php');
dbconn();
if (get_user_class() < UC_MODERATOR) {
    die;
}
stdhead();
begin_frame("Админ-консоль");
?>
<link rel="stylesheet" type="text/css" href="/console/cons.php?type=css" />
<script type="text/javascript" src="/console/cons.php?type=js" /></script>

<div id="console" class="console" style="overflow:hidden;"><?=$SITENAME?>. <?=date('Y')?>.
<br />СonsolePanel by Expantano. (c) All rights reserved.
<br />Tracker:/functions/staff> 
<input class="coninput" style="width:400px;" type="text" onkeypress="presskey(0,event);" id="consoleinput0" />
</div>
<?php 
end_frame();
stdfoot();
?>
