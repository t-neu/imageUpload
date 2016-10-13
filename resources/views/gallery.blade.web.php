@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>{{ $user->first_name . " " . $user->last_name }}'s Gallery</h2>
            <img src="/mvc-examples/laravel/image-app/public/uploads/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
            <?php if(isset($badFile)) { ?>
                <p style="color:#FF0000;">Please upload an image file.</p>
                <?php }else{ ?>
                <p>Image has been successfully updated.</p>
            <?php } ?>
            <form enctype="multipart/form-data" action="{{ url('/gallery') }}" method="POST">
                <label>Add Gallery Image</label>
                <input type="file" name="image">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="pull-left btn btn-sm btn-primary">
            </form>
            <div class="gallery">
            {{  }}
            @foreach ($imagelist as $images)
            <div class="col-md-4">
                <img src="/mvc-examples/laravel/image-app/public/uploads/gallery/{{ $images }}" style="width:150px; height:150px; float:left;">
            </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection