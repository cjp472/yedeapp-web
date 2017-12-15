<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Handlers\ImageUploadHandler;

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
     * @param  App\Handlers\ImageUploadHandler  $uploader
     * @param  App\Models\User  $user
     * @return View
     */
    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        $data = $request->all();

        // Set tha avatar's width to 362px
        $avatar_max_width = 362;

        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id, $avatar_max_width);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);
        
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功');
    }
}
