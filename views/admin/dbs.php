<script language="javascript">
/**
 * highlight current collection being viewed
 *
 * @param string name collection name
 */
function highlightCollection(name, count) {
	var collections = $(".collections");
	collections.find("li").each(function () {
		var a = $(this).find("a");
		if (a.attr("cname") == name) {
			if (count != undefined) {
				$(this).find(".count").html(count);
			}
			a.css("font-weight", "bold");
			a.css("color", "blue");
		}
		else {
			a.css("font-weight", "normal");
			a.css("color", "");
		}
	});
}

$(function () {
	var collections = $(".collections");
	collections.find("li").each(function () {
		var li = $(this);
		var a = $(this).find("a");
		var name = a.attr("cname");

		li.click(function () {
			window.location.hash = "#" + name;
		});

		//highlight current selected
		if (window.location.hash == "#" + name) {
			a.css("font-weight", "bold");
			a.css("color", "blue");
		}
	});

	// will be used to redirect to db by name
	var template = '<?php h(url("db.index",array("db"=>'__DB__')));?>';
	$('#selector').submit(function(e) {
	    e.preventDefault();
	    if($('#db').val()) {
		window.parent.frames['right'].location=template.replace('__DB__', $('#db').val());
	    }
	});
});



</script>

<div style="background-color:#eeefff;height:100%">
	<div style="margin-left:20px">
		<a href="<?php h(url("server.index"));?>" target="right">
			<span class="icon icon-globe"></span>
			<?php hm("server"); ?>
		</a>
	</div>

	<div style="margin-left:20px;margin-bottom:3px;">
		<a href="<?php h(url("server.databases"));?>" target="right">
			<span class="icon icon-eye-open"></span>
			<?php hm("overview"); ?>
		</a>
	</div>

	<div style="margin-bottom:10px;border-bottom:1px #ccc solid"></div>

	<ul class="dbs">
		<?php foreach ($dbs as $db) : ?>
		<li>
			<a href="<?php echo $baseUrl;?>&db=<?php h($db["name"]);?>" <?php if ($db["name"] == x("db")): ?>style="font-weight:bold"<?php endif;?> onclick="window.parent.frames['right'].location='<?php h(url("db.index",array("db"=>$db["name"])));?>'">
				<span class="icon icon-hdd"></span>
				<?php echo $db["name"];?>
			</a>
			<?php if ($db["collectionCount"]>0): ?>
			<span class="count count-small">
				(<?php h($db["collectionCount"]); ?>)
			</span>
			<?php endif;?>

			<ul class="collections">
				<?php if($db["name"] == x("db")): ?>

					<?php if (!empty($tables)):?>
						<?php foreach ($tables as $table => $count) :?>
						<li>
							<a href="<?php h(url("collection.index", array( "db" => $db["name"], "collection" => $table ))); ?>" target="right" cname="<?php h($table);?>">
								<span class="icon icon-<?php if (preg_match("/\.(files|chunks)$/", $table)) h('th'); else h('list-alt'); ?>"></span>
								<?php h($table);?>
							</a>
							<span class="count count-small">(<?php h($count);?>)</span>
						</li>
						<?php endforeach; ?>

					<?php else:?>
						<li><?php hm("nocollections2"); ?></li>
					<?php endif;?>
				<?php endif; ?>

				<?php if ($db["name"] == x("db")):?>
				<li>
					<a href="<?php h(url("db.newCollection", array( "db" => $db["name"] ))); ?>" target="right" title="<?php hm("createnewcollection"); ?>">
						<span class="icon icon-plus"></span>
						<?php hm("create"); ?> &raquo;
					</a>
				</li>
				<?php endif;?>
			</ul>
		</li>
		<?php endforeach; ?>
		<?php if($showDbSelector): ?>
		<li>
			<img src="<?php render_theme_path() ?>/images/database.png" align="absmiddle" width="14"/>
			<form id="selector" action="#" style="display:inline">
				<input type="text" name="db" id="db" />
				<input type="submit" value="<?php hm("selectdb"); ?>">
			</form>
		</li>
		<?php endif;?>
	</ul>
	<div style="height:40px"></div>
</div>
