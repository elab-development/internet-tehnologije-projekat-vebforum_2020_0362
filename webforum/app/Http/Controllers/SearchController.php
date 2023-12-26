<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Http\Resources\ThreadResource;

class SearchController extends Controller
{
    public function searchThread(Request $request)
    {
        $query = Thread::query();

        //Pretrazuje se po imenu auta
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        //Paginacija samo auta koji zadovoljavaju uslov za name
        $page = $request->input('page', 1);
        $perPage = 2;

        $threads = $query->orderBy('name')->paginate($perPage, ['*'], 'page', $page);

        if($threads->isEmpty()){
            return response()->json(['message' => 'There arent any threads that match your search criteria.'], 404);
        }
        return response()->json(['Current page: ' => $threads->currentPage(), 'Last page:' => $threads->lastPage(),
         'Threads that match your search criteria:' => ThreadResource::collection($threads)], 200);
    }
}
