@extends('layouts.master')

@section('title') Modify {{$team->name }} Profile @stop

@section('content')
<div class="container-fluid">
    <x-breadcrumb type="Team" action="Modify a Team Member" />

    <div class="row">
        <div class="col-lg-12">
            {!! Form::model($team, ['method' => 'PATCH', 'route' => ['teams.update', $team->id], ]) !!}
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card m-b-20">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Modify {{ $team->name }}</h4>
                                <hr>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">Member Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Member Name" value="{{ $team->name }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="role" class="col-sm-3 col-form-label">Member Position</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="role" name="role" class="form-control @error('role') is-invalid @enderror" placeholder="Member Position" value="{{ $team->role }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fb_url" class="col-sm-3 col-form-label">Facebook URL</label>
                                    <div class="col-sm-9">
                                        <input type="url" id="fb_url" name="fb_url" class="form-control @error('fb_url') is-invalid @enderror" placeholder="Facebook URL" value="{{ $team->fb_url }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="twitter_url" class="col-sm-3 col-form-label">Twitter URL</label>
                                    <div class="col-sm-9">
                                        <input type="url" id="twitter_url" name="twitter_url" class="form-control @error('twitter_url') is-invalid @enderror" placeholder="Twitter URL" value="{{ $team->twitter_url }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="insta_url" class="col-sm-3 col-form-label">Instagram URL</label>
                                    <div class="col-sm-9">
                                        <input type="url" id="insta_url" name="insta_url" class="form-control @error('insta_url') is-invalid @enderror" placeholder="Instagram URL" value="{{ $team->insta_url }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="linkedin_url" class="col-sm-3 col-form-label">LinkedIn URL</label>
                                    <div class="col-sm-9">
                                        <input type="url" id="linkedin_url" name="linkedin_url" class="form-control @error('linkedin_url') is-invalid @enderror" placeholder="LinkedIn URL" value="{{ $team->linkedin_url }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="published" class="col-sm-3 col-form-label">Published</label>
                                    <div class="col-sm-9">
                                        <input type="checkbox" id="switch1" class="form-control @error('published') is-invalid @enderror" name="published" switch="none" @if($team->published) checked @endif />
                                            <label for="switch1" data-on-label="Yes"
                                                    data-off-label="No"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card m-b-20">
                            <div class="card-body">
                                <div class="form-group float-center">
                                    <img src="@if(is_null($team->picture)){{URL::to('assets/images/users/user-4.jpg')}} @else {{ URL::to($team->picture) }} @endif" id="photo" style="width:100%; height:347px; margin-top:10px;" alt="Greenicc">
                                    <div>
                                        <input type="file" id="picture" class="form-control @error('picture') is-invalid @enderror" name="picture" id="picture" accept="image/*" onchange="showMyImage(this)" value="{{ old('picture') }}" />
                                    </div>
                                </div>
                                <div class="form-group float-right">
                                    <div class="">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            Save Change
                                        </button>
                                        <a href="{{ route('teams.index') }}" class="btn btn-secondary waves-effect m-l-5"><i class="ion-arrow-left-c"></i> Cancel</a>
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