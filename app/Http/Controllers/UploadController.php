<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Cloudder;
use App\videos;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    public function showForm(){
        return view("pages.upload");
    }

    public function saveUpload(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => ['required','string', 'min:6', 'max:255'],
            'description' => ['required', 'min:12', 'max:1024'],
            'link_video' => ['nullable', 'required_without:upload_video', 'regex:/^(http(s)?:\/\/)?(www.)?youtube.com\/watch\?v=([A-z0-9\_\-]){4,48}/'],
            'upload_video' => ['nullable', 'required_without:link_video', 'file', 'mimes:3gpp,mp4,webm,mpeg,3gp']
        ], [
            'title.required' => "Please enter a title for this video clip", 
            'title.string' => "Title must be of type string!", 
            'title.min' => "Title too short", 
            'title.max' => "Title too long", 
            'description.required' => "Give a descriptive information about this video clip", 
            'description.min' => "Description too short", 
            'description.max' => "Description too long", 
            'link_video.required_without' => "Please enter url of youtube video, or upload a video below", 
            'upload_video.required_without' => "Please attach a video file or enter link to youtube video above", 
            'upload_video.file' => "Invalid Upload!!!", 
            'upload_video.mimes' => "Unsurported video format uploaded", 
        ])->validate();


        if ($request->hasFile("upload_video")){
            $videoPath = $request->file("upload_video")->getRealPath();
            Cloudder::uploadVideo($videoPath);

            $uploadObj = Cloudder::getResult();

            $publiID = $uploadObj['public_id'];
            $fileFormat = $uploadObj['format'];

            $vidURL = $uploadObj['secure_url'];
            $thumbURL = str_replace("$publiID.$fileFormat", "$publiID.jpg", $vidURL);
        }else{
            $vidURL = $request->link_video;
            $fetch = explode("v=", $vidURL);
            $videoID = $fetch[1];
            $vidURL = "https://www.youtube.com/embed/$videoID?autoplay=1";
            $thumbURL =  "http://img.youtube.com/vi/$videoID/mqdefault.jpg";
        }

        $videoObj = new videos;

        $videoObj->fill(
            [
              "title" => $request->title,
              "description" => $request->description,
              "uploaded_by" => Auth::id(),
              "video_page_token" => md5(time().uniqid().Auth::id()),
              "stream_url" => md5(Auth::id().time().uniqid()),
              "video_url" => $vidURL,
              "thumb_url" => $thumbURL,
            ]
        );

        $videoObj->save();

        return redirect()->route("video.upload");
            
        dd($request);
    }
}

