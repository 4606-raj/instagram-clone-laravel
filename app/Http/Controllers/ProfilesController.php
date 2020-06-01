<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
 	public function index($user) {
    	$user = User::findOrFail($user);

        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;


        // $postCounter = Cache::remember(
        //     'count.posts.'.$user->id, 
        //     now()->addSeconds(30), 
        //     function() use ($user) {
        //         return $user->posts->count();
        //     });

        // $followersCounter = Cache::remember(
        //     'count.followers.'.$user->id, 
        //     now()->addSeconds(30), 
        //     function() use ($user) {
        //         return $user->profile->followers->count();
        //     });

        // $followingCounter = Cache::remember(
        //     'count.following.'.$user->id, 
        //     now()->addSeconds(30), 
        //     function() use ($user) {
        //         return $user->following->count();
        //     });

        $postCounter = $user->posts->count();
        $followersCounter = $user->profile->followers->count();
        $followingCounter = $user->following->count();


        // return view('profiles.index', [
        // 	'user' => $user, 
        //     'follows' => $follows,
        // ]);
        
        return view('profiles.index', compact('user', 'follows', 'postCounter', 'followersCounter', 'followingCounter'));
    }

    public function edit(User $user) {

        $this->authorize('update', $user->profile); 

    	return view('profiles.edit', compact('user'));

    }

    public function update(User $user) {

        $this->authorize('update', $user->profile); 

    	$data = request()->validate([
    		'title' => 'required',
    		'description' => 'required',
    		'url' => 'url',
            'image' => '',
    	]);

        $imagePath = '';
        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

		auth()->user()->profile->update(array_merge($data, $imageArray ?? []));

		return redirect("/profile/{$user->id}");
    }

    // to update follwers number onclick follow button in profile view.
    public function some($user) {

        $user = User::findOrFail($user);
        return $user->profile->followers->count();

    }

}
