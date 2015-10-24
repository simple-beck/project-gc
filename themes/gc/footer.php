			<footer id="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

				<div id="inner-footer" class="container">
          <?php $section = get_simple_post('footer-info'); ?>
          <?php echo get_vc_custom_css( $section->ID ); ?>

          <?php echo apply_filters( 'the_content', $section->post_content ); ?>
          <?php echo bones_get_edit_link( $section->ID ); ?>
				</div>

			</footer>

		</div>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>
    <div style="display:none;">
      <div id="loaded-event-placeholder"></div>
    </div>

	</body>

</html> <!-- end of site. what a ride! -->
