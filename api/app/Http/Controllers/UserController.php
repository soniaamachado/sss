<?php

namespace App\Http\Controllers;

use App\Article;
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

        return $users;
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
        $data['password'] = bcrypt($data['password']);

        $user = \App\User::create($data);

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
       return $user;
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

        if ($request->only(['name'])){
            $user->name = $data['name'];
        }
        if ($request->only(['email'])){
            $user->email = $data['email'];
        }
        if ($request->only(['password'])){
            $user->password = $data['password'];
        }
        if ($request->only(['user_role'])){
            $user->user_role = $data['user_role'];
        }

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
                'data' => $user,
                'msg' => 'Utilizador apagado com sucesso',
            ], 200
        );
    }
    public function getArticles (User $user){
        $result = Article::with('user')->get()->where('user',$user);

        return response(
            [
                'status' => 200,
                'data' => $result,
                'msg' => 'ok!',
            ], 200
        );
    }
}
