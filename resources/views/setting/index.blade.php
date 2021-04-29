@extends('layouts.master')

@section('title') Setting @stop

@section('content')
<div class="container-fluid">
    <x-breadcrumb type="Setting" action="Details" />

    <div class="row">
        <div class="col-lg-12">
            <form class="" action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$setting->id}}">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card m-b-20">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Settings</h4>
                                <hr>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">Business Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Business Name" value="{{ $setting->name }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="col-sm-3 col-form-label">Phone Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone Number" value="{{ $setting->phone }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Email address</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email address" value="{{ $setting->email }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fb_url" class="col-sm-3 col-form-label">Facebook URL</label>
                                    <div class="col-sm-9">
                                        <input type="url" id="fb_url" name="fb_url" class="form-control @error('fb_url') is-invalid @enderror" placeholder="Facebook URL" value="{{ $setting->fb_url }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="twitter_url" class="col-sm-3 col-form-label">Twitter URL</label>
                                    <div class="col-sm-9">
                                        <input type="url" id="twitter_url" name="twitter_url" class="form-control @error('twitter_url') is-invalid @enderror" placeholder="Twitter URL" value="{{ $setting->twitter_url }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="insta_url" class="col-sm-3 col-form-label">Instagram URL</label>
                                    <div class="col-sm-9">
                                        <input type="url" id="insta_url" name="insta_url" class="form-control @error('insta_url') is-invalid @enderror" placeholder="Instagram URL" value="{{ $setting->insta_url }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="linkedin_url" class="col-sm-3 col-form-label">LinkedIn URL</label>
                                    <div class="col-sm-9">
                                        <input type="url" id="linkedin_url" name="linkedin_url" class="form-control @error('linkedin_url') is-invalid @enderror" placeholder="LinkedIn URL" value="{{ $setting->linkedin_url }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="google_url" class="col-sm-3 col-form-label">Google URL</label>
                                    <div class="col-sm-9">
                                        <input type="url" id="google_url" name="google_url" class="form-control @error('google_url') is-invalid @enderror" placeholder="Google URL" value="{{ $setting->google_url }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" rows="3" placeholder="Address">{{ $setting->address }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="about_us" class="col-sm-3 col-form-label">About us</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control @error('about_us') is-invalid @enderror" name="about_us" id="description" rows="6">{{ $setting->about_us }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card m-b-20"> 
                            <div class="card-body">
                                <div class="form-group float-center">
                                    <img src="@if(is_null($setting->logo)) {{URL::to('assets/images/users/logo.jpg')}} @else {{ URL::to($setting->logo) }} @endif" id="logo" style="width:100%; height:250px; margin-top:10px;" alt="Greenicc">
                                    <div>
                                        <input type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" accept="image/*" onchange="showMyImage(this)" placeholder="Logo" value="{{ old('picture') }}" />
                                    </div>
                                </div>
                                <div class="form-group float-center">
                                    <img src="@if(is_null($setting->breadcrumb)) {{URL::to('assets/images/users/breadcrumb.jpg')}} @else {{ URL::to($setting->breadcrumb) }} @endif" id="breadcrumb" style="width:100%; height:150px; margin-top:10px;" alt="Greenicc">
                                    <div>
                                        <input type="file" class="form-control @error('breadcrumb') is-invalid @enderror" name="breadcrumb" accept="image/*" onchange="showMyImage1(this)" value="{{ old('breadcrumb') }}" />
                                    </div>
                                </div>
                                <div class="form-group float-center">
                                    <img src="@if(is_null($setting->whyus_background)) {{URL::to('assets/images/users/background.jpg')}} @else {{URL::to($setting->whyus_background)}} @endif" id="whyus_background" style="width:100%; height:250px; margin-top:10px;" alt="Greenicc">
                                    <div>
                                        <input type="file" class="form-control @error('whyus_background') is-invalid @enderror" name="whyus_background" accept="image/*" onchange="showMyImage2(this)" value="{{ old('whyus_background') }}" />
                                    </div>
                                </div>
                                <div class="form-group float-right">
                                    <div class="">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            Save Changes
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
    <!--Wysiwig js-->
    <script src="{{ URL::asset('assets/plugins/tinymce/tinymce.min.js')}}"></script>

<script>
    $(document).ready(function () {
        if($("#description").length > 0){
            tinymce.init({
                selector: "textarea#description",
                theme: "modern",
                height:200,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                style_formats: [
                    {title: 'Bold text', inline: 'b'},
                    {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                    {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                    {title: 'Example 1', inline: 'span', classes: 'example1'},
                    {title: 'Example 2', inline: 'span', classes: 'example2'},
                    {title: 'Table styles'},
                    {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                ]
            });
        }
    });
    function showMyImage(fileInput) {

        var files = fileInput.files;

        for (var i = 0; i < files.length; i++) { 
            var file = files[i];
            var imageType = /image.*/; 

            if (!file.type.match(imageType)) {
                continue;
            } 

            var img=document.getElementById("logo"); 
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

    function showMyImage1(fileInput) {

        var files = fileInput.files;

        for (var i = 0; i < files.length; i++) { 
            var file = files[i];
            var imageType = /image.*/; 

            if (!file.type.match(imageType)) {
                continue;
            } 

            var img=document.getElementById("breadcrumb"); 
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

    function showMyImage2(fileInput) {

        var files = fileInput.files;

        for (var i = 0; i < files.length; i++) { 
            var file = files[i];
            var imageType = /image.*/; 

            if (!file.type.match(imageType)) {
                continue;
            } 

            var img=document.getElementById("whyus_background"); 
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