<?php

	/**	Customised Walker class used to insert additional dropdown items for styling #sitenav */
	class Padded_Walker extends Walker_Nav_Menu{
		
		/**	Text to append to the links of elements with adjacent submenus */
		var $disclosure	=	"<em class=\"disclosure\"></em>";


		/** Number of top-level nav items */
		var $top_count	=	0;

		
		/** Whether to wrap each top-level link in an additional element */
		var $top_wrap	=	FALSE;


		function has_subnav($item){
			setup_postdata($item);
			$count	=	count(get_posts(array(
				"meta_key"		=>	"_menu_item_menu_item_parent",
				"meta_value"	=>	$item->ID,
				"post_type"		=>	"nav_menu_item"
			)));
			return $count > 0;
		}


		function start_lvl(&$output, $depth){
			$t			=	str_repeat("\t", ($depth+3)+($depth*2)+1);
			$output		.=	"\n$t	<div class=\"submenu\">\n" . "$t		<ul>\n";
		}


		function start_el(&$output, $item, $depth, $args){
			$args				=	(object) $args;
			$root				=	$depth == 0;
			if($root)				$this->top_count++;

			$args->before		=	$root ? ("\n" . ($this->top_wrap ? (str_repeat("\t", $depth+4) . "<div class=\"navwrap\">\n") : "") . "\t\t\t\t\t") : "	";
			$args->link_after	=	$root ? "" : ($this->has_subnav($item) ? $this->disclosure : "") . "<span></span>";
			$output				.=	str_repeat("\t", (($depth+3)+($depth-1*2)+3) - ($root ? 1 : 0));
			parent::start_el($output, $item, $depth, $args);
		}


		function end_el(&$output, $item, $depth){
			$t		=	str_repeat("\t", $depth+3);
			$output	.=	($depth == 0) ? "\n" . ($this->top_wrap ? "$t	</div>\n" : "") . "$t</li>\n\n" : (!$this->has_subnav($item) ? "" : str_repeat("\t", ($depth+3)+($depth*2)+1))."</li>\n";
		}


		function end_lvl(&$output, $depth){
			$t			=	str_repeat("\t", ($depth+3)+($depth*2)+1);
			$output		.=	"$t		</ul>\n";
			$output		.=	"\n$t		<div class=\"padding\"></div>\n";
			$output		.=	($depth > 0) ? "$t		<div class=\"buffer\"></div>\n" : "$t		<div class=\"shadow\"><b></b></div>\n";
			$output		.=	"$t	</div>\n";
		}
	}

?>