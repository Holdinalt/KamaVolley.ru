<?php
/*
Template Name: Шабон команды
Template Post Type: page
*/
?>
<?php ?>
<?php get_header('team')?>

<main class="page-main">
    <h1 class="visually-hidden">Команда - Волейбольный клуб “Кама”</h1>
    <div class="main-container">
        <?php get_sidebar('team')?>

        <section class="team-structure">
            <h2 class="section-title section-title_big team-structure__title">Состав клуба</h2>
            <ul class="team-structure__groups-list">
                <li class="group team-structure__groups-item">
                    <h3 class="section-title group__title">Игроки</h3>
                    <ul class="group__list">

                        <?php

                        $posts = get_posts( array(
                            'numberposts' => 0,
                            'orderby'     => 'date',
                            'order'       => 'DESC',
                            'post_type'   => 'team',

                            'tax_query' => [
                                [
                                    'taxonomy' => 'team-tax',
                                    'field'    => 'player', // тут можно указать slug и ниже вписать ярлыки нужных рубрик
                                    'terms'    => [10],
                                ]
                            ],

                            'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                        ) );

                        foreach( $posts as $post ){
                            setup_postdata($post);
                            ?>

                            <li class="group__item gradient-container">
                                <div class="group__photo">
                                    <img src="<?php the_field('фотография');?>" width="320" height="455" alt="Щур Александр Сергеевич">
                                    <div class="gradient gradient_team-structure"></div>
                                </div>
                                <p class="group__name gradient-text"><?php the_field('фио');?></p>
                                <img class="arrow-icon group__arrow-icon group__arrow-icon_up" width="16" height="9" src="<?php echo get_template_directory_uri() . '/assets/img/arrow-icon.svg' ?>" alt="">
                            </li>

                        <?php }
                        wp_reset_postdata();
                        ?>
                    </ul>
                </li>
                <li class="group team-structure__groups-item">
                    <h3 class="section-title group__title">Тренерский штаб</h3>
                    <ul class="group__list">
                        <?php

                        $posts = get_posts( array(
                            'numberposts' => 0,
                            'orderby'     => 'date',
                            'order'       => 'DESC',
                            'post_type'   => 'team',

                            'tax_query' => [
                                [
                                    'taxonomy' => 'team-tax',
                                    'field'    => 'coach', // тут можно указать slug и ниже вписать ярлыки нужных рубрик
                                    'terms'    => [11],
                                ]
                            ],

                            'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                        ) );

                        foreach( $posts as $post ){
                            setup_postdata($post);
                            ?>

                            <li class="group__item gradient-container">
                                <div class="group__photo">
                                    <img src="<?php the_field('фотография');?>" width="320" height="455" alt="Щур Александр Сергеевич">
                                    <div class="gradient gradient_team-structure"></div>
                                </div>
                                <p class="group__name gradient-text"><?php the_field('фио');?></p>
                                <img class="arrow-icon group__arrow-icon group__arrow-icon_up" width="16" height="9" src="<?php echo get_template_directory_uri() . '/assets/img/arrow-icon.svg' ?>" alt="">
                            </li>

                        <?php }
                        wp_reset_postdata();
                        ?>
                    </ul>
                </li>
                <li class="group team-structure__groups-item">
                    <h3 class="section-title group__title">Персонал</h3>
                    <ul class="group__list">
                        <?php

                        $posts = get_posts( array(
                            'numberposts' => 0,
                            'orderby'     => 'date',
                            'order'       => 'DESC',
                            'post_type'   => 'team',

                            'tax_query' => [
                                [
                                    'taxonomy' => 'team-tax',
                                    'field'    => 'staff', // тут можно указать slug и ниже вписать ярлыки нужных рубрик
                                    'terms'    => [12],
                                ]
                            ],

                            'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                        ) );

                        foreach( $posts as $post ){
                            setup_postdata($post);
                            ?>

                            <li class="group__item gradient-container">
                                <div class="group__photo">
                                    <img src="<?php the_field('фотография');?>" width="320" height="455" alt="Щур Александр Сергеевич">
                                    <div class="gradient gradient_team-structure"></div>
                                </div>
                                <p class="group__name gradient-text"><?php the_field('фио');?></p>
                                <img class="arrow-icon group__arrow-icon group__arrow-icon_up" width="16" height="9" src="<?php echo get_template_directory_uri() . '/assets/img/arrow-icon.svg' ?>" alt="">
                            </li>

                        <?php }
                        wp_reset_postdata();
                        ?>
                    </ul>
                </li>
            </ul>
        </section>
    </div>
</main>

<?php get_footer()?>

