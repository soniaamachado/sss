<?php

namespace App\Http\Controllers;

use App\user;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();

        return response(
            [
                'status' => 200,
                'data' => $users,
                'msg' => 'Ok.',
            ],200
        );
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
        $data = $request->only(['name', 'email', 'password', 'user_role',]);

        $validator = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required',
            'password' => 'required',
            'user_role' => 'required',
        ],
            [
                'name.required' => 'O campo name é obrigatório.',
                'name.max' => 'O campo name só pode ter um máximo de 100 carateres',
                'email.required' => 'O campo email é obrigatório.',
                'password.required' => 'O campo password é obrigatório',
                'user_role.required' => 'O campo user_role é obrigatório.',
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

        $user = \App\Article::create($data);

        return response(
            [
                'status' => 201,
                'data' => $user,
                'msg' => 'Ok.',
            ], 201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user  $user
     *  @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        return response(
            [
                'status' => 200,
                'data' => $user,
                'msg' => 'Ok.',
            ],200
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        $data = $request->only(['name', 'email', 'password', 'user_role',]);

        $validator = Validator::make($data,
            [
                'name' => 'required|max:100',
                'email' => 'required',
                'password' => 'required',
                'user_role' => 'required',
            ],
            [
                'name.required' => 'O campo name é obrigatório.',
                'name.max' => 'O campo name só pode ter um máximo de 100 carateres',
                'email.required' => 'O campo email é obrigatório.',
                'password.required' => 'O campo password é obrigatório',
                'user_role.required' => 'O campo user_role é obrigatório.',
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

        $user->title = $data['title'];
        $user->description = $data['description'];
        $user->image = $data['image'];
        $user->user_id = $data['user_id'];
        $user->save();


        return response(
            [
                'status' => 200,
                'data' => $user,
                'msg' => 'Ok.',
            ], 200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        $user -> delete();

        return response(
            [
                'status' => 200,
                'data' => 'Utilizador apagado.',
                'msg' => 'Ok.',
            ], 200
        );
    }
}
