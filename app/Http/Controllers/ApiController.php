<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    public function movies(){
        $search_keyword = $_GET['search_keyword']??'';
        $client = new Client();
        $response = $client->request('GET', 'http://www.omdbapi.com/?s='.$search_keyword.'&apikey=947437ac');
        $searched_movies = json_decode($response->getBody(), true);
        return view('frontend.api.movies', compact('searched_movies'));
    }
}
