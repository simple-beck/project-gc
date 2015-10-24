<?php $event_id = $event->ID; ?>
<div class="single-event-popup <?php echo tribe_events_event_classes( $event_id ); ?>">
    <div class="col-sm-4">
      <?php echo tribe_event_featured_image( $event_id, 'event-popup', false ); ?>
    </div>
    <div class="col-sm-8">
      
      <h2 class="event-title"><?php echo $event->post_title; ?></h2>
      <?php echo apply_filters( 'the_content', $event->post_content ); ?>

      <ul class="meta-info">
        <li><label>What:</label> <?php echo $event->post_title; ?></li>
        <li><label>Whare:</label> <?php echo tribe_events_event_schedule_details( $event_id ); ?></li>

        <?php if ( tribe_address_exists( $event_id ) ) : ?>
          <li><label>Where:</label> <?php echo tribe_get_full_address( $event_id ); ?></li>
        <?php endif; ?>

        <li><label>Cost:</label> <?php echo get_post_meta( $event_id, '_ecp_custom_2', true ); ?></li>
        
        <?php if ( tribe_has_organizer( $event_id ) ): ?>
          <li><label>Info:</label> <a href="mailto:<?php echo tribe_get_organizer_email( $event_id ); ?>"><?php echo tribe_get_organizer_email( $event_id ); ?></a></li>
        <?php endif; ?>
  
        <li><label>Register:</label> <?php echo get_post_meta( $event_id, '_ecp_custom_5', true ); ?></li>
      </ul>

      <?php echo bones_get_edit_link( $event_id ); ?>

    </div>
</div>
