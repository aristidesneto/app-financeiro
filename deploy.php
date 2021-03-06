<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'my_project');

// Project repository
set('repository', 'git@github.com:aristidesneto/app-financeiro.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts
host('production')
    ->hostname('usrc1_app@206.189.193.189')
    ->port(22345)
    ->set('keep_releases', 3)
    ->stage('prod')
    ->set('branch', 'master')
    ->set('deploy_path', '/var/www/clients/client1/web20/web');


// Tasks
task('deploy:npm_prod', function () {
    if (has('previous_release')) {
        run('cp -R {{previous_release}}/node_modules {{release_path}}/node_modules');
    }
    run('cd {{release_path}} && npm install');
    run('cd {{release_path}} && npm run prod');
});

after('deploy:vendors', 'deploy:npm_prod');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

