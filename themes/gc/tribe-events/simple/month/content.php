<?php
/**
 * Month View Content Template
 * The content template for the month view of events. This template is also used for
 * the response that is returned on month view ajax requests.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/month/content.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<div id="tribe-events-content" class="tribe-events-month">

	<!-- Notices -->
	<?php tribe_events_the_notices() ?>

	<!-- Month Header -->
	<?php do_action( 'tribe_events_before_header' ) ?>
	<div class="row tribe-events-header" id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>

		<div class="col-sm-3"></div>
		<div class="col-sm-6"><h3 class="month-title"><?php echo tribe_get_current_month_text(); ?></h3></div>
		<div class="col-sm-3"></div>

		<!-- Header Navigation -->
		<?php tribe_get_template_part( 'simple/month/nav' ); ?>

	</div>
	<!-- #tribe-events-header -->
	<?php do_action( 'tribe_events_after_header' ) ?>

	<!-- Month Grid -->
	<?php tribe_get_template_part( 'month/loop', 'grid' ) ?>

	<!-- Month Footer -->
	<?php do_action( 'tribe_events_before_footer' ) ?>
	
	<div id="tribe-events-footer">

		<!-- Footer Navigation -->
		<?php do_action( 'tribe_events_before_footer_nav' ); ?>
		<?php do_action( 'tribe_events_after_footer_nav' ); ?>

	</div>
	<!-- #tribe-events-footer -->
	<?php do_action( 'tribe_events_after_footer' ) ?>

	<?php tribe_get_template_part( 'month/mobile' ); ?>
	<?php tribe_get_template_part( 'month/tooltip' ); ?>

</div><!-- #tribe-events-content -->
