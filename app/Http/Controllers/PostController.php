<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PostController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request ) {
        if ( $request->ajax() ) {
            $post = Post::all();
            return Datatables::of( $post )
                ->addColumn( 'action', function ( $post ) {
                    return "<a class='text-light btn btn-sm btn-info' onclick='showData($post->id)'>Show</a> " .
                        "<a class='text-light btn btn-sm btn-primary' onclick='editData($post->id)'>Edit</a> " .
                        "<a class='text-light btn btn-sm btn-danger' onclick='deleteData($post->id)'>Delete</a>";
                } )
                ->make( true );
        }
        return view( 'postAjax' );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {
        $data = [
            'name'   => $request['name'],
            'email'  => $request['email'],
            'mobile' => $request['mobile'],
        ];
        return Post::create( $data );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show( $id ) {
        //single data show here
        $post = Post::find( $id );
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit( $id ) {
        $post = Post::find( $id );
        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id ) {
        $post         = Post::find( $id );
        $post->name   = $request['name'];
        $post->email  = $request['email'];
        $post->mobile = $request['mobile'];
        $post->update();
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id ) {
        Post::destroy( $id );
    }
}
