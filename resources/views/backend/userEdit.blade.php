@extends('backend.layouts.headerSidebar')

@section('title')
    Edit User
@endsection

@section('content')
    <div class="edit-user-section">
        <div class="row">
            <div class="col-6">
                <div class="heading">
                    <h5>Edit Users</h5>
                </div>
            </div>
            <div class="col-6">
                <div class="text-end">
                    <a href="{{ route('user.list') }}" class="btn btn-success btn-sm">Back To Users List</a>
                </div>
            </div>
        </div>
        <div class="edit-user-body pt-5">
            <div class="row">
                <div class="col-10 offset-1">
                    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <label class="form-label">Full Name :</label>
                            <input type="text" name="name" value="{{old('name',$user->name)}}" class="form-control" placeholder="Enter Name" {{ $errors->has('name') ? 'autofocus' : '' }}>
                            @error('name')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Email Address :</label>
                            <input type="email" name="email" value="{{old('email',$user->email)}}" class="form-control" placeholder="Enter Email" {{$errors->has('email')?'autofocus':''}}>
                            @error('email')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Phone Number :</label>
                            <input type="number" name="number" value="{{old('number',$user->contacts)}}" class="form-control" placeholder="Enter Phone Number" {{$errors->has('number')?'autofocus':''}}>
                            @error('number')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="mb-2">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">User Role</label>
                                    <select name="role" class="form-select" {{$errors->has('role')?'autofocus':''}} required>
                                        <option value="" selected disabled>Select Role</option>
                                        <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="manager" {{ old('role', $user->role ?? '') == 'manager' ? 'selected' : '' }}>Manager</option>
                                        <option value="editor" {{ old('role', $user->role ?? '') == 'editor' ? 'selected' : '' }}>Editor</option>
                                        <option value="reporter" {{ old('role', $user->role ?? '') == 'reporter' ? 'selected' : '' }}>Reporter</option>
                                        <option value="visitor" {{ old('role', $user->role ?? '') == 'visitor' ? 'selected' : '' }}>Visitor</option>
                                        <option value="guest" {{ old('role', $user->role ?? '') == 'guest' ? 'selected' : '' }}>Guest</option>
                                        <option value="user" {{ old('role', $user->role ?? '') == 'user' ? 'selected' : '' }}>User</option>
                                    </select>
                                    @error('role') <span class="text-danger">{{$message}}</span> @enderror
                                </div>
                                <div class="col-6">
                                    <label class="form-label">User Status:</label>
                                    <select name="status" class="form-select" {{$errors->has('status')?'autofocus':''}}>
                                        <option value="" disabled selected>Select Role</option>
                                        <option value="active"{{old('status',$user->status ?? '')=='active'?'selected':''}}>Active</option>
                                        <option value="inactive"{{old('status',$user->status ?? '')=='inactive'?'selected':''}}>Inactive</option>
                                        <option value="deleted"{{old('status',$user->status ?? '')=='deleted'?'selected':''}}>Deleted</option>
                                    </select>
                                    @error('status')<span class="text-danger">{{$message}}</span>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Upload Image :</label>
                            <input type="file" name="image" onchange="document.querySelector('#output').src=window.URL.createObjectURL(this.files[0])" class="form-control" accept="image/*">
                            @error('image')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="py-3">
                            <img src="{{$user->image_url ?? ''}}" id="output" alt="" class="img-thumbnail"  width="200px" height="120px">
                        </div>
                        <div class="text-end">
                            <button type="button" onclick="window.location.reload();" class="btn btn-danger mx-2 px-4">Discard <i class="fa-solid fa-trash"></i></button>
                            <button type="submit" class="btn btn-success px-5">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection