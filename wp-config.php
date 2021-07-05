<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'wp_kama_volley' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'wp_volley_admin' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 'hold081000' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         't B0ekiRDit{MH!m~U -lP?)BDrp4pr$!~Uy5bHy=:t(?5&WwPl:SnV`Y6f%@jh5' );
define( 'SECURE_AUTH_KEY',  '/B<3)4IwX>;Er6KyA/Ka{4bgEC,#RQPJ+=;1=[9;r`,}n(ARU($OZHrkO<$nMle_' );
define( 'LOGGED_IN_KEY',    '(PyW R{){qnCcypaa8jErfPY(7Z7u525#KqI=wa%LAxx9xm9nNZK&hsf@!bV/ypy' );
define( 'NONCE_KEY',        'N+^aU2M+HtR6UR&X^20_h=?Z#Z*n>XgkN__->jun{|;rEbA7.8UFdMtl&CS>b^Gs' );
define( 'AUTH_SALT',        'aX.A/A3WuKm7F+.t!Y2tuv|F16]>Oq1lLVLY]Tf,X;#`0iaL]XJg?Hk/v2Ue~8UL' );
define( 'SECURE_AUTH_SALT', 'Mol{k*Q~jD.SrNSs_K~Vn^qa-C@&jf$=/q$lt SQOVT(M4l#WkOr4;#&ync9dZ!N' );
define( 'LOGGED_IN_SALT',   '#<<`cFO!7c%Ay<N9EYcGuUy[1?/CDFv707EF7xrPn~.;3aQ`+X[#I5G[vzPTDg]2' );
define( 'NONCE_SALT',       '_l~=[0|T5eujhtuTuPa_tWv.OL!VLM8hzKD4+_40L>EysiWo&a3[pxaj`MAHmuv}' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
