<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Announce;
use App\Http\Resources\AnnounceResource;
use App\Http\Resources\AnnounceResourceCollection;
use DB;

class AnnounceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ann = Announce::all();
        return new AnnounceResourceCollection($ann);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ann = DB::table('announces')->insert([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        if (!$ann){
            return response()->json(['status' => 1]);
        }else {
            return response()->json(['status' => 0, 'post' => $ann]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ann = Announce::find($id);
        return new AnnounceResource($ann);
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
        $result = DB::table('announces')
                    ->where('id',$id)
                    ->update([
                        'title' => $request->title,
                        'content' => $request->content,
                    ]);
        if (!$result) {
            return response()->json(['status' => 1, 'message' => 'Post not found'],404);
        }else {
            return response()->json(['status' => 0]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ann = Announce::find($id);
        if ($ann != null){
            $ann->delete();
            return response()->json(null,204);
        }else {
            return response()->json(['message' => 'Wrong ID']);
        }
    }
}
