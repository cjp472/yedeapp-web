<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * User profile show page.
     *
     * @param  App\Models\User  $user
     * @return View
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
    
    /**
     * User profile editing page.
     *
     * @param  App\Models\User  $user
     * @return View
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * User profile updating.
     *
     * @param  App\Http\Requests\UserRequest  $request
     * @param  App\Models\User  $user
     * @return View
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('users.show', $user->id)->with('success', '更新成功');
    }
}
