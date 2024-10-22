@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="acc-header">
            <h2>OFFICES</h2>
            <div class="right-part">
                <a href="{{ route('accounts.create') }}" class="add-btn btn btn-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                        <path fill="white"
                            d="M12 4c4.411 0 8 3.589 8 8s-3.589 8-8 8s-8-3.589-8-8s3.589-8 8-8m0-2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2m5 9h-4V7h-2v4H7v2h4v4h2v-4h4z" />
                    </svg>
                    Add office
                </a>
            </div>
        </div>
        <div class="bg-gray">
            <table class="table">
                <tr class="fw-bold">
                    <th>Office name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>


            </table>
        </div>
    </div>

    <style>
        body{
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

        .search-bar {
            border-radius: 10px;
            margin-right: 5px;
            margin-top: 4px;
        }

        .right-part {
            display: flex;
            justify-content: end;
            margin-top: 50px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 2px 10px 4px #dcdcdc;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            border-color: #2f2f2f;
            padding: 8  px;
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
    </style>
@endsection
