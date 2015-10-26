
<!-- Bar -->
<?php

$filters = tribe_events_get_filters();
$views   = tribe_events_get_views();

$current_url = tribe_events_get_current_filter_url();
?>
<?php 
  wp_enqueue_script( 'bootstrap-datepicker', get_stylesheet_directory_uri() . '/library/js/libs/bootstrap-datepicker.min.js' ); 
?>

<div class="events-nav-bar">

  <form id="tribe-bar-form" class="tribe-clearfix" name="tribe-bar-form" method="post" action="<?php echo esc_attr( $current_url ); ?>">
    
    <?php if ( ! empty( $filters ) ) { ?>
      <div class="tribe-bar-filters">
        <div class="tribe-bar-filters-inner tribe-clearfix">
          <?php foreach ( $filters as $filter ) : ?>
            <div class="<?php echo esc_attr( $filter['name'] ) ?>-filter">
              <label class="label-<?php echo esc_attr( $filter['name'] ) ?>" for="<?php echo esc_attr( $filter['name'] ) ?>"><?php echo $filter['caption'] ?></label>
              <?php echo $filter['html'] ?>
            </div>
          <?php endforeach; ?>
          <div class="tribe-bar-submit">
            <input class="tribe-events-button tribe-no-param" type="submit" name="submit-bar" value="<?php echo esc_attr( sprintf( __( 'Find %s', 'tribe-events-calendar' ), tribe_get_event_label_plural() ) ); ?>" />
          </div>
          <!-- .tribe-bar-submit -->
        </div>
        <!-- .tribe-bar-filters-inner -->
      </div><!-- .tribe-bar-filters -->
    <?php } // if ( !empty( $filters ) ) ?>

  </form>
</div>


<div class="events-content-wrap">
  <?php tribe_show_month(); ?>
</div>

<?php wp_enqueue_script( 'fancybox' ); ?>

<script type="text/javascript">

jQuery(document).ready(function($){

  // events object with functions
  app.events = {

    load_month: function( eventDate, callback ){

      var data = {
        "action": 'tribe_calendar',
        "eventDate": eventDate,
        "tribe-bar-date": eventDate
      };
      url = "/wp-admin/admin-ajax.php";

      $.ajax({
          type: "POST",
          url: url,
          data: data,
          dataType: "json",
          success: function(data) {            
              // insert into content area
              $('.events-content-wrap').html( data.html );
              if(callback.onSuccess) {
                callback.onSuccess();
              }
          },
          error: function() {
              //
          }
      });

    },

    load_single_event: function(event_id){
      
      var data = {
        "action": 'get_single_event',
        "event_id": event_id
      };
      url = "/wp-admin/admin-ajax.php";

      $.ajax({
          type: "POST",
          url: url,
          data: data,
          dataType: "json",
          success: function(data) {
              console.log(data);
              // insert into content area
              $('#loaded-event-placeholder').html( data.html );

              // open fancybox
              $.fancybox({
                 'href' : '#loaded-event-placeholder',
                  maxWidth  : 850,
                  maxHeight  : 400,
                  fitToView : false,
                  width   : '80%',
                  // height    : '90%',
                  autoSize  : false,
                  closeClick  : false,
                  openEffect  : 'none',
                  closeEffect : 'none',             
              });
          },
          error: function() {
              //
          }
      });

    },

    set_loading : function( is_loading ){
      app.events.is_loading = is_loading;
      if( is_loading ){
        $('.events-content-wrap').addClass('is_loading');
      } else {
        $('.events-content-wrap').removeClass('is_loading');
      }

    }
  }

  // handle next month click
  $('.tribe-events-nav-next a').live('click', function(e){
    e.preventDefault();

    // set loading
    app.events.set_loading(true);

    // load next month
    app.events.load_month( $(this).attr('data-month'), {
      onSuccess : function(){
        app.events.set_loading(false);
      }
    });
  });

  // handle prev month click
  $('.tribe-events-nav-previous a').live('click', function(e){
    e.preventDefault();

    // set loading
    app.events.set_loading(true);

    // load next month
    app.events.load_month( $(this).attr('data-month'), {
      onSuccess : function(){
        app.events.set_loading(false);
      }
    });
    
  });

  // Click on single even in Calendar
  $('.tribe-events-calendar .hentry').live('click', function(e){
    e.preventDefault();

    $event_data = $(this).data('tribejson');

    app.events.load_single_event( $event_data.eventId );

  });
  
  // Click on single even in Calendar
  $('.latest-events-list .item .item-link').on('click', function(e){
    e.preventDefault();

    app.events.load_single_event( $(this).data('event_id') );

  });

  // handle datepicker
  $tribe_datepicker = $('#tribe-bar-date').datepicker({
    startView: 'year'
  });

  $tribe_datepicker.on('changeMonth', function(e){
    console.log( e.date );
  });


});
</script>
