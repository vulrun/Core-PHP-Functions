<?php
/**
 * @param
 * $total_rows      (int) Total Rows
 * $rows_per_page   (int) Rows per page
 * $page_no         (int) Current Page Number
 *
 * $rows_per_page = 50;                                    // Preserve it in DATABASE or in COOKIE or go with static
 * $page_no = max(1, $_GET['page']);                       // $page_no minimum value should be 1 and fetching from query string
 * $limit = ($page_no - 1) * $rows_per_page;
 *
 * And MySQL Limit would be "LIMIT $limit, $rows_per_page"
 * Add <?php echo pagination(1090, $rows_per_page, $page_no); ?>
**/

function pagination($total_rows = 0, $rows_per_page = 20, $page_no = 1){
	$li = array();
	$links = array();
	$Ist = 1;
	$Lst = ceil($total_rows / $rows_per_page);

	if( $Lst < 1 ) return;

	// Add current page to the array
	if( $page_no > 0 ){
		$links[] = $page_no;
	}

	// Add the pages around the current page to the array
	if( $page_no > 2 ){
		$links[] = $page_no - 1;
		$links[] = $page_no - 2;
	}
	if( $page_no + 2 <= $Lst ){
		$links[] = $page_no + 1;
		$links[] = $page_no + 2;
	}
	

	// Link to first page, plus ellipses if necessary
	if( !in_array($Ist, $links) ) {
		$class = $page_no == $Ist ? 'active' : '';
		$li[] = sprintf('<li class="page-item %s"><a class="page-link" href="%s">%s</a></li>', $class, permalink('page', $Ist), $Ist);

		if( !in_array($Ist + 1, $links) ){
			$li[] = '<li class="page-item disabled"><a class="page-link" href="#">&hellip;</a></li>';
		}
	}

	sort($links);
	foreach( $links as $link ){
		$class = $page_no == $link ? 'active' : '';
		$li[] = sprintf('<li class="page-item %s"><a class="page-link" href="%s">%s</a></li>', $class, permalink('page', $link), $link );
	}

	// Link to last page, plus ellipses if necessary
	if( !in_array($Lst, $links) ) {
		if( !in_array($Lst - 1, $links) ){
			$li[] = '<li class="page-item disabled"><a class="page-link" href="#">&hellip;</a></li>';
		}

		$class = $page_no == $Lst ? 'active' : '';
		$li[] = sprintf('<li class="page-item %s"><a class="page-link" href="%s">%s</a></li>', $class, permalink('page', $Lst), $Lst );
	}


	$html = '<ul class="pagination m-0">'.implode("\n", $li).'</ul>';
	return $html;
}
