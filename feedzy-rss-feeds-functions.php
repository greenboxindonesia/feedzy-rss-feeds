<?php
/***************************************************************
 * Enqueue feedzy CSS
 ***************************************************************/
function feedzy_register_custom_style() {
	wp_register_style( 'feedzy-style', plugins_url('css/feedzy-rss-feeds.css', __FILE__ ), NULL, NULL );
}
function feedzy_print_custom_style() {
	global $feedzyStyle;
	if ( !$feedzyStyle )
		return;

	wp_print_styles( 'feedzy-style' );
}
add_action( 'init', 'feedzy_register_custom_style' );
add_action( 'wp_footer', 'feedzy_print_custom_style' );


/***************************************************************
 * Feed item container class
 ***************************************************************/
function feedzy_classes_item(){
	$classes = array( 'rss_item' );
	$classes = apply_filters( 'feedzy_add_classes_item', $classes );
	$classes = implode( ' ', $classes );
	return $classes;
}


/***************************************************************
 * Get an image from the feed
 ***************************************************************/
function feedzy_returnImage( $string ) {
	$img = html_entity_decode($string, ENT_QUOTES, 'UTF-8');
	$pattern = "/<img[^>]+\>/i";
	preg_match( $pattern, $img, $matches );
	if( isset( $matches[0] ) ){
		$string = $matches[0];
	}
	return $string;
}

function feedzy_scrapeImage( $string ) {
	$link = '';
	$pattern = '/src=[\'"]?([^\'" >]+)[\'" >]/';     
	preg_match( $pattern, $string, $link );
	if( isset( $link[1] ) ){
		$link = $link[1];
		$link = urldecode( $link );
	}
	return $link;
}

/***************************************************************
 * Image name encode + get image url if in url param
 ***************************************************************/
function feedzy_image_encode( $string ) {
	
	//Check if img url is set as an URL parameter
	$url_tab = parse_url( $string );
	if( isset( $url_tab['query'] ) ){
		preg_match_all( '/(http|https):\/\/[^ ]+(\.gif|\.GIF|\.jpg|\.JPG|\.jpeg|\.JPEG|\.png|\.PNG)/', $url_tab['query'], $imgUrl );
		if( isset( $imgUrl[0][0] ) ){
			$string = $imgUrl[0][0];
		}
	}
	
	//Encode image name only en keep extra parameters
	$query = '';
	$url_tab = parse_url( $string );
	if( isset( $url_tab['query'] ) ){
		$query = '?' . $url_tab['query'];
	}
	$path_parts = pathinfo( $string );
	$path = $path_parts['dirname'];
	$file = $path_parts['filename'] . '.' . pathinfo( $url_tab['path'], PATHINFO_EXTENSION );
	$file = rawurldecode( $file );
	
	//Return a well encoded image url
	return $path . '/' . rawurlencode( $file ) . $query;
}

/***************************************************************
 * Filter feed description input
 ***************************************************************/
function feedzy_summary_input_filter( $description, $content, $feedURL ) {
	$description = trim( strip_tags( $description ) );
	$description = trim( chop( $description, '[&hellip;]' ) );
 
    return $description;
}
add_filter('feedzy_summary_input', 'feedzy_summary_input_filter', 9, 3);	


/***************************************************************
 * Check if keywords are in title
 ***************************************************************/
function feedzy_feed_item_keywords_title( $continue, $keywords_title, $item, $feedURL ){
	if ( !empty( $keywords_title ) ) {
		$continue = false;
		foreach ( $keywords_title as $keyword ) {
			if ( strpos( $item->get_title(), $keyword ) !== false ) {
				$continue = true;
			}
		}
	}
	return $continue;
}
add_filter('feedzy_item_keyword', 'feedzy_feed_item_keywords_title', 9, 4); 


/***************************************************************
 * Insert cover picture to main rss feed content
 ***************************************************************/
function feedzy_insert_thumbnail_RSS( $content ) {
	 global $post;
	 if ( has_post_thumbnail( $post->ID ) ){
		  $content = '' . get_the_post_thumbnail( $post->ID, 'thumbnail' ) . '' . $content;
	 }
	 return $content;
}
add_filter( 'the_excerpt_rss', 'feedzy_insert_thumbnail_RSS' );
add_filter( 'the_content_feed', 'feedzy_insert_thumbnail_RSS' );


/***************************************************************
 * Include cover picture (medium) to rss feed enclosure 
 * and media:content
 ***************************************************************/
function feedzy_include_thumbnail_RSS (){
	 global $post;
	 
	 if ( has_post_thumbnail( $post->ID ) ){
		 
		$postThumbnailId = get_post_thumbnail_id( $post->ID );
		$attachmentMeta = wp_get_attachment_metadata( $postThumbnailId );
		$imageUrl = wp_get_attachment_image_src( $postThumbnailId, 'medium' );
		
		echo '<enclosure url="' . $imageUrl[0] . '" length="' . filesize( get_attached_file( $postThumbnailId ) ) . '" type="image/jpg" />';				
		echo '<media:content url="' . $imageUrl[0] . '" width="' . $attachmentMeta['sizes']['medium']['width'] . '" height="' . $attachmentMeta['sizes']['medium']['height'] . '" medium="image" type="' . $attachmentMeta['sizes']['medium']['mime-type'] . '" />';
	
	}
}
//add_action('rss_item', 'feedzy_include_thumbnail_RSS');
//add_action('rss2_item', 'feedzy_include_thumbnail_RSS');