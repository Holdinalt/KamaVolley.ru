<?php
/*
Template Name: Шабон новостей
Template Post Type: page
*/
?>

<?php get_header("news"); ?>

<main class="page-main">
    <h1 class="visually-hidden">Новости - Волейбольный клуб “Кама”</h1>
    <div class="main-container">
        <div class="columns-container columns-container_top">
            <section class="main-news gradient-container">
                <?php ?>
                <?php

                $posts = get_posts( array(
                    'numberposts' => 1,
                    'orderby'     => 'date',
                    'order'       => 'DESC',
                    'category_name' => "Главная новость",
                    'post_type'   => 'post',
                    'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                ) );

                foreach( $posts as $post ){
                    setup_postdata($post);
                    ?>

                    <h2 class="visually-hidden">Главная новость</h2>
                    <a href="<?php the_permalink();?>">
                        <div class="main-news__photo">
                            <?php the_post_thumbnail('the-main-new', array(

                            ));?>
                            <div class="gradient gradient_main-news"></div>
                        </div>
                        <div class="main-news__description gradient-text">
                            <time class="main-news__time" datetime="2021-03-27"><?php the_time('d.m.Y');?></time>
                            <p class="main-news__text">
                                <?php the_title();?>
                            </p>
                        </div>
                    </a>

                <?php }
                wp_reset_postdata();
                ?>
            </section>

            <section class="articles">
                <h2 class="visually-hidden">Статьи</h2>
                <ul class="articles__list">
                    <?php

                    $posts = get_posts( array(
                        'numberposts' => 5,
                        'offset' => 1,
                        'orderby'     => 'date',
                        'order'       => 'DESC',
                        'category_name' => "Главная новость",
                        'post_type'   => 'post',
                        'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                    ) );

                    foreach( $posts as $post ){
                        setup_postdata($post);
                        ?>

                        <li class="articles__item">
                            <a href="<?php the_permalink();?>">
                                <h3 class="articles__title"><?php the_title();?></h3>
                                <time class="articles__time" datetime="<?php the_time('Y.m.d');?>"><?php the_time('Y.m.d');?></time>
                            </a>
                        </li>

                    <?php }
                    wp_reset_postdata();
                    ?>
                </ul>
            </section>
        </div>

        <section class="news">
            <h2 class="visually-hidden">Новости</h2>
            <ul class="news__list">
                <?php

                $posts = get_posts( array(
                    'numberposts' => 16,
                    'orderby'     => 'date',
                    'order'       => 'DESC',
                    'category_name' => "Новость",
                    'post_type'   => 'post',
                    'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                ) );

                foreach( $posts as $post ){
                    setup_postdata($post);
                    ?>

                    <li class="news__item gradient-container">
                        <a href="<?php the_permalink();?>">
                            <div class="news__photo">
                                <?php the_post_thumbnail('main-news', array(

                                ));?>
                                <div class="gradient gradient_news"></div>
                            </div>
                            <div class="news__description gradient-text">
                                <time class="news__time" datetime="2021-03-27"><?php the_time('d.m.Y');?></time>
                                <p class="news__text">
                                    <?php the_title();?>
                                </p>
                            </div>
                        </a>
                    </li>


                <?php }
                wp_reset_postdata();
                ?>
            </ul>
            <div class="news__all-button-container">
                <a class="news__all-button" href="#">Показать больше</a>
            </div>
        </section>
    </div>
</main>


<!--Когда в ряду одна картинка, текст съебывает-->
<?php get_footer(); ?>
