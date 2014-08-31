<?php
/**
 * Setup grid classes based on meta options
*/
function prth_grid($prth_grid_style){
	
	if($prth_grid_style == '3 Column'){
		return 'grid-3';
	}
	
	if($prth_grid_style == '4 Column'){
		return 'grid-4';
	}
	
	if($prth_grid_style == '5 Column'){
		return 'grid-5';
	}
	
	if($prth_grid_style == '6 Column'){
		return 'grid-6';
	}		
}

?>