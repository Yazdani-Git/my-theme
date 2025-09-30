<?php
defined('ABSPATH') || exit ("no access");
if( empty($this->e9dce80b4b6b660680beadda30ec) ): ?>
    <div class="notice notice-error">
        <?php if (version_compare(PHP_VERSION, '7.0.0') >= 0):?>
        <p>
            <?php printf(esc_html__( 'To activating %s, please insert your license key', 'guard-gn-a583da5bbf9442be6d9bba371303e' ), esc_html__($this->f86130c45aef913253a519b2ef, 'guard-gn-a583da5bbf9442be6d9bba371303e')); ?>
            <a href="<?php echo admin_url( 'admin.php?page='.$this->fbba0d901693de27e3555949cce4da ); ?>" class="button button-primary"><?php _e('Active License', 'guard-gn-a583da5bbf9442be6d9bba371303e'); ?></a>
        </p>
        <?php else:?>
            <p>
                <?php printf(esc_html__( 'The PHP version of the website is lower than 7.0. Ask your host administrator to upgrade PHP version to activate %s. ', 'guard-gn-a583da5bbf9442be6d9bba371303e' ), esc_html__($this->f86130c45aef913253a519b2ef, 'guard-gn-a583da5bbf9442be6d9bba371303e')); ?>
            </p>
    <?php endif; ?>
    </div>
<?php elseif( $this->c144031b6e9016470eef529ae2e45d===true ): ?>
    <div class="notice notice-error">
        <p>
            <?php printf(esc_html__( 'Something is wrong with your %s license. Please check it.', 'guard-gn-a583da5bbf9442be6d9bba371303e' ), esc_html__($this->f86130c45aef913253a519b2ef, 'guard-gn-a583da5bbf9442be6d9bba371303e')); ?>
            <a href="<?php echo admin_url( 'admin.php?page='.$this->fbba0d901693de27e3555949cce4da ); ?>" class="button button-primary"><?php _e('Check Now', 'guard-gn-a583da5bbf9442be6d9bba371303e'); ?></a>
        </p>
    </div>
<?php endif; ?>