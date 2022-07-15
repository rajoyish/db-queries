<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {


    DB::transaction(function () {

        // try catch block is not necessary as well as  DB::rollBack(). Laravel automatically rollback transation if on of transaction gets failed;
        try {
            DB::table('users')->delete();

            $result = DB::table('users')->where('id', 1)->update(['email' => 'none']);
            // DB::table('users')->where('id', 3)->update(['email' => 'none@none.com']);

            if (!$result) {
                throw new \Exception;
            }
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }, 5); // optional third argument, how many times a transaction should be reattempted.

    // Selecting 'users' by Query Builder
    $queryBuilder = DB::table('users')->select()->get();
    dump($queryBuilder);
});
