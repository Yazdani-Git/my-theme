<div id="modal_video" class="modal">
    <!-- Modal content -->
    <div class="modal-content">

        <div class="modal-header">
            <i class="fas fa-xmark close_video"></i>
            <h4>ویدیو محصول</h4>
        </div>
        <div class="modal-body">
            <video controls>
                <source src="<?php the_field('product_video'); ?>" type="video/mp4">
            </video>
        </div>


    </div>
</div>
<div id="modal_share" class="modal">
    <!-- Modal content -->
    <div class="modal-content">

        <div class="modal-header">
            <i class="fas fa-xmark close_share"></i>
            <h4>اشتراک گذاری محصول</h4>
        </div>
        <div class="modal-body modal-shar">
            <div class="short-link">
               <span>
                   <i class="fa-solid fa-link"></i>
               لینک کوتاه محصول
               </span>
                <textarea readonly>
                    <?php
                    global $product;
                    echo home_url() . "/?p=" . $product->id ;
                    ?>
                </textarea>
            </div>
            <div class="social-sharing">
                <p>این پست را به اشتراک بگذارید</p>
                <div class="box-sharing">
                    <a href="https://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" target="_blank" class="facebook">
                        <i class="fa-brands fa-facebook-square"></i>
                    </a>
                    <a href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php $url = wp_get_attachment_url( get_post_thumbnail_id($product->id) ); echo $url; ?>" target="_blank" class="pinterest">
                        <i class="fa-brands fa-pinterest-square"></i>
                    </a>
                    <a href="https://t.me/share/url?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" target="_blank" class="telegram">
                        <i class="fa-brands fa-telegram"></i>
                    </a>
                    <a href="https://whatsapp://send?text=<?php the_permalink(); ?>" target="_blank" class="whatsapp">
                        <i class="fa-brands fa-whatsapp-square"></i>
                    </a>
                </div>
            </div>
        </div>


    </div>
</div>



<div class="product-action">
    <div class="item-action">
        <button class="woocommerce-product-gallery__trigger">
            <i class="fa-brands fa-sistrix"></i>
            <span>بزرگنمایی محصول</span>
        </button>
    </div>
    <div class="item-action">
        <?php $idpro = $product->id ?>
        <?php echo do_shortcode("[woosw id=$idpro]");  ?>
    </div>
    <div class="item-action" id="btn_modal_share">
        <button>
            <i class="fa-solid fa-share-alt"></i>
            <span>اشتراک گذاری محصول</span>
        </button>
    </div>

    <?php if (get_field('product_video')) { ?>
        <div class="item-action" id="btn_modal_video">
            <button>
                <i class="fa-regular fa-circle-play"></i>
                <span>ویدیو محصول</span>
            </button>
        </div>
    <?php } ?>
    <div class="item-action">
        <?php echo do_shortcode('[compare_button id="' . get_the_ID() . '"]'); ?>
    </div>


</div>