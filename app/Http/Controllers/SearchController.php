<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Alert;

class SearchController extends Controller
{
    //Valid input for user searches
    private $validUserSearchData = ['email'];

    public function searchUsers(Request $request) {
        $searchQuery = $request->only($this->validUserSearchData);
        $results = SearchService::getUserByEmail($searchQuery['email']);

        return response()->json($results);
    }
}