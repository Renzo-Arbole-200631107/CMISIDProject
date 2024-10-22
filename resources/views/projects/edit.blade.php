@extends('layouts.app')

@section('content')
<div class="container">
    <div class="header">
        <div>
            <h3>EDIT PROJECT</h3>
        </div>
        <div>
            <a href="{{route('projects.index')}}" class="btn btn-outline-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/>
                <path fill="currentColor" d="M2.614 5.426A1.5 1.5 0 0 1 4 4.5h10a7.5 7.5 0 1 1 0 15H5a1.5 1.5 0 0 1 0-3h9a4.5 4.5 0 1 0 0-9H7.621l.94.94a1.5 1.5 0 0 1-2.122 2.12l-3.5-3.5a1.5 1.5 0 0 1-.325-1.634"/></g></svg>
                Back</a>
        </div>
    </div>

    <div>
        <form action="{{route('projects.update', ['project' => $project])}}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Project name</label>
                <input type="text" class="form-control" name="project_name" value="{{$project->project_name}}">
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Description</label>
                <textarea class="form-control" name="description" rows="3">{{$project->description}}</textarea>
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Project owner (Office / Department)</label>
                <input type="text" class="form-control" name="project_owner" value={{$project->project_owner}}>
            </div>
            <div class="mb-4">
            <label class="form-label fw-bold">Developer name</label>
                <select name="account_id" class="form-control">
                    <option>Select developer</option>
                    @foreach ($accounts as $account)
                        <option value={{$account->id}} {{old('account_id', $account->id) == $account->id ? 'selected' : ''}}>
                            {{$account->first_name}} {{$account->middle_name}} {{$account->last_name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Designation</label>
                <input type="text" class="form-control" name="designation" value={{$project->designation}}>
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Estimated deployment</label>
                <input type="date" class="form-control" name="estimate_deployment" value={{$project->estimate_deployment}}>
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Deployment date</label>
                <input type="date" class="form-control" name="deployment_date" value={{$project->deployment_date}}>
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Version</label>
                <input type="text" class="form-control" name="version" value="{{$project->version}}">
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Status</label>
                <select id="inputStatus" class="form-control" name="status">
                    <option value="On-going development" {{old('status', $project->status) == 'On-going development' ? 'selected' : ''}}>On-going development</option>
                    <option value="For deployment" {{old('status', $project->status) == 'For deployment' ? 'selected' : ''}}>For deployment</option>
                    <option value="Deployed" {{old('status', $project->status) == 'Deployed' ? 'selected' : ''}}>Deployed</option>
                    <option value="For update" {{old('status', $project->status) == 'For update' ? 'selected' : ''}}>For update</option>
                    <option value="Cancelled" {{old('status', $project->status) == 'Cancelled' ? 'selected' : ''}}>Cancelled</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Link</label>
                <input type="text" class="form-control" name="link" value={{$project->link}}>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Attachment/s</label>
                <input class="form-control" name="attachment[]" type="file" id="formFileMultiple" multiple>
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Developer remarks</label>
                <textarea class="form-control" name="dev_remarks" value= rows="3">{{$project->dev_remarks}}</textarea>
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Google Analytics remarks</label>
                <textarea class="form-control" name="google_remarks" rows="3">{{$project->google_remarks}}</textarea>
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">SEO comments</label>
                <textarea class="form-control" name="seo_comments" rows="3">{{$project->seo_comments}}</textarea>
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">DPA Compliance remarks</label>
                <textarea class="form-control" name="dpa_remarks" value= rows="3">{{$project->dpa_remarks}}</textarea>
            </div>
            <div class="mb-5">
                <label for="" class="form-label fw-bold">Remarks</label>
                <textarea class="form-control" name="remarks" value= rows="3">{{$project->remarks}}</textarea>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="white" d="M12 4c4.411 0 8 3.589 8 8s-3.589 8-8 8s-8-3.589-8-8s3.589-8 8-8m0-2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2m5 9h-4V7h-2v4H7v2h4v4h2v-4h4z"/></svg>
                Save changes</button>
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
        margin-top: 50px;
    }

    .btn {
        margin-top: 50px;
    }
    form{
        padding: 24px;
    }
</style>
@endsection

