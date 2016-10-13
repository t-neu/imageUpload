@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row" style="margin-bottom: 25px;">
        <div class=".col-md-8" style="margin-left:5.5%;">
            <h2>{{ $user->first_name . " " . $user->last_name }}'s Gallery</h2>
            <img src="/mvc-examples/laravel/image-app/public/uploads/avatars/{{ $user->avatar }}" style="width:75px; height:75px; float:left; border-radius:50%; margin-right:25px;">
            <?php if(isset($badFile)) { 
                    if ($badFile == '1') { ?>
                        <p style="color:#FF0000;">Please upload  an image file.</p>
                    <?php }else{ ?>
                        <p>Image has been successfully updated.</p>
                  <?php } }?>
            <form enctype="multipart/form-data" action="{{ url('/gallery') }}" method="POST">
                <label>Add Gallery Image</label>
                <input type="file" name="image" style="width: 400px;>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="pull-left btn btn-sm btn-primary" style="margin-top: 10px;">
            </form>
        </div>
    </div>
    <div class="row">
        <div class="gallery container-fluid">
            @foreach ($imagelist as $images)
            <div class="col-md-4 img-responsive center-block" style="margin-bottom: 5px;">
                <img src="/mvc-examples/laravel/image-app/public/uploads/gallery/{{ $images }}" style="width:80%; height:80%; max-width:250px; float:left;">
            </div>
            @endforeach
        </div>
    </div>   
</div>
@endsection