<div class="operation">
	<?php render_server_menu("status"); ?>
</div>

<table bgcolor="#cccccc" cellpadding="2" cellspacing="1" width="600" class="table-main">
	<tr>
		<th colspan="2"><?php hm("server_status"); ?> <span class="code">({serverStatus:1})</span></th>
	</tr>
	<?php foreach ($status as $param=>$value):?>
	<tr bgcolor="#fff">
		<td width="120" valign="top"><?php h($param);?></td>
		<td class="code"><?php h($value);?></td>
	</tr>
	<?php endforeach; ?>
</table>
