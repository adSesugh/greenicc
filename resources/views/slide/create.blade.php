@extends('layouts.master')

@section('title') Add Slide @stop

@section('content')
<div class="container-fluid">
    <x-breadcrumb type="Slides" action="Add a slide" />

    <div class="row">
        <div class="col-lg-12">
            <form class="" action="{{ route('slides.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card m-b-20">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Creating a new slide</h4>
                                <hr>
                                <div class="form-group row">
                                    <label for="overlay_text_title" class="col-sm-3 col-form-label">Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="overlay_text_title" name="overlay_text_title" class="form-control @error('overlay_text_title') is-invalid @enderror" placeholder="Overlay text title" value="{{ old('overlay_text_title') }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label">Published</label>
                                    <div class="col-sm-9">
                                        <input type="checkbox" id="switch1" class="form-control @error('status') is-invalid @enderror" name="status" switch="none" />
                                            <label for="switch1" data-on-label="Yes"
                                                    data-off-label="No"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="overlay_text" class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control @error('overlay_text') is-invalid @enderror" name="overlay_text" rows="6">{{ old('overlay_text') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card m-b-20">
                            <div class="card-body">
                                <div class="form-group float-center">
                                    <img src="{{URL::to('assets/images/users/user-4.jpg')}}" id="photo" style="width:100%; height:250px; margin-top:10px;" alt="Greenicc">
                                    <div>
                                        <input type="file" id="banner" class="form-control @error('banner') is-invalid @enderror" name="banner" id="banner" accept="image/*" onchange="showMyImage(this)" value="{{ old('banner') }}" />
                                    </div>
                                </div>
                                <div class="form-group float-right">
                                    <div class="">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            Submit
                                        </button>
                                        <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
</div>
@endsection

@section('script')
<script>
    function showMyImage(fileInput) {

        var files = fileInput.files;

        for (var i = 0; i < files.length; i++) { 
            var file = files[i];
            var imageType = /image.*/; 

            if (!file.type.match(imageType)) {
                continue;
            } 

            var img=document.getElementById("photo"); 
            img.file = file; 
            var reader = new FileReader();

            reader.onload = (function(aImg) { 
                return function(e) { 
                aImg.src = e.target.result; 
                }; 
            })(img);

            reader.readAsDataURL(file);
        } 
    }
</script>
@endsection