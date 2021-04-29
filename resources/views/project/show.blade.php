@extends('layouts.master')

@section('title') {{$project->title }} Profile @stop

@section('content')
<div class="container-fluid">
    <x-breadcrumb type="Project" action="profile" />

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-5">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">
                                {{$project->title}} Profile 
                                <small>
                                    @if($project->published)
                                        <span class="badge badge-pill badge-success">Published</span>
                                    @else
                                        <span class="badge badge-pill badge-info">Unpublished</span>
                                    @endif
                                </small>
                            </h4>
                            <hr>
                            <div class="form-group row">
                                <div class="col-12" style="text-align:justify;">
                                    {!! $project->body !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card m-b-20">
                        <div class="card-body">
                            @if(count($project->gallery) > 0)
                                <div class="col-12">
                                    <div class="row">
                                        @foreach ($project->gallery as $item)
                                            <div class="col-3">
                                                <img src="{{ URL::to($item->picture) }}" alt="{{ config('app.name') }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="col-12" style="text-align:center;">
                                    No Gallery found!
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection