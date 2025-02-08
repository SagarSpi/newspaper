<?php

namespace App\Http\Controllers\Backend;

use App\Models\Backend\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $users = User::orderBy('created_at','DESC')
                    ->paginate(9);

        return view('backend.users',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {   

        // Default Image 
        $uploadedFileUrl = 'https://res.cloudinary.com/demeqriqu/image/upload/v1739026688/Newspaper/Users-image/Default_image/user_default_image.png';
        $public_id = 'Newspaper/Users-image/Default_image/user_default_image';

        if ($request->hasFile('image')) {

            $timeStamp = Carbon::now()->format('Y-M');
            $folderName = 'Newspaper/Users-image/'.$timeStamp;
            $imageUniqueName = time();

            // Upload with image to cloudinary
            $uploadimage = cloudinary()->upload($request->file('image')->getRealPath(), [
                'folder' => $folderName,
                'public_id'=> $imageUniqueName
            ]);

            $uploadedFileUrl = $uploadimage->getSecurePath();
            $public_id = $uploadimage->getPublicId();
        }

        $User = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'image_url'=>$uploadedFileUrl,
            'image_id'=>$public_id,
            'contacts'=>$request->number,
            'role'=>$request->role,
            'status'=>'active'
        ]);

        return redirect()->route('login')->with('success','Users Created Succesfully!');
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
        $user = User::findOrFail($id);

        return view('backend.userEdit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {   
        $user = User::findOrFail($id);
        
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
