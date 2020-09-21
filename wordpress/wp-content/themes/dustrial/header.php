<?php
/**
 * The header for our theme.
 *
 * @package dustrial
 */
?>
<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
    <meta charset="<?php bloginfo('charset');?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url');?>">
    
    <?php if ( ! ( function_exists( 'has_site_icon' ) && has_site_icon() ) ) {
        if( function_exists( 'dustrial_framework_init' ) ) {
            $site_icon = dustrial_get_option('dustrial_site_icon');
            $attachment = wp_get_attachment_image_src( $site_icon, 'full' );
            $site_fav_icon    = ($attachment) ? $attachment[0] : $site_icon;
        ?>
            <link rel="shortcut icon" type="image/png" href="<?php echo esc_url( $site_fav_icon );?>">
        <?php } else { ?>
            <link rel="shortcut icon" type="image/png" href="<?php echo esc_url( DUSTRIAL_IMG . 'favicon.png' ); ?>">
        <?php
        } 
    }
    wp_head();
    ?>
</head>

<body <?php body_class();?>>
    <?php 
    if( function_exists( 'dustrial_framework_init' ) ) {
        $preloader = dustrial_get_option('dustrial_preloader_enable');
        if (!empty($preloader)) { ?>
            <div id="loader-wrapper">
                <div id="loader">
                    <div id="noTrespassingOuterBarG">
                        <div id="noTrespassingFrontBarG" class="noTrespassingAnimationG">
                            <div class="noTrespassingBarLineG"></div>
                            <div class="noTrespassingBarLineG"></div>
                            <div class="noTrespassingBarLineG"></div>
                            <div class="noTrespassingBarLineG"></div>
                            <div class="noTrespassingBarLineG"></div>
                            <div class="noTrespassingBarLineG"></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php 
        }
    } ?>

    <!-- Start Header -->
    <?php do_action( 'dustrial_header_style' ); ?> 
    <!-- End Header -->