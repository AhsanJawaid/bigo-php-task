@extends('layouts.app-master')

@section('content')
<div class="bg-light p-5 rounded">
    @auth
    @if(count($arrValues) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Profile Url</th>
                <th scope="col">Cover Letter</th>
                <th sXcope="col">Resume</th>
                <th sXcope="col">Status</th>
                <th sXcope="col">Options</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($arrValues as $key => $value)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td>{{ $value->username }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->profile_url }}</td>
                    <td>{{ $value->cover_letter }}</td>
                    <td><a href="{{ URL::to('storage/app/public/uploads/'.$value->resume) }}" target="_blank">{{ $value->resume }}</a></td>
                    @php 
                        $status = '';
                        if($value->status == 1){
                            $status = 'Pending Review';
                        } else if($value->status == 2){
                            $status = 'Ready For Interview';
                        } else if($value->status == 3){
                            $status = 'Archived';
                        }
                    @endphp
                    <td>{{ $status }}</td>
                    <td>
                        @if($value->status == 1)
                            <a href='{{ URL::to("applicants-list/".$value->id."/2") }}'>Mark as ReadyToInterview</a>
                            <a href='{{ URL::to("applicants-list/".$value->id."/3") }}'>Mark as Archived</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    @endauth
</div>
@endsection