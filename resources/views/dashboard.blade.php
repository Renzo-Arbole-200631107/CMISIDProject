@extends('layouts.app')
@section('content')
    <div class="banner">
        <div class="overlay">
            <div class="text">
                <h1>WELCOME, {{ auth()->user()->username }}</h1>
                <p>City Management Information Systems and Innovation Department</p>
            </div>
        </div>
    </div>
    <div class="details-pad">
        <div class="purple-box">
            <h5>For Development</h5>
            <p>{{ $statusCounts['Ongoing'] }}</p>
        </div>
        <div class="orange-box">
            <h5>On-going Development</h5>
            <p>{{ $statusCounts['Ongoing'] }}</p>
        </div>
        <div class="yellow-box">
            <h5>For Deployment</h5>
            <p>{{ $statusCounts['ForDeployment'] }}</p>
        </div>
        <div class="green-box">
            <h5>Deployed</h5>
            <p>{{ $statusCounts['Deployed'] }}</p>
        </div>
        <div class="blue-box">
            <h5>For Update</h5>
            <p>{{ $statusCounts['ForUpdate'] }}</p>
        </div>
        <div class="red-box">
            <h5>Cancelled</h5>
            <p>{{ $statusCounts['Cancelled'] }}</p>
        </div>
    </div>
    <div class="additional-boxes">
        <a href="{{ route('users.index') }}" class="status-box new-box">
            <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                    <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                        <path d="M16 9a4 4 0 1 1-8 0a4 4 0 0 1 8 0m-2 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0" />
                        <path
                            d="M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11s11-4.925 11-11S18.075 1 12 1M3 12c0 2.09.713 4.014 1.908 5.542A8.99 8.99 0 0 1 12.065 14a8.98 8.98 0 0 1 7.092 3.458A9 9 0 1 0 3 12m9 9a8.96 8.96 0 0 1-5.672-2.012A6.99 6.99 0 0 1 12.065 16a6.99 6.99 0 0 1 5.689 2.92A8.96 8.96 0 0 1 12 21" />
                    </g>
                </svg>
            </span>
            @if (auth()->user()->hasRole('developer'))
                VIEW ACCOUNT
                <p>View, edit, and manage your account</p>
            @endif
            @if (auth()->user()->hasRole('project manager')||
            auth()->user()->hasRole('admin'))
                VIEW ACCOUNTS
                <p>Create, update, and manage employee accounts</p>
            @endif
        </a>
            @if (auth()->user()->hasRole('project manager')||
            auth()->user()->hasRole('admin'))
            <a href="{{ route('offices.index') }}" class="status-box new-box">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 22V8c0-2.828 0-4.243-.879-5.121C12.243 2 10.828 2 8 2s-4.243 0-5.121.879C2 3.757 2 5.172 2 8v8c0 2.828 0 4.243.879 5.121C3.757 22 5.172 22 8 22zM6.5 11h-1m5 0h-1m-3-4h-1m1 8h-1m5-8h-1m1 8h-1m9 0h-1m1-4h-1m.5-3h-4v14h4c1.886 0 2.828 0 3.414-.586S22 19.886 22 18v-6c0-1.886 0-2.828-.586-3.414S19.886 8 18 8" color="currentColor"/>
                    </svg>
                </span>
                VIEW OFFICES
                <p>Create, update, and manage offices</p>
            @endif
        </a>
        <a href="{{ route('projects.index') }}" class="status-box new-box">
            <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M6 22q-.825 0-1.412-.587T4 20V4q0-.825.588-1.412T6 2h12q.825 0 1.413.588T20 4v16q0 .825-.587 1.413T18 22zm0-2h12V4h-2v7l-2.5-1.5L11 11V4H6zm0 0V4zm5-9l2.5-1.5L16 11l-2.5-1.5z" />
                </svg>
            </span>

            @if (auth()->user()->hasRole('developer'))
                VIEW PROJECTS
                <p>View or update your current projects</p>
            @endif
            @if (auth()->user()->hasRole('project manager')||
            auth()->user()->hasRole('admin'))
                VIEW PROJECTS
                <p>View different projects from different offices</p>
            @endif
        </a>
    </div>

    <style>
        .banner {
            background-image: url('img/cityhall.png');
            background-size: cover;
            background-position: center;
            height: 350px;
            position: relative;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: left;
            color: white;
            text-align: left;
        }

        .text h1 {
            font-weight: 700;
            font-size: 85px;
            margin-top: 50px;
            margin-left: 50px;
        }

        .text p {
            font-size: 1.5em;
            font-weight: 700;
            margin-left: 50px;
        }

        .details-pad {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            background: white;
            margin-top: 20px;
            margin-left: 30px;
            margin-right: 30px;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0px 2px 10px 10px #dcdcdc;
            position: relative;

            overflow: hidden;
        }

        .details-pad div {
            flex: 1;
            margin: 10px;
            padding: 20px;
            height: 175px;
            border-radius: 6px;
            box-shadow: 0px 5px 10px 8px #dcdcdc;
            box-sizing: border-box;
        }


        .details-pad p {
            font-size: 50px;
            text-align: center;
            font-weight: 600;
            color: #545454;
        }

        .purple-box {
            background: #e7bfff;
        }

        .purple-box h5 {
            font-weight: 700;
            color: #545454;
        }

        .red-box {
            background: #FF8A8A;
        }

        .red-box h5 {
            font-weight: 700;
            color: #545454;
        }

        .orange-box {
            background: #FFD09B;
        }

        .orange-box h5 {
            font-weight: 700;
            color: #545454;
        }

        .yellow-box {
            background: #FFF7D1;
        }

        .yellow-box h5 {
            font-weight: 700;
            color: #545454;
        }

        .blue-box {
            background: #D2E0FB;
        }

        .blue-box h5 {
            font-weight: 700;
            color: #545454;
        }

        .green-box {
            background: #C1CFA1;
        }

        .green-box h5 {
            font-weight: 700;
            color: #545454;
        }

        .additional-boxes {
            display: flex;
            justify-content: space-between;
            margin: 20px 30px 0 30px;
        }

        .new-box {
            background: white;
            color: #2f2f2f;
            padding: 25px;
            text-align: center;
            border-radius: 6px;
            box-shadow: 0px 2px 10px 10px #dcdcdc;
            flex: 1;
            margin: 10px;
            transition: background-color 0.3s, color 0.3s;
            font-weight: 600;
            text-decoration: none;
        }

        .new-box p {
            font-weight: 300;
        }

        .new-box .icon svg {
            transition: fill 0.3s;
        }

        .new-box:hover {
            background: #d2d2d2;
            color: white;
        }

        .new-box:hover .icon svg {
            fill: white;
        }

        @media (max-width: 768px) {
            .text h1 {
                font-size: 40px;
                /* Adjust the font size for mobile view */
                margin-top: 20px;
                margin-left: 20px;
                margin-right: 20px;
                /* Add margin to the right */
            }

            .text p {
                font-size: 1em;
                /* Adjust the font size for mobile view */
                margin-left: 20px;
                margin-right: 20px;
                /* Add margin to the right */
            }

            .details-pad {
                display: flex;
                flex-direction: column;
                /* Stack the boxes vertically on mobile view */
                margin-left: 10px;
                /* Adjust the margin for mobile view */
                margin-right: 10px;
                /* Adjust the margin for mobile view */
            }

            .details-pad div {
                margin: 5px;
                /* Adjust the margin for mobile view */
                padding: 10px;
                /* Adjust the padding for mobile view */
                width: 100%;
                /* Ensure the boxes take full width on mobile view */
            }

            .additional-boxes {
                flex-direction: column;
                /* Stack the boxes vertically on mobile view */
                margin: 10px;
                /* Adjust the margin for mobile view */
            }

            .new-box {
                margin: 10px 0;
                /* Adjust the margin for mobile view */
                width: 100%;
                /* Ensure the boxes take full width on mobile view */
            }
        }
    </style>
@endsection
