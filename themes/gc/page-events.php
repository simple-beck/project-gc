<?php
/*
 Template Name: Events Page
 *
 * Used for events main view
*/
?>

<?php get_header(); ?>

      <div id="content">

        <div id="inner-content" class="container">

            <main id="main" class="" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

              <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

              <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

                <header class="article-header">
                  <h1 class="page-title"><?php the_title(); ?></h1>
                </header>

                <section class="entry-content cf" itemprop="articleBody">
                  <?php the_content(); ?>
                </section>

                <footer class="article-footer">

                  <?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

                </footer>

              </article>

              <?php endwhile; endif; ?>

            </main>

        </div>

      </div>


<?php get_footer(); ?>
