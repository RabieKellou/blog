@extends('layouts.app')
@section('content')
    <form action="{{ route('users.update',['user'=>$user->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-4">
                <h5>choose a new avatar</h5>
                <img src="{{ $user->image? $user->image->url() : '' }}" alt="" class="img-thumbnail">
                <input type="file" name="avatar" id="avatar" class="form-control-file">
            </div>
            <div class="col-md-8">
                <div class="for-group">
                    <label for="name">Name : </label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name',$user->name) }}">

                </div>
                <div class="for-group">
                    <label for="language">Language : </label>
                    <select name="locale" id="language" class="form-control mb-3">
                        @foreach (App\User::LOCALES as $locale => $label)
                            <option value="{{ $locale }}" {{ $user->locale=== $locale? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-warning btn-block">Update</button>
            </div>
        </div>
    </form>
@endsection
