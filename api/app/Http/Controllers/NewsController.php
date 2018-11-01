<?php

namespace App\Http\Controllers;

use App\Article;
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

    public function store(Request $request)
    {
        //

        $data = $request->only(['title', 'description', 'image', 'user_id',]);

        $validator = $request->validate([
                'title' => 'required|max:150',
                'description' => 'required',
                'image' => 'required',
                'user_id' => 'required|exists:users,id',
            ],
            [
                'title.required' => 'O campo título é obrigatório.',
                'title.max' => 'O campo título só pode ter um máximo de 150 carateres',
                'description.required' => 'O campo descrição é obrigatório',
                'image.required' => 'O campo imagem é obrigatório.',
                'user_id.required' => 'O campo ID Utilizador é obrigatório.',
                'user_id.exists' => 'O campo ID Utilizador tem que estar ligado a um utilizador existente.',
            ]);
        if ($validator->fails()) {
            return response(
                [
                    'status' => 400,
                    'data' => $validator->errors()->all(),
                    'msg' => 'Erro.',
                ], 400
            );
        }

        $article = \App\Article::create($data);

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
        //

        return response(
            [
                'status' => 200,
                'data' => $article,
                'msg' => 'Ok.',
            ],200
        );
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

        $data = $request->only(['title', 'description', 'image', 'user_id']);



        $validator = Validator::make($data,
            [
                'title' => 'required|max:255',
                'description' => 'required',
                'image' => 'required',
                'user_id' => 'required|exists:users,id',
            ],
            [
                'title.required' => 'O campo título é obrigatório.',
                'title.max' => 'O campo título só pode ter um máximo de 255 carateres',
                'description.required' => 'O campo descrição é obrigatório',
                'image.required' => 'O campo imagem é obrigatório.',
                'user_id.required' => 'O campo ID Utilizador é obrigatório.',
                'user_id.exists' => 'O campo ID Utilizador tem que estar ligado a um utilizador existente.',
            ]);

        if ($validator->fails()) {
            return response(
                [
                    'status' => 400,
                    'data' => $validator->errors()->all(),
                    'msg' => 'Erro.',
                ], 400
            );
        }

        $article->title = $data['title'];
        $article->description = $data['description'];
        $article->image = $data['image'];
        $article->user_id = $data['user_id'];
        $article->save();


        return response(
            [
                'status' => 200,
                'data' => $article,
                'msg' => 'Ok.',
            ], 200
        );

    }

//    public function imageUpload (Request $request){
//        $article = Auth::article();
//        $article-> image = $request ['title'];
//        $article-> update();
//
//        $file = $request->file('image');
//        $filename = $request ['image'].'-'.$article->$article->id.'.jpg';
//        if ($file){
//            Storage::disk('local')->put($filename, File::get($file));
//        }
//        return redirect()->route('article');
//    }

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
