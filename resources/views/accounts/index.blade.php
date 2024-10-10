@extends('layouts.app')
@section('content')
<div class="container">
    <a href="{{route('accounts.create')}}" class="btn btn-primary">
        Add
    </a>
    <div class="bg-gray">
        <table class="table">
            <tr class="fw-bold">
                <th>Complete name</th>
                <th>Username</th>
                <th>Access</th>
                <th>Actions</th>
            </tr>

            @foreach ($accounts as $account) 
                <tr>
                    <td>{{$account->last_name}}, {{$account->first_name}} {{$account->middle_name}}</td>
                    <td>{{$account->username}}</td>
                    @if ($account->is_admin === 0)
                        <td class="text-success fw-bold">Developer</td>
                        @elseif($account->is_admin === 1)
                        <td class="text-primary fw-bold">Project Manager</td>
                    @endif
                    @if($account->is_active === 1)
                        <td>Active</td>
                        @else
                        <td>Inactive</td>
                    @endif
                    <td><a href="{{route('accounts.edit', ['account' => $account])}}" class=" btn btn-dark">Edit</a></td>
                </tr>  
                          
            @endforeach
        </table>
    </div>
</div>
@endsection