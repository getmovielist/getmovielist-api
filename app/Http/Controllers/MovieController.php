<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MovieController extends BaseController
{
    public function __construct()
    {
        $this->classe = Movie::class;
    }


    public function showPop(string $id)
    {
	    $url = 'http://popcorn-ru.tk/movie/'.$id;
	    $ch = curl_init($url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        return response()->json(json_decode(curl_exec($ch)));
    }

}
