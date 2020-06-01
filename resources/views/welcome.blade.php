@extends('layouts.app')

@section('content')

    <div class="container col-6 my-4 py-4" style="text-align: center; background-color: #f0f0fe">
        <h1>Welcome To freeCodeGram </h1>
        <h3>Here are some of trending posts, Follow and Explore</h3>
    </div>

   <div class="container">
        @foreach ($posts as $post)
            @if ($post->user->profile->followers->count() > 0)
                <div class="row">
                   <div class="col-6 offset-3">
                      <a href="/profile/{{ $post->user->id }}">
                         <img src="/storage/{{ $post->image }}" alt="Post Image" class="w-100">
                      </a>
                   </div>
                </div>

                <div class="row pt-2 pb-4">

                   <div class="col-6 offset-3">
                      <div class="d-flex align-items-center">
                         
                         
                        <span class="font-weight-bold" style="margin-right: 2% !important;">
                            <a href="/profile/{{ $post->user->id }}">
                                <span class="text-dark">{{ $post->user->username }}</span>
                            </a>
                        </span>
                            
                        <span style="flex-basis: 80%;">{{ $post->caption }}</span>
                         

                         {{-- <follow-button user-id="{{ $post->user->id }}"></follow-button> --}}
                         @php
                            $follows = (auth()->user()) ? auth()->user()->following->contains($post->user->id) : false;

                        @endphp

                        @auth()
                          @if(auth()->user()->id != $post->user->id)
                            <follow-button user-id="{{ $post->user->id }}" follows={{ $follows }}></follow-button>
                          @endif
                        @endauth

                      </div>
                        <hr>
                </div>
             </div>
            @endif
         @endforeach

         <div class="row d-flex justify-content-center">
            {{-- {{ $posts->links() }} --}}
         </div>
   </div>
@endsection
