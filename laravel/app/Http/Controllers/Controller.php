<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // Translate on/off to 1/0
    public function setBoolean($value)
    {
        if ($value == 'on') {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * Remove old profile image from user
     */
    protected function deleteOldImage($type, $oldImage)
    {
        if ($type == 'user-avatar') {
            if (auth()->user()->image) {
                Storage::disk('local')->delete('public/images/profiles/'.auth()->user()->image);
            }
        } else {
            Storage::disk('local')->delete('public/images/'.$type.'/'.$oldImage);
        }
    }
}
