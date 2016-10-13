@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row" style="margin-bottom: 25px;">
        <div class=".col-md-8" style="margin-left:5.5%;">
            <img src="/mvc-examples/laravel/image-app/public/uploads/avatars/{{ $user->avatar }}" style="width:120px; height:120px; float:left; border-radius:50%; margin-right:25px;">
            <h2>{{ $user->first_name . " " . $user->last_name }}'s Profile</h2>
            <?php if(isset($badFile)) { ?>
                <p style="color:#FF0000;">Please upload an image file.</p>
                <?php }else{ ?>
                <p>Image has been successfully updated.</p>
            <?php } ?>
            <form enctype="multipart/form-data" action="{{ url('/profile') }}" method="POST">
                <label>Update Profile Image</label>
                <input type="file" name="avatar">
        </div>
    </div>
    <div class="row" style="margin-bottom: 25px;">
        <div class="col-md-10 col-md-offset-1">
                    <label class="col-sm-2 control-label">First Name</label>
                    <input class="form-control" type="text" name="first_name" value="{{ $user->first_name }}">
                    <label class="col-sm-2 control-label">Last Name</label>
                    <input class="form-control" type="text" name="last_name" value="{{ $user->last_name }}">
                    <label class="col-sm-2 control-label">Email</label>
                    <input class="form-control" type="text" name="email" value="{{ $user->email }}"><br />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="pull-left btn btn-sm btn-primary">
            </form>
        </div>
    </div>
</div>
@endsection