<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class CreateDatabase extends Command
{
    protected $signature = 'run:create-database';
    protected $description = 'create new database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        DB::statement('CREATE DATABASE csi');
    }
}
