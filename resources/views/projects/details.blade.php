@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="header">
            <div>
                <div>
                    <div class="project-name">
                        <h3>{{ $project->project_name }}</h3>
                        @if ($project->status == 'Deployed')
                            <h6 class="text-success fw-bold btn-container"><span class="badge-dep">Deployed</span></h6>
                        @elseif($project->status == 'For update')
                            <h6 class="text-primary fw-bold btn-container"><span class="badge-upt">For Update</span></h6>
                        @elseif($project->status == 'For deployment')
                            <h6 class="text-primary fw-bold btn-container"><span class="badge-tbd">For Deployment</span></h6>
                        @elseif($project->status == 'On-going development')
                            <h6 class="text-primary fw-bold btn-container"><span class="badge-ong">On-going</span></h6>
                        @elseif($project->status == 'Cancelled')
                            <h6 class="text-primary fw-bold btn-container"><span class="badge-can">Cancelled</span></h6>
                        @endif
                    </div>
                    <h5>{{ $project->office->office_name }}</h5>
                </div>
            </div>
            <div>
                    <a href="{{route('projects.edit', ['project' => $project])}}" class="btn btn-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="white" d="M12 4c4.411 0 8 3.589 8 8s-3.589 8-8 8s-8-3.589-8-8s3.589-8 8-8m0-2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2m5 9h-4V7h-2v4H7v2h4v4h2v-4h4z"/></svg>
                        Edit project</a>
                    <a href="{{ url('logs/' . $project->id) }}" class="btn btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <g fill="none" stroke="black" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2">
                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0-18 0" />
                                <path d="M12 7v5l3 3" />
                            </g>
                        </svg>
                        Logs
                    </a>
                    <a href="{{route('projects.index')}}" class="btn btn-outline-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/>
                        <path fill="currentColor" d="M2.614 5.426A1.5 1.5 0 0 1 4 4.5h10a7.5 7.5 0 1 1 0 15H5a1.5 1.5 0 0 1 0-3h9a4.5 4.5 0 1 0 0-9H7.621l.94.94a1.5 1.5 0 0 1-2.122 2.12l-3.5-3.5a1.5 1.5 0 0 1-.325-1.634"/></g></svg>
                        Back</a>
                </div>
        </div>

        <div class="dates">
            <div class="col-md-3 date">
                <h5 class="fw-bold">Start SAD</h5>
                <h4 class="input-data">
                    {{ $project->start_sad }}
                </h4>
            </div>
            <div class="col-md-3 date">
                <h5 class="fw-bold">Start Development</h5>
                <h4 class="input-data">
                    {{ $project->start_dev }}
                </h4>
            </div>
            <div class="col-md-3 date">
                <h5 class="fw-bold">Estimated Deployment</h5>
                <h4 class="input-data">
                    {{ $project->estimate_deployment }}
                </h4>
            </div>
            <div class="col-md-3 date">
                <h5 class="fw-bold">Deployment Date</h5>
                <h4 class="input-data">
                    {{ $project->deployment_date }}
                </h4>
            </div>
        </div>

        <div class="pad-shadow">
            <div class="px-3 py-1">
                <h4 class="info-container fw-bold p-2">REMARKS</h4>
            </div>
            <div class="details-pad">
                <div class="col-md-6 mt-3">
                    <div class="mb-4">
                        <h6 class="info-container fw-bold">Developer's Remarks</h6>
                        <h6 class="input-data">{{ $project->dev_remarks }}</h6>
                    </div>
                    <div class="mb-4">
                        <h6 class="info-container fw-bold">Google Analytics Remarks</h6>
                        <h6 class="input-data">{{ $project->google_remarks }}</h6>
                    </div>
                    <div class="mb-4">
                        <h6 class="info-container fw-bold">DPA Compliance Remarks</>
                            <h6 class="input-data">{{ $project->dpa_remarks }}</h6>
                    </div>

                </div>
                <div class="col-md-6  mt-3">
                    <div class="mb-4">
                        <h6 class="info-container fw-bold">SEO Comments</h6>
                        <h6 class="input-data"> {{ $project->seo_comments }}</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="pad-shadow">
            <div class="px-3 py-1">
                <h4 class="info-container p-2 fw-bold">OTHER DETAILS</h4>
            </div>
            <div class="details-pad ">
                <div class="col-md-6 mt-3">
                    <div class="mb-4">
                        <h6 class="info-container fw-bold">Description:</h6>
                        <h6 class="input-data">{{ $project->description }}</h6>
                    </div>
                    <div class="mb-4">
                        <h6 class="info-container fw-bold">Developer Name:</h6>
                        <h6 class="input-data">{{ $project->user->last_name }}, {{ $project->user->first_name }}
                            {{ $project->user->middle_name }}</h6>
                    </div>
                    <div class="mb-4">
                        <h6 class="info-container fw-bold">Version:</h6>
                        <h6 class="input-data">{{ $project->version }}</h6>
                    </div>
                </div>

                <div class="col-md-6 mt-3">
                    <div class="mb-4">
                        <h6 class="info-container fw-bold">Public Link:</h6>
                        <h6 class="input-data">{{ $project->public_link }}</h6>
                    </div>
                    <div class="mb-4">
                        <h6 class="info-container fw-bold">Admin Link:</h6>
                        <h6 class="input-data">{{ $project->admin_link }}</h6>
                    </div>
                    <div class="mb-4">
                        <h6 class="info-container fw-bold">Attachments:</h6>
                        <ul>
                            @foreach ($project->attachments as $attachment)
                                <li>
                                    <a href="{{ asset($attachment->file_path) }}" target="_blank">
                                        {{ preg_replace('/_\d+\./', '.', $attachment->file_name) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            background-color: #f2f2f2;
            margin-top: 100px;
        }

        .dates {
            display: flex;
            flex-direction: row;
            justify-content: center;
            margin-bottom: 20px;
            padding: 16px;
            width: 100%;
            gap: 10px;
        }

        .date {
            background-color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100px;
            text-align: center;
            box-shadow: 0px 2px 10px 4px #dcdcdc;
            border-radius: 6px;

        }

        .input-data {
            color: #606060;
        }

        .project-name {
            display: flex;
            align-items: center;
            /* Aligns items vertically in the center */
            gap: 10px;
            /* Space between project name and button */
        }

        .badge-dep {
            padding: 5px 10px;
            border: 1px solid #008000;
            border-radius: 15px;
            color: #008000;
        }

        .badge-upt {
            padding: 5px 10px;
            border: 1px solid #ff6d00;
            border-radius: 15px;
            color: #ff6d00;
        }

        .badge-tbd {
            padding: 5px 10px;
            border: 1px solid black;
            border-radius: 15px;
            color: black;
        }

        .badge-ong {
            padding: 5px 10px;
            border: 1px solid #182e6f;
            border-radius: 15px;
            color: #182e6f;
        }

        .badge-can {
            padding: 5px 10px;
            border: 1px solid #cd1c18;
            border-radius: 15px;
            color: #cd1c18;
        }

        .header {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .header h3 {
            font-weight: 700;

        }

        .details-pad {
            display: flex;
            background: white;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 10px;
            padding-right: 10px;
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
            box-shadow: 0px 2px 10px 4px #dcdcdc;
        }

        .info-container {
            line-height: 1.5;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 2px 10px 4px #dcdcdc;
        }

        .log-list {
            font-weight: normal;
        }

        h6 {
            font-size: 16px;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                /* Stack elements vertically */
                align-items: stretch;
                /* Ensure elements take full width */
            }

            .dates {
                flex-direction: column;
                /* Stack elements vertically */
                gap: 10px;
                /* Add space between elements */
            }

            .date {
                width: 100%;
                /* Ensure elements take full width */
            }

            .details-pad {
                flex-direction: column;
                /* Stack elements vertically */
                padding: 10px;
                /* Adjust padding for mobile view */
            }

            .col-md-6 {
                width: 100%;
                /* Ensure elements take full width */
                margin-bottom: 10px;
                /* Add space between elements */
            }

            .btn-container {
                width: 100%;
                /* Ensure buttons take full width */
                margin-bottom: 10px;
                /* Add space between buttons */
            }

            .project-name h3 {
                font-size: 24px;
                /* Adjust font size for mobile view */
            }

            .project-name h6 {
                font-size: 16px;
                /* Adjust font size for mobile view */
            }

            .input-data {
                font-size: 14px;
                /* Adjust font size for mobile view */
            }
        }
    </style>
@endsection
