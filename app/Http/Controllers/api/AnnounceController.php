<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DB\Announce;
use DB;

class AnnounceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function annList()
    {
        $ann = Announce::all();
        return response()->json($ann);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newAnn(Request $request)
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
    public function designAnn($id)
    {
        $ann = Announce::find($id);
        return response()->json($ann);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAnn(Request $request, $id)
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
    public function delAnn($id)
    {
        $ann = Announce::find($id);
        if ($ann != null){
            $ann->delete();
            return $ann;
        }else {
            return response()->json(['message' => 'Wrong ID']);
        }
    }
    public function NewList(){
        $ann = Announce::all();
        return response()->json($ann);
    }
}
