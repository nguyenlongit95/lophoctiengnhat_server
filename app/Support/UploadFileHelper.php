<?php

namespace App\Support;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UploadFileHelper
{
    /**
     * Function upload video to server
     *
     * @param array $request
     * @param int $id of course thematic
     * @param string $path public path store
     * @return mixed
     */
    public function uploadVideos($request, $id, $path)
    {
        if ($request->hasFile('video_link_upload')) {
            $file = $request->file('video_link_upload');
            $fileExt = $file->getClientOriginalExtension();
            if ($fileExt === 'mp4' || $fileExt === 'flv') {
                $fileName = 'video_'. $id . '_' .$file->getClientOriginalName();
                try {
                    $request->file('video_link_upload')->move(public_path($path), $fileName);
                    return $fileName;
                } catch (\Exception $exception) {
                    Log::error($exception);
                }
            } else {
                return 1; // error extension
            }
        } else {
            return 0; // File not found
        }
    }

    /**
     * Function check file and move file to storage path
     *
     * @param $request
     * @return int or string avatar name
     */
    public function uploadAvatar($request)
    {
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $ext = $avatar->getClientOriginalExtension();
            IF ($ext == 'png' || $ext == 'jpg') {
                if ($avatar->getSize() >= 2049432) {
                    return 1; // error file size
                }
                $avatarName = 'avatar_user_' . Auth::user()->id . '_' . $avatar->getClientOriginalName();
                try {
                    $request->file('avatar')->move(public_path('/source/images/avatar/'),  $avatarName);
                    return $avatarName;
                } catch (\Exception $exception) {
                    Log::error($exception);
                    return 2; // System error, cannot move file to storage
                }
            } else {
                return 0; // error file ext
            }
        }
    }
}
