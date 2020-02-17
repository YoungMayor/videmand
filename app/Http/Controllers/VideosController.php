<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\videos;
use App\purchases;

use Iman\Streamer\VideoStreamer;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class VideosController extends Controller
{
    public function showPage(){
        return view("pages.videos");
    }

    public function getVideos(Request $request){
        $videos = videos::latest()->simplePaginate();
        $videoList = [];

        foreach($videos as $thisVideo){
            $vid = $thisVideo->id;

            $videoList[$vid]['tt'] = $thisVideo->title;
            $videoList[$vid]['ds'] = substr($thisVideo->description, 0 , 70)."...";
            $videoList[$vid]['url'] = route("video.watch", ['token' => $thisVideo->video_page_token]);
            $videoList[$vid]['th'] = $thisVideo->thumb_url;
        }
        if ($videoList){
            $response['list'] = $videoList;
            $response['next'] = $videos->currentPage() + 1;
            return $response;
        }else{
            return [];
        }
    }
    
    public function showSearchPage(Request $request){
        return view("pages.videos", ['search' => $request->term]);
    }

    public function searchVideos(Request $request){
        $videos = videos::search($request->param)
        ->paginate();
        $videoList = [];

        foreach($videos as $thisVideo){
            $vid = $thisVideo->id;

            $videoList[$vid]['tt'] = $thisVideo->title;
            $videoList[$vid]['ds'] = substr($thisVideo->description, 0 , 70)."...";
            $videoList[$vid]['url'] = route("video.watch", ['token' => $thisVideo->video_page_token]);
            $videoList[$vid]['th'] = $thisVideo->thumb_url;
        }
        if ($videoList){
            $response['list'] = $videoList;
            $response['next'] = $videos->currentPage() + 1;
            return $response;
        }else{
            return [];
        }
    }

    public function showMyPage(){
        return view("pages.videos", ['my_vids' => true]);
    }

    public function getMyVideos(Request $request){
        $videos = videos::whereIn("id",
            purchases::select("video_id")
            ->where("user_id", Auth::id())
        )
        ->latest()
        ->simplePaginate();
        $videoList = [];

        foreach($videos as $thisVideo){
            $vid = $thisVideo->id;

            $videoList[$vid]['tt'] = $thisVideo->title;
            $videoList[$vid]['ds'] = substr($thisVideo->description, 0 , 70)."...";
            $videoList[$vid]['url'] = route("video.watch", ['token' => $thisVideo->video_page_token]);
            $videoList[$vid]['th'] = $thisVideo->thumb_url;
        }
        if ($videoList){
            $response['list'] = $videoList;
            $response['next'] = $videos->currentPage() + 1;
            return $response;
        }else{
            return [];
        }
    }

    public function showVideoPage($token){
        $videoDetails = videos::where("video_page_token", $token)
        ->join("users", "videos.uploaded_by", "users.id")
        ->select("*", "videos.created_at AS uploaded_on", "videos.id AS video_id", "videos.video_page_token AS token")
        ->first();

        if (!$videoDetails){
            return abort("404");
        }

        $purchasedObj = purchases::where("user_id", Auth::id())
        ->where("video_id", $videoDetails->video_id)->first();

        $isPurchased = ($purchasedObj) ? true: false;

        return view("pages.watch", ['vd' => $videoDetails, "purchased" => $isPurchased]);
    }

    function streamVideo($token){
        $videoDetails = videos::where("video_page_token", $token)->first();

        $videoURL = $videoDetails->video_url;
        // return redirect($videoURL);
        // // $videoURL = "vids/vid1.mp4";
        // // return mime_content_type($videoURL);

        // // return header("Location: $videoURL");

        // $stream = new VideoStreamer($videoURL);
        // return $stream->start();
        // return response()->streamVideoFile($videoURL);

        // dd($videoURL);
    }
}
