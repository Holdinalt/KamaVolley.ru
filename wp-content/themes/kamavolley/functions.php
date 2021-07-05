<?php

add_action( 'wp_enqueue_scripts', 'style_theme');
add_action( 'widgets_init', 'register_my_widgets' );
add_action('after_setup_theme', 'after_setup');
add_action( 'init', 'register_post_types' );

function style_theme() {
    wp_enqueue_style('normalize', get_template_directory_uri() . '/assets/css/normalize.css');
    wp_enqueue_style('style', get_stylesheet_uri());
}

function register_my_widgets(){

    register_sidebar( array(
        'name'          => 'Таблица результатов матчей на главной',
        'id'            => "teams-table",
        'description'   => ''
    ) );

    register_sidebar( array(
        'name'          => 'О клубе на странице команды',
        'id'            => "club-info",
        'description'   => '',
        'before_widget' => '',
        'after_widget'  => "",
        'before_title'  => '',
        'after_title'   => "",
        'class'         => 'lol',
    ) );
}

function after_setup() {

    register_nav_menu('top', 'Верхнее меню');

    add_theme_support( 'post-thumbnails', array( 'post' ) );
    add_image_size( 'the-main-new', 1045, 340, true);
    add_image_size( 'main-news', 450, 190, true);
    add_image_size( 'partner', 240, 120, false);
    add_image_size( 'team-logo-small', 70, 70, false);
    add_image_size( 'team-member-big', 320, 455, false);
}


function register_post_types(){
    register_post_type( 'partners', [
        'label'  => null,
        'labels' => [
            'name'               => 'Партнеры', // основное название для типа записи
            'singular_name'      => 'Партнер', // название для одной записи этого типа
            'add_new'            => 'Добавить партнера', // для добавления новой записи
            'add_new_item'       => 'Добавление партнера', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактирование партнера', // для редактирования типа записи
            'new_item'           => 'Новый партнер', // текст новой записи
            'view_item'          => 'Смотреть партнеров', // для просмотра записи этого типа.
            'search_items'       => 'Искать партнера', // для поиска по этим типам записи
            'not_found'          => 'Не найдено ни одного партнера', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Партнеры', // название меню
        ],
        'description'         => 'Отдельный тип записей для партнеров',
        'public'              => true,
         'publicly_queryable'  => true, // зависит от public
         'exclude_from_search' => true, // зависит от public
         'show_ui'             => true, // зависит от public
         'show_in_nav_menus'   => true, // зависит от public
        'show_in_menu'        => true, // показывать ли в меню адмнки
         'show_in_admin_bar'   => true, // зависит от show_in_menu
        'show_in_rest'        => true, // добавить в REST API. C WP 4.7
        'rest_base'           => true, // $post_type. C WP 4.7
        'menu_position'       => 9,
        'menu_icon'           => 'dashicons-businessman',
        'capability_type'   => 'post',
        //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
        //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
        'hierarchical'        => false,
        'supports'            => ['title'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'taxonomies'          => [],
        'has_archive'         => false,
        'rewrite'             => true,
        'query_var'           => true,
    ] );

    register_taxonomy( 'match-result-tax', [ 'match-result' ], [
        'label'                 => '', // определяется параметром $labels->name
        'labels'                => array(
            'name'              => 'Раздел статуса встречи',
            'singular_name'     => 'Раздел статуса встречи',
            'search_items'      => 'Искать статусы встречи',
            'all_items'         => 'Все статусы встречи',
            'parent_item'       => 'Родит. статус встречи',
            'parent_item_colon' => 'Родит. статус встречи',
            'edit_item'         => 'Ред. статус встречи',
            'update_item'       => 'Обновить статус встречи',
            'add_new_item'      => 'Добавить статус встречи',
            'new_item_name'     => 'Новый статус встречи',
            'menu_name'         => 'Раздел статуса встречи',
        ),
        'description'           => 'Рубрика для определения статуса встречи - завершен матч или только планируется', // описание таксономии
        'public'                => true,
        'show_in_nav_menus'     => false, // равен аргументу public
        'show_ui'               => true, // равен аргументу public
        'show_tagcloud'         => false, // равен аргументу show_ui
        'hierarchical'          => true,
        'rewrite'               => array('slug'=>'match-id', 'hierarchical'=>false, 'with_front'=>false, 'feed'=>false ),
        'show_admin_column'     => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
    ] );

    register_taxonomy( 'match-result-tournaments', [ 'match-result' ], [
        'label'                 => '', // определяется параметром $labels->name
        'labels'                => array(
            'name'              => 'Раздел турниров',
            'singular_name'     => 'Раздел турнира',
            'search_items'      => 'Искать турниры',
            'all_items'         => 'Все турниры',
            'parent_item'       => 'Родит. турнир',
            'parent_item_colon' => 'Родит. турнир',
            'edit_item'         => 'Ред. турнир',
            'update_item'       => 'Обновить турнир',
            'add_new_item'      => 'Добавить турнир',
            'new_item_name'     => 'Новый турнир',
            'menu_name'         => 'Раздел турниров',
        ),
        'description'           => 'Рубрика для определения турнира. Например, Высшая лига "А"', // описание таксономии
        'public'                => true,
        'show_in_nav_menus'     => false, // равен аргументу public
        'show_ui'               => true, // равен аргументу public
        'show_tagcloud'         => false, // равен аргументу show_ui
        'hierarchical'          => true,
        'show_admin_column'     => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
    ] );

    register_post_type( 'match-result', [
        'label'  => null,
        'labels' => [
            'name'               => 'Результаты матчей', // основное название для типа записи
            'singular_name'      => 'Результат матча', // название для одной записи этого типа
            'add_new'            => 'Добавить результат матча', // для добавления новой записи
            'add_new_item'       => 'Добавление результата матча', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактирование результата матча', // для редактирования типа записи
            'new_item'           => 'Новый результат матча', // текст новой записи
            'view_item'          => 'Смотреть результаты матча', // для просмотра записи этого типа.
            'search_items'       => 'Искать результат матча', // для поиска по этим типам записи
            'not_found'          => 'Не найдено ни одного результата матча', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Результаты матчей', // название меню
        ],
        'description'         => 'Отдельный тип записей для результатов матчей',
        'public'              => true,
        'publicly_queryable'  => true, // зависит от public
        'exclude_from_search' => true, // зависит от public
        'show_ui'             => true, // зависит от public
        'show_in_nav_menus'   => true, // зависит от public
        'show_in_menu'        => true, // показывать ли в меню адмнки
        'show_in_admin_bar'   => true, // зависит от show_in_menu
        'show_in_rest'        => true, // добавить в REST API. C WP 4.7
        'rest_base'           => true, // $post_type. C WP 4.7
        'menu_position'       => 8,
        'menu_icon'           => 'dashicons-awards',
        'capability_type'   => 'post',
        //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
        'map_meta_cap'      => true, // Ставим true чтобы включить дефолтный обработчик специальных прав
        'hierarchical'        => false,
        'supports'            => ['title'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'taxonomies'          => ['match-result-tax', 'match-result-tournaments'],
        'rewrite'             => array( 'slug'=>'match-result/%match-result-tax%', 'with_front'=>false, 'pages'=>false, 'feeds'=>false, 'feed'=>false ),
        'has_archive'         => 'match-result',
        'query_var'           => true,
    ] );

    register_taxonomy( 'team-tax', [ 'team' ], [
        'label'                 => '', // определяется параметром $labels->name
        'labels'                => array(
            'name'              => 'Раздел ролей в команде',
            'singular_name'     => 'Раздел роли в команде',
            'search_items'      => 'Искать роли в команде',
            'all_items'         => 'Все роли в команде',
            'parent_item'       => 'Родит. роль в команде',
            'parent_item_colon' => 'Родит. роли в команде',
            'edit_item'         => 'Ред. роль в команде',
            'update_item'       => 'Обновить роль в команде',
            'add_new_item'      => 'Добавить роль в команде',
            'new_item_name'     => 'Новая роль в команде',
            'menu_name'         => 'Раздел ролей в команде',
        ),
        'description'           => 'Рубрика для определения роли в команде. Человек делает свою работу в качестве игрока, тренера или персонала', // описание таксономии
        'public'                => true,
        'show_in_nav_menus'     => false, // равен аргументу public
        'show_ui'               => true, // равен аргументу public
        'show_tagcloud'         => false, // равен аргументу show_ui
        'hierarchical'          => true,
        'show_admin_column'     => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
    ] );

    register_post_type( 'team', [
        'label'  => null,
        'labels' => [
            'name'               => 'Команда', // основное название для типа записи
            'singular_name'      => 'Команда', // название для одной записи этого типа
            'add_new'            => 'Добавить нового члена команды', // для добавления новой записи
            'add_new_item'       => 'Добавление нового члена команды', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактирование члена команды', // для редактирования типа записи
            'new_item'           => 'Новый член команды', // текст новой записи
            'view_item'          => 'Смотреть члена команды', // для просмотра записи этого типа.
            'search_items'       => 'Искать члена команды', // для поиска по этим типам записи
            'not_found'          => 'Не найдено ни одного члена команды', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Команда', // название меню
        ],
        'description'         => 'Отдельный тип записей людей, состоящих в команде',
        'public'              => true,
        'publicly_queryable'  => true, // зависит от public
        'exclude_from_search' => true, // зависит от public
        'show_ui'             => true, // зависит от public
        'show_in_nav_menus'   => true, // зависит от public
        'show_in_menu'        => true, // показывать ли в меню адмнки
        'show_in_admin_bar'   => true, // зависит от show_in_menu
        'show_in_rest'        => true, // добавить в REST API. C WP 4.7
        'rest_base'           => true, // $post_type. C WP 4.7
        'menu_position'       => 4,
        'menu_icon'           => 'dashicons-groups',
        'capability_type'   => 'post',
        //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
        'map_meta_cap'      => true, // Ставим true чтобы включить дефолтный обработчик специальных прав
        'hierarchical'        => false,
        'supports'            => ['title'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'taxonomies'          => ['team-tax'],
        'rewrite'             => array( 'slug'=>'team/%team-tax%', 'with_front'=>false, 'pages'=>false, 'feeds'=>false, 'feed'=>false ),
        'has_archive'         => 'team',
        'query_var'           => true,
    ] );
}

