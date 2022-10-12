<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserInforRequest;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = $this->userRepository->getUserById(Auth::id());

        return view('user.home.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserInforRequest $request)
    {
        $user = $this->userRepository->getUserById(auth()->id());
        $filename = $user->image;
        if ($request->hasFile('image')) {
            $fileName = strtotime(date('Y-m-d H:i:s')) . "_" . $request->image->getClientOriginalName();
            $img = Image::make($request->image->getRealPath());
            $img->stream();
            Storage::disk('user')->put($fileName, $img, 'public');
            if (!empty($user->image)) {
                Storage::delete('/public/users/' . $user->image);
            }
        }

        $newDetail = [
            'name' => $request->name,
            'email' => $request->email,
            'image' => $fileName,
            'phone' => $request->phone,
            'address' => $request->address
        ];
        $this->userRepository->updateUser(Auth::id(), $newDetail);

        return back()->with('success', __('messages.update.success'));
    }
}
