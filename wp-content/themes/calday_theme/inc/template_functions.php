<?php
	
	
	
	add_filter( 'wp_pagenavi', 'ik_pagination', 10, 2 );
	
	function ik_pagination($html) {
		$out = '';
	  
		//wrap a's and span's in li's
		$out = str_replace("<div","",$html);
		$out = str_replace("class='wp-pagenavi'>","",$out);
		$out = str_replace("<a","<li><a",$out);
		$out = str_replace("</a>","</a></li>",$out);
		$out = str_replace("<span","<li><span",$out);  
		$out = str_replace("</span>","</span></li>",$out);
		$out = str_replace("</div>","",$out);
	  
		return '<ul class="pagination pagination-centered">'.$out.'</ul>';
	}
	
	function tailored_post_meta() {
        if( $category = get_the_category() ) {
            echo '<div class="post_meta">';
            if($category[0]){
                echo ' Posted in <a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a> on ';
            }
            the_time( get_option( 'date_format' ) );
            echo '</div>';
        }
    }
	
	function add_image_responsive_class($content) {
	   global $post;
	   $pattern ="/<img(.*?)class=\"(.*?)\"(.*?)>/i";
	   $replacement = '<img$1class="$2 img-responsive"$3>';
	   $content = preg_replace($pattern, $replacement, $content);
	   return $content;
	}
	add_filter('the_content', 'add_image_responsive_class');
	
	function catch_that_image() {
	  global $post, $posts;
	  $first_img = '';
	  ob_start();
	  ob_end_clean();
	  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	  $first_img = $matches[1][0];
	
	  if(empty($first_img)) {
		$first_img = "/path/to/default.png";
	  }
	  return $first_img;
	}
	
	function custom_excerpt_length( $length ) {
		return 30;
	}
	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
	
	function new_excerpt_more( $more ) {
		return '...';
	}
	add_filter('excerpt_more', 'new_excerpt_more');