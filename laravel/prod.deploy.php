<?php

namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/slack.php';
require 'contrib/npm.php';

set('application', 'PDRNL Events');
set('repository', 'git@github.com:platformdroneracingnl/race-event-registration.git');

set('slack_webhook', env('APP_SLACK_WEBHOOK'));
set('release', env('RELEASE_VERSION'));
set('slack_success_text', 'Version *{{release}}* has just been successfully deployed on the live server.');
set('slack_failure_text', 'The deployment failed, check the build logs to see what went wrong.');

host('prod')
    ->set('remote_user', env('APP_DEPLOY_USER'))
    ->set('hostname', env('APP_HOST'))
    ->set('deploy_repository_path', 'laravel')
    ->set('deploy_path', env('APP_DEPLOY_PATH'));

task('deploy', [
    'deploy:prepare',
    'deploy:vendors',
    'artisan:storage:link',
    'artisan:view:cache',
    'artisan:config:cache',
    'artisan:migrate',
    'npm:install',
    'npm:run:prod',
    'deploy:publish',
]);

task('npm:run:prod', function () {
    cd('{{release_or_current_path}}');
    run('npm run prod');
});

after('deploy:failed', 'deploy:unlock', 'slack:notify:failure');
after('deploy:success', 'slack:notify:success');