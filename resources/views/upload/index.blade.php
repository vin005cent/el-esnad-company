<?php
//dd( url("/uploads/images/" . Session::get('imageName')) );
//http://127.0.0.1:8000/uploads/images/1594123630.jpeg
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload Image</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<body>

<div class="container" style="padding-top: 200px;">

    <div class="content">

        <h1>Upload Form</h1><br><br><br>
        <div class="row">

            <div class="col-md-4">

                <!-- Show alert messages -->
                @if(session()->has('flash_success_message'))
                    <div class="alert alert-success">
                        {{ session()->get('flash_success_message') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>

                    </div>

                @endif

                <form class="form-control" method="POST" action="{{ route('upload.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="file" name="file">
                    </div>
                    <div class="form-group">
                        <input class="btn btn-info" type="submit" value="Upload" accept="image/*">
                    </div>
                </form>
            </div>

            <!--SHOW IMAGES-->
            <div class="show-images col-md-8">
                <div class="row">

                    @if(!Session::has('imageName'))
                        <div class="col-md-6 alert alert-info">
                            No images Found
                        </div>

                    @else
                        <div class="col-md-4 images-space">
                            <strong>Original Image:</strong>
                            <br/>
                            <img src="{{ url("/uploads/images/" . Session::get('imageName')) }}" />
                        </div>

                        <div class="col-md-2 images-space">
                            <strong>100 X 100:</strong>
                            <br/>
                            <img src="{{ url("/uploads/thumbnail2/" . Session::get('imageName')) }}" />
                        </div>

                        <div class="col-md-2 images-space">
                            <strong>50 X 50:</strong>
                            <br/>
                            <img src="{{ url("/uploads/thumbnail/" . Session::get('imageName')) }}" />
                        </div>
                    @endif

                </div>
            </div>

        </div>


    </div>
</div>



<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>
