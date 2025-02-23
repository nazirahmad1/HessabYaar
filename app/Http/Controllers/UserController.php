<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

    
         // try {
        //     $limit = $request->has('limit') ? $request->limit : 10;
        //     // $user = User::where('status',1) ->where('role','admin') ->orWhere('role','superadmin') ->orderBy('id', 'desc') ->paginate($limit);
        //     $users = User::where('status', 1)->whereIn('role', ['admin', 'superadmin']) ->orderBy('id', 'desc') ->paginate($limit);
        //     if ($users->isEmpty()) {
        //         return response()->json(['کاربری برای نمایش وجود ندارد']);
        //     }
    
        //     $totalPages = $users->lastPage();
    
        //     return response()->json(['users' => $users, 'total_pages' => $totalPages]);
        // } catch (Exception $e) {
        //     return response()->json(['error' => $e->getMessage()], 500);
        // }

        try {
            $currentUser = Auth::user()->id;
            $user = User::where('id',$currentUser)->first();

            return view('profile.index',['user'=>$user]);
           

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
