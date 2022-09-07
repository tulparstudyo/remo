<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
define(   'GIT_URL', 'https://codeload.github.com/tulparstudyo/remo/zip/refs/tags/latest');
if(isset($_GET['step'])){
    if($_GET['step']==1){
        $process = download_from_git();
        $result = step_1_result($process);
    } else if($_GET['step']==2){
        if(isset($_POST['env'])){
            $process = save_env_file($_POST);
            $result = step_2_result($process);
        } else {
            $result = step_2();
        }
    } else if($_GET['step']==3){
        if(isset($_POST['htaccess'])){
            $process = save_htaccess_file($_POST);
            $result = step_3_result($process);
        } else {
            $result = step_3();
        }
    } else if($_GET['step']==4){
        $result = step_4();
    }  else{
        $result = start();
    }
} else {
    $result = start();
}

?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>Setup Real Estate Orginizator</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    </head>
    <body>
    <main>
        <div class="px-4 py-5 my-5 text-center">
            <img class="d-block mx-auto mb-4" src="https://avatars.githubusercontent.com/u/37733016?v=4" width="72">
            <h2 class="display-5 fw-bold">Real Estate Meeting Organizer</h2>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4"><?=$result['description']?></p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <?=$result['button']?>
                </div>
            </div>
        </div>
    </main>
    </body>
    </html>

<?php
function start(){
    $result['description'] = "Start file download from: ".GIT_URL."<br>";
    $result['button'] = '<a class="btn btn-primary btn-lg px-4 gap-3" href="setup.php?step=1">Start</a>';
    return $result;
}
function step_1_result($status){
    if($status){
        $result['description'] = "Files downloaded from: ".GIT_URL."<br>";
        $result['button'] = "<a class='btn btn-info btn-lg px-4 gap-3' href='setup.php?step=2'>Next</a>";
    } else {
        $result['description'] = "Files Not downloaded from: ".GIT_URL."<br>";
        $result['button'] = "<a class='btn btn-primary btn-lg px-4 gap-3' href='setup.php?step=1'>Retry</a>";
    }
    return $result;
}
function step_2(){
    $result['description'] = "Edit Your .env File<br>";
    $result['description'] .= '<form method="post" target="" enctype="multipart/form-data"><textarea name="env" rows="18" style="width:100%">
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:YmLApjzC8Bgu9iofM3u9moBiC+u6vUlFwhcHacn0lhU=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=remo_user
DB_USERNAME=remo_remo_user
DB_PASSWORD=remo_user

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=database
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=tulparstd@gmail.com
MAIL_PASSWORD=lmtmxkekccsoufvh
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="tulparstd@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

GOOGLE_MAPS_DISTANCE_API_KEY=AIzaSyCPb0ERYHOQzhJR3wyLcUwFXoLul02UONM
</textarea><br><input class="btn btn-primary btn-lg px-4 gap-3" type="submit" value="Save"></form><br>';
    $result['button'] = '';
    return $result;
}
function step_2_result($status){
    if($status){
        $result['description'] = ".env files stored<br>";
        $result['button'] = "<a class='btn btn-info btn-lg px-4 gap-3' href='setup.php?step=3'>Next</a>";
    } else {
        $result['description'] = ".env file not stored<br>";
        $result['button'] = "<a class='btn btn-primary btn-lg px-4 gap-3' href='setup.php?step=2'>Start</a>";
    }
    return  $result;
}
function step_3(){
    $result['description'] = "Edit Your .htaccess File<br>";
    $result['description'] .= '<form method="post" enctype="multipart/form-data"><textarea name="htaccess" rows="18" style="width:100%">### Rewrite Rules Added by CyberPanel Rewrite Rule Generator

RewriteEngine On
RewriteCond %{HTTPS}  !=on
RewriteRule ^/?(.*) https://%{SERVER_NAME}/$1 [R,L]

### End CyberPanel Generated Rules.

<IfModule mod_rewrite.c>
RewriteEngine On
RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
</textarea><br><input class="btn btn-primary btn-lg px-4 gap-3" type="submit" value="Save"></form><br>';
    $result['button'] = '';
    return $result;
}
function step_3_result($status){
    if($status){
        $result['description'] = ".htaccess files stored<br>";
        $result['button'] = "<a class='btn btn-info btn-lg px-4 gap-3' href='setup.php?step=4'>Next</a>";
    } else {
        $result['description'] = ".env file not stored<br>";
        $result['button'] = "<a class='btn btn-primary btn-lg px-4 gap-3' href='setup.php?step=3'>Restry</a>";
    }
    return $result;
}
function step_4(){
    $result['description'] = "Setup success";
    $result['button'] = "<a class='btn btn-primary btn-lg px-4 gap-3' href='/'>Home</a>";
    return $result;
}
function save_env_file($post){
    $env = isset($post['env']) ?$post['env']:false;
    if($env){
        $fp = fopen(__DIR__."/.env","wb");
        fwrite($fp,$env);
        fclose($fp);
        load_env();
        execute_sql();
        return true;
    } else {
        return false;
    }
}
function save_htaccess_file($post){
    $env = isset($post['htaccess']) ?$post['htaccess']:false;
    if($env){
        $fp = fopen(__DIR__."/.htaccess","wb");
        fwrite($fp,$env);
        fclose($fp);
        return true;
    } else {
        return false;
    }
}
function download_from_git(){
    $files = [];
    try{
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_URL, GIT_URL);

        $content = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            if(is_dir(__DIR__.'/remo-latest')) deleteDirectory(__DIR__.'/remo-latest');
            $fp = fopen(__DIR__."/remo-latest.zip","wb");
            fwrite($fp,$content);
            fclose($fp);
            $zip = new ZipArchive;
            $res = $zip->open(__DIR__.'/remo-latest.zip');
            if ($res === TRUE) {
                $zip->extractTo(__DIR__);
                $zip->close();
                $files = rcopy(__DIR__.'/remo-latest', __DIR__);
            } else {
                echo '<header class="bg-danger text-white navbar navbar-expand-lg navbar-dark bd-navbar sticky-top"><nav class="container-xxl bd-gutter flex-wrap flex-lg-nowrap" aria-label="Main navigation">Zip Archice Error.</nav></header>';
            }
        }
    } catch (\Exception $ex){
        echo $ex->getMessage();
    }
    return $files;
}
function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }
    if (!is_dir($dir)) {
        return unlink($dir);
    }
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }
        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }
    }
    return rmdir($dir);
}
function rcopy($src, $dst, $copy_files=[]) {

    if (is_dir( $src )) {
        if(!is_dir($dst)) mkdir( $dst );
        $files = scandir ( $src );
        foreach ( $files as $file ){
            if ($file != "." && $file != ".."){
                $copy_files[] = "$src/$file";
                 rcopy( "$src/$file", "$dst/$file", $copy_files );
            }
        }
    } else if (is_file( $src )){
        copy ( $src, $dst);
    }
    return $copy_files;
}
function load_env(){
    $lines = file(__DIR__.'/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);

        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
            putenv(sprintf('%s=%s', $name, $value));
            if(!defined($name)){
                define($name, $value);
            }
            $_ENV[$name] = $value;
            //$_SERVER[$name] = $value;
        }
    }
}
function execute_sql(){
    try {
        $servername = isset($_ENV['DB_HOST'])?$_ENV['DB_HOST']:false;
        $username = isset($_ENV['DB_USERNAME'])?$_ENV['DB_USERNAME']:false;
        $password = isset($_ENV['DB_PASSWORD'])?$_ENV['DB_PASSWORD']:false;
        $dbname = isset($_ENV['DB_DATABASE'])?$_ENV['DB_DATABASE']:false;
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->multi_query(get_sql())) {
            do {
                // Store first result set
                if ($result = $conn-> store_result()) {
                    while ($row = $result -> fetch_row()) {
                        printf("%s\n", $row[0]);
                    }
                    $result -> free_result();
                }
                // if there are more result-sets, the print a divider
                if ($conn -> more_results()) {

                }
                //Prepare next result set
            } while ($conn -> next_result());
        }
        $header =  "Database migrated<br>";
    } catch (\Exception $ex){
        $header =  '<header class="bg-danger text-white navbar navbar-expand-lg navbar-dark bd-navbar sticky-top"><nav class="container-xxl bd-gutter flex-wrap flex-lg-nowrap" aria-label="Main navigation">Mysql Error: '.$ex->getMessage().'</nav></header>';
    }
    echo $header;
    return TRUE;
}
function get_sql(){
    return "START TRANSACTION;
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `estates`;
CREATE TABLE `estates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mapurl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` decimal(8,7) DEFAULT NULL,
  `longitude` decimal(8,7) DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `constituency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `county` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postcode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `embed` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `meetings`;
CREATE TABLE `meetings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `estate_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `distance` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_at` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `end_at` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_unicode_ci,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `teams`;
CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `personal_team` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `team_invitations`;
CREATE TABLE `team_invitations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `team_user`;
CREATE TABLE `team_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

ALTER TABLE `estates`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_user_id_index` (`user_id`);

ALTER TABLE `team_invitations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_invitations_team_id_email_unique` (`team_id`,`email`);

ALTER TABLE `team_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_user_team_id_user_id_unique` (`team_id`,`user_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `estates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `meetings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `team_invitations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `team_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `team_invitations`
  ADD CONSTRAINT `team_invitations_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;
COMMIT;
";
}
