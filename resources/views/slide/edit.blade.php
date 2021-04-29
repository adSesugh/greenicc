@extends('layouts.master')

@section('title') Modify Slide @stop

@section('content')
<div class="container-fluid">
    <x-breadcrumb type="Slides" action="Add a slide" />

    <div class="row">
        <div class="col-lg-12">
            {!! Form::model($slide, ['method' => 'PATCH', 'route' => ['slides.update', $slide->id], ]) !!}
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card m-b-20">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Creating a new slide</h4>
                                <hr>
                                <div class="form-group row">
                                    <label for="overlay_text_title" class="col-sm-3 col-form-label">Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="overlay_text_title" name="overlay_text_title" class="form-control @error('overlay_text_title') is-invalid @enderror" placeholder="Overlay text title" value="{{ $slide->overlay_text_title }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label">Published</label>
                                    <div class="col-sm-9">
                                        <input type="checkbox" id="switch1" class="form-control @error('status') is-invalid @enderror" name="status" switch="none" @if($slide->status) checked @endif />
                                            <label for="switch1" data-on-label="Yes"
                                                    data-off-label="No"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="overlay_text" class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control @error('overlay_text') is-invalid @enderror" name="overlay_text" rows="6">{{ $slide->overlay_text }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group float-right">
                                    <div class="">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            Save Change
                                        </button>
                                        <a href="{{ route('slides.index') }}" class="btn btn-secondary waves-effect m-l-5"><i class="ion-arrow-left-c"></i> Cancel</a>
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