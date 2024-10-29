@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="acc-header">
            <h2>PROJECTS</h2>
            <div class="right-part">
                @if (auth()->user()->hasRole('project manager'))
                    <a href="{{ route('projects.create') }}" class="add-btn btn btn-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="white"
                                d="M12 4c4.411 0 8 3.589 8 8s-3.589 8-8 8s-8-3.589-8-8s3.589-8 8-8m0-2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2m5 9h-4V7h-2v4H7v2h4v4h2v-4h4z" />
                        </svg>
                        Add project
                    </a>
                @endif
            </div>
        </div>
        <div class="below-header">
            <div class="left-part">
                <form action="{{ route('projects.index') }}" method="get">
                    <input type="search" class="search-bar" placeholder="Search here.." name="search" id="search">
                </form>
            </div>
            <div class="right-part">
                <div class="date-filter">
                    <form action="{{ route('projects.index') }}" method="GET">
                        <select id="status-filter" name="status">
                            <option value="">Select Status</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="On-going development">On-going Deployment</option>
                            <option value="For deployment">For Development</option>
                            <option value="For update">For Update</option>
                            <option value="Deployed">Deployed</option>
                        </select>

                        <label for="start_date">Start Date:</label>
                        <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}">

                        <label for="end_date">End Date:</label>
                        <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}">

                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path fill="white" fill-rule="evenodd"
                                    d="M4.953 2.25h14.094c.667 0 1.237 0 1.693.057c.483.061.95.198 1.334.558c.39.367.545.824.613 1.299c.063.437.063.98.063 1.6v.776c0 .489 0 .91-.036 1.263c-.04.38-.125.735-.331 1.076c-.205.339-.48.585-.798.805c-.299.208-.68.423-1.13.676l-2.942 1.656c-.67.377-.903.513-1.059.648c-.357.31-.562.655-.658 1.086c-.041.185-.046.417-.046 1.123v2.732c0 .901 0 1.666-.093 2.255c-.098.625-.327 1.225-.927 1.6c-.587.367-1.232.333-1.86.184c-.605-.143-1.35-.435-2.244-.784l-.086-.034c-.42-.164-.786-.307-1.076-.457c-.312-.161-.602-.361-.823-.673c-.225-.316-.314-.654-.355-1c-.036-.315-.036-.693-.036-1.115v-2.708c0-.706-.004-.938-.046-1.123a1.93 1.93 0 0 0-.658-1.086c-.156-.135-.39-.271-1.059-.648L3.545 10.36c-.45-.253-.831-.468-1.13-.676c-.318-.22-.593-.466-.798-.805c-.206-.341-.291-.697-.33-1.076c-.037-.352-.037-.774-.037-1.263v-.776c0-.62 0-1.163.063-1.6c.068-.475.223-.932.613-1.299c.384-.36.85-.497 1.334-.558c.456-.057 1.026-.057 1.693-.057M3.448 3.796c-.334.042-.44.11-.495.163c-.05.046-.114.127-.156.418c-.045.318-.047.752-.047 1.438v.69c0 .534 0 .878.028 1.144c.026.247.07.366.124.455c.055.091.147.194.368.348c.234.162.553.343 1.04.617l2.913 1.64l.08.045c.56.315.94.529 1.226.777a3.43 3.43 0 0 1 1.14 1.893c.081.367.081.78.081 1.36v2.759c0 .472.001.762.027.98c.022.198.059.265.086.304c.03.042.09.107.289.21c.212.109.505.224.967.405c.961.376 1.608.627 2.097.743c.479.114.637.055.718.004c.068-.043.173-.13.242-.563c.072-.457.074-1.103.074-2.084v-2.758c0-.58 0-.993.082-1.36a3.43 3.43 0 0 1 1.139-1.893c.286-.248.667-.463 1.225-.777l.081-.045l2.913-1.64c.487-.274.806-.455 1.04-.617c.221-.154.313-.257.368-.348c.054-.089.098-.208.123-.455c.028-.266.029-.61.029-1.145v-.69c0-.685-.002-1.12-.047-1.437c-.042-.291-.107-.372-.155-.418c-.056-.052-.162-.121-.496-.163c-.35-.045-.825-.046-1.552-.046H5c-.727 0-1.201.001-1.552.046"
                                    clip-rule="evenodd" />
                            </svg>
                            Filter</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="bg-gray">
        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            <table class="table">
                <tr class="fw-bold">
                    <th>Project name</th>
                    <th>Product owner</th>
                    <th>Developer</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>

                @foreach ($projects as $project)
                    <tr>
                        <td class="fw-bold"><a href="{{ url('/projects/' . $project->id) }}"
                                class="title">{{ $project->project_name }}</a></td>
                        <td>{{ $project->office->office_name }}</td>
                        <td>{{ $project->user->last_name }}, {{ $project->user->first_name }}
                            {{ $project->user->middle_name }}</td>
                        <td>{{ $project->status }}</td>
                        <td>
                            <a href="{{ route('projects.edit', ['project' => $project]) }}" class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="4em" height="2em" viewBox="0 0 24 24">
                                    <path fill="black"
                                        d="m7 17.013l4.413-.015l9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583zM18.045 4.458l1.589 1.583l-1.597 1.582l-1.586-1.585zM9 13.417l6.03-5.973l1.586 1.586l-6.029 5.971L9 15.006z" />
                                    <path fill="black"
                                        d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01c-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2" />
                                </svg>
                            </a>
                            <a href="{{ url('logs/' . $project->id) }}" class="title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="4em" height="2em" viewBox="0 0 24 24">
                                    <g fill="none" stroke="black" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2">
                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0-18 0" />
                                        <path d="M12 7v5l3 3" />
                                    </g>
                                </svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>

            <div class="pagination">
                {{ $projects->links() }}
            </div>

        </div>
    </div>

    <script>
        document.getElementById('filter-button').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the form from submitting immediately

            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;
            const status = document.getElementById('status-filter').value;

            const url = new URL(window.location.href);
            if (startDate) url.searchParams.set('start_date', startDate);
            if (endDate) url.searchParams.set('end_date', endDate);
            if (status) url.searchParams.set('status', status);

            window.location.href = url.toString();
        });
    </script>

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

        .below-header {
            display: flex;
            justify-content: space-between;
        }

        .right-part {
            display: flex;
            justify-content: end;
            margin-bottom: 10px;
        }

        .date-filter {
            margin-right: 5px;
            margin-top: 5px;
        }

        .search-bar {
            border-radius: 10px;
            margin-right: 5px;
            margin-top: 4px;
        }

        .acc-header h2 {
            font-weight: bold;
            margin-top: 50px;
        }

        .add-btn {
            background: #2f2f2f;
            margin-top: 50px;
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

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 2px 10px 4px #dcdcdc;
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

        .btn-container {
            justify-content: center;
        }

        .pagination {
            justify-content: center;
        }

        .pagination svg {
            display: none;
        }
    </style>
@endsection
