<?php if( function_exists( 'dustrial_framework_init' ) ) {
  $newsletter_shortcode = dustrial_get_option('footer_newsletter_shortcode');
  if( !empty( $newsletter_shortcode ) ) {
  ?>
    <!-- Subscription Section -->
    <div class="subscription">
      <div class="container">
        <div class="row align-items-center d-flex">
          <?php
            $bg_img_id = dustrial_get_option('footer_logo');
            if( !empty( $bg_img_id ) ) {
              $attachment = wp_get_attachment_image_src( $bg_img_id, 'full' );
              $bg_img    = ($attachment) ? $attachment[0] : $bg_img_id;
            } else {
              $bg_img = DUSTRIAL_IMG . 'logo-2.png';
            }
          ?>
          
          <div class="col-lg-3">
            <div class="block mb-4 mb-md-0">
              <a href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo esc_url( $bg_img ); ?>" alt="<?php esc_attr_e('Newsletter Logo', 'dustrial') ?>">
              </a>
            </div>
          </div>

          <div class="col-lg-9">
            <div class="block">
              <?php echo do_shortcode($newsletter_shortcode); ?>
            </div>
          </div>

        </div>
      </div>
    </div>
    <!-- End Subscription Section -->

  <?php }
} ?>

<?php if ( is_active_sidebar( 'footer-widgets') || is_active_sidebar( 'footer-widgets2') || is_active_sidebar( 'footer-widgets3') || is_active_sidebar( 'footer-widgets4') ) { 

  if( function_exists( 'dustrial_framework_init' ) ) {
    $footer_widget_cols = dustrial_get_option('footer_widget_cols');
    if (!empty($footer_widget_cols)) {
      $fw1 = $footer_widget_cols;
    } else {
      $fw1 = '2';
    }
    if (!empty($footer_widget_cols)) {
      $fw2 = $footer_widget_cols;
    } else {
      $fw2 = '3';
    }
    if (!empty($footer_widget_cols)) {
      $fw4 = $footer_widget_cols;
    } else {
      $fw4 = '4';
    }
  } else {
    $fw1 = '2';
    $fw2 = '3';
    $fw4 = '4';
  }

?>

  <!-- Start Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-<?php echo esc_attr($fw1); ?> col-md-6">
          <?php dynamic_sidebar( 'footer-widgets' ); ?>
        </div>
        <div class="col-lg-<?php echo esc_attr($fw2); ?> col-md-6">
          <?php dynamic_sidebar( 'footer-widgets2' ); ?>
        </div>
        <div class="col-lg-<?php echo esc_attr($fw2); ?> col-md-6">
          <?php dynamic_sidebar( 'footer-widgets3' ); ?>
        </div>
        <div class="col-lg-<?php echo esc_attr($fw4); ?> col-md-6">
          <?php dynamic_sidebar( 'footer-widgets4' ); ?>
        </div>
      </div>
    </div>
  </footer>
  <!-- End Footer -->

  <?php } ?>

  <!-- CopyRight Section -->
  <div class="copyright">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="copyright-content">
            <p>
              <?php if ( function_exists( 'dustrial_framework_init' )) { ?>
                <?php echo wp_kses_stripslashes( dustrial_get_option('copyright_text') ); ?>
              <?php } else { ?>
                <?php esc_html_e( '&copy; Copyright 2019 by - Dustrial', 'dustrial' ); ?>
              <?php } ?>
            </p>
          </div>
        </div>
        <?php
        if( function_exists( 'dustrial_framework_init' ) ) {

          $footer_social_btn_target_blank = dustrial_get_option('footer_social_btn_target_blank');

          if  ( $footer_social_btn_target_blank == 1 ) {
            $target = '_blank';
          } else {
            $target = '_self';
          }

          // var_dump($target);

          $footer_social_btn = dustrial_get_option('footer_social_btn');
          if (is_array($footer_social_btn)) {
          ?>
            <div class="col-md-6">
              <div class="block social-media d-flex justify-content-center  justify-content-md-end">
                <?php foreach ($footer_social_btn as $key => $value) {
                    $icon = $value['social_icon'];
                    $a = explode(' ',$icon);
                    $b = explode('-',$icon);
                  ?>
                  <a class="ct-<?php echo esc_attr($b[1]); ?> d-flex justify-content-center align-items-center" href="<?php echo esc_url( $value['social_link'] ); ?>" target="<?php echo esc_attr( $target ); ?>"><i class="<?php echo esc_attr( $value['social_icon'] ); ?>" aria-hidden="true"></i></a>
                <?php } ?>
              </div>
            </div>
            <?php
          }
        } ?>
      </div>
    </div>
  </div>
  <!-- End CopyRight Section -->