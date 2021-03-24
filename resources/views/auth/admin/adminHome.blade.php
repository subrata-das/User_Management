@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Users List</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div  class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr class="table-primary">
                                    <th>Name</th>
                                    <th>Email ID</th>
                                    <th>Mobile Number</th>
                                    {{--  <th>Status</th>  --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($usersInfo as $userInfo)

                                    @if ($userInfo->userInfo)
                                    @php
                                        $UserInfo=$userInfo;
                                    @endphp
                                    <tr id="tr_{{ $userInfo->id }}">
                                        <td>
                                            {{ $userInfo->name }}
                                        </td>
                                        <td>
                                            {{ $userInfo->email }}
                                        </td>
                                        <td>
                                                {{ $userInfo->userInfo->mobile_no }}
                                        </td>
                                        <td>
                                            <a href="{{ route('userShow',['id'=>$userInfo->id]) }}" target="_blank" class="btn btn-primary" >View</a>
                                            <a href="{{ route('userEdit',['id'=>$userInfo->id]) }}" target="_blank" class="btn btn-secondary" >Edit</a>
                                            <button class="btn btn-danger delete" id="{{ $userInfo->id }}" >Delete</button>
                                        </td>
                                    </tr>
                                    @endif
                                @empty
                                <tr>
                                    <td>
                                        No record found
                                    </td>
                                </tr>
                                @endforelse

                                @php
                                    $phpPouteUrl = "";
                                @endphp
                                
                                @if (isset($UserInfo))
                                    @php
                                        $phpPouteUrl = route('userDestroy',['id'=>$userInfo->id]);
                                    @endphp
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    
                   
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.delete').click(function(){
            var id = $(this).attr('id');
            var routeUrl= "<?php echo $phpPouteUrl; ?>";

            if(routeUrl.length>0){
                routeUrl= routeUrl.split('/');
                routeUrl[routeUrl.length-1]=id;
                routeUrl=routeUrl.join('/');
            }
            
            $.ajax({
                url:routeUrl,
                method:'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data){
                    console.log(data);
                },
                // error:function(err){
                //     console.log(err);
                // }
                
            });
            $('$tr_'+id).fadeOut();
            // console.log(routeUrl);
        });
    });
</script>

@endsection
