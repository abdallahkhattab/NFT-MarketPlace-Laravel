<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProfileRequest;
use App\Traits\imageUploadTrait;

class ProfileController extends Controller
{
    use imageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validated();

        $data['user_id'] = Auth::id();
        
        Profile::create($data);

        return redirect()->back()->with(['message'=> 'success']);
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
    public function edit(Profile $profile)
    {
        $user = Auth::user();
        $profile = $user->profile;
        $wallet = $user->wallet;
        return view('profile.custom-edit-profile',compact('profile','user','wallet'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProfileRequest $request , Profile $profile)
    {
        $data = $request->validated();

        $data['user_id'] = Auth::id();

           // Handle avatar upload
    if ($request->hasFile('avatar')) {
        $data['avatar'] = $this->uploadImage($request->file('avatar'),'profile');
    }

    // Handle background image upload
    if ($request->hasFile('background_image')) {
        $data['background_image'] =$this->uploadImage($request->file('background_image'),'profile'); 
    }

       
        $profile->update($data);

        return redirect()->back()->with(['message'=> 'success']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
