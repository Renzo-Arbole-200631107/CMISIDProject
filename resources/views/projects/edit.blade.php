@extends('layouts.app')

@section('content')
<div class="container">
    <div class="header">
        <div>
            <h3 class="text-bold">Update project</h3>
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
                <label for="" class="form-label fw-bold">Project name</label>
                <input type="text" class="form-control" name="project_name" placeholder="Enter project name">
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Description</label>
                <textarea class="form-control" name="project_name" placeholder="Description" rows="3"></textarea>
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Project owner (Office / Department)</label>
                <input type="text" class="form-control" name="project_name" placeholder="Enter office or department">
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Developer Name</label>
                <input type="text" class="form-control" name="project_name" placeholder="Enter developer name">
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Designation</label>
                <input type="text" class="form-control" name="designation" placeholder="Enter designation">
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Estimated deployment</label>
                <input type="date" class="form-control" name="estimated_deployment">
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
                <select id="inputStatus" class="form-control">
                    <option selected>On-going development</option>
                    <option>For deployment</option>
                    <option>Deployed</option>
                    <option>For update</option>
                    <option>Cancelled</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="" class="form-label fw-bold">Link</label>
                <input type="text" class="form-control" name="link" placeholder="Enter link">
            </div>
            <div class="mb-4">
                <label for="formFileMultiple" class="form-label fw-bold">Attachment/s</label>
                <input class="form-control" type="file" id="formFileMultiple" multiple>
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
                <label for="" class="form-label fw-bold">SEO remarks</label>
                <textarea class="form-control" name="seo_remarks" placeholder="Add remarks" rows="3"></textarea>
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

