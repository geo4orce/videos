<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(\Auth::check(), 503, 'must be logged in');

        $file = $request->file('video');
        abort_unless($file, 503, 'file cannot be empty');

        abort_unless($file->getMimeType() == 'video/mp4', 503, 'file must be mp4');

        // store on disk
        $path = $file->store('videos');

        // create DB record
        $video = new Video;
        $video->name = $request->get('name');
        $video->parsePath($path);
        $video->user_id = \Auth::id();
        $video->save();

        return back()->with('status', 'Video uploaded!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        if (!\Storage::exists($video->path)) {
            abort(404);
        }

        $response = response(\Storage::get($video->path), 200);
        $response->header('Content-Type', $video->format);

        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        abort_unless(\Auth::check(), 503, 'must be logged in');
        abort_unless($video->owner->id == \Auth::id(), 503, 'only can edit your own');

        // update DB record
        $video->name = $request->get('name');
        $video->location_id = $request->get('location_id');
        $video->keywords()->sync($request->get('keywords'));
        $video->save();

        return back()->with('status', 'Video updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        abort_unless(\Auth::check(), 503, 'must be logged in');
        abort_unless($video->owner->id == \Auth::id(), 503, 'only can delete your own');

        // delete from disk
        \Storage::delete($video->path);

        // delete DB record
        $video->delete();

        return back()->with('status', 'Video deleted!');
    }

    public function like($id)
    {
        abort_unless(\Auth::check(), 503, 'must be logged in');

        try {
            $out = \DB::table('likes')->insert([
                'user_id' => \Auth::id(),
                'video_id' => $id,
            ]);
        } catch (\Exception $e) {
            \Log::error('probably constraint violation');
            return 500;
        }

        return $out ? 200 : 500;
    }

    public function unlike($id)
    {
        abort_unless(\Auth::check(), 503, 'must be logged in');

        try {
            $out = \DB::table('likes')
                ->where('user_id', \Auth::id())
                ->where('video_id', $id)
                ->delete();
        } catch (\Exception $e) {
            \Log::error('probably constraint violation');
            return 500;
        }

        return $out ? 200 : 500;
    }
}
