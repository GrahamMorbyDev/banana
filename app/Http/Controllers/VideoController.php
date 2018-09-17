<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;

class VideoController extends Controller
{
    // Get All Videos
    public function get()
    {
        $videos = new Video();
        $videos = $videos->latest()->get();
        return $videos;
    }

    // Get a Single Video
    public function single(Request $request)
    {
        $video = new Video();
        $id = $request->get('id');
        if ($id) {
            $video = $video->where('id', $id)->first();
        }
        return $video;
    }

    //Upload a Video
    public function post(Request $request)
    {
        //Validate the Video
        $this->validateVideo($request);

        //Image
        $imagepath = $request->file('featuredimage')->store('videoimages');

        $title = $request->get('title') . ".mp4";

        //Video
        $videopath = $request->file('filename')->storeAs('videos', $title);

        //Open Video Model
        $video = new Video();

        //Video Params
        $video->title = $request->get('title');
        $video->description = $request->get('description');
        $video->featuredimage = $imagepath;
        $video->filename = $videopath;
        $video->storeId = $request->get('storeId');
        $video->filesize = $request->get('filesize');

        //Save Video
        $video->save();

        //Return Statement
        return 200;

    }

    //Validate Video
    public function validateVideo(Request $request, $new = true)
    {

        if ($new) {
            $this->validate($request, [
                'featuredimage' => 'required||max:1000000',
                'filename' => 'required||max:1000000'
            ]);
        }

        $this->validate($request, [
            'title' => 'required||max:191',
            'description' => 'required'
        ]);

    }

    // Delete a Video
    public function delete(Request $request)
    {
        $video = new Video;
        $video = $video->find($request->get('id'));
        $video->delete();
        return 'Video Deleted';
    }
}
