<?php defined('ABSPATH') || exit ("no access");  ?>
<style>
	<?php include __DIR__.'/assets/style.css' ?>
</style>
<div class="license-input">
    <script>
        var zhaket_guard=<?php echo json_encode(array(
                                                    'ajax_url' => admin_url('admin-ajax.php'),
                                                    'confirm_msg' => esc_html__('Are you sure?', 'guard-gn-a583da5bbf9442be6d9bba371303e'),
                                                    'wrong_license_message' => esc_html__('Something goes wrong, please try again.', 'guard-gn-a583da5bbf9442be6d9bba371303e'),
                                                    'this_slug' => $this->fbba0d901693de27e3555949cce4da,
                                                    'view_problem_console_log' => esc_html__('Something is wrong, please check the console log for details',
                                                                                             'guard-gn-a583da5bbf9442be6d9bba371303e'),
                                                    'please_add_valid_license' => esc_html__('License key is not valid, Please enter valid license key.',
                                                                                             'guard-gn-a583da5bbf9442be6d9bba371303e'),
                                                    'nonce' => wp_create_nonce('guard-gn-a583da5bbf9442be6d9bba371303e'),
                                                )) ?>
    </script>
    <script>
        <?php include __DIR__.'/assets/script.js' ?>
    </script>
    <h1> <?php printf(esc_html__('%s Activation', 'guard-gn-a583da5bbf9442be6d9bba371303e'), esc_html__($this->f86130c45aef913253a519b2ef, 'guard-gn-a583da5bbf9442be6d9bba371303e')); ?></h1>
    <?php if ($this->e9dce80b4b6b660680beadda30ec): ?>
        <h3><?php esc_html_e('Your activation key:', 'guard-gn-a583da5bbf9442be6d9bba371303e') ?></h3>
        <code id="code-style"><?php echo $this->ee19fa6b7048e60c04adc086b() ?></code>
        <div class="text-left">
            <span id="recheck-license" onclick="recheck_licence(this)"><?php esc_html_e('Recheck license', 'guard-gn-a583da5bbf9442be6d9bba371303e') ?></span>
            <span id="remove-license" onclick="remove_licence(this)"><?php esc_html_e('Remove / Change key', 'guard-gn-a583da5bbf9442be6d9bba371303e') ?></span>
        </div>
        <div id="license-message" style="display: flex; <?php echo ($this->c144031b6e9016470eef529ae2e45d===true)? 'background:red;':''?>">
            <div class="result" style=""><?php echo $this->e807f756ee9cdd029f('last_message'); ?></div>
        </div>
		<?php if($this->c144031b6e9016470eef529ae2e45d===true): ?>
			<div id="license-warning" style="display: flex; background:#90e5ff; color:black">
				<div><?php esc_html_e('Your license is active but need to revalidate. if has error on revalidate you can test after 24 hours.',
									  'guard-gn-a583da5bbf9442be6d9bba371303e') ?></div>
			</div>
		<?php endif; ?>
        <!-- /#license-message -->
    <?php else: ?>
        <h3><?php esc_html_e('Enter your activation key:', 'guard-gn-a583da5bbf9442be6d9bba371303e') ?></h3>
        <input id="license-input" type="text" value="">
        <div class="text-left">
                    <span id="install-license" onclick="install_licence(this)"><?php esc_html_e('Activate',
                                                                                                'guard-gn-a583da5bbf9442be6d9bba371303e') ?></span>
        </div>
        <div id="license-message">
        </div>
    <?php endif; ?>

    <!-- /#license-message -->
    <div id="license-help">
        <strong><?php esc_html_e('Manual:', 'guard-gn-a583da5bbf9442be6d9bba371303e') ?></strong>
        <ul>
            <?php if ($this->e9dce80b4b6b660680beadda30ec): ?>
                <li>
                    <?php esc_html_e('Your key is used on this website, and it is not possible to use on another website.',
                                     'guard-gn-a583da5bbf9442be6d9bba371303e') ?>
                </li>
                <li>
                    <?php esc_html_e('If you want to transfer a license to another domain, click on the "Remove / Change key", after that login to your account of zhaket.com and go to the download section and click on change domain button. Enter your new domain name and use the license key on your desired domain.',
                                     'guard-gn-a583da5bbf9442be6d9bba371303e') ?>
                </li>
            <?php else: ?>
                <li>
                    <?php esc_html_e('To use the product, you should enter the license key, to find your license key, login to your account of zhaket.com and go to downloads section, after than select product and copy your license key or click on create license button and copy your license key.',
                                     'guard-gn-a583da5bbf9442be6d9bba371303e') ?>
                </li>
                <li>
                    <?php esc_html_e('Each license can be activated only for one website', 'guard-gn-a583da5bbf9442be6d9bba371303e') ?>
                </li>
                <li>
                    <?php esc_html_e('If your license is activated on another domain, first click on the "Remove / Change key" on the old website, then login to your account of zhaket.com and go to the download section and click on the change domain button, enter your website domain name and use the license key to activate.',
                                     'guard-gn-a583da5bbf9442be6d9bba371303e') ?>
                </li>
            <?php endif; ?>
        </ul>
        <?php
        if ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) {
            echo '<hr>';
            echo sprintf( esc_html__( 'The %s constant is set to true. WP-Cron spawning is disabled.', 'guard-gn-a583da5bbf9442be6d9bba371303e' ), 'DISABLE_WP_CRON' );
        }
        if ( defined( 'ALTERNATE_WP_CRON' ) && ALTERNATE_WP_CRON ) {
            echo '<hr>';
            echo sprintf( esc_html__( 'The %s constant is set to true.', 'guard-gn-a583da5bbf9442be6d9bba371303e' ), 'ALTERNATE_WP_CRON'
            );
        }

        ?>
        <hr>
        <span style="display: block;direction: ltr;text-align:left;font-size: 10px">version:3.1</span>
    </div>


</div>