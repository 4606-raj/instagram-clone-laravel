@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-4">
            <img src="{{ $user->profile->profileImage() }}" class="rounded-circle" width="60%">
        </div>
        <div class="col-9 pt-4">
            <div class="d-flex justify-content-between align-items-baseline">

                <div class="d-flex align-items-center pb-3">
                    <div class="h4">{{ $user->username }}</div>

                    @auth()
                        @if(auth()->user()->id != $user->id)
                            <follow-button user-id="{{ $user->id }}" follows={{ $follows }}></follow-button>
                        
                        @endif
                    @endauth

                </div>

                @can('update', $user->profile)
                    <a href="/p/create" >Add New Post</a>
                @endcan
            </div>
                @can('update', $user->profile)
                    <a href="/profile/{{ $user->id }}/edit" >Edit Profile</a>
                @endcan
            <div class="d-flex">
                <div class="pr-5"><strong>{{ $postCounter }}</strong> posts</div>
                <div class="pr-5" id="followersHere"><strong>{{ $followersCounter }}</strong> followers</div>
                <div class="pr-5"><strong>{{ $followingCounter }}</strong> following</div>
            </div>
            <div class="pt-3 font-weight-bold">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="#">{{ $user->profile->url }}</a></div>
        </div>
    </div>
    <div class="row pt-5">

        @foreach($user->posts as $post)
            <div class="col-4 pb-4">
                <a href="/p/{{ $post->id }}">
                    <img src="/storage/{{ $post->image }}" class="w-100">
                </a>
            </div>

        @endforeach
        
    </div>
</div>
@endsection
