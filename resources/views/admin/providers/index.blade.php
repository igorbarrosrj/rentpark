@extends('layouts.admin')
@section('content')
<div class="col-sm-12">

  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div>
  @endif
</div>
<div class="row">
<div class="col-sm-12">

    <h1 class="display-3">Providers</h1> 
     <div>
    <a style="margin: 19px;" href="{{ route('admin.providers.create')}}" class="btn btn-primary">New Providers</a>
    </div>    
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Name</td>
          <td>Email</td>
          <td>Mobile</td>
          <td>work</td>
          <td>School</td>
          <td>Languages</td>
          <td colspan = 2>Actions</td>
        </tr>
    </thead>
    <tbody>
        @foreach($providers as $provider)
        <tr>
            <td>{{$provider->id}}</td>
            <td>{{$provider->name}}</td>
            <td>{{$provider->email}}</td>
            <td>{{$provider->mobile}}</td>
            <td>{{$provider->work}}</td>
            <td>{{$provider->school}}</td>
            <td>{{$provider->languages}}</td>
            <td>
                <a href="{{ route('admin.providers.view',$provider->id)}}" class="btn btn-primary">View</a>
            </td>
            <td>
                <a href="{{ route('admin.providers.edit',$provider->id)}}" class="btn btn-primary">Edit</a>
            </td>
            <td>
                <form action="{{ route('admin.providers.delete', $provider->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" onclick="return confirm('Are you sure to delete the provider ?')" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
 {{ $providers->onEachSide(2)->links() }}
</div>
@endsection

