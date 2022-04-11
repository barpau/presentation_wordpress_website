<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package naam
 */

?>
<?php
global $post;
$categories = get_the_category();
$cat_type = $categories[0]->slug; ?>
<div class="library">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    if ( 'post' === get_post_type() ) :
    ?>
    <header class="entry-header-post">
        <div id="post-img">
<!--            --><?php //naam_post_thumbnail(); ?>
<!--                <img src="http://www.naamjoga.cz/wp-content/uploads/2021/04/danielle-macinnes-222441-unsplash-scaled-e1618987984802.jpg"/>-->
        </div>
        <?php else : ?>
    <header class="entry-header">
			<div class="entry-meta">
				<?php
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
        <div class="page-title">
            <?php if ($cat_type == "clanky"): ?>
            <h1 class="entry-title">Aktuální články</h1>
            <?php else: ?>
            <h1 class="entry-title">Aktuality</h1>
            <?php endif; ?>
        </div>
        <div class="container">
            <div class="grid-container" id="posts">
                <?php if ($cat_type == "clanky"): ?>
                <div class="post-widget-column" id="post-list">
                    <ul class="post-list">
                        <?php
                        // Define our WP Query Parameters
                       $the_query = new WP_Query();
                        ?>
                        <?php
                        $page = get_query_var('paged');
                        if ($page == 0) :
                            // the query
                        $wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'post_cat'=> $cat_type));
                        else :
                            $offset = ($page - 1)*5;
                            $wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'offset' => $offset));
                            ?>
                        <?php endif; ?>
                        <?php if ( $wpb_all_query->have_posts() ) : ?>
                            <!-- the loop -->
                            <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post() ; ?>


<!--                                --><?php //if ($wpb_all_query->query['post_cat'] === 'clanky'): ?>
                                <article>
                                    <li><h4 id="post-list-title"><?php the_title(); ?></h4></li>

                                    <div class="article-content">
                                        <?php the_title( '<h3 class="entry-title">', '</h3>' );?>
                                        <?php the_content(); ?>
                                    </div>
                                </article>
<!--                                --><?php //endif; ?>
                            <?php endwhile; ?>
                            <!-- end of the loop -->

                        <?php wp_reset_postdata(); ?>

                        <?php else : ?>
                        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                        <?php endif; ?>
                    </ul>
<!--                    Posts navigation-->
                   <?php wp_pagenavi(); ?>

                </div>
                <div class="post-text-column" id="post-text">
                        <?php the_title( '<h3 class="entry-title">', '</h3>' );?>
                        <div class="first-article-content">
                            <?php the_content(); ?>
                        </div>
                </div>
<!--                aktuality-->
                <?php else: ?>
                <div class="wp-block-columns">
                   <div class="wp-block-column">
                       <?php the_title( '<h4 class="entry-title">', '</h4>' );?>
                       <div class="wp-block-image">
                           <?php naam_post_thumbnail(); ?>
                       </div>
                   </div>
                    <div class="wp-block-column">
                        <?php the_content(); ?>
                    </div>
                </div>
                    <hr class="between-line">

                <?php endif; ?>

            </div>
        </div>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
</div>
      <?php  get_footer();
        die; ?>




