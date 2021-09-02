<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Response;

class DatabaseController extends Controller
{
    public function migrate(string $key)
    {
        if($key == 'dbpassword')
        {
            try {
                echo '<br>init with tables migrattions...';
                    Artisan::call('migrate', [
                        '--path' => 'database/migrations'
                        ]);
                    echo '<br>done with tables migrations';
            } catch (Exception $e) {
                Response::make($e->getMessage(), 500);
            }
        } else {
            App::abort(404);
        }
    }

    public function rollback(string $key)
    {
        if($key == 'dbpassword')
        {
            try {
                echo '<br>init with tables rollback migrattions...';
                Artisan::call('migrate:rollback', [
                    '--path' => 'database/migrations'
                    ]);
                echo '<br>done with tables rollback migrations';
            } catch (Exception $e) {
                Response::make($e->getMessage(), 500);
            }
        } else {
            App::abort(404);
        }
    }

    public function seed(string $key) {
        if($key == 'dbpassword') {
            try {
                echo '<br>init seeding...';
                Artisan::call('db:seed');
                echo '<br>done seeding';
            } catch (Exception $e) {
                Response::make($e->getMessage(), 500);
            }
        } else {
            App::abort(404);
        }
    }

    public function migrateFresh(string $key)
    {
        if($key == 'dbpassword')
        {
            try {
                echo '<br>init with fresh tables migrattions...';
                    Artisan::call('migrate:fresh', [
                        '--path' => 'database/migrations'
                        ]);
                    echo '<br>done with fresh tables migrations';
            } catch (Exception $e) {
                Response::make($e->getMessage(), 500);
            }
        } else {
            App::abort(404);
        }
    }
}
