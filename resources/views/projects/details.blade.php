@extends('layouts.app')

@section('content')
<div class="container">
    <div class="header">
        <div>
            <h3>Details</h3>
        </div>
        <div>
            <a href="{{route('projects.index')}}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                <path fill="white" d="M12 20a8 8 0 0 0 8-8a8 8 0 0 0-8-8a8 8 0 0 0-8 8a8 8 0 0 0 8 8m0-18a10 10 0 0 1 10 10a10 10 0 0 1-10 10C6.47 22 2 17.5 2 12A10 10 0 0 1 12 2m.5 5v5.25l4.5 2.67l-.75 1.23L11 13V7z"/></svg>
                Logs</a>
            <a href="{{route('projects.index')}}" class="btn btn-outline-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/>
                <path fill="currentColor" d="M2.614 5.426A1.5 1.5 0 0 1 4 4.5h10a7.5 7.5 0 1 1 0 15H5a1.5 1.5 0 0 1 0-3h9a4.5 4.5 0 1 0 0-9H7.621l.94.94a1.5 1.5 0 0 1-2.122 2.12l-3.5-3.5a1.5 1.5 0 0 1-.325-1.634"/></g></svg>
                Back</a>
        </div>
    </div>

    <div class="pad-shadow">
        <div class="details-pad">

            <div class="left-column">
                <h5 class="fw-bold info-container">
                    {{$project->project_name}}
                </h5>
                <h5 class="info-container">
                    Description: {{$project->description}}
                </h5>
                <h5 class="info-container">
                    Project Owner: {{$project->project_owner}}
                </h5>
                <h5 class="info-container">
                    Developer Name: {{$project->user->last_name}}, {{$project->user->first_name}} {{$project->user->middle_name}}
                </h5>
                <h5 class="info-container">
                    Estimated Deployment: {{$project->estimate_deployment}}
                </h5>
                <h5 class="info-container">
                    Deployment Date: {{$project->deployment_date}}
                </h5>
                <h5 class="info-container">
                    Version: {{$project->version}}
                </h5>
                <h5 class="info-container">
                    Status: {{$project->status}}
                </h5>
            </div>

            <div class="right-column">
                <h5 class="info-container">
                    Link: {{$project->link}}
                </h5>
                <h5 class="info-container">
                    Attachments: {{$project->attachment}}
                </h5>
                <h5 class="info-container">
                    Google Analytics Remarks: {{$project->google_remarks}}
                </h5>
                <h5 class="info-container">
                    SEO Comments: {{$project->seo_comments}}
                </h5>
                <h5 class="info-container">
                    DPA Compliance Remarks: {{$project->dpa_remarks}}
                </h5>
                <h5 class="info-container">
                    Remarks: {{$project->remarks}}
                </h5>
            </div>
        </div>
    </div>
    <div class="pad-shadow">
        <div class="details-pad">
            <h4 class="info-container px-4">Activity Log</h4>
        </div>
        <div class="details-pad">
            <table class="table">
                <tr>
                    <td>Updated at</td>
                    <td>Changes</td>
                </tr>
                @foreach ($activities as $activity)
                <tr>
                    <td>{{ $activity->created_at }}</td>
                    <td>{{ $activity->description }}</td>
                </tr>
                    
                @endforeach

            </table>
        </div>
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
    }

    .details-pad {
        display: flex;
        background: white;
        padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 10px;
        padding-right: 10px;
        color: white;
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
        outline: none;
    }

    .pad-shadow {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0px 2px 10px 4px #dcdcdc;
    }

    .left-column {
        flex: 1;
        margin: 0 10px;
    }

    .right-column {
        flex: 1;
        margin: 0 10px;
    }

    .info-container {
        display: flex;
        line-height: 2.5;
        flex-direction: column;
        color: black;
    }

    .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 2px 10px 4px #dcdcdc;
        }
</style>

@endsection
