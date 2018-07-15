<?php

/**
 * @var string $active_page current route
 */

?>
@extends('layouts.app')

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

            <h2>Upload new:</h2>
            <form method="POST" action="/videos" enctype="multipart/form-data">
                <input name="name" placeholder="Title" required /><br>
                <input type="file" name="video" accept="video/mp4" required /><br>
                <input type="submit">
                @csrf
            </form>

        </div>
    </div>
</div>
@endsection
