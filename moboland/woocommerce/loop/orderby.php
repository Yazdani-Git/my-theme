<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>

<div class="desktop-moboland">
    <form class="woocommerce-ordering" method="get">
        <ul class="catalog-list">
            <i class="fa-solid fa-chart-column"></i>
            <span>مرتب سازی بر اساس : </span>
            <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
                <?php
                $link = remove_query_arg( 'orderby' );
                $link = add_query_arg( array( 'orderby' => $id ), $link );
                $name = str_replace( 'Sort by ', '', esc_html( $name ) );
                $name = str_replace( 'Sort', '', esc_html( $name ) );
                $name = str_replace( '', '', esc_html( $name ) );
                $link = add_query_arg( array( 'orderby' => $id ), $link );
                $name = str_replace( 'سازی', '', esc_html( $name ) );
                $name = str_replace( 'بر', '', esc_html( $name ) );
                $name = str_replace( 'اساس', '', esc_html( $name ) );
                $name = str_replace( 'مرتب', '', esc_html( $name ) );
                $name = str_replace( '', '', esc_html( $name ) );
                ?>
                <li class="list-inline-item <?php echo $orderby == $id ? 'active' : ''; ?>">
                    <a href="<?php echo $link; ?>" class="<?php echo $orderby == $id ? 'active' : ''; ?>" rel="nofollow"><?php echo $name; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>

        </select>
        <input type="hidden" name="paged" value="1" />
        <?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
    </form>
</div>

<div class="mobile-moboland">
    <form class="woocommerce-ordering" method="get">
        <select name="orderby" class="orderby" aria-label="<?php esc_attr_e( 'Shop order', 'woocommerce' ); ?>">
            <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
                <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
            <?php endforeach; ?>
        </select>
        <input type="hidden" name="paged" value="1" />
        <?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
    </form>
</div>

<div class="mobile-moboland filter-shop-page">
    <i class="fa-solid fa-sliders"></i>
    <span>فیلترهای محصولات</span>
</div>
