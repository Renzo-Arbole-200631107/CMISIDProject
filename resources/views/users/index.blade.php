@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        @if (auth()->user()->hasRole('developer')||
        auth()->user()->hasRole('project manager'))
            <div class="acc-header">
                <h2>MY ACCOUNT</h2>
            </div>
            <div class="bg-grey">
            @if (session('status'))
                <div class="py-3">
                    <h4 class="text-success fw-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" 
                    viewBox="0 0 24 24"><g fill="currentColor">
                        <path d="M10.243 16.314L6 12.07l1.414-1.414l2.829 2.828l5.656-5.657l1.415 1.415z"/>
                        <path fill-rule="evenodd" d="M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11s-4.925 11-11 11S1 18.075 1 12m11 9a9 9 0 1 1 0-18a9 9 0 0 1 0 18" 
                        clip-rule="evenodd"/></g></svg>
                        {{ session('status') }}</h4>
                </div>
            @endif
            <div class="pad-shadow">
                <div class="details-pad">
                    <div class="col-md-6 d-flex flex-column justify-content-start p-2">
                        <div>
                            <h5 class="fw-bold">{{ auth()->user()->last_name }}, {{ auth()->user()->first_name }}
                            {{ auth()->user()->middle_name }}</h5>
                        </div>
                        <div>
                            <h6 class="fw-bold fst-italic">{{auth()->user()->username}}</h6>
                        </div>
                    </div>
                    <div class="col-md-5 text-end p-2">
                        <div>
                            @if(auth()->user()->hasRole('project manager'))
                                <h5 class="text-primary fw-bold btn-container">Project Manager</h5>
                            @elseif(auth()->user()->hasRole('developer'))
                                <h5 class="text-success fw-bold btn-container">Developer</h5>
                            @endif

                        </div>
                        <div>
                            @if (auth()->user()->is_active === 1)
                                <h6 class="fw-bold">Active</h6>
                            @elseif(auth()->user()->is_active === 0)
                                <h6 class="fw-bold">Inactive</h6>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-1 text-center p-2">
                        <div>
                        <a href="{{ route('users.edit', auth()->user()->id) }}" class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="4em" height="2em" viewBox="0 0 24 24">
                                    <path fill="black"
                                        d="m7 17.013l4.413-.015l9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583zM18.045 4.458l1.589 1.583l-1.597 1.582l-1.586-1.585zM9 13.417l6.03-5.973l1.586 1.586l-6.029 5.971L9 15.006z" />
                                    <path fill="black"
                                        d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01c-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        @endif

        @if (auth()->user()->hasRole('admin'))
            <div class="acc-header">
                <h2>ACCOUNTS</h2>
                <div class="right-part">
                    <form action="{{ route('users.index') }}" method="get">
                        <input type="search" class="form-control" placeholder="Search here.." name="search" id="search" value="{{ old('search', request('search')) }}">
                    </form>
                    @if (auth()->user()->hasRole('admin'))
                        <a href="{{ route('users.create') }}" class="add-btn btn btn-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path fill="white"
                                    d="M12 4c4.411 0 8 3.589 8 8s-3.589 8-8 8s-8-3.589-8-8s3.589-8 8-8m0-2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2m5 9h-4V7h-2v4H7v2h4v4h2v-4h4z" />
                            </svg>
                            Add account
                        </a>
                    @endif
                </div>
            </div>
            <div class="bg-gray">
                @if (session('status'))
                    <div class="py-3">
                        <h4 class="text-success fw-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" 
                        viewBox="0 0 24 24"><g fill="currentColor">
                            <path d="M10.243 16.314L6 12.07l1.414-1.414l2.829 2.828l5.656-5.657l1.415 1.415z"/>
                            <path fill-rule="evenodd" d="M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11s-4.925 11-11 11S1 18.075 1 12m11 9a9 9 0 1 1 0-18a9 9 0 0 1 0 18" 
                            clip-rule="evenodd"/></g></svg>
                            {{ session('status') }}</h4>
                    </div>
                @endif
                <table class="table">
                    <tr class="fw-bold">
                        <th>Complete name</th>
                        <th>Username</th>
                        <th>Access</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>

                    @foreach ($users as $user)
                        <tr>
                            <td class="fw-bold text-start">{{ $user->last_name }}, {{ $user->first_name }} {{ $user->middle_name }}
                            </td>
                            <td>{{ $user->username }}</td>

                            @if ($user->hasRole('developer'))
                                <td class="text-success fw-bold btn-container"><span class="badge-dev">Developer</span></td>
                            @elseif($user->hasRole('project manager'))
                                <td class="text-primary fw-bold btn-container"><span class="badge-proj">Project
                                        Manager</span></td>
                            @elseif($user->hasRole('admin'))
                                <td class="text-primary fw-bold btn-container"><span class="badge-ad">Admin</span></td>
                            @endif

                            @if ($user->is_active === 1)
                                <td>Active</td>
                            @else
                                <td>Inactive</td>
                            @endif

                            
                                <td>
                                    <a href="{{ route('users.edit', $user->id) }}" class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="4em" height="2em"
                                            viewBox="0 0 24 24">
                                            <path fill="black"
                                                d="m7 17.013l4.413-.015l9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583zM18.045 4.458l1.589 1.583l-1.597 1.582l-1.586-1.585zM9 13.417l6.03-5.973l1.586 1.586l-6.029 5.971L9 15.006z" />
                                            <path fill="black"
                                                d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01c-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2" />
                                        </svg>
                                    </a>
                                </td>
                        </tr>
                    @endforeach
                </table>

                <div class="pagination">
                    {{ $users->links() }}
                </div>

            </div>
        @endif
    </div>

    <style>
        body {
            background-color: #f2f2f2;
        }

        .acc-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .acc-header h2 {
            margin-top: 50px;
            font-weight: bold;
        }

        .below-header {
            display: flex;
            justify-content: space-between;
        }
        .add-btn {
            background: #2f2f2f;
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

        .left{
            justify-content: start;
        }

        .right{
            justify-content: end;
        }

        .search-bar {
            border-radius: 10px;
            margin-right: 5px;
            margin-top: 4px;
        }

        .right-part {
            display: flex;
            justify-content: end;
            margin-top:50px;
        }

        .profile {
            display: flex;
            flex-direction: row;
            justify-content: center;
            margin-bottom: 20px;
            padding: 16px;
            width: 100%;
            gap: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 2px 10px 4px #dcdcdc;
        }

        .pad-shadow {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0px 2px 10px 4px #dcdcdc;
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

        .table th,
        .table td {
            border: 1px solid #ddd;
            border-color: #2f2f2f;
            padding: 8 px;
            text-align: center;
            border: none;
        }

        .table th {
            background-color: #2f2f2f;
            color: #ddd;
            font-weight: bold;
        }

        .badge-dev {
            padding: 5px 10px;
            border: 1px solid #008000;
            border-radius: 15px;
            color: #008000;
        }

        .badge-proj {
            padding: 5px 10px;
            border: 1px solid #00008A;
            border-radius: 15px;
            color: #00008A;
        }

        .badge-ad {
            padding: 5px 10px;
            border: 1px solid #6A4C9C;
            border-radius: 15px;
            color: #6A4C9C;
        }

        .btn-container {
            justify-content: center;
        }

        .pagination {
            justify-content: center;
        }

        .pagination svg {
            display: none;
        }

        @media (max-width: 768px) {

            
            .right-part {
                display: flex;
                flex-direction: row;
                /* Stack elements vertically */
                align-items: stretch;
                /* Ensure elements take full width */
                margin: 10px;
                /* Adjust margin for mobile view */
            }

            .search-bar,
            .date-filter select,
            .date-filter input,
            .date-filter button {
                width: 100%;
                /* Ensure elements take full width */
                margin-bottom: 10px;
                /* Add space between elements */
            }

            .date-filter {
                display: flex;
                flex-direction: column;
                /* Stack elements vertically */
                align-items: stretch;
                /* Ensure elements take full width */
            }

            .table {
                width: 100%;
                /* Ensure table takes full width */
                overflow-x: auto;
                /* Enable horizontal scrolling if needed */
                display: block;
                /* Ensure table is block-level element */
            }

            .table th,
            .table td {
                white-space: nowrap;
                /* Prevent text from wrapping */
                overflow: hidden;
                /* Hide overflow text */
                text-overflow: ellipsis;
                /* Add ellipsis for overflow text */
            }
        }
    </style>

@endsection
