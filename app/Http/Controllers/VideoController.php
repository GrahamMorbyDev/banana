<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;

class VideoController extends Controller
{
    // Get All Videos
    public function get() {
        $videos = new Video();
        $videos = $videos->latest()->get();
        return $videos;
    }

    // Get a Single Video
    public function single(Request $request) {
        $video = new Video();
        $id = $request->get('id');
        if ($id)
        {
            $video = $video->where('id', $id)->first();
        }
        return $video;
    }

    // Upload a Video
    public function post(Request $request)
    {
        if ($request->get('id')) {
            if ($this->updateVideo($request)) {
                return redirect()->back()->with('alert-success', 'Updated Successfully');
            } else {
                return redirect()->back()->with('alert-warning', 'Updated not Successful');
            }
        } else {
            $this->validateVideo($request);
            //image
            $imagepath = $request->file('featuredimage')->store('videoimages');
            //video
            $videopath = $request->file('filename')->store('videos');

            $video = new Video();
            $video->title = $request->get('title');
            $video->description = $request->get('description');
            $video->featuredimage = $imagepath;
            $video->filename = $videopath;

            $video->save();
            return redirect()->route('editVideo', ['id' => $video->id])->with('alert-success', 'Uploaded Successfully');
        }
    }

    //Validate Video
    public function validateVideo(Request $request, $new = true)
    {

        if ($new)
        {
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
    public function delete(Request $request) {
        $video = new Video;
        $video = $video->find($request->get('id'));
        $video->delete();
        return 'Video Deleted';
    }
}
