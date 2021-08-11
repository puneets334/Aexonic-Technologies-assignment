@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Status</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Pin Code</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key=>$user)
                        @php
                            $countryName = \App\Models\Country::where('id',$user->country)->first();
                            $cityName = \App\Models\Cities::where('id',$user->country)->first();
                            $stateName = \App\Models\State::where('id',$user->country)->first();
                        @endphp
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><img src="{{ $user->image }}" style="width: 100px;"></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->mobile }}</td>
                            <td>
                                @if($user->status == 'Active')
                                    <a href="javascript:;" onclick="changeStatus('{{ $user->id }}','Inactive');">{{ $user->status }}</a>
                                @else
                                    <a href="javascript:;" onclick="changeStatus('{{ $user->id }}','Active');">{{ $user->status }}</a>
                                @endif
                            </td>
                            <td>{{ $countryName->name }}</td>
                            <td>{{ $cityName->name }}</td>
                            <td>{{ $stateName->name }}</td>
                            <td>{{ $user->pincode }}</td>
                            <td>
                                <a href="{{ route('edit',[$user->id]) }}" class="btn btn-sm btn-primary">Edit </a>
                                <a href="{{ route('delete',[$user->id]) }}" onclick="return confirm('Do you really want to delete this?');" class="btn btn-sm btn-warning">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('footer-script')
    <script>
        function changeStatus(id,val) {
            $.ajax({
                url: "{{route('changeStatus')}}",
                type: "POST",
                data: {
                    user_id: id,
                    status: val,
                    _token: '{{csrf_token()}}'
                },
                success: function (data) {
                    if(data == 'success') {
                        alert('status updated successfully');
                        window.location.reload();
                    }
                }
            });
        };
    </script>
@endpush