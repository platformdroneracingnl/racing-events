<?php

namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/slack.php';
require 'contrib/npm.php';

set('application', 'PDRNL - Racing events');
set('ssh_multiplexing', true); // Speed up deployment
set('repository', 'git@github.com:platformdroneracingnl/racing-events.git');

set('slack_webhook', getenv('APP_SLACK_WEBHOOK'));
set('release', getenv('RELEASE_VERSION'));
set('slack_success_text', 'Version *{{release}}* has just been successfully deployed on the live server.');
set('slack_failure_text', 'The deployment failed, check the build logs to see what went wrong.');

host('prod')
    ->set('remote_user', getenv('APP_DEPLOY_USER'))
    ->set('port', getenv('APP_DEPLOY_PORT'))
    ->set('hostname', getenv('APP_HOST'))
    ->set('sub_directory', 'laravel')
    ->set('deploy_path', getenv('APP_DEPLOY_PATH'));

task('deploy', [
    'deploy:prepare',
    'deploy:vendors',
    'artisan:storage:link',
    'artisan:view:cache',
    'artisan:config:cache',
    'artisan:migrate',
    'npm:install',
    'npm:run:dev',
    'deploy:publish',
]);

task('npm:run:dev', function () {
    cd('{{release_or_current_path}}');
    run('npm run dev');
});

after('deploy:failed', 'deploy:unlock', 'slack:notify:failure');
after('deploy:success', 'slack:notify:success');
