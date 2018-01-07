<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {
    $query = $request->search;
    if(isset($query)){
        $found = DB::table('searches')->where('query', $query)->first();
        if(isset($found->query)) {
            // it was a term that was searched before
            DB::table('searches')->increment('accesses');
            $accesses = $found->accesses;
        }
        else {
            if($query[0]!="*"){
                DB::table('searches')->insert(
                    ['query' => $query,
                    "created_at" =>  \Carbon\Carbon::now(), 
                    "updated_at" => \Carbon\Carbon::now(),
                    ]
                );
                $accesses = 0;
            }
        }
        if($query[0]=='*') {
            return redirect('resource/'.ltrim($query,"* "));
        }
        $searches = DB::table('searches')->get();
        $redirect = "http://google.com/search?query=".$query;
        return view('welcome')
            ->with('redirect', $redirect)
            ->with('accesses', $accesses)
            ->with('history_list', $searches);
    }
    $searches = DB::table('searches')->get();
    return view('welcome')
        ->with('history_list', $searches);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/add', 'ResourcesController@create');

Route::resource('resource', 'ResourcesController');