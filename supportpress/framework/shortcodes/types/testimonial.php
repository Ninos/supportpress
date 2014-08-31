<script type="text/javascript">
var ColumnDialog = {
	local_ed : 'ed',
	init : function(ed) {
		ColumnDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertColumn(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		 
		// set up variables to contain our input values
		var content = jQuery('textarea#testimony-content').val();
		var by = jQuery('input#testimony-by').val();
		 
		var output = '';
		
		// setup the output of our shortcode
		output = '[testimony ';
		output += 'by="' + by + '"';
		
		// check to see if the content field is blank
		if(content) {	
			output += ']'+ content + '[/testimony]';
		}
		
		// if it is blank use selected text
		else {
			output += ']' + mceSelected + '[/testimony]';
		}
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(ColumnDialog.init, ColumnDialog);
 
</script>
<form action="/" method="get" accept-charset="utf-8">
	<div class="form-section clearfix">
        <label for="testimony-content">Content</label>
 		<textarea type="text" name="testimony-content" value="" id="testimony-content" rows="5"></textarea>
    </div>
	<div class="form-section clearfix">
        <label for="testimony-by">By<br /></label>
        <input type="text" name="testimony-by" value="" id="testimony-by"></input>
    </div>
    <a href="javascript:ColumnDialog.insert(ColumnDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Place</a>
</form>