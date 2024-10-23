@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="header">
            <div>
                <h3 class="text-bold">ADD OFFICE</h3>
            </div>
            <div>
                <a href="{{ route('accounts.index') }}" class="btn btn-outline-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                        <g fill="none" fill-rule="evenodd">
                            <path
                                d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                            <path fill="currentColor"
                                d="M2.614 5.426A1.5 1.5 0 0 1 4 4.5h10a7.5 7.5 0 1 1 0 15H5a1.5 1.5 0 0 1 0-3h9a4.5 4.5 0 1 0 0-9H7.621l.94.94a1.5 1.5 0 0 1-2.122 2.12l-3.5-3.5a1.5 1.5 0 0 1-.325-1.634" />
                        </g>
                    </svg>
                    Back</a>
            </div>
        </div>

        <div>
            <form action="{{ route('offices.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="office_name" class="form-label fw-bold">Office name</label>
                    <input type="text" class="form-control" name="office_name" id="office_name"
                        placeholder="Enter office name">
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Is Active?</label>
                    <select name="is_active" id="is_active" class="form-control">
                        <option value="1" selected>Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-dark">
                        Add office
                    </button>
                </div>
            </form>     
        </div>
    </div>

    <style>
        body {
            background-color: #f2f2f2;
        }

        .header {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            padding: 24px;
        }

        .header h3 {
            font-weight: 700;
            margin-top: 50px;
        }

        .btn {
            margin-top: 50px;
        }

        form {
            padding: 24px;
        }
    </style>
@endsection
