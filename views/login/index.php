<script type="text/javascript">
var showMore = <?php echo $moreOptions; ?>;

$(function () {
	showMore = !showMore;
	r_show_more_options($("#more_options_btn")[0]);

	//go to top window
	if (window.self != window.top) {
		if (window.parent.location.toString().match(/\?action=admin/)) {
			window.parent.location.reload();
		}
	}
});

function r_show_more_options(btn) {
	if (!showMore) {
		$("#more_options").show();
		$(btn).html("Less &raquo;");
		showMore = 1;
		$("#show_more_options").val(1);
	}
	else {
		$("#more_options").hide();
		$(btn).html("More &raquo;");
		showMore = 0;
		$("#show_more_options").val(0);
	}
	return false;
}

$(document).ready(function() {
	$('body').addClass('login-page');
});
</script>

<div id="login-form-wrapper" style="padding:10px;margin:200px auto;width:300px;border:1px #ccc solid">
<?php if (isset($message)):?><p class="error"><?php h($message); ?></p><?php endif;?>
	<form id="login-form" method="post">
	<input type="hidden" name="more" id="show_more_options" value="<?php echo $moreOptions; ?>"/>
	<table>
		<tr class="separator">
			<td colspan="2">Login</td>
		</tr>
		<tr>
			<td width="100">Host</td>
			<td><?php render_select_hosts("host", $hostIndex); ?></td>
		</tr>
		<tr>
			<td nowrap><?php hm("username"); ?></td>
			<td><input type="text" name="username" value="<?php echo $username;?>" style="width:150px"/></td>
		</tr>
		<tr>
			<td><?php hm("password"); ?></td>
			<td><input type="password" name="password" style="width:150px"/></td>
		</tr>
		<tr class="more">
			<td colspan="2"><br><a href="#" onclick="return r_show_more_options(this)" id="more_options_btn">More &raquo;</a></td>
		</tr>
		<tbody style="display:none" id="more_options">
		<tr>
			<td><?php hm("language"); ?></td>
			<td><select name="lang" style="width:150px">
			<?php foreach ($languages as $code => $lang):?>
			<option value="<?php h($code);?>" <?php if(x("lang") == $code || (x("lang") ==""&&__LANG__==$code)): ?>selected="selected"<?php endif;?> ><?php h($lang); ?></option>
			<?php endforeach;?>
			</select></td>
		</tr>
		<tr>
			<td><?php hm("alive"); ?>:</td>
			<td>
			<select name="expire" style="width:150px">
			<?php foreach ($expires as $long => $name):?>
			<option value="<?php h($long);?>"><?php h($name);?></option>
			<?php endforeach;?>
			</select>
			</td>
		</tr>
		<tr class="separator">
			<td colspan="2"><br><br>Non-Admins</td>
		</tr>
		<tr>
			<td valign="top">DB Name(s)</td>
			<td><input type="text" name="db" style="width:150px" value="<?php h($db); ?>"/><br/></td>
		</tr>
		</tbody>
		<tr>
			<td colspan="2" align="center">
			<br>
			<input type="submit" value="<?php hm("loginandrock"); ?>"/>
			<br><br>
			</td>
		</tr>
	</table>
	</form>

	<div class="credit">
		<?php hm("rockmongocredits") ?>
	</div>
</div>