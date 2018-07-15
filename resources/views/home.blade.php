<?php

/**
 * @var string $active_page current route
 * @var array $videos
 */

$num = count($videos);

?>

@extends('layouts.app')

@include('modal.view', [

])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('inc.tabs', [
                'active_page' => $active_page,
            ])

            <h2>We found {{$num}} {{str_plural('video', $num)}} in the world:</h2>

            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Likes</th>
                    <th scope="col">Author</th>
                    <th scope="col">Location</th>
                    <th scope="col">Keywords</th>
                </tr>
                </thead>
                <tbody>
                <?php /** @var \App\Video $video */ ?>
                @foreach ($videos as $video)
                    <tr
                        data-toggle="modal"
                        data-target="#viewModal"
                        data-id="{{$video->id}}"
                        data-name="{{$video->name}}"
                        data-liked="{{$video->liked}}"
                    >
                        <th scope="row">{{$video->name}}</th>
                        <td>{{$video->duration}}</td>
                        <td>{{$video->likes}}</td>
                        <td>{{$video->owner->name}}</td>
                        <td>{{$video->location->name}}</td>
                        <td>{{$video->keywords_string}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
