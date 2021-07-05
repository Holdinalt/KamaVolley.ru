<?php
/*
Template Name: Шабон матчей
Template Post Type: page
*/
?>
<?php function get_blix_archive($show_comment_count = 0, $before = '<h4>', $after = '</h4>', $year = 0, $post_type = 'match-result', $limit = 100)
{

    global $month, $wpdb;
    $result = '';

    $AND_year = $year ? $wpdb->prepare(" AND YEAR(post_date) = %s", $year) : '';
    $LIMIT = $limit ? $wpdb->prepare(" LIMIT %d", $limit) : '';

    $arcresults = $wpdb->get_results("SELECT DISTINCT YEAR(post_date) AS year, MONTH(post_date) AS month, count(ID) as posts FROM " . $wpdb->posts . " WHERE post_type='$post_type' $AND_year AND post_status='publish' GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC");

    if ($arcresults) {
        foreach ($arcresults as $arcresult) {
            $url = get_month_link($arcresult->year, $arcresult->month);
            $text = sprintf('%s %d', $month[zeroise($arcresult->month, 2)], $arcresult->year);
            $result .= get_archives_link($url, $text, '', $before, $after);

            $thismonth = zeroise($arcresult->month, 2);
            $thisyear = $arcresult->year;

            $arcresults2 = $wpdb->get_results("SELECT ID, post_date, post_title, comment_status, guid, comment_count FROM " . $wpdb->posts . " WHERE post_date LIKE '$thisyear-$thismonth-%' AND post_status='publish' AND post_type='$post_type' AND post_password='' ORDER BY post_date DESC $LIMIT");

            if ($arcresults2) {
                foreach ($arcresults2 as $arcresult2) {
                    if ($arcresult2->post_date != '0000-00-00 00:00:00') {
//                        $url       =  get_permalink($arcresult2->ID); //$arcresult2->guid;
//                        $arc_title = $arcresult2->post_title;
//
//                        if( $arc_title ) $text = strip_tags($arc_title);
//                        else $text = $arcresult2->ID;
//
//                        $result .= "<li>". get_archives_link($url, $text, '');
//                        if( $show_comment_count ){
//                            $cc = $arcresult2->comment_count;
//                            if( $arcresult2->comment_status == "open" OR $comments_count > 0) $result .= " ($cc)";
//                        }
//                        $result .= "</li>\n";
                        setup_postdata($arcresult2);


                    }
                }
                $result .= "</ul>\n";
            }
        }
    }

    return $result;
} ?>
<?php get_header('matches') ?>

<main class="page-main">
    <h1 class="visually-hidden">Матчи - Волейбольный клуб “Кама”</h1>
    <div class="main-container">
        <div class="columns-container columns-container_top columns-container_no-spaces">
            <section class="closest-match closest-match_matches">
                <div class="closest-match__title-row">
                    <h2 class="section-title section-title_small closest-match__title">Ближайший матч</h2>
                    <a class="closest-match__more-link" href="#">Подробнее</a>
                </div>
                <?php

                $posts = get_posts(array(
                    'numberposts' => 1,
                    'orderby' => 'date',
                    'order' => 'ASC',
                    'post_type' => 'match-result',

                    'tax_query' => [
                        [
                            'taxonomy' => 'match-result-tax',
                            'field' => 'next', // тут можно указать slug и ниже вписать ярлыки нужных рубрик
                            'terms' => [7],
                        ]
                    ],

                    'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                ));

                foreach ($posts as $post) {
                    setup_postdata($post);
                    ?>

                    <div class="closest-match__content">
                        <div class="closest-match__match-row">
                            <div class="team team_first closes-match_team">
                                <h3 class="team__title"><?php the_field('team-1-name'); ?></h3>
                                <img src="<?php the_field('team-1-logo'); ?>" width="70" height="70" alt="">
                            </div>
                            <div class="closest-match__divider"></div>
                            <div class="team team_second closes-match_team">
                                <img src="<?php the_field('team-2-logo'); ?>" width="70" height="70" alt="">
                                <h3 class="team__title"><?php the_field('team-2-name'); ?></h3>
                            </div>
                        </div>
                        <p class="closest-match__details">
                            <time datetime="2021-03-29"><?php the_field('date'); ?></time>
                            <br>
                            <?php the_field('global-place'); ?>
                        </p>
                    </div>

                <?php }
                wp_reset_postdata();
                ?>
            </section>

            <section class="list-block list-block_tournaments">
                <h2 class="column-title list-block__column-title">Турниры</h2>


                <?php
                // список разделов произвольной таксономии genre

                $args = array(
                    'taxonomy' => 'match-result-tournaments', // название таксономии
                    'orderby' => 'name',  // сортируем по названиям
                    'show_count' => 0,       // не показываем количество записей
                    'pad_counts' => 0,       // не показываем количество записей у родителей
                    'hierarchical' => 1,       // древовидное представление
                    'title_li' => '',      // список без заголовка
                    'style' => 'none',
                    'hide_empty' => 1,
                    'number' => 4,

                );
                ?>

                <ul class="list-block__list">
                    <li class="list-block__item">
                        <?php wp_list_categories($args); ?>
                    </li>
                </ul>
            </section>

            <section class="list-block list-block_tournaments-calendar">
                <h2 class="column-title list-block__column-title">Календарь</h2>
                <ul class="list-block__list">
                    <li class="list-block__item list-block__item_active">
                        <a href="#">
                            <h3 class="list-block__title">Матчи сезона 2020/2021</h3>
                        </a>
                    </li>
                    <li class="list-block__item">
                        <a href="#">
                            <h3 class="list-block__title">Матчи сезона 2019/2020</h3>
                        </a>
                    </li>
                    <li class="list-block__item">
                        <a href="#">
                            <h3 class="list-block__title">Матчи сезона 2018/2019</h3>
                        </a>
                    </li>
                </ul>
            </section>
        </div>

        <section class="all-matches">
            <h2 class="section-title section-title_big all-matches__title">Матчи сезона 2020/2021</h2>

            <ul class="all-matches__months-list">
                <li class="month all-matches__months-item">
                    <h3 class="section-title month__title">Апрель 2021</h3>
                    <ul class="month__list">

<!--                        --><?php
//
//                        $show_comment_count = 0;
//                        $before = '<h3 class="section-title month__title">';
//                        $after = '</h3>';
//                        $year = 0;
//                        $post_type = 'match-result';
//                        $limit = 100;
//
//                        global $month, $wpdb;
//                        $result = '';
//
//                        $AND_year = $year ? $wpdb->prepare(" AND YEAR(date) = %s", $year) : '';
//                        $LIMIT = $limit ? $wpdb->prepare(" LIMIT %d", $limit) : '';
//
//                        $arcresults = $wpdb->get_results("SELECT DISTINCT YEAR(date) AS year, MONTH(date) AS month, count(ID) as posts FROM " . $wpdb->posts . " WHERE post_type='$post_type' $AND_year AND post_status='publish' GROUP BY YEAR(date), MONTH(date) ORDER BY post_date DESC");
//
//                        if ($arcresults){
//                            foreach ($arcresults as $arcresult){
//
//                                $url = get_month_link($arcresult->year, $arcresult->month);
//                                $text = sprintf('%s %d', $month[zeroise($arcresult->month, 2)], $arcresult->year);
//                                $result .= get_archives_link($url, $text, '', $before, $after);
//
//                                echo $text;
//
//                                $thismonth = zeroise($arcresult->month, 2);
//                                $thisyear = $arcresult->year;
//
//                                $arcresults2 = $wpdb->get_results("SELECT ID, date, post_title, comment_status, guid, comment_count FROM " . $wpdb->posts . " WHERE date LIKE '$thisyear-$thismonth-%' AND post_status='publish' AND post_type='$post_type' AND post_password='' ORDER BY date DESC $LIMIT");
//
//                                if ($arcresults2){
//                                    foreach ($arcresults2 as $arcresult2){
//                                        if ($arcresult2->post_date != '0000-00-00 00:00:00') {
//                                            setup_postdata($arcresult2);
//
//                                            ?>
<!---->
<!--                                            lol-->
<!---->
<!--                                            --><?php
//
//                                            wp_reset_postdata();
//                                        }
//                                    }
//
//                                }
//                            }
//                        }
//
//                    ?>




                        <?php

                        $posts = get_posts(array(
                        'numberposts' => 0,
                        'meta_key' => 'date',
                        'orderby' => 'meta_value',
                        'order' => 'DESC',
                        'post_type' => 'match-result',

                        'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                        ));

                        foreach ($posts as $post) {
                        setup_postdata($post);
                        ?>

                        <li class="match month__item">
                            <ul class="match__list">
                                <li class="match__item match__item_teams">
                                    <div class="team team_first match__team">
                                        <h3 class="team__title"><?php the_field('team-1-name'); ?></h3>
                                        <img class="team__logo" src="<?php the_field('team-1-logo'); ?>" width="70"
                                             height="70" alt="Логотип команды ”Локомотив-Изумруд”">
                                    </div>
                                    <div class="match__divider"></div>
                                    <div class="team team_second match__team">
                                        <img class="team__logo" src="<?php the_field('team-2-logo'); ?>" width="70"
                                             height="70" alt="Логотип команды ”КАМА”">
                                        <h3 class="team__title"><?php the_field('team-2-name'); ?></h3>
                                    </div>
                                </li>
                                <li class="match__item match__item_time">
                                    <time datetime="2021-04-29"><?php the_field('date'); ?></time>
                                </li>
                                <li class="match__item match__item_place">
                                    <?php the_field('global-place'); ?><br>
                                    <?php the_field('local-place'); ?>
                                </li>
                                <li class="match__item match__item_league">
                                    Высшая лига "А"
                                </li>
                                <li class="match__item match__item_result">
                                    <div class="match__result-container">
                                        <?php

                                        $main_res = get_post_field('main-result');

                                        switch ($main_res) {
                                        case 2:
                                        echo "<p class=\"match__status match__status_win\">Победа</p>";
                                        break;
                                        case 1:
                                        echo "<p class=\"match__status match__status_draw\">Ничья</p>";
                                        break;
                                        case -1:
                                        echo "<p class=\"match__status match__status_lose\">Поражение</p>";
                                        break;
                                        case 0:
                                        echo "<p class=\"match__status match__status_soon\">Скоро...</p>";
                                        }

                                        ?>
                                        <p class="match__scores">Счёт: <?php the_field('result-points'); ?></p>
                                    </div>
                                </li>
                            </ul>
                        </li>

                        <?php }
                        wp_reset_postdata();
                        ?>


                    </ul>
                </li>
                <li class="month all-matches__months-item">
                    <h3 class="section-title month__title">Март 2021</h3>
                    <ul class="month__list">
                        <li class="match month__item">
                            <ul class="match__list">

                                <li class="match__item match__item_teams">
                                    <div class="team team_first match__team">
                                        <h3 class="team__title">КАМА</h3>
                                        <img class="team__logo" src="img/team1-logo.png" width="70" height="70"
                                             alt="Логотип команды ”КАМА”">
                                    </div>
                                    <div class="match__divider"></div>
                                    <div class="team team_second match__team">
                                        <img class="team__logo" src="img/team6-logo.png" width="70" height="70"
                                             alt="Логотип команды ”КАМА”">
                                        <h3 class="team__title">Якась Беларусь</h3>
                                    </div>
                                </li>
                                <li class="match__item match__item_time">
                                    <time datetime="2021-03-23">ВТ, 23.03.2021</time>
                                </li>
                                <li class="match__item match__item_place">
                                    Пермь<br>
                                    “Крутая Арена”
                                </li>
                                <li class="match__item match__item_league">
                                    Высшая лига "А"
                                </li>
                                <li class="match__item match__item_result">
                                    <div class="match__result-container">
                                        <p class="match__status match__status_lose">Поражение</p>
                                        <p class="match__scores">Счёт: 2-3</p>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="match month__item">
                            <ul class="match__list">
                                <li class="match__item match__item_teams">
                                    <div class="team team_first match__team">
                                        <h3 class="team__title">КАМА</h3>
                                        <img class="team__logo" src="img/team1-logo.png" width="70" height="70"
                                             alt="Логотип команды ”КАМА”">
                                    </div>
                                    <div class="match__divider"></div>
                                    <div class="team team_second match__team">
                                        <img class="team__logo" src="img/team7-logo.png" width="70" height="70"
                                             alt="Логотип команды ”КАМА”">
                                        <h3 class="team__title">Локомотив Новосибирск</h3>
                                    </div>
                                </li>
                                <li class="match__item match__item_time">
                                    <time datetime="2021-03-18">ЧТ, 18.03.2021</time>
                                </li>
                                <li class="match__item match__item_place">
                                    Новосибирск<br>
                                    “ААА Арена”
                                </li>
                                <li class="match__item match__item_league">
                                    Высшая лига "А"
                                </li>
                                <li class="match__item match__item_result">
                                    <div class="match__result-container">
                                        <p class="match__status match__status_win">Победа</p>
                                        <p class="match__scores">Счёт: 3-1</p>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="match month__item">
                            <ul class="match__list">
                                <li class="match__item match__item_teams">
                                    <div class="team team_first match__team">
                                        <h3 class="team__title">КАМА</h3>
                                        <img class="team__logo" src="img/team1-logo.png" width="70" height="70"
                                             alt="Логотип команды ”КАМА”">
                                    </div>
                                    <div class="match__divider"></div>
                                    <div class="team team_second match__team">
                                        <img class="team__logo" src="img/team8-logo.png" width="70" height="70"
                                             alt="Логотип команды ”КАМА”">
                                        <h3 class="team__title">Леф</h3>
                                    </div>
                                </li>
                                <li class="match__item match__item_time">
                                    <time datetime="2021-04-29">ПТ, 12.03.2021</time>
                                </li>
                                <li class="match__item match__item_place">
                                    Пермь<br>
                                    “Крутая Арена”
                                </li>
                                <li class="match__item match__item_league">
                                    Высшая лига "А"
                                </li>
                                <li class="match__item match__item_result">
                                    <div class="match__result-container">
                                        <p class="match__status match__status_win">Победа</p>
                                        <p class="match__scores">Счёт: 3-1</p>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="match month__item">
                            <ul class="match__list">
                                <li class="match__item match__item_teams">
                                    <div class="team team_first match__team">
                                        <h3 class="team__title">КАМА</h3>
                                        <img class="team__logo" src="img/team1-logo.png" width="70" height="70"
                                             alt="Логотип команды ”КАМА”">
                                    </div>
                                    <div class="match__divider"></div>
                                    <div class="team team_second match__team">
                                        <img class="team__logo" src="img/team9-logo.png" width="70" height="70"
                                             alt="Логотип команды ”КАМА”">
                                        <h3 class="team__title">Ещё леф</h3>
                                    </div>
                                </li>
                                <li class="match__item match__item_time">
                                    <time datetime="2021-04-29">СР, 03.03.2021</time>
                                </li>
                                <li class="match__item match__item_place">
                                    Не Пермь<br>
                                    “Не оч Арена”
                                </li>
                                <li class="match__item match__item_league">
                                    Высшая лига "А"
                                </li>
                                <li class="match__item match__item_result">
                                    <div class="match__result-container">
                                        <p class="match__status match__status_win">Победа</p>
                                        <p class="match__scores">Счёт: 3-1</p>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </section>
    </div>
</main>

<?php get_footer() ?>

