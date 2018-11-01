<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\Article\ArticleStoreRequest;
use App\User;
use Illuminate\Http\Request;
use Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $article = Article::all();

        return response(
            [
                'status' => 200,
                'data' => $article,
                'msg' => 'Ok.',
            ],200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(ArticleStoreRequest $request)
    {
        $data = $request->only(['title', 'description', 'image', 'user_id',]);

        $users= User::pluck('id')->toArray();
        $data['user_id'] = array_rand($users);
        //random user pois ainda não se sabe os id dos users

        $path = $request-> file('image')->store('Article_Images');
        $data['image']= $path;
        //
        $article = Article::create($data);

        return response(
            [
                'status' => 201,
                'data' => $article,
                'msg' => 'Ok.',
            ], 201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return $article;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //

        $data = $request->only(['title', 'description', 'image', 'user_id',]);

        $users= User::pluck('id')->toArray();
        $data['user_id'] = array_rand($users);
        //random user pois ainda não se sabe os id dos users

        $path = $request-> file('image')->store('Article_Images');
        $data['image']= $path;
        //
        $article = Article::create($data);

        $article->save();

        return response(
            [
                'status' => 201,
                'data' => $article,
                'msg' => 'Ok.',
            ], 201
        );
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //

        $article -> delete();

        return response(
            [
                'status' => 200,
                'data' => 'Registo apagado.',
                'msg' => 'Ok.',
            ], 200
        );
    }
}
