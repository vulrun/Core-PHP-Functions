<?php
/**
 * @param
 * $total  (int) Total Rows
 * $freq   (int) Rows per page
 * $page   (int) Current Page Number 
**/

function pagination($total, $freq, $page){
	$li = array();
	$links = array();
	$Ist = 1;
	$Lst = ceil($total / $freq);

	if( $Lst < 1 ) return;

	// Add current page to the array
	if( $page > 0 ){
		$links[] = $page;
	}

	// Add the pages around the current page to the array
	if( $page > 2 ){
		$links[] = $page - 1;
		$links[] = $page - 2;
	}
	if( $page + 2 <= $Lst ){
		$links[] = $page + 1;
		$links[] = $page + 2;
	}


	// Link to first page, plus ellipses if necessary
	if( !in_array($Ist, $links) ) {
		$class = $page == $Ist ? 'active' : '';
		$li[] = sprintf('<li class="page-item %s"><a class="page-link" href="%s">%s</a></li>', $class, permalink('page', $Ist), $Ist);

		if( !in_array($Ist + 1, $links) ){
			$li[] = '<li class="page-item disabled"><a class="page-link" href="#">&hellip;</a></li>';
		}
	}

	sort($links);
	foreach( $links as $link ){
		$class = $page == $link ? 'active' : '';
		$li[] = sprintf('<li class="page-item %s"><a class="page-link" href="%s">%s</a></li>', $class, permalink('page', $link), $link );
	}

	// Link to last page, plus ellipses if necessary
	if( !in_array($Lst, $links) ) {
		if( !in_array($Lst - 1, $links) ){
			$li[] = '<li class="page-item disabled"><a class="page-link" href="#">&hellip;</a></li>';
		}

		$class = $page == $Lst ? 'active' : '';
		$li[] = sprintf('<li class="page-item %s"><a class="page-link" href="%s">%s</a></li>', $class, permalink('page', $Lst), $Lst );
	}


	$html = '<ul class="pagination m-0">'.implode("\n", $li).'</ul>';
	return $html;
}
