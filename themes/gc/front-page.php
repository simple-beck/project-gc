<?php get_header(); ?>

      <div id="content">

         <div id="inner-content" class="container">
            <div class="row">

              <main id="main" class="col-sm-9" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

                  <section class="entry-content cf" itemprop="articleBody">
                    <?php the_content(); ?>
                  </section> <?php // end article section ?>

                  <footer class="article-footer">
                    <?php echo bones_get_edit_link( get_the_id() ); ?>
                  </footer>

                </article>

                <?php endwhile; endif; ?>

              </main>

              <div class="col-sm-3">
                <?php $section = get_simple_post('home-side'); ?>
                <section class="section-home-side">
                  <?php echo get_vc_custom_css( $section->ID ); ?>
                  <?php echo apply_filters( 'the_content', $section->post_content ); ?>
                  <?php echo bones_get_edit_link( $section->ID ); ?>
                </section>
              </div>

            </div>

        </div>

        
        <section id="section-events-calendar" class="page-section section-events-calendar">
          <div class="container">
            
            <div class="row">
              <div class="col-sm-8 col-md-9">
                <?php $section = get_simple_post('events-calendar'); ?>
                <?php echo get_vc_custom_css( $section->ID ); ?>
                <?php echo apply_filters( 'the_content', $section->post_content ); ?>
                <?php echo bones_get_edit_link( $section->ID ); ?>

                <!-- Calendar -->
                <?php include_once '_events-calendar.php'; ?>
              </div>
              <div class="col-sm-4 col-md-3">

                <?php include '_partial-latest-events.php' ?>
              </div>
            </div>

          </div>
        </section>

        <section id="section-club-kit" class="page-section section-club-kit">
          <?php $section = get_simple_post('club-kit'); ?>
          <?php echo get_vc_custom_css( $section->ID ); ?>

          <div class="container">

            <div class="row">
              <div class="col-sm-9">
                <?php echo apply_filters( 'the_content', $section->post_content ); ?>
                <?php echo bones_get_edit_link( $section->ID ); ?>
              </div>
              <div class="col-sm-3 cta-badge-wrap">
                <div class="cta-badge has-ribbon">
                  <div class="badge-content">
                    Don't Miss Out!
                  </div>
                </div>
              </div>
            </div>

            <?php include_once '_query-products.php' ?>
          </div>

        </section>

        <?php the_simple_section( 'club-membership' ); ?>

        <?php the_simple_section( 'gccs-social' ); ?>

      </div>

<?php get_footer(); ?>
