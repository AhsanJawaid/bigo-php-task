@extends('layouts.app-master')

@section('content')
@auth
    <form method="post" action="{{ route('application._add') }}" enctype="multipart/form-data">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="user_id" value="{{ $UserId }}" />
        <input type="hidden" name="id" value="{{ $ApplicationId }}" />
        
        <h1 class="h3 mb-3 fw-normal">Submit Application</h1>

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="profile_url" placeholder="e.g. LinkedIn" value="{{ (isset($arrValues[0]) ? $arrValues[0]->profile_url : "") }}" required="required" autofocus>
            <label for="floatingProfileUrl">Profile Url</label>
            @if ($errors->has('profile_url'))
                <span class="text-danger text-left">{{ $errors->first('profile_url') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <textarea class="form-control" name="cover_letter" placeholder="Cover Letter" required="required" autofocus>{{ (isset($arrValues[0]) ? $arrValues[0]->cover_letter : "") }}</textarea>
            <label for="floatingCoverLetter">Cover Letter</label>
            @if ($errors->has('cover_letter'))
                <span class="text-danger text-left">{{ $errors->first('cover_letter') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="file" class="form-control" name="resume" value="{{ (isset($arrValues[0]) ? $arrValues[0]->resume : "") }}" />
            <label for="floatingResume">Resume</label>
            @if ($errors->has('resume'))
                <span class="text-danger text-left">{{ $errors->first('resume') }}</span>
            @endif
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Submit Application</button>
        
    </form>
@endauth
@endsection
