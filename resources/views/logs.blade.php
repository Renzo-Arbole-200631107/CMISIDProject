@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="header">
            <div>
                <h3 class="project-name">Activity Log for {{ $project->project_name }}</h3>

            </div>
            <div>
                <a href="{{ route('projects.index') }}" class="btn btn-outline-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/>
                    <path fill="currentColor" d="M2.614 5.426A1.5 1.5 0 0 1 4 4.5h10a7.5 7.5 0 1 1 0 15H5a1.5 1.5 0 0 1 0-3h9a4.5 4.5 0 1 0 0-9H7.621l.94.94a1.5 1.5 0 0 1-2.122 2.12l-3.5-3.5a1.5 1.5 0 0 1-.325-1.634"/></g></svg>
                    Back</a>
            </div>
        </div>
        <div class="container">
            <div class="pad-shadow">
                <div class="details-pad">
                    <table class="table">
                        <tr>
                            <td>Updated at</td>
                            <td>Changes</td>
                        </tr>
                        @foreach ($activities as $activity)
                            <tr>
                                <td class="log-list">{{ $activity->created_at }}</td>
                                <td class="log-list fst-italic">{{ $activity->description }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <style>
        .header{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            
            margin-bottom: 30px;
        }
        .header h3{
        font-weight: 700;

        }
        .details-pad {
            display: flex;
            background: white;
            padding: 5px 10px;
            color: black;
            /* Change to black for visibility */
            border-radius: 6px;
            font-weight: bold;
            margin-top: 20px;
            justify-content: space-between;
            /* Add this line */
        }

        .pad-shadow {
            width: 100%;
            margin-bottom: 20px;
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 2px 10px 4px #dcdcdc;
        }

        .log-list {
            font-weight: normal;
        }

        .right-part {
            display: flex;
            justify-content: end;
            margin-bottom: 10px;
        }
    </style>
@endsection
