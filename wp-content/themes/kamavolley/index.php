<?php get_header(); ?>

<main class="page-main">
    <h1 class="visually-hidden">Волейбольный клуб “Кама”</h1>
    <div class="main-container">
        <div class="columns-container columns-container_main-news-standings">
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

            <?php get_sidebar('index')?>
        </div>

        <div class="columns-container">
            <section class="gallery">
                <h2 class="visually-hidden">Фотогалерея</h2>
                <ul class="gallery__list">
                    <li class="gallery__item">
                        <a class="gallery__image">
                            <img src="<?php echo get_template_directory_uri() . '/assets/img/galllery-photo1.jpg' ?> " width="680" height="240" alt="Общее фото команды">
<!--                            <div class="gradient gradient_gallery"></div>-->
                        </a>
                    </li>
                </ul>
                <ul class="gallery__dots-list">
                    <li class="gallery__dots-item gallery__dots-item_active"></li>
                    <li class="gallery__dots-item"></li>
                    <li class="gallery__dots-item"></li>
                    <li class="gallery__dots-item"></li>
                    <li class="gallery__dots-item"></li>
                </ul>
                <button class="gallery__button gallery__button_prev" type="button">
                    <span class="visually-hidden">Назад</span>
                    <img class="arrow-icon" width="16" height="9" src="assets/img/arrow-icon.svg" alt="">
                </button>
                <button class="gallery__button gallery__button_next" type="button">
                    <span class="visually-hidden">Вперед</span>
                    <img class="arrow-icon" width="16" height="9" src="assets/img/arrow-icon.svg" alt="">
                </button>
            </section>

            <section class="closest-match">
                <div class="closest-match__title-row">
                    <h2 class="section-title section-title_small closest-match__title">Ближайший матч</h2>
                    <a class="closes-match__more-link" href="#">Подробнее</a>
                </div>

                <?php

                $posts = get_posts( array(
                    'numberposts' => 1,
                    'orderby'     => 'date',
                    'order'       => 'ASC',
                    'post_type'   => 'match-result',

                    'tax_query' => [
                        [
                            'taxonomy' => 'match-result-tax',
                            'field'    => 'next', // тут можно указать slug и ниже вписать ярлыки нужных рубрик
                            'terms'    => [7],
                        ]
                    ],

                    'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                ) );

                foreach( $posts as $post ){
                    setup_postdata($post);
                    ?>

                    <div class="closest-match__content">
                        <div class="closest-match__match-row">
                            <div class="team team_first closes-match_team">
                                <h3 class="team__title"><?php the_field('team-1-name');?></h3>
                                <img src="<?php the_field('team-1-logo');?>" width="70" height="70" alt="">
                            </div>
                            <div class="closest-match__divider"></div>
                            <div class="team team_second closes-match_team">
                                <img src="<?php the_field('team-2-logo');?>" width="70" height="70" alt="">
                                <h3 class="team__title"><?php the_field('team-2-name');?></h3>
                            </div>
                        </div>
                        <p class="closest-match__details">
                            <time datetime="2021-03-29"><?php the_field('date');?></time><br>
                            <?php the_field('global-place');?>
                        </p>
                    </div>

                <?php }
                wp_reset_postdata();
                ?>

            </section>
        </div>

        <section class="news">
            <h2 class="visually-hidden">Новости</h2>
            <ul class="news__list">

                <?php

                $posts = get_posts( array(
                    'numberposts' => 6,
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
                <a class="news__all-button" href="#">Все новости</a>
            </div>
        </section>
    </div>

    <section class="partners">
        <div class="main-container">
            <h2 class="section-title partners__title">Спонсоры и партнеры команды</h2>
            <ul class="partners__list">
                <?php

                $posts = get_posts( array(
                    'numberposts' => 7,
                    'orderby'     => 'date',
                    'order'       => 'DESC',
                    'post_type'   => 'partners',
                    'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                ) );

                foreach( $posts as $post ){
                    setup_postdata($post);
                    ?>


                <li class="partners__item">
                    <a class="partners__logo" href="<?php the_field('partner-website');?>" target="_blank">
                        <img src="<?php the_field('partner-logo');?> " alt="">
                    </a>

                </li>

                <?php }
                wp_reset_postdata();
                ?>

            </ul>
        </div>
    </section>
</main>

<?php get_footer(); ?>
