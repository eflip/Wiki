<?php if($wiki['parent'] != 0): ?>
Back to <a href="%appurl%byid/<?=$wiki['parent'];?>">Parent</a>

<br />
<br />
<?php endif; ?>

<form class="wiki_edit_article" action="%baseurl%apps/wiki/update/<?=$wiki['id'];?>/" method="post">		
	
	
	<div class="row no_martop">
		<div class="col-9">
			Title <input style="font-size: 24px; width: 100%; padding: 5px; margin-bottom: 5px;" class="dark_b" name="title" value="<?=htmlspecialchars($wiki['title'], ENT_QUOTES);?>" />
			
			
			
			
			<div class="row">
				<div class="col-6">
					Parent
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
					Alias:
					<input name="alias" value="<?=htmlspecialchars($wiki['alias'], ENT_QUOTES);?>" placeholder="Wiki Alias" />
				</div>
			</div>
			
			<textarea style="width:100%; height: 400px" id="editor" name="content"><?=htmlspecialchars($wiki['content'], ENT_QUOTES);?></textarea>
			
			<div id="editor" name="content"><?=htmlspecialchars($wiki['content'], ENT_QUOTES);?></textarea>
			
			<input type="submit" class="martop green" value="Save Page" /> <?=isset($msg)?$msg:'';?>
			
			<a <?=jsprompt('Are you sure you want to delete this?');?> class="x martop" href="%appurl%rm/<?=$wiki['id'];?>/">Delete this wiki</a>
		</div>
		<div class="col-3">
			<h4>Linked</h4>
				
			<ol class="fvlist">
				<?php if($sub_wikis != null)
					foreach($sub_wikis as $subwiki): ?>
				<li>
					<a href="%appurl%<?=urlencode($subwiki);?>/from/<?=$wiki['id'];?>"><?=$subwiki;?></a>
				</li>
				<?php endforeach;
					else
					echo '<li>No subwikis found. Add [[this]] or [[that]] to your page.</li>'; ?>
			</ol>
		</div>
	</div>
</form>
<?php /*readfile(ROOT.'system/lib/editor.js');*/ 


		$ext = 'html';

?>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script src="https://d1n0x3qji82z53.cloudfront.net/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
$(document).ready(function(){
	var editor = ace.edit("editor");
	
	editor.commands.addCommand({
		name: "unfind",
		bindKey: {
			win: "Ctrl-F",
			mac: "Command-F"
		},
		exec: function(editor, line) {
			return false;
		},
		readOnly: true
	})
	
	editor.setShowPrintMargin(false);
	editor.setTheme("ace/theme/textmate");
	editor.getSession().setMode("ace/mode/<?php echo $ext; ?>");
	editor.focus(); //To focus the ace editor
</script>