<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {

    // Plain SQL by PDO
    $pdo = DB::connection()->getPdo();
    $users = $pdo->query('select * from users')->fetchAll();
    dump($users);

    // RAW SQL
    $result = DB::select('select * from users where id = ? && name = ?', [1, 'Dr. Roosevelt Hackett']);
    $result = DB::select('select * from users where id = :id', ['id' => 2]);
    DB::insert('insert into users (name, email, password) values(?, ?, ?)', ['Bobby Padilla', 'nutokebu@osiza.km', 'password']);
    $affected = DB::update('update users set email = "rajoyish@gmail.com" where email = ?', ['nutokebu@osiza.km']);
    dump($affected);
    $deleted = DB::delete('delete from users where id = ?', [1]);
    dump($deleted);


    // Selecting 'users' by RAW SQL
    $rawSql = DB::select('select * from users');
    dump($rawSql);

    // Selecting 'users' by Query Builder
    $queryBuilder = DB::table('users')->select()->get();
    dump($queryBuilder);

    // Selecting 'users' by Eloquent ORM
    $eloquentOrm = User::all();
    dump($eloquentOrm);


    return view('welcome');
});
