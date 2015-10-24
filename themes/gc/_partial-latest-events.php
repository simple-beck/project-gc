<?php
  // get all categories for events
  $cats = get_terms('tribe_events_cat', $args);
?>

<!-- set categories colors -->
<style type="text/css" media="screen">
  <?php foreach( $cats as $item ): ?>
    <?php $term_color = get_term_meta( $item->term_id , '_events_category_color', true ) ?>
    
    .tribe-events-category-<?php echo $item->slug; ?> .entry-title, 
    .tribe-events-category-<?php echo $item->slug; ?> .entry-title a,
    .tribe-events-category-<?php echo $item->slug; ?> .event-title,
    .tribe-events-category-<?php echo $item->slug; ?> .event-title a, 
    .tribe-events-category-<?php echo $item->slug; ?> .meta-info label
    {
      color: <?php echo $term_color; ?>;
    }
  <?php endforeach; ?>
</style>

<!-- Events Categories  -->
<ul class="events-categories-list">
  <?php foreach( $cats as $item ): ?>
    <?php $term_color = get_term_meta( $item->term_id , '_events_category_color', true ) ?>
    <li class="item"><i class="ic-block" style="background-color: <?php echo $term_color; ?>"></i><?php echo $item->name; ?></li>
  <?php endforeach; ?>
</ul>

<?php 
  // Retrieve the next 3 upcoming events
  $events = tribe_get_events( array(
    'posts_per_page' => 3,
  ) );
?>

<ul class="latest-events-list">
<?php foreach( $events as $event ): ?>

  <li class="item cf">
    <a href="#" class="link" data-event_id="<?php echo $event->ID; ?>">

      <?php $src = wp_get_attachment_image_src( get_post_thumbnail_id( $event->ID ), 'event-medium' ); ?>
      <img class="bg-image" src="<?php echo $src[0]; ?>" alt="">
      <div class="item-content">
        <div class="date">
          <span class="num"><?php echo tribe_get_start_date( $event, false, 'd' ); ?></span>
          <?php echo tribe_get_start_date( $event, false, 'F' ); ?>
        </div>

        <?php 
          $term_color = get_term_meta( array_pop( tribe_get_event_cat_ids(  $event ) ) , '_events_category_color', true ); 

          $term_color = implode(',', sscanf($term_color, "#%02x%02x%02x")) ;
        ?>
        <div class="title-wrap" style="background-color: rgba(<?php echo $term_color; ?>, .7);" >

          <strong>
            <?php if( tribe_event_is_all_day($event) ): ?>
              All Day
            <?php else: ?>  
              <?php printf('%s - %s', tribe_get_start_time( $event, 'ga' ), tribe_get_end_time( $event, 'ga' ) ); ?>
            <?php endif; ?>
          </strong>
          <br/> <?php echo get_the_title( $event ); ?>
        </div>
      </div>      

    </a>
  </li>

<?php endforeach; ?>
</ul>

