<?php if($wiki['parent'] != 0): ?>
Back to <a href="%appurl%byid/<?=$wiki['parent'];?>">Parent</a>

<br />
<br />
<?php endif; ?>

<form class="wiki_edit_article" action="%baseurl%apps/wiki/update/<?=$wiki['id'];?>/" method="post">		
	
	
	<div class="row no_martop">
		<div class="col-9">
			
			
			
			
			<div class="row">
				<div class="col-6">
					Parent Wiki
					<select name="parent" id="">
						<?php ob_start(); ?>
						
						 <option value="0">-- Index --</option>
						
						<?php
						
						echo (new wikiModel)->selectparent();
						
						echo str_replace('value="'.$wiki['parent'].'"', 'selected="selected" value="'.$wiki['parent'].'"', ob_get_clean());
						
						?>
					</select>
				</div>
				<div class="col-6">
					Site Title <input style="font-size: 24px; width: 100%; padding: 5px;" class="dark_b" name="title" value="<?=htmlspecialchars($wiki['title'], ENT_QUOTES);?>" />
					<textarea id="content" name="content"><?=htmlentities($wiki['content']);?></textarea>
				</div>
			</div>
			
			Wiki Title<input  style="font-size: 24px; width: 100%; padding: 5px;" class="marbot" name="alias" value="<?=htmlspecialchars($wiki['alias'], ENT_QUOTES);?>" placeholder="Wiki Alias" />			
			Page Content (markdown supported) <div id="editor" class="dark_b"><?=htmlentities($wiki['content']);?></div>
			
			<div class="row">
				<div class="col-8">
					<input type="submit" class="green" value="Save Page" /> <?=isset($msg)?$msg:'';?>
				</div>
				<div class="col-4">
					<a <?=jsprompt('Are you sure you want to delete this?');?> class="red button" href="%appurl%rm/<?=$wiki['id'];?>/">Delete this wiki</a>
				</div>
			</div>
			
			
		</div>
		<div class="col-3">
			<h4>Linked</h4>
				
			<ol class="fvlist">
				<?php if($sub_wikis != null)
					foreach($sub_wikis as $subwiki): ?>
				<li>
					<a href="%appurl%<?=urlencode($subwiki);?>?from=<?=$wiki['id'];?>"><?=$subwiki;?></a>
				</li>
				<?php endforeach;
					else
					echo '<li>No subwikis found. Add [[this]] or [[that]] to your page.</li>'; ?>
			</ol>
		</div>
	</div>
</form>

<style type="text/css" media="screen">
	#editor { 
		position: relative;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		height: <?=($linecount*16);?>px;
	}
</style>
<script src="https://d1n0x3qji82z53.cloudfront.net/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
$(document).ready(function(){
	var editor = ace.edit("editor");
	
	editor.setShowPrintMargin(false);
	editor.setTheme("ace/theme/textmate");
	editor.getSession().setMode("ace/mode/html");
	editor.focus(); //To focus the ace editor
	
	$("#content").hide();
	
	// ty SelçukDERE http://stackoverflow.com/a/23965289
	editor.getSession().on("change", function () {
        $("#content").val(editor.getSession().getValue());
    });
});
</script>