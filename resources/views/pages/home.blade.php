@extends('layout')


@section('content')
    <div>
        <canvas
                class="ex-line-graph"
                data-chart="line"
                data-scale-line-color="transparent"
                data-scale-grid-line-color="rgba(255,255,255,.05)"
                data-scale-font-color="#a2a2a2"
                data-labels="['','Aug 29','','','Sept 5','','','Sept 12','','','Sept 19','']"
                data-value="[{fillColor: 'rgba(28,168,221,.03)', data: [2500, 3300, 2512, 2775, 2498, 3512, 2925, 4275, 3507, 3825, 3445, 3985]}]">
        </canvas>
    </div>
@endsection