<?php
/**
 * Setup grid classes based on meta options
*/
function prth_grid($grid_style){
	
	if($grid_style == '3 Column'){
		return 'grid-3';
	}
	
	if($grid_style == '4 Column'){
		return 'grid-4';
	}
	
	if($grid_style == '5 Column'){
		return 'grid-5';
	}
	
	if($grid_style == '6 Column'){
		return 'grid-6';
	}		
}
?>