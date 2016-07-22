<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package OneEngine
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8">
    <!-- Title
	================================================== -->
	<title><?php bloginfo('name'); ?><?php if(is_front_page()){ echo ' - ' .get_bloginfo('description');} else echo wp_title(); ?>
    </title>
    <!-- Title / End -->
    
    <!-- Meta
	================================================== -->
	<meta name="description" content="<?php echo oneengine_option( 'meta_description' );?>">
    <meta name="keywords" content="<?php echo oneengine_option( 'meta_keyword' ); ?>">
	<meta name="author" content="<?php echo oneengine_option( 'meta_author' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <meta property="og:image" content="http://www.cupolsoc.com/wp-content/uploads/2014/12/NSP-logo_200dpi1.jpg" />
<meta property="og:image" content="http://www.nextsteppoland.org/wp-content/uploads/2014/12/NSP-logo_200dpi1.jpg" />
       
	<!-- Meta / End -->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="<?php echo oneengine_option('favicon', false, 'url'); ?>">
    <link rel="icon" type="image/png" href="<?php echo oneengine_option('favicon', false, 'url'); ?>" />
	<link rel="apple-touch-icon" href="<?php echo oneengine_option('touch_icon', false, 'url'); ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo oneengine_option('touch_icon_72', false, 'url'); ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo oneengine_option('touch_icon_144', false, 'url'); ?>">
    <!-- Favicons / End -->
    
    <noscript>
    	<style>
        	#portfolio_list div.item a div.hover {
				top: 0px;
				left: -100%;
				-webkit-transition: all 0.3s ease;
				-moz-transition: all 0.3s ease-in-out;
				-o-transition: all 0.3s ease-in-out;
				-ms-transition: all 0.3s ease-in-out;
				transition: all 0.3s ease-in-out;
			}
			#portfolio_list div.item a:hover div.hover{
				left: 0px;
			}
        </style>
    </noscript>
    	  
	<?php
    //loads comment reply JS on single posts and pages
    if ( is_single()) wp_enqueue_script( 'comment-reply' ); 
    ?>
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
    <script type='text/javascript' src='./wp-content/themes/oneengine/js/jquery-2.1.1.min.js'></script>
    <script type='text/javascript'>
    function show_company(title, content){
        $('#show-company .company-title').html(title);
        $('#show-company .company-content').html(content);
    }

    function show_team_content(container, destination){
        $init_title = $(container+" div.image-team-wrapper:first-child").attr('data-title');
        $init_content = $(container+" div.image-team-wrapper:first-child").attr('data-content');

        $(destination+" .show-content").html($init_content);
        $(destination+" .show-title").html($init_title);

        $(container+" div.image-team-wrapper").click(function(){
            $this = $(this);
            $(destination+" .show-content").html($this.attr('data-content'));
            $(destination+" .show-title").html($this.attr('data-title'));
        });
    }

    function show_speaker_bio(container, destination){
/*        $init_title = $(container).find(".social-btn").attr('data-name');
        $init_content = $(container).find(".social-btn").attr('data-content');

        $(destination+" .show-content").html($init_content);*/
       

        $(container+" .social-btn").click(function(){
            $this = $(this);
            $(destination+" .show-content").html($this.attr('data-content'));
            
        });

        $('.show-ticket-section').click(function(){
            $('#tickets').animatescroll({padding:50});
        });
    }

    $(document).ready(function(){
        show_team_content("#corporate_partners_wrapper", "#show-corporate-partner");
        show_speaker_bio("#speaker_wrapper", "#show-speaker");
        show_team_content("#patron_partners_wrapper", "#show-patron-partner");
	show_speaker_bio("#nsp_team_wrapper","#show-team");
    });
    </script>
    <script type="text/javascript"  src='./wp-content/themes/oneengine/js/animatescroll.min.js'></script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!-- Preloading
    ======================================================================== -->
	<div class="mask-color">
        <div id="preview-area">
            <div class="spinner">
              <div class="dot1"></div>
              <div class="dot2"></div>
            </div>
        </div>
    </div>
	<!-- Preloading / End -->
    <?php if( is_front_page() ){ ?>
    
    <!-- Slider
    ======================================================================== -->
    <!-- Slider / End -->
    <!-- Header
    ======================================================================== -->
    <div class="sticky-wrapper" style="height:80px;">
     <header id="header">
        <div class="container" >
            <div class="row">
                <div class="col-md-3 col-xs-3">
                    <!-- Logo
                    ======================================================================== -->
                    <div class="logo-wrapper">
                        <div class="logo">
                             <a href="<?php echo home_url(); ?>">
                                <?php 
                                    $top   = '' ;
                                    $left  = '' ;
                                    $width = '' ;
                                    if( oneengine_option('logo_top') != '' )$top    = 'top:'.oneengine_option('logo_top').'px;' ;
                                    if( oneengine_option('logo_left') != '' )$left  = 'left:'.oneengine_option('logo_left').'px;';
                                    if( oneengine_option('logo_width') != '' )$width = 'width:'.oneengine_option('logo_width').'px;';
                                    if( oneengine_option('custom_logo', false, 'url') !== '' ){
                                        echo '<div class="logo-wrapper" style="'.$width.$left.$top.'"><img src="'. oneengine_option('custom_logo', false, 'url') .'" alt="'.get_bloginfo( 'name' ).'" /></div>';
                                    }else{
                                ?>
                                    <div class="logo-img"><span>E</span></div>
                                <?php } ?>
                             </a>
                        </div>  
                    </div>
                    <!-- Logo / End -->
                </div>
                
                <div class="col-md-9 col-xs-9">
                    <!-- Menu
                    ======================================================================== --> 
                    <nav id="main-menu-top">
                          <?php
                              wp_nav_menu(array( 
                                  'container' => false,
                                  'container_class' => 'menu',
                                  'menu_class' => 'main-menu',
                                  'menu_id'         => 'menu-res',
                                  'theme_location' => 'main_nav',
                                  'before' => '',
                                  'after' => '',
                                  'link_before' => '',
                                  'link_after' => '',
                                  'fallback_cb' => false,
                              ));      
                          ?>
                    </nav>
                    <!-- Menu / End -->
                    
                    <nav class="menu-responsive"> 
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header / End --></div>
	<!-- Header / End -->
    <img style="display:block; width:100%; height:auto;" src="./wp-content/uploads/2014/12/strona-tytulowa_NSP-3.png" />

	<?php } ?>
