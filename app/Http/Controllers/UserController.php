<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use App\Handlers\ImageUploadHandler;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Auth all the methods except show.
        $this->middleware('auth');
    }

    /**
     * User profile show page.
     *
     * @param  App\User  $user
     * @return View
     */
    public function show(User $user, $tab = 'history')
    {
        $items_per_page = 15;

        switch ($tab) {
            case 'favorite':
                $items = $user->vote->topics()->orderBy('created_at', 'desc')->with('course')->paginate($items_per_page);
                break;
                
            case 'comment':
                $items = $user->comments()->orderBy('created_at', 'desc')->with('course','topic')->paginate($items_per_page);
                break;

            case 'history':
            default: // history
                $items = [];
                break;
        }
        
        return view('user.show', compact('user', 'items', 'tab'));
    }
    
    /**
     * User profile editing page.
     *
     * @param  App\User  $user
     * @return View
     */
    public function edit(User $user)
    {
        // Laravel's base class 'Controller' has a trait called 'AuthorizesRequests',
        // and this trait has a method called 'authorize()' which could use the UserPolicy
        // methods to auth UsersContoller methods.
        $this->authorize('update', $user);

        return view('user.edit', compact('user'));
    }

    /**
     * User profile updating.
     *
     * @param  App\Http\Requests\UserRequest  $request
     * @param  App\Handlers\ImageUploadHandler  $uploader
     * @param  App\User  $user
     * @return View
     */
    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        $this->authorize('update', $user);
        
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
        
        return redirect()->route('user.show', $user->id)->with('success', '更新成功');
    }
}
