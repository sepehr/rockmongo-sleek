<h3><?php render_navigation($db,$collection,false); ?> &raquo; <?php hm("statistics"); ?> [<a href="<?php h($_SERVER["REQUEST_URI"]);?>"><?php hm("refresh"); ?></a>]</h3>

<div class="content-wrapper">
<table bgcolor="#cccccc" width="600" class="table-main" cellpadding="2" cellspacing="1">
	<tr bgcolor="#cfffff">
		<th colspan="2" class="code">db.<?php h($collection); ?>.stats()</th>
	</tr>

<?php foreach ($stats as $name => $stat):?>
	<tr bgcolor="#ffffff">
		<td width="150" bgcolor="#fffeee" valign="top" class="code"><?php h($name);?></td>
		<td class="code">
		<?php
			if (is_array($stat)) {
				h("<xmp>" . var_export($stat, true) . "</xmp>");
			}
			else {
				if (in_array($name, array( "size", "storageSize", "lastExtentSize", "totalIndexSize" ))) {
					$stat = round($stat/1024/1024, 2) . "m";
				}
				h($stat);
			}
			?>
		</td>
	</tr>
<?php endforeach; ?>

<?php if(!empty($top)):?>
 	<tr bgcolor="#efefef">
		<td colspan="2" class="code">{top:1}</td>
	</tr>

	<?php foreach ($top as $name => $stat):?>
		<tr bgcolor="#ffffff">
			<td width="150" bgcolor="#fffeee" valign="top" class="code"><?php h($name);?></td>
			<td class="code"><?php
				h($stat);
				?></td>
		</tr>
	<?php endforeach; ?>

<?php endif;?>
</table>
</div>