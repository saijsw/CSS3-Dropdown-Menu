<?php

	/**	Customised Walker class used to insert additional dropdown items for styling #sitenav */
	class Padded_Walker extends Walker_Nav_Menu{
		
		function end_lvl(&$output, $depth){
			$t			=		str_repeat("\t", $depth);
			
			$extra		=		$t . "	<li class=\"padding\"></li>\n";
			$extra		.=		$t . "	<li class=\"shadow\"></li>\n";
			if($depth > 0)
				$extra	.=		$t . "	<li class=\"buffer\"></li>\n";
			
			$output		.=		$extra;
			$output		.=		$t . "</ul>\n";
		}
	}

?>