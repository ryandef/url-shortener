<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $find = Link::where('url', $request->url)->first();
        if($find) {
            $json = array();
            $json['status'] = 200;
            $json['url'] = route('link.detail', $find->short_url);

            return response()->json($json);
        }

        $data = new Link();
        $data->url = $request->url;
        $check = 0;

        do{
            $url = Str::random(5);
            $exists = Link::where('short_url', $url)->count();
            if($exists > 0){
                $check = 1;
            }

        }while($check == 1);

        $data->short_url = $url;
        $data->save();

        $json = array();
        $json['status'] = 200;
        $json['url'] = route('link.detail', $data->short_url);

        return response()->json($json);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Link::where('short_url', $id)->first();

        if($data) {
            $data->hits += 1;
            $data->save();
            return redirect($data->url);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
