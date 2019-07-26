@extends('layouts.admin') 
@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Update a Provider</h1>

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
        <form method="post" action="{{ route('admin.providers.save', $provider->id) }}" enctype="multipart/form-data">
            @method('PUT') 
            @csrf
            <div class="form-group">

                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" value={{ $provider->name }} />
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" value={{ $provider->email }} />
            </div>
            <div class="form-group">
                <label for="mobile">Mobile:</label>
                <input type="text" class="form-control" name="mobile" value={{ $provider->mobile }} />
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" class="form-control" name="description" value={{ $provider->description }} />
            </div>
            <div class="form-group">
                <label for="picture">Picture:</label>
                <input type="file" class="form-control" name="picture" value={{ $provider->picture }}   />
            </div>
            <div class="form-group">
                <label for="work">Work</label>
                <input type="text" class="form-control" name="work" value={{ $provider->work }} />
            </div>
            <div class="form-group">
                <label for="school">School:</label>
                <input type="text" class="form-control" name="school" value={{ $provider->school }} />
            </div>
            <div class="form-group">
                <label for="languages">Languages:</label>
                <input type="text" class="form-control" name="languages" value={{ $provider->languages }} />
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
