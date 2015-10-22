<?php
/*
 * CUSTOM POST TYPE TEMPLATE
 *
 * This is the custom post type post template. If you edit the post type name, you've got
 * to change the name of this template to reflect that name change.
 *
 * For Example, if your custom post type is "register_post_type( 'bookmarks')",
 * then your single template should be single-bookmarks.php
 *
 * Be aware that you should rename 'custom_cat' and 'custom_tag' to the appropiate custom
 * category and taxonomy slugs, or this template will not finish to load properly.
 *
 * For more info: http://codex.wordpress.org/Post_Type_Templates
*/
?>
<!-- if XHR request -->
<?php if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'): ?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">

			<?php $additional_images = get_post_meta( get_the_id(), '_product_additional_images', true ); ?>

      <?php if( $additional_images ): ?>
	      <div class="images-list-wrap">
	        <ul class="images-list">

	        <?php foreach( $additional_images as $key => $image ): ?>
	          <?php  
	          	$src = wp_get_attachment_image_src( $key, 'product-large' ); 
	          	$thumb_src = wp_get_attachment_image_src( $key, 'product-thumb' ); 
	          ?>
	          <li data-thumb="<?php echo $thumb_src[0]; ?>">
	          	<img src="<?php echo $src[0]; ?>" >
	          </li>
	        <?php endforeach; ?>

	        </ul>
	      </div>
      <?php endif; ?>

      <div class="row">
      	<div class="col-sm-6">
					<h1 class="single-title product-title"><?php the_title(); ?></h1>
					<?php $price = get_post_meta( get_the_id(), '_product_price', true ); ?>
					<?php if( $price ): ?>
						<div class="product-price"><?php printf( '$%s', get_post_meta( get_the_id(), '_product_price', true )); ?></div>
					<?php endif; ?>

      	</div>

      	<div class="col-sm-6">
					<section class="entry-content">
						<?php echo apply_filters('the_content', get_post_meta( get_the_id(), '_product_short_info', true ) );?>
					</section> <!-- end article section -->
      	</div>

      </div>

		</article>

		<?php endwhile;  endif; ?>



	<?php die(); ?>
<!-- else if normal request -->
<?php else: ?>

	<?php get_header(); ?>

				<div id="content">

					<div id="inner-content" class="container">

							<main id="main" class="" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

								<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">

									<?php $additional_images = get_post_meta( get_the_id(), '_product_additional_images', true ); ?>
						      
						      <?php if( $additional_images ): ?>
						      <div  style="width:600px;">
						        <ul class="images-list">

						        <?php foreach( $additional_images as $key => $image ): ?>
						          <?php  
						          	$src = wp_get_attachment_image_src( $key, 'product-large' ); 
						          	$thumb_src = wp_get_attachment_image_src( $key, 'product-thumb' ); 
						          ?>
						          <li data-thumb="<?php echo $thumb_src[0]; ?>">
						          	<img src="<?php echo $src[0]; ?>" >
						          </li>
						        <?php endforeach; ?>

						        </ul>
						      </div>

						      <?php endif; ?>

									<header class="article-header">

										<h1 class="single-title custom-post-type-title"><?php the_title(); ?></h1>

									</header>

									<section class="entry-content">
										<?php the_content();?>
									</section> <!-- end article section -->

									<footer class="article-footer">
									</footer>

								</article>

								<?php endwhile;  endif; ?>

							</main>

					</div>

				</div>
		<?php wp_enqueue_script( 'lightslider' ); ?>
		<script type="text/javascript">
		jQuery(document).ready(function($){

		   $('.images-list').lightSlider({
		      gallery:true,
		      item:1,
		      vertical:true,
		      verticalHeight:500,
		      vThumbWidth:170,
		      vThumbHeight:170,
		      thumbItem:3,
		      thumbMargin:4,
		      slideMargin:0
		   });

		});
		</script>

	<?php get_footer(); ?>


<?php endif; ?>
