@extends('layouts.admin') 
@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Update Admin Details</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br /> 
        @endif
        <form method="post" action="{{ route('admin.profile.save', $admin->id)}}" enctype="multipart/form-data">
            @method('PUT') 
            @csrf
            <div class="form-group">

                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" value={{ $admin->name }} />
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" value={{ $admin->email }} />
            </div>
            <div class="form-group">
                <label for="mobile">Mobile:</label>
                <input type="number" class="form-control" name="mobile" value={{ $admin->mobile }} />
            </div>
            <div class="form-group">
                <label for="about">About:</label>
                <input type="text" class="form-control" name="about" value={{ $admin->about }} />
            </div>
            <div class="form-group">
                <label for="picture">Picture:</label>
                <input type="file" class="form-control" name="picture" value={{ $admin->picture }}   />
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
