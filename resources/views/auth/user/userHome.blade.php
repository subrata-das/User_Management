@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile Info</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div  class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $userInfo->name }}</td>
                                </tr>
                                <tr>
                                    <th>User Name</th>
                                    <td>{{ $userInfo->username }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $userInfo->email }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div  class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Date of birth</th>
                                    <td>{{ $userInfo->userInfo->DOB }}</td>
                                </tr>
                                <tr>
                                    <th>Mobile No.</th>
                                    <td>{{ $userInfo->userInfo->mobile_no }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $userInfo->userInfo->address }}</td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td>{{ $userInfo->userInfo->city }}</td>
                                </tr>
                                <tr>
                                    <th>State</th>
                                    <td>{{ $userInfo->userInfo->state }}</td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td>{{ $userInfo->userInfo->country }}</td>
                                </tr>

                                <tr>
                                    <th>Profile Image</th>
                                    <td>
                                        <img src="{{ asset('storage/'.$userInfo->userInfo->image) }}" height="75px" width="75px" alt="Profile Image">
                                        {{--  {{ $userInfo->userInfo->image }}  --}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
