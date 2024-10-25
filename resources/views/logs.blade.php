@extends('layouts.app')
@section('content')
    <div class="pad-shadow">
        <div class="details-pad">
            <h4 class="info-container px-4">Activity Log for Project: {{ $project->project_name }}</h4>
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


    <style>
        .details-pad {
            display: flex;
            background: white;
            padding: 5px 10px;
            color: black;
            /* Change to black for visibility */
            border-radius: 6px;
            font-weight: bold;
        }

        .pad-shadow {
            width: 100%;
            margin-bottom: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 2px 10px 4px #dcdcdc;
        }
    </style>
@endsection
