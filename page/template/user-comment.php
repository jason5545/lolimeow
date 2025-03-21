<?php
/**
 * @link https://www.boxmoe.com
 * @package lolimeow
 */
//boxmoe.com===安全設定=防止直接存取主題檔案
if(!defined('ABSPATH')){echo'Look your sister';exit;}

?>
<p class="fs-6 mb-2 text-muted">你的歷史留言內容將在這裡呈現</p>
<?php 
    $current_user = wp_get_current_user();
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $comments_per_page = 20;
    $offset = ($paged - 1) * $comments_per_page;

    $comments = get_comments(array(
        'user_id' => $current_user->ID,
        'status'  => 'approve',
        'number'  => $comments_per_page,
        'offset'  => $offset,
    ));

    $total_comments = get_comments(array(
        'user_id' => $current_user->ID,
        'status'  => 'approve',
        'count'   => true,
    ));

    // 統計被回覆的總數量
    $total_replies = 0;
    foreach ($comments as $comment) {
        $total_replies += get_comments(array(
            'parent' => $comment->comment_ID,
            'count'  => true,
        ));
    }
	$total_pages = ceil($total_comments / $comments_per_page);

	$output = '';
	$output .= '<div class="row gx-4">';
	$output .= '<div class="col-lg-6">';
	$output .= '   <div class="card border-0 mb-4 mb-lg-0 bg-light-subtle">';
	$output .= '	  <div class="card-body py-lg-3 px-lg-4">';
	$output .= '		 <div class="mb-1">';
	$output .= '			<h6>發出留言數</h6>';
	$output .= '			<h4>' . $total_comments . '則</h4>';
	$output .= '		 </div>';
	$output .= '	  </div>';
	$output .= '   </div>';
	$output .= '</div>';
	$output .= '<div class="col-lg-6">';
	$output .= '   <div class="card border-0 mb-4 mb-lg-0 bg-light-subtle">';
	$output .= '	  <div class="card-body py-lg-3 px-lg-4">';
	$output .= '		 <div class="mb-1">';
	$output .= '			<h6>被回覆留言數</h6>';
	$output .= '			<h4>' . $total_replies . '則</h4>';
	$output .= '		 </div>';
	$output .= '	  </div>';
	$output .= '   </div>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '<div class="table-responsive border mt-4 mb-4 rounded-3 px-4 py-3">';
	$output .= '<table class="table table-hover">';
  	$output .= '<thead>';
    $output .= '<tr>';
    $output .= '  <th scope="col">留言內容</th>';
    $output .= '  <th scope="col">被回覆數</th>';
    $output .= '  <th scope="col">檢視原文</th>';
    $output .= '</tr>';
  	$output .= '</thead>';
  	$output .= '<tbody>';
	if (empty($comments)) {
	$output .= '  <tr>';
    $output .= '  <td colspan="3" align="center">你暫時還沒有發出留言！</td>';
    $output .= '</tr>';        
    }else{
		foreach ($comments as $comment) {
			$replies_count = get_comments(array(
				'parent' => $comment->comment_ID,
				'count'  => true,
			));
			$comment_content = wp_trim_words($comment->comment_content, 10, '...');
			$comment_post_url = get_permalink($comment->comment_post_ID);
			$output .= '<tr>';
			$output .= '<td>' . esc_html($comment_content) . '</td>';
			$output .= '<td>' . intval($replies_count) . '</td>';
			$output .= '<td><a href="' . esc_url($comment_post_url) . '">檢視原文</a></td>';
			$output .= '</tr>';
		}
	}
  	$output .= '</tbody>';
	$output .= '</table>';
	$output .= '</div>';
	$output .= '<div class="mt-4">';
	$output .= '<nav>';
	$output .= '<ul class="pagination justify-content-center pagination-sm">';

	$current_page = max(1, get_query_var('paged', 1));

	// 計算顯示的頁碼範圍
	$start = max(1, min($current_page - 2, $total_pages - 4));
	$end = min($total_pages, max(5, $current_page + 2));

	// 顯示第一頁和省略號
	if ($start > 1) {
		$output .= '<li class="page-item"><a href="' . esc_url(add_query_arg('paged', 1)) . '" class="page-link">1</a></li>';
		if ($start > 2) {
			$output .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
		}
	}

	// 顯示中間的頁碼
	for ($i = $start; $i <= $end; $i++) {
		$class = ($i === $current_page) ? ' active' : '';
		$output .= '<li class="page-item' . $class . '"><a href="' . esc_url(add_query_arg('paged', $i)) . '" class="page-link">' . $i . '</a></li>';
	}

	// 顯示最後一頁和省略號
	if ($end < $total_pages) {
		if ($end < $total_pages - 1) {
			$output .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
		}
		$output .= '<li class="page-item"><a href="' . esc_url(add_query_arg('paged', $total_pages)) . '" class="page-link">' . $total_pages . '</a></li>';
	}

	$output .= '</ul>';
	$output .= '</nav>';
	$output .= '</div>';	
    echo $output;

?>