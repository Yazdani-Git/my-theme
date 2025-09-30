<?php
/**
 *
 * @category  PLugins
 * @package   Wordpress
 * @author    IPdev.ir
 * @copyright 2022 The Ideh Pardazan (ipe.ir). All rights reserved.
 * @license   https://sms.ir/ ipe license
 * @version   IPE: 1.0.19
 * @link      https://app.sms.ir

 */

if (!function_exists('is_admin')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}
date_default_timezone_set('Asia/Tehran');

require_once dirname(__FILE__) . "/../SMSIRAppClass.php";


wp_enqueue_style('smsIr', get_template_directory_uri() . '/include/SMSIRApp/includes/templates/assets/css/smsir.css', true, 103);
wp_enqueue_style('dataTable', get_template_directory_uri() . '/include/SMSIRApp/includes/templates/assets/css/jquery.dataTables.min.css', true, 103);
wp_enqueue_script('smsIr', get_template_directory_uri() . '/include/SMSIRApp/includes/templates/assets/js/smsir.js', true, 103);
wp_enqueue_script('dataTable', get_template_directory_uri() . '/include/SMSIRApp/includes/templates/assets/js/jquery.dataTables.min.js', true, 103);

$inventory_data = SMSIRAppClass::getInventoryLog();
?>

<div class="sms-ir-header-div">
	<h1>
		<img width="100px" src="<?= get_template_directory_uri() . '/include/SMSIRApp/includes/templates/assets/img/logo.png' ?>">
		لیست موجود شد خبرم کن
	</h1>
</div>

<div class="row sms-ir-main-div sms-ir-list-div" id="smsIrTabContent">
	<p>لیست زیر نمایش دهنده اطلاعات تمامی کاربرانی است که در فرم "موجود شد خبرم کن" ثبت نام کرده اند.</p>
	<hr>
	<div class="table-responsive">
		<table id="dataTable" class="table table-bordered table-hover">
			<thead>
			<tr>
                <th>ردیف</th>
				<th>شناسه</th>
                <th>
                    <object data="<?= get_template_directory_uri() ?>include/SMSIRApp/includes/templates/assets/img/svg/info.svg"></object>
                    شناسه محصول
                    <p style="display: none">شما میتوانید با کلیک بر روی شناسه محصول جزئیات محصول را مشاهده نمایید.</p>
                </th>
                <th>
                    <object data="<?= get_template_directory_uri() ?>include/SMSIRApp/includes/templates/assets/img/svg/info.svg"></object>
                    نام محصول
                    <p style="display: none">شما میتوانید با کلیک بر روی نام محصول جزئیات محصول را مشاهده نمایید.</p>
                </th>				<th>نام کاربر</th>
				<th>شماره کاربر</th>
			</tr>
			</thead>
			<tbody>
			<?php
            $i = 0;
                foreach ($inventory_data as $item) { ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $item->id ?></td>
                        <td><?= $item->ID ?></td>
                        <td><?= $item->post_title ?></td>
                        <td><?= $item->name ?></td>
                        <td><?= $item->mobile ?></td>
                    </tr>
			<?php
                    $i++;
                }
            ?>
			</tbody>
			<tfoot>
			<tr>
                <th>ردیف</th>
				<th>شناسه</th>
				<th>شناسه محصول</th>
				<th>نام محصول</th>
				<th>نام کاربر</th>
				<th>شماره کاربر</th>
			</tr>
			</tfoot>
		</table>
	</div>
</div>
