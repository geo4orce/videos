<?php

/**
 * @var string $active_page current route
 * @var array $videos
 */

$num = count($videos);

?>

@extends('layouts.app')

@include('modal.view')
@include('modal.edit')
@include('modal.del')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('inc.tabs', [
                'active_page' => $active_page,
            ])

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <h2>You have {{$num}} {{str_plural('video', $num)}}:</h2>

            <table class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Duration</th>
                    <th scope="col">File Size</th>
                    <th scope="col">Video Format</th>
                    <th scope="col">Bitrate</th>
                    <th scope="col">Likes</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($videos as $video)
                    <?php /** @var \App\Video $video */ ?>
                    <tr
                        data-toggle="modal"
                        data-target="#exampleModal"
                        data-id="{{$video->id}}"
                        data-name="{{$video->name}}"
                        data-liked="{{$video->liked}}"
                    >
                        <th scope="row">{{$video->name}}</th>
                        <td>{{$video->duration}}</td>
                        <td>{{$video->size}}</td>
                        <td>{{$video->format}}</td>
                        <td>{{$video->bitrate}}</td>
                        <td>{{$video->likes}}</td>
                        <td>
                            <button
                                data-toggle="modal"
                                data-target="#viewModal"
                                data-id="{{$video->id}}"
                                data-name="{{$video->name}}"
                            >View</button>
                            <button
                                data-toggle="modal"
                                data-target="#editModal"
                                data-id="{{$video->id}}"
                                data-name="{{$video->name}}"
                                data-location_id="{{$video->location->id}}"
                                data-keywords="{{$video->keywords}}"
                            >Edit</button>
                            <button
                                data-toggle="modal"
                                data-target="#delModal"
                                data-id="{{$video->id}}"
                                data-name="{{$video->name}}"
                            >Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
