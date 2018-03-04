<?php
/*
 * This file has been generated automatically.
 * Please change the configuration for correct use deploy.
 */

require 'recipe/yii.php';

// Set configurations
set('repository', 'https://github.com/Lastefond/coinreader-fe.git');

set('shared_files', [
    'config/params-local.php',
]);

task('deploy:fix_assets', function () {
    run('chmod 777 {{release_path}}/web/assets');
});
task('deploy:run_migrations', function () {
    run('{{release_path}}/yii migrate up --interactive=0');
})->desc('Run migrations');

// Configure servers
localServer('production')
    ->env('deploy_path', '/var/www/html/coinreader-fe');

task('deploy', [
    'deploy:prepare',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:fix_assets',
    'deploy:run_migrations',
    'deploy:symlink',
    'cleanup',
])->desc('Deploy your project');