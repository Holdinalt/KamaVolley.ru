<?php get_header('news')?>

<main class="page-main">
    <h1 class="visually-hidden">Крутая статья с кричащим заголовком о том, что ребята отыграли вот прям вообще круто, молодцы какие! - Волейбольный клуб “Кама”</h1>
    <div class="main-container">

        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="<?php echo get_site_url()?>">Главная</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="<?php echo get_site_url() . '/news/'?>">Новости</a>
            </li>
            <li class="breadcrumbs__item breadcrumbs__item_current">
                <?php echo wp_trim_words( the_title('', '', false), 24 );?>
            </li>

        </ul>

        <article class="post">
            <header class="post__header">
                <time class="post__time" datetime="<?php the_time('d.m.Y');?>"><?php the_time('d.m.Y');?></time>
                <h2 class="post__title"><?php the_title();?></h2>
            </header>

            <?php
            $cats = '';
            foreach ( get_the_category() as $category ) {
                if ($category->term_id != '2' && $category->term_id != '3'){
                    if ($cats == ''){
                        $cats .= $category->term_id;
                    } else {
                        $cats .= ',' . $category->term_id;
                    }
                }
            }
            ?>


            <?php the_content();?>

        </article>

        <aside class="related-posts">
            <h2 class="related-posts__title">Похожие статьи</h2>
            <ul class="related-posts__list">



                <?php

                $posts = get_posts( array(
                    'numberposts' => 3,
                    'orderby'     => 'date',
                    'order'       => 'DESC',
                    'category__and'  => $cats,
                    'post_type'   => 'post',
                    'exclude'     => array(get_the_ID()),
                    'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                ) );

                foreach( $posts as $post ){
                    setup_postdata($post);
                    ?>

                    <li class="related-posts__item gradient-container">
                        <a href="<?php the_permalink();?>">
                            <div class="related-posts__photo">
                                <?php the_post_thumbnail('main-news', array(

                                ));?>
                                <div class="gradient gradient_news"></div>
                            </div>
                            <div class="related-posts__description gradient-text">
                                <time class="related-posts__time" datetime="<?php the_time('d.m.Y');?>"><?php the_time('d.m.Y');?></time>
                                <p class="related-posts__text">
                                    <?php the_title();?>
                                </p>
                            </div>
                        </a>
                    </li>

                <?php }
                wp_reset_postdata();
                ?>
            </ul>
        </aside>
    </div>
</main>

<aside>

</aside>

<?php get_footer()?>

