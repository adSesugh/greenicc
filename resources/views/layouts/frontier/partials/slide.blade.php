@if($slides->count() > 0)
    <div class="slider-main">
        <div id="slider" class="nivoSlider">
            @foreach ($slides as $slide)
                <img src="{{ URL::to($slide->banner) }}" alt="" title="#{{$slide->id}}">
            @endforeach
        </div>
        @foreach ($slides as $s)
            <div id="{{$s->id}}" class="nivo-html-caption">
                <h2>{!! $s->overlay_text_title !!}</h2>	
                {!! $s->overlay_text !!}
            </div>
        @endforeach
    </div><!-- slider -->
@endif
