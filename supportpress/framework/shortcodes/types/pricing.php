<script type="text/javascript">
var PricingDialog = {
	local_ed : 'ed',
	init : function(ed) {
		PricingDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertPricing(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values
		var wrap = jQuery('select#pricing-wrap').val();
		
		var column = jQuery('select#pricing-column').val();
		var featured = jQuery('select#pricing-featured').val();
		var title = jQuery('input#pricing-title').val();
		var price = jQuery('input#pricing-price').val();
		var price_extra = jQuery('textarea#pricing-price-extra').val();
		var button_url = jQuery('input#pricing-button-url').val();
		var button_text = jQuery('input#pricing-button-text').val();
		var button_color = jQuery('select#pricing-button-color').val();
		var content = jQuery('textarea#pricing-content').val();
		 
		 
		 //set defaults
		 if(title == '') { title = 'Sample Text'; } 
		 if(button_text == '') { button_text = 'Sample Text'; } 
		 if(price == '') { price = '$100/month'; }
		 if(button_color == '') { button_color ='green'; }
		 
		//set highlighted content variable
		var mceSelected = tinyMCE.activeEditor.selection.getContent();
		var output = '';
		
		// setup the output of our shortcode
		output = '&nbsp;';
		
		if(wrap == 'yes') {
			output += '[pricing_table]';
		}
				output +='[pricing column='+column+' title=\"'+title+'\" price=\"'+price+'\"';
				if(price_extra) {
					output +='price_extra=\"'+ price_extra+'" ';
				}
				output +=' button_url=\"'+button_url+'\" button_text=\"'+button_text+'\" button_color=\"'+button_color+'\" ';
				if(content) {	
					output += ']'+ content;
				}
				else {
					output += ']' + mceSelected;
				}	
				output += '[/pricing]';
		
		if(wrap == 'yes') {
			output += '[/pricing_table]';
		}
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(PricingDialog.init, PricingDialog);
</script>
<form action="/" method="get" accept-charset="utf-8">

        <div class="form-section clearfix">
            <label for="pricing-wrap">New Table</label>
            <select name="pricing-wrap" id="pricing-wrap" size="1">
                <option value="no" selected="selected">No</option>
                <option value="yes">Yes</option>
            </select>
        </div>
        
        <hr />
        
		<div class="form-section clearfix">
            <label for="pricing-column">Column: Size</label>
            <select name="pricing-column" id="pricing-column" size="1">
             	<option value="2" selected="selected">Two</option>
                <option value="3">Three</option>
                <option value="4">Four</option>
                <option value="5">Five</option>
            </select>
        </div>
        
        <div class="form-section clearfix">
            <label for="pricing-title">Title</label>
            <input type="text" name="pricing-title" value="" id="pricing-title" />
        </div>
		<div class="form-section clearfix">
            <label for="pricing-price">Price</label>
            <input type="text" name="pricing-price" value="" id="pricing-price" />
        </div>
		<div class="form-section clearfix">
            <label for="pricing-price-extra">Price Extra info</label>
            <textarea type="text" name="pricing-extra" value="" id="pricing-extra" /></textarea>
        </div>
		<div class="form-section clearfix">
            <label for="pricing-button-url">Button URL</label>
            <input type="text" name="pricing-button-url" value="" id="pricing-button-url" />
        </div>
		<div class="form-section clearfix">
            <label for="pricing-button-text">Button Text</label>
            <input type="text" name="pricing-button-text" value="" id="pricing-button-text" />
        </div>
        <div class="form-section clearfix">
            <label for="pricing-button-color">Button Color</label>
            <select name="pricing-button-color" id="pricing-button-color" size="1">
                <option value="black" selected="selected">Black</option>
                <option value="blue">Blue</option>
                <option value="gray">Gray</option>
                <option value="green">Green</option>
                <option value="orange">Orange</option>
                <option value="pink">Pink</option>
                <option value="purple">Purple</option>
                <option value="red">Red</option>
            </select>
        </div>
        <div class="form-section clearfix">
            <label for="pricing-content">Content<br /><small>Leave Blank To Use Highlighted.=</small></label>
            <textarea type="text" name="pricing-content" value="" id="pricing-content"></textarea>
        </div>
    
    <a href="javascript:PricingDialog.insert(PricingDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Place</a>
    
</form>