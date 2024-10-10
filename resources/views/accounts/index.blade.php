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
                    @if ($account->role->role_description)
                        @if($role->role_description == 'Developer')
                                <td class="bg-success">{{$account->role->role_description}}</td>
                                @else
                                <td class="bg-primary">{{$account->role->role_description}}</td>
                        @endif
                    @endif
                    <td><a href="{{route('accounts.edit', ['account' => $account])}}" class=" btn btn-dark">Edit</a></td>
                </tr>  
                          
            @endforeach
        </table>
    </div>
</div>
@endsection