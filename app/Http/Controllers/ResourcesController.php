<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resource;
use DB;

class ResourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "test";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('resources.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);
        
        $resource = Resource::where('title', '=', $request->title)->first();
        if(isset($resource)){
            DB::table('searches')->increment('accesses');
            Resource::where('title','=',$request->title)
                ->update(['body' => $request->body]);
        }
        else{
            $resource = new Resource();
            $resource->setValues(            
                $request->input('title'),
                $request->input('body')
                );
            $resource->save();  
            
            //add to search dropdown
            DB::table('searches')->insert(
                ['query' => '* '.$resource->title,
                "created_at" =>  \Carbon\Carbon::now(), # \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # \Datetime()
                ]
            );
            return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($title)
    {
        $searchTerm = DB::table('searches')->where('query', '* '.$title)->first();
        $accesses = $searchTerm->accesses;
        $resource = Resource::where('title', '=', $title)->first();
        return view('resources.show')
            ->with('title', $resource->title)
            ->with('body', $resource->body)
            ->with('accesses', $accesses);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($title)
    {
        $resource = Resource::where('title', '=', $title)->first();
        return view('resources.edit')
            ->with('title', $resource->title)
            ->with('body', $resource->body);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // caught by store
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $title
     * @return \Illuminate\Http\Response
     */
    public function destroy($title)
    {
        //$resource = Resource::where('title', '=', $title)->first()->delete();
        DB::table('resources')
          ->where('title', '=', $title)
          ->delete();
        DB::table('searches')
          ->where('query', '=', "* ".$title)
          ->delete();
    }
}
