@extends('layouts.app')
@section('content')
<div class="container">
    <div class="header">
        <div>
            <h3 class="text-bold">Add user</h3>
        </div>
        <div>
            <a href="{{route('users.index')}}" class="btn btn-outline-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/>
                <path fill="currentColor" d="M2.614 5.426A1.5 1.5 0 0 1 4 4.5h10a7.5 7.5 0 1 1 0 15H5a1.5 1.5 0 0 1 0-3h9a4.5 4.5 0 1 0 0-9H7.621l.94.94a1.5 1.5 0 0 1-2.122 2.12l-3.5-3.5a1.5 1.5 0 0 1-.325-1.634"/></g></svg>
                Back</a>
        </div>
    </div>

    <div>
    <div class="card">
                    @if($errors->any())
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                        @endif
    </div>
    <form action="{{route('users.store')}}" method="POST">
                    @method('post')
                    @csrf
                    <div class="mb-4">
                        <label for="" class="form-label fw-bold">Last name</label>
                        <input type="text" class="form-control" name="last_name" value="{{old('last_name')}}" id="last_name" placeholder="Enter last name">
                    </div>
                    <div class="mb-4">
                        <label for="" class="form-label fw-bold">First Name</label>
                        <input type="text" class="form-control" name="first_name" value="{{old('first_name')}}" id="first_name" placeholder="Enter first name">
                    </div>
                    <div class="mb-4">
                        <label for="" class="form-label fw-bold">Middle Name</label>
                        <input type="text" class="form-control" name="middle_name" value="{{old('middle_name')}}" id="middle_name" placeholder="Enter middle name">
                    </div>
                    <div class="mb-4">
                        <label for="" class="form-label fw-bold">Username</label>
                        <input type="text" class="form-control" name="username" value="{{old('username')}}" id="username" placeholder="Enter username">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">User role</label>
                        <select name="role" id="role_description" class="form-control">
                            <option value="">Select role</option>
                            <option value="developer" {{old('role') == "developer"}}>Developer</option>
                            <option value="project manager" {{old('role' == "project manager")}}>Project Manager</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Is Active?</label>
                        <select name="is_active" id="is_active" class="form-control">
                            <option value="1" {{old('is_active') == "1"}}>Yes</option>
                            <option value="0" {{old('is_active') == "0"}}>No</option>
                        </select>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="white" d="M12 4c4.411 0 8 3.589 8 8s-3.589 8-8 8s-8-3.589-8-8s3.589-8 8-8m0-2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2m5 9h-4V7h-2v4H7v2h4v4h2v-4h4z"/></svg>
                        Add user</button>
                    </div>
                </form>
    </div>
</div>

<style>
    body{
        background-color: #f2f2f2;
    }

    .header{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        padding: 24px;
    }

    .header h3{
        font-weight: 700;
        margin-top: 60px;
    }

    .btn {
        margin-top: 60px;
    }

    form{
        padding: 24px;
    }
</style>
@endsection
