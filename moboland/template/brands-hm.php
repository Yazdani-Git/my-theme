<section class="main-brand">
    <div class="container">
        <div class="title-brand">
            <h4>محبوب ترین برندها</h4>
        </div>
        <div class="box-brand">
            <div class="inner-brand">
                <div class="owl-carousel owl-theme brand-slider">

                    <?php
                   $term_brand = get_terms(
                            array(
                                    'taxonomy' => 'product_brand' ,
                                'hide_empty' => false ,

                            )
                   );

                   foreach ($term_brand as $brand){

                    ?>

                    <div class="item brand-item">
                        <figure>
                            <a href="<?php echo get_term_link($brand->term_id) ?>">
                              <?php
                             $attach_id = get_term_meta($brand->term_id, 'brand_thumbnail' , 1);
                              echo wp_get_attachment_image($attach_id , 'full');
                              ?>
                            </a>
                        </figure>
                    </div>

                    <?php } ?>


                </div>
            </div>
        </div>
    </div>
</section>