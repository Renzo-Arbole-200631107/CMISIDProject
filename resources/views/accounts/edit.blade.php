@extends('layouts.app')
@section('content')
<div class="container">
    <div class="header">
        <div>
            <h3 class="text-bold">Edit user</h3>
        </div>
        <div>
            <button type="button" class="btn btn-outline-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/>
                <path fill="currentColor" d="M2.614 5.426A1.5 1.5 0 0 1 4 4.5h10a7.5 7.5 0 1 1 0 15H5a1.5 1.5 0 0 1 0-3h9a4.5 4.5 0 1 0 0-9H7.621l.94.94a1.5 1.5 0 0 1-2.122 2.12l-3.5-3.5a1.5 1.5 0 0 1-.325-1.634"/></g></svg>
                Back</button>
        </div>
    </div>

    <div>
        <form action="">
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Last name</label>
                <input type="text" class="form-control" name="last_name" placeholder="Enter last name">
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">First Name</label>
                <input type="text" class="form-control" name="first_name" placeholder="Enter first name">
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Middle Name</label>
                <input type="text" class="form-control" name="middle_name" placeholder="Enter middle name">
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Enter username">
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">User role</label>
                <select id="inputStatus" class="form-control">
                    <option selected>Developer</option>
                    <option>Project Manager</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Is Active?</label>
                <select id="inputStatus" class="form-control">
                    <option selected>Yes</option>
                    <option>No</option>
                </select>
            </div>
            
            <div class="text-right">
                <button type="button" class="btn btn-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 1536 1536"><path fill="white" d="M384 1408h768v-384H384zm896 0h128V512q0-14-10-38.5t-20-34.5l-281-281q-10-10-34-20t-39-10v416q0 40-28 68t-68 28H352q-40 0-68-28t-28-68V128H128v1280h128V992q0-40 28-68t68-28h832q40 0 68 28t28 68zM896 480V160q0-13-9.5-22.5T864 128H672q-13 0-22.5 9.5T640 160v320q0 13 9.5 22.5T672 512h192q13 0 22.5-9.5T896 480m640 32v928q0 40-28 68t-68 28H96q-40 0-68-28t-28-68V96q0-40 28-68T96 0h928q40 0 88 20t76 48l280 280q28 28 48 76t20 88"/></svg>
                 Save project</button>
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
    form{
        padding: 24px;
    }
</style>
@endsection