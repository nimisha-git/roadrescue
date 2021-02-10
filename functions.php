<?php

function theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'avada-stylesheet' ) );
    wp_enqueue_style( 'MyFontsWebfontsKit-style', get_stylesheet_directory_uri() . '/fonts/MyFontsWebfontsKit.css', array() );
    wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/css/style.css', array() );
    define( 'SET_VERSIONS', time() );
    wp_enqueue_style( 'custom-style-1', get_stylesheet_directory_uri() . '/css/custom.css', array() );
    define( 'SET_VERSIONS', time() );
    wp_enqueue_style( 'custom-slick', get_stylesheet_directory_uri() . '/css/slick.css', array() );
    define( 'SET_VERSIONS', time() );
     //wp_enqueue_script( 'jquery-preloader', get_theme_file_uri( '/js/preloader.js' ), array( 'jquery' ), SET_VERSIONS, true );
    wp_enqueue_script( 'jquery-slick', get_theme_file_uri( '/js/slick.min.js' ), array( 'jquery' ), SET_VERSIONS, true );
    wp_enqueue_script( 'jquery-vendor', get_theme_file_uri( '/js/vendor.js' ), array( 'jquery' ), SET_VERSIONS, true );
    wp_enqueue_script( 'jquery-developer', get_theme_file_uri( '/js/developer.js' ), array( 'jquery' ), SET_VERSIONS, true );

}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

if( function_exists('acf_add_options_page') ) {
	
	$parent = acf_add_options_page(array(
		'page_title' 	=> 'Theme Option',
		'menu_title'	=> 'Theme Option',
		'menu_slug' 	=> 'theme-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

}
add_action('wp_head', 'acf_scrip_head');
function acf_scrip_head(){
	echo get_field('head_script', 'option');
};
function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function dealers_post_type()
{
  register_post_type('dealers',
        array(
         'labels'      => array(
             'name'          => __('Dealers'),
             'singular_name' => __('Dealers'),
         ),
         'public'      => true,
         'has_archive' => false,
         'menu_icon'   => 'dashicons-portfolio',
         'supports'    => array('title', 'thumbnail')
        )
  );
}
add_action('init', 'dealers_post_type');
function ambulances_post_type()
{
  register_post_type('ambulances',
        array(
         'labels'      => array(
             'name'          => __('Ambulances'),
             'singular_name' => __('Ambulances'),
         ),
         'public'      => true,
         'has_archive' => false,
         'menu_icon'   => 'dashicons-portfolio',
         'supports'    => array('title', 'thumbnail','editor')
        )
  );
}
add_action('init', 'ambulances_post_type');
function dynamic_year(){
	$year= date("Y");
	return $year;
}
add_shortcode('dateyear', 'dynamic_year');
function wp_dealerstatelisting() {
    $args = array('post_type'=> 'dealers','posts_per_page' => -1);
    $resultData = '';
    $result = new WP_Query( $args );
    if ( $result-> have_posts() ){
        $allstate = '';
        while ( $result->have_posts() ) : $result->the_post(); 
            $allstate .= get_field('state').'., ';
        endwhile; wp_reset_postdata();
        $statearray = array_filter(array_unique(explode('., ', $allstate)));
        sort($statearray);
     	$resultData .='<div class="location-input">
            <ul>
                <li class="icon-location"><img src="../wp-content/uploads/2020/12/location-icon.png" alt=""></li>
                <li>
                    <span>
                        <select name="states" id="states">
                            <option value="">Select</option>';
					        foreach ($statearray as $select){
					             $resultData .='<option value="'.$select.'">'.$select.'</option>';
					        }
            			$resultData .='</select>
        			</span>
		        </li>
		        <li class="go-btn">
		            <button id="searchbtn">GO</button>
		        </li>
		    </ul>
    	</div>
    	<div class="center-block"></div>';
    } 
    return $resultData;
} 
add_shortcode('dealerstatelisting', 'wp_dealerstatelisting'); 
function dealer_list(){ 
    global $wpdb;
    $state           = $_POST['state'];
    if($state ){
	    $args = array(
		  	'post_type'   => 'dealers',
		  	'meta_query' => array(
		        array(
		            'key'     => 'state',
		            'value'   => $state,
		            'compare' => '=',
		        ),
		    )
		);
		$the_query = new WP_Query( $args );
	 
		// The Loop
		if ( $the_query->have_posts() ) {
		    while ( $the_query->have_posts() ) {
		        $the_query->the_post();
		        $info=get_field('info');
		        echo '<section id="page-body">
	               
	                <article class="locator-content" id="locator-content"><div class="locator-mini " data-sr="enter bottom FadeInUp and move 500px 0.2s">';
					foreach ($info as  $value) {
					  	echo '<div class="container-fluid">
						  	<div class="row">
								<div class="col-sm-12">
								  <h2>'.$value['center'].'</h2>
								</div>
							
								<div class="col-sm-12">
									<div class="media-table">
										<div class="media-table-cell">
											<img src="../wp-content/uploads/2020/12/location-icon.png" alt="location" class="locator-icon">
										</div>
									  	<p class="locator-address media-table-body">'.$value['address'].'</p>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="media-table">
										<div class="media-table-cell">
											<i class="fa fa-phone"></i>
										</div>
									  	<p class="media-table-body">'.$value['phone'].'</p>
									</div>
								</div>';
								if($value['website']): 
									echo '<div class="col-sm-12">
										<div class="media-table">
											<div class="media-table-cell">
												<i class="fa fa-globe"></i>
											</div>
										  	<p class="media-table-body">
										  		<a href="'.$value['website'].'" target="_blank">'.$value['website'].'</a>
									  		</p>
									  	</div>
								  	</div>';
							  	endif;
							echo '</div>
						  	<div class="clearfix"></div>
						  	<div class="row">';
						  		if($value['email']):
									echo '<div class="col-lg-3 col-md-4 col-sm-5">
										<div class="btn-push-out cl-effect-10">
											<a href="mailto:'.$value['email'].'" target="_blank" data-hover="CONTACT DEALER"><span>CONTACT DEALER</span></a>
										</div>
									</div>';
								endif;
								if($value['address']):
									echo '<div class="col-lg-3 col-md-4 col-sm-6">
									  	<div class="btn-push-out cl-effect-10 text-center">
									  		<a target="_blank" href="https://maps.google.com?daddr='.$value['address'].'" data-hover="GET DIRECTIONS"><span>GET DIRECTIONS</span></a>
									  	</div>
									</div>';
								endif;
						  	echo '</div>
					  	</div>';
					}
					echo '</article>
	            </section>';
		       
		    }
		wp_reset_postdata();
		} else {
		   	echo '<section id="page-body">
		        <article class="locator-content" id="locator-content">
			        <div class="container-fluid">
					  	<div class="row">
					  		<div class="col-sm-12">
			        			<h3> NO RESULT FOUND</h3>
		        			</div>
		        		</div>
				  	</div>
		        </article>
		    </section>';
		}
	}else{
        echo '<section id="page-body">
	        <article class="locator-content" id="locator-content">
		        <div class="container-fluid">
				  	<div class="row">
		        		<div class="col-sm-12">
		        			<h4 style="text-align: center;" class=""> NO RESULT FOUND</h4>
	        			</div>
	        		</div>
			  	</div>
	        </article>
	    </section>';
    }
	/* Restore original Post Data */
   
    exit;
}
add_action('wp_ajax_dealer_list', 'dealer_list');
add_action('wp_ajax_nopriv_dealer_list', 'dealer_list');


function wp_standardtabs() {
	$result='';
    $tabs=get_field('tabs',get_the_ID());
    if($tabs):
    	$result.='<div class="modules-tab">
			<div class="nav-tabs">
				<ul>';
				    foreach($tabs as $key => $t):
				    	$cls='';
				    	if($key==0):
				    		$cls='selected';
				    	endif;
				    	$result.='<li  class="'.$cls.'" data-tab="modules-tab'.$key.'">'.$t['tab_title'].'</li>';
				    endforeach;
			    $result.='</ul>
		    </div>';

     	$result.='<div class="tab-content">';
	     foreach($tabs as $key => $t):
    		$cls='';
	    	if($key==0):
	    		$cls='active';
	    	endif;
    		$result.='<div id="modules-tab'.$key.'" class="tab-pane '.$cls.'">';
	    	foreach($t['tab_content'] as $tc):
					$result.='<div class="row row-height">
	    				<div class="col-md-4 col-sm-height col-top"> 
	    					<img src="'.$tc['image'].'">
    					</div>
						<div class="col-md-8 col-sm-height col-top">
							<h2>'.$tc['title'].'</h2>
							'.$tc['content'].'
						</div>
					</div>';
	    	endforeach;
				$result.='</div>';
	    endforeach;
        $result.='</div>';
	    $result.='</div>';
    endif;
    return $result;
} 
add_shortcode('standardtabs', 'wp_standardtabs'); 

add_shortcode('standardslider', 'wp_standardslider'); 
function wp_standardslider() {
	$result='';
    $slider=get_field('slider',get_the_ID());
    if($slider):
    	$result.='<div class="chessis-sldider">';
		    foreach($slider as $key => $slide):
		    	$images=$slide['images'];
		    	if($images):
	    		 	foreach($images as $image):
				    	$result.='<figure>
					  		<img src="'.$image['image'].'" alt="">
					  		<figcaption>
					  			'.$image['title'].'
					  		</figcaption>
					 	</figure>';
				 	endforeach;
			 	endif;
		    endforeach;
	    $result.='</div>';
    endif;
    return $result;
} 