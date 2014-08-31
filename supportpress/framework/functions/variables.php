<?php
/**
 * Let's build some arrays for use later
*/

//counters
$prth_counter=0;
$prth_staff_counter=0;


/*--------------------------------------*/
/* Social Icons
/*--------------------------------------*/
function prth_social_icons() {
	
	//array defined
	$social_icons = array('twitter','facebook','linkedin','tumblr','flickr','pinterest','github','youtube','vimeo','rss');
	
	//return array
	return apply_filters('prth_social_icons', $social_icons);
}

/*--------------------------------------*/
/* Fonts
/*--------------------------------------*/
function prth_google_fonts() {
	
	//array defined
	$custom_fonts = array( 'default' => 'Default', 'Helvetica' => 'Helvetica','Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial','Georgia' => 'Georgia','Lucida Sans Unicode' => 'Lucida Sans Unicode','Times New Roman' => 'Times New Roman','Verdana' => 'Verdana','Abel' => 'Abel','Abril Fatface' => 'Abril Fatface','Aclonica' => 'Aclonica','Actor' => 'Actor','Adamina' => 'Adamina','Aguafina Script' => 'Aguafina Script','Aladin' => 'Aladin','Aldrich' => 'Aldrich','Alice' => 'Alice','Alike Angular' => 'Alike Angular','Alike' => 'Alike','Allan' => 'Allan','Allerta Stencil' => 'Allerta Stencil','Allerta' => 'Allerta','Amaranth' => 'Amaranth','Amatic SC' => 'Amatic SC','Andada' => 'Andada','Andika' => 'Andika','Annie Use Your Telescope' => 'Annie Use Your Telescope','Anonymous Pro' => 'Anonymous Pro','Antic' => 'Antic','Anton' => 'Anton','Arapey' => 'Arapey','Architects Daughter' => 'Architects Daughter','Arimo' => 'Arimo','Artifika' => 'Artifika','Arvo' => 'Arvo','Asset' => 'Asset','Astloch' => 'Astloch','Atomic Age' => 'Atomic Age','Aubrey' => 'Aubrey','Bangers' => 'Bangers','Bentham' => 'Bentham','Bevan' => 'Bevan','Bigshot One' => 'Bigshot One','Bitter' => 'Bitter','Black Ops One' => 'Black Ops One','Bowlby One SC' => 'Bowlby One SC','Bowlby One' => 'Bowlby One','Brawler' => 'Brawler','Bubblegum Sans' => 'Bubblegum Sans','Buda' => 'Buda','Butcherman Caps' => 'Butcherman Caps','Cabin Condensed' => 'Cabin Condensed','Cabin Sketch' => 'Cabin Sketch','Cabin' => 'Cabin','Cagliostro' => 'Cagliostro','Calligraffitti' => 'Calligraffitti','Candal' => 'Candal','Cantarell' => 'Cantarell','Cardo' => 'Cardo','Carme' => 'Carme','Carter One' => 'Carter One','Caudex' => 'Caudex','Cedarville' => 'Cedarville','Changa One' => 'Changa One','Cherry Cream Soda' => 'Cherry Cream Soda','Chewy' => 'Chewy','Chicle' => 'Chicle','Chivo' => 'Chivo','Coda Caption' => 'Coda Caption','Coda' => 'Coda','Comfortaa' => 'Comfortaa','Coming Soon' => 'Coming Soon','Contrail One' => 'Contrail One','Convergence' => 'Convergence','Cookie' => 'Cookie','Copse' => 'Copse','Corben' => 'Corben','Cousine' => 'Cousine','Coustard' => 'Coustard','Covered By Your Grace' => 'Covered By Your Grace','Crafty Girls' => 'Crafty Girls','Creepster Caps' => 'Creepster Caps','Crimson Text' => 'Crimson Text','Crushed' => 'Crushed','Cuprum' => 'Cuprum','Damion' => 'Damion','Dancing Script' => 'Dancing Script','Dawning of a New Day' => 'Dawning of a New Day','Days One' => 'Days One','Delius Swash Caps' => 'Delius Swash Caps','Delius Unicase' => 'Delius Unicase','Delius' => 'Delius','Devonshire' => 'Devonshire','Didact Gothic' => 'Didact Gothic','Dorsa' => 'Dorsa','Dr Sugiyama' => 'Dr Sugiyama','Droid Sans Mono' => 'Droid Sans Mono','Droid Sans' => 'Droid Sans','Droid Serif' => 'Droid Serif','EB Garamond' => 'EB Garamond','Eater Caps' => 'Eater Caps','Expletus Sans' => 'Expletus Sans','Fanwood Text' => 'Fanwood Text','Federant' => 'Federant','Federo' => 'Federo','Fjord One' => 'Fjord One','Fondamento' => 'Fondamento','Fontdiner Swanky' => 'Fontdiner Swanky','Forum' => 'Forum','Francois One' => 'Francois One','Gentium Basic' => 'Gentium Basic','Gentium Book Basic' => 'Gentium Book Basic','Geo' => 'Geo','Geostar Fill' => 'Geostar Fill','Geostar' => 'Geostar','Give You Glory' => 'Give You Glory','Gloria Hallelujah' => 'Gloria Hallelujah','Goblin One' => 'Goblin One','Gochi Hand' => 'Gochi Hand','Goudy Bookletter 1911' => 'Goudy Bookletter 1911','Gravitas One' => 'Gravitas One','Gruppo' => 'Gruppo','Hammersmith One' => 'Hammersmith One','Herr Von Muellerhoff' => 'Herr Von Muellerhoff','Holtwood One SC' => 'Holtwood One SC','Homemade Apple' => 'Homemade Apple','IM Fell DW Pica SC' => 'IM Fell DW Pica SC','IM Fell DW Pica' => 'IM Fell DW Pica','IM Fell Double Pica SC' => 'IM Fell Double Pica SC','IM Fell Double Pica' => 'IM Fell Double Pica','IM Fell English SC' => 'IM Fell English SC','IM Fell English' => 'IM Fell English','IM Fell French Canon SC' => 'IM Fell French Canon SC','IM Fell French Canon' => 'IM Fell French Canon','IM Fell Great Primer SC' => 'IM Fell Great Primer SC','IM Fell Great Primer' => 'IM Fell Great Primer','Iceland' => 'Iceland','Inconsolata' => 'Inconsolata','Indie Flower' => 'Indie Flower','Irish Grover' => 'Irish Grover','Istok Web' => 'Istok Web','Jockey One' => 'Jockey One','Josefin Sans' => 'Josefin Sans','Josefin Slab' => 'Josefin Slab','Judson' => 'Judson','Julee' => 'Julee','Jura' => 'Jura','Just Another Hand' => 'Just Another Hand','Just Me Again Down Here' => 'Just Me Again Down Here','Kameron' => 'Kameron','Kelly Slab' => 'Kelly Slab','Kenia' => 'Kenia','Knewave' => 'Knewave','Kranky' => 'Kranky','Kreon' => 'Kreon','Kristi' => 'Kristi','La Belle Aurore' => 'La Belle Aurore','Lancelot' => 'Lancelot','Lato' => 'Lato','League Script' => 'League Script','Leckerli One' => 'Leckerli One','Lekton' => 'Lekton','Lemon' => 'Lemon','Limelight' => 'Limelight','Linden Hill' => 'Linden Hill','Lobster Two' => 'Lobster Two','Lobster' => 'Lobster','Lora' => 'Lora','Love Ya Like A Sister' => 'Love Ya Like A Sister','Loved by the King' => 'Loved by the King','Luckiest Guy' => 'Luckiest Guy','Maiden Orange' => 'Maiden Orange','Mako' => 'Mako','Marck Script' => 'Marck Script','Marvel' => 'Marvel','Mate SC' => 'Mate SC','Mate' => 'Mate','Maven Pro' => 'Maven Pro','Meddon' => 'Meddon','MedievalSharp' => 'MedievalSharp','Megrim' => 'Megrim','Merienda One' => 'Merienda One','Merriweather' => 'Merriweather','Metrophobic' => 'Metrophobic','Michroma' => 'Michroma','Miltonian Tattoo' => 'Miltonian Tattoo','Miltonian' => 'Miltonian','Miss Fajardose' => 'Miss Fajardose','Miss Saint Delafield' => 'Miss Saint Delafield','Modern Antiqua' => 'Modern Antiqua','Molengo' => 'Molengo','Monofett' => 'Monofett','Monoton' => 'Monoton','Monsieur La Doulaise' => 'Monsieur La Doulaise','Montez' => 'Montez','Mountains of Christmas' => 'Mountains of Christmas','Mr Bedford' => 'Mr Bedford','Mr Dafoe' => 'Mr Dafoe','Mr De Haviland' => 'Mr De Haviland','Mrs Sheppards' => 'Mrs Sheppards','Muli' => 'Muli','Neucha' => 'Neucha','Neuton' => 'Neuton','News Cycle' => 'News Cycle','Niconne' => 'Niconne','Nixie One' => 'Nixie One','Nobile' => 'Nobile','Nosifer Caps' => 'Nosifer Caps','Nothing You Could Do' => 'Nothing You Could Do','Nova Cut' => 'Nova Cut','Nova Flat' => 'Nova Flat','Nova Mono' => 'Nova Mono','Nova Oval' => 'Nova Oval','Nova Round' => 'Nova Round','Nova Script' => 'Nova Script','Nova Slim' => 'Nova Slim','Nova Square' => 'Nova Square','Numans' => 'Numans','Nunito' => 'Nunito','Old Standard TT' => 'Old Standard TT','Open Sans Condensed' => 'Open Sans Condensed','Open Sans' => 'Open Sans','Orbitron' => 'Orbitron','Oswald' => 'Oswald','Over the Rainbow' => 'Over the Rainbow','Ovo' => 'Ovo','PT Sans Caption' => 'PT Sans Caption','PT Sans Narrow' => 'PT Sans Narrow','PT Sans' => 'PT Sans','PT Serif Caption' => 'PT Serif Caption','PT Serif' => 'PT Serif','Pacifico' => 'Pacifico','Passero One' => 'Passero One','Patrick Hand' => 'Patrick Hand','Paytone One' => 'Paytone One','Permanent Marker' => 'Permanent Marker','Petrona' => 'Petrona','Philosopher' => 'Philosopher','Piedra' => 'Piedra','Pinyon Script' => 'Pinyon Script','Play' => 'Play','Playfair Display' => 'Playfair Display','Podkova' => 'Podkova','Poller One' => 'Poller One','Poly' => 'Poly','Pompiere' => 'Pompiere','Prata' => 'Prata','Prociono' => 'Prociono','Puritan' => 'Puritan','Quattrocento Sans' => 'Quattrocento Sans','Quattrocento' => 'Quattrocento','Questrial' => 'Questrial','Quicksand' => 'Quicksand','Radley' => 'Radley','Raleway' => 'Raleway','Rammetto One' => 'Rammetto One','Rancho' => 'Rancho','Rationale' => 'Rationale','Redressed' => 'Redressed','Reenie Beanie' => 'Reenie Beanie','Ribeye Marrow' => 'Ribeye Marrow','Ribeye' => 'Ribeye','Righteous' => 'Righteous','Rochester' => 'Rochester','Rock Salt' => 'Rock Salt','Rokkitt' => 'Rokkitt','Rosario' => 'Rosario','Ruslan Display' => 'Ruslan Display','Salsa' => 'Salsa','Sancreek' => 'Sancreek','Sansita One' => 'Sansita One','Satisfy' => 'Satisfy','Schoolbell' => 'Schoolbell','Shadows Into Light' => 'Shadows Into Light','Shanti' => 'Shanti','Short Stack' => 'Short Stack','Sigmar One' => 'Sigmar One','Signika Negative' => 'Signika Negative','Signika' => 'Signika','Six Caps' => 'Six Caps','Slackey' => 'Slackey','Smokum' => 'Smokum','Smythe' => 'Smythe','Sniglet' => 'Sniglet','Snippet' => 'Snippet','Sorts Mill Goudy' => 'Sorts Mill Goudy','Special Elite' => 'Special Elite','Spinnaker' => 'Spinnaker','Spirax' => 'Spirax','Stardos Stencil' => 'Stardos Stencil','Sue Ellen Francisco' => 'Sue Ellen Francisco','Sunshiney' => 'Sunshiney','Supermercado One' => 'Supermercado One','Swanky and Moo Moo' => 'Swanky and Moo Moo','Syncopate' => 'Syncopate','Tangerine' => 'Tangerine','Tenor Sans' => 'Tenor Sans','Terminal Dosis' => 'Terminal Dosis','The Girl Next Door' => 'The Girl Next Door','Tienne' => 'Tienne','Tinos' => 'Tinos','Tulpen One' => 'Tulpen One','Ubuntu Condensed' => 'Ubuntu Condensed','Ubuntu Mono' => 'Ubuntu Mono','Ubuntu' => 'Ubuntu','Ultra' => 'Ultra','UnifrakturCook' => 'UnifrakturCook','UnifrakturMaguntia' => 'UnifrakturMaguntia','Unkempt' => 'Unkempt','Unlock' => 'Unlock','Unna' => 'Unna','VT323' => 'VT323','Varela Round' => 'Varela Round','Varela' => 'Varela','Vast Shadow' => 'Vast Shadow','Vibur' => 'Vibur','Vidaloka' => 'Vidaloka','Volkhov' => 'Volkhov','Vollkorn' => 'Vollkorn','Voltaire' => 'Voltaire','Waiting for the Sunrise' => 'Waiting for the Sunrise','Wallpoet' => 'Wallpoet','Walter Turncoat' => 'Walter Turncoat','Wire One' => 'Wire One','Yanone Kaffeesatz' => 'Yanone Kaffeesatz','Yellowtail' => 'Yellowtail','Yeseva One' => 'Yeseva One','Zeyada' => 'Zeyada');
	
	//return array
	return apply_filters('prth_google_fonts', $custom_fonts);

}


/*--------------------------------------*/
/* Translations Used Multiple Times
/*--------------------------------------*/

function prth_translation($arg) {
	
	global $itdata; //get global variables
	
	//read more
	if($arg == 'readmore'){
		return $itdata['translation_read_more_text'] ? $itdata['translation_read_more_text'] : __('read more','prth');
	}
	
	//tags
	if($arg == 'tags'){
		return $itdata['translation_tags_text'] ? $itdata['translation_tags_text'] : __('Tags','prth');
	}
	
	//comments
	if($arg == 'comments'){
		$lang_0_comments = $itdata['translation_comments_text'] ? '0 ' . $itdata['translation_comments_text'] . 's' : __('0 Comments', 'prth');
		$lang_1_comment = $itdata['translation_comments_text'] ? '1 ' . $itdata['translation_comments_text'] : __('1 Comment', 'prth');
		$lang_x_comment = $itdata['translation_comments_text'] ? '% ' . $itdata['translation_comments_text'] . 's' : __('% Comments', 'prth');
		$lang_no_comment = $itdata['translation_comments_disabled_text'] ? $itdata['translation_comments_disabled_text'] : __('Comments Disabled', 'prth');
		comments_popup_link( $lang_0_comments, $lang_1_comment, $lang_x_comment, '', $lang_no_comment);
	}

}

?>