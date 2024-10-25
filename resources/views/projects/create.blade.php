@extends('layouts.app')

@section('content')
<div class="container">
    <div class="header">
        <div>
            <h3>ADD PROJECT</h3>
        </div>
        <div>
            <a href="{{route('projects.index')}}" class="btn btn-outline-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/>
                <path fill="currentColor" d="M2.614 5.426A1.5 1.5 0 0 1 4 4.5h10a7.5 7.5 0 1 1 0 15H5a1.5 1.5 0 0 1 0-3h9a4.5 4.5 0 1 0 0-9H7.621l.94.94a1.5 1.5 0 0 1-2.122 2.12l-3.5-3.5a1.5 1.5 0 0 1-.325-1.634"/></g></svg>
                Back</a>
        </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div>
        <form action="{{route('projects.store')}}" method="POST" enctype="multipart/form-data">
            @method('post')
            @csrf
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Project name</label>
                <input type="text" class="form-control" name="project_name" placeholder="Enter project name">
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Description</label>
                <textarea class="form-control" name="description" placeholder="Description" rows="3"></textarea>
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Project owner (Office / Department)</label>
                <select name="office_id" class="form-control">
                    <option value="">Select office/department</option>
                    @foreach ($offices as $office)
                        <option value="{{$office->id}}">
                            {{$office->office_name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
            <label class="form-label fw-bold">Developer name</label>
                <select name="user_id" class="form-control">
                    <option>Select developer</option>
                    @foreach ($users as $user)
                        <option value={{$user->id}}>
                            {{$user->first_name}} {{$user->middle_name}} {{$user->last_name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Designation</label>
                <input type="text" class="form-control" name="designation" placeholder="Enter designation">
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Start SAD date</label>
                <input type="date" class="form-control" name="start_sad">
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Estimated deployment</label>
                <input type="date" class="form-control" name="estimate_deployment">
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Deployment date</label>
                <input type="date" class="form-control" name="deployment_date">
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Version</label>
                <input type="text" class="form-control" name="version" placeholder="Enter version">
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Status</label>
                <select id="inputStatus" class="form-control" name="status">
                    <option selected>Select status</option>
                    <option value="On-going development">On-going development</option>
                    <option value="For deployment">For deployment</option>
                    <option value="Deployed">Deployed</option>
                    <option value="For update">For update</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Link</label>
                <input type="text" class="form-control" name="link" placeholder="Enter link">
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Attachment/s</label>
                <input class="form-control" name="attachment[]" type="file" multiple>
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Developer remarks</label>
                <textarea class="form-control" name="dev_remarks" placeholder="Add remarks" rows="3"></textarea>
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Google Analytics remarks</label>
                <textarea class="form-control" name="google_remarks" placeholder="Add remarks" rows="3"></textarea>
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">SEO comments</label>
                <textarea class="form-control" name="seo_comments" placeholder="Add remarks" rows="3"></textarea>
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">DPA Compliance remarks</label>
                <textarea class="form-control" name="dpa_remarks" placeholder="Add remarks" rows="3"></textarea>
            </div>
            <div class="mb-5">
                <label for="" class="form-label fw-bold">Remarks</label>
                <textarea class="form-control" name="remarks" placeholder="Add remarks" rows="3"></textarea>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="white" d="M12 4c4.411 0 8 3.589 8 8s-3.589 8-8 8s-8-3.589-8-8s3.589-8 8-8m0-2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2m5 9h-4V7h-2v4H7v2h4v4h2v-4h4z"/></svg>
                Add project</button>
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
        margin-top: 50px;
    }

    form{
        padding: 24px;
    }
</style>
@endsection

