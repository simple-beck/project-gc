<?php $the_query= new WP_Query("post_type=product&orderby=menu_order&order=DESC&posts_per_page=4"); ?>
<?php if($the_query->have_posts()):?>

  <ul class="product-list">
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <?php  $src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'product-thumb' ); ?>

    <li class="item">
      <a href="<?php the_permalink() ?>" class="fancybox fancybox.ajax">
        <img class="featured-image" src="<?php echo $src[0]; ?>" alt="">

        <h3 class="item-title">
          <?php if( get_post_meta(get_the_id(), '_product_price', true) ): ?>
            <?php printf('%s: $%s', get_the_title(), get_post_meta(get_the_id(), '_product_price', true) ); ?>
          <?php else: ?>
          <?php the_title(); ?>
          <?php endif; ?>
        </h3>
        <?php echo bones_get_edit_link( get_the_id() ); ?>
      </a>
    </li>

    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
  </ul>

<?php endif; ?>
<?php wp_enqueue_script( 'fancybox' ); ?>
<?php wp_enqueue_script( 'lightslider' ); ?>
<script type="text/javascript">
jQuery(document).ready(function($){
 
  $(".product-list .item a").fancybox({
    beforeShow: function( current, previous ){
      console.log( 'google' );
       $('.images-list').lightSlider({
          gallery:true,
          item:1,
          vertical:true,
          verticalHeight:500,
          vThumbWidth:170,
          vThumbHeight:170,
          thumbItem:3,
          thumbMargin:4,
          slideMargin:0,
          controls: 0,
       });
    },    
    maxWidth  : 850,
    // maxHeight : 600,
    fitToView : false,
    width   : '80%',
    height    : '90%',
    autoSize  : false,
    closeClick  : false,
    padding  : 0,
    openEffect  : 'none',
    closeEffect : 'none',
  });

});
</script>
