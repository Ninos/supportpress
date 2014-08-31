<script type="text/javascript">
var GoogleMapDialog = {
	local_ed : 'ed',
	init : function(ed) {
		GoogleMapDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertGoogleMap(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		var title = jQuery('input#googlemap-title').val();
		var location = jQuery('textarea#googlemap-location').val();
		var zoom = jQuery('input#googlemap-zoom').val(); 
		var height = jQuery('input#googlemap-height').val(); 
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		
		// setup the output of our shortcode
		var output = '';
		
		output = '&nbsp;';
		output = '[googlemap ';
		
		if(title) {
			output += ' title=\"'+ title +'\" ';
		} else { }

		if(location) {
			output += ' location=\"'+ location +'\" ';
		} else { }
		
		if(zoom) {
			output += ' zoom=\"'+ zoom +'\" ';
		} else { }
		
		if(height) {
			output += ' height=\"'+ height +'\" ';
		} else { }
		
		output += ']';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(GoogleMapDialog.init, GoogleMapDialog);
 
</script>
<form action="/" method="get" accept-charset="utf-8">
    <div class="form-section clearfix">
		<label for="googlemap-title">Title</label>
        <input type="text" name="googlemap-title" value="" id="googlemap-title" />
    </div>
    
	<div class="form-section clearfix">
		<label for="googlemap-location">Location</label>
		<textarea name="googlemap-location" value="" id="googlemap-location"></textarea>
    </div>
    
	<div class="form-section clearfix">
		<label for="googlemap-zoom">Zoom Level</label>
		<input type="text" name="googlemap-zoom" value="" id="googlemap-zoom" />
    </div>
    
	<div class="form-section clearfix">
      <label for="googlemap-height">Height Level</label>
		<input type="text" name="googlemap-height" value="" id="googlemap-height" />
    </div>
   
	<a href="javascript:GoogleMapDialog.insert(GoogleMapDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
</form>