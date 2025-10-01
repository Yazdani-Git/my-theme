<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$priotech_options = get_option('priotech_options');
$sms_login_enabled = isset($priotech_options['login_system_select']) && $priotech_options['login_system_select'] === 'sms';

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( $sms_login_enabled && !is_user_logged_in() ) : ?>

    <div class="sms-login-form-page" id="customer_login">
        <div class="u-columns col2-set">
            <div class="u-column1 col-1">
                <h2><?php esc_html_e( 'Login / Register', 'priotech' ); ?></h2>
                <div class="sms-login-form">
                    <div id="sms-step-1">
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="sms-mobile-input"><?php esc_html_e( 'Please enter your mobile number', 'priotech' ); ?></label>
                            <input type="tel" class="input-text" id="sms-mobile-input" placeholder="<?php esc_attr_e( 'e.g., 09123456789', 'priotech' ); ?>">
                        </p>
                        <p class="form-row">
                            <button type="button" id="send-otp-button" class="woocommerce-button button"><?php esc_html_e( 'Send Verification Code', 'priotech' ); ?></button>
                        </p>
                    </div>

                    <div id="sms-step-2" style="display: none;">
                         <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="sms-otp-input"><?php esc_html_e( 'Enter the verification code sent to', 'priotech' ); ?> <span id="entered-mobile"></span></label>
                            <input type="text" class="input-text" id="sms-otp-input" placeholder="<?php esc_attr_e( 'Verification Code', 'priotech' ); ?>">
                        </p>
                        <p class="form-row">
                            <button type="button" id="verify-otp-button" class="woocommerce-button button"><?php esc_html_e( 'Login', 'priotech' ); ?></button>
                        </p>
                        <p id="otp-timer" style="display: none;"><?php esc_html_e( 'Resend code in', 'priotech' ); ?> <span id="countdown-timer">60</span> <?php esc_html_e( 'seconds', 'priotech' ); ?></p>
                        <button id="resend-otp-button" class="button" style="display: none;"><?php esc_html_e( 'Resend Code', 'priotech' ); ?></button>
                    </div>

                    <div id="sms-login-messages" class="sms-login-messages woocommerce-error" style="display: none;"></div>
                </div>
            </div>
        </div>
    </div>

<?php else : ?>

	<div class="u-columns col2-set" id="customer_login">

		<div class="u-column1 col-1">

<?php endif; ?>


<?php if ( ! $sms_login_enabled ) : ?>

			<h2><?php esc_html_e( 'Login', 'woocommerce' ); ?></h2>

			<form class="woocommerce-form woocommerce-form-login login" method="post">

				<?php do_action( 'woocommerce_login_form_start' ); ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
				</p>

				<?php do_action( 'woocommerce_login_form' ); ?>

				<p class="form-row">
					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
						<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
					</label>
					<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
					<button type="submit" class="woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
				</p>
				<p class="woocommerce-LostPassword lost_password">
					<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
				</p>

				<?php do_action( 'woocommerce_login_form_end' ); ?>

			</form>

		</div>

		<div class="u-column2 col-2">

			<h2><?php esc_html_e( 'Register', 'woocommerce' ); ?></h2>

			<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

				<?php do_action( 'woocommerce_register_form_start' ); ?>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
					</p>

				<?php endif; ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
						<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
					</p>

				<?php else : ?>

					<p><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'woocommerce' ); ?></p>

				<?php endif; ?>

				<?php do_action( 'woocommerce_register_form' ); ?>

				<p class="woocommerce-form-row form-row">
					<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
					<button type="submit" class="woocommerce-button button woocommerce-form-register__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
				</p>

				<?php do_action( 'woocommerce_register_form_end' ); ?>

			</form>

		</div>

	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>