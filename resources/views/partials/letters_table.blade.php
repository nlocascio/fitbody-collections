    <!-- letters table -->
    <div class="table-full">
        <div class="table-responsive">
            <table class="table" data-sort="table">
                <thead>
                <tr>
                    <th class="col-sm-1 text-center">
                        <div class="pull-left">
                            <input type="checkbox" id="CheckAll">
                        </div>
                    </th>
                    <th class="header headerSortDown col-sm-1">#</th>
                    <th class="header col-sm-3">Customer name</th>
                    <th class="header col-sm-3">Description</th>
                    <th class="header col-sm-2">Date</th>
                    <th class="header col-sm-1">Total</th>
                </tr>
                </thead>
                <tbody>

                @foreach($letters as $letter)
                    <tr>
                        <td>
                            <div class="pull-left">
                                {!! Form::checkbox('letterCheckbox', $letter->id, false, ['class' => 'multiSelectCheckBox']) !!}

                                <div class="row">
                                    <div class="col-xs-5">
                                        {{--<input type="checkbox" name="letterCheckbox" value="{{$letter->id}}">--}}
                                    </div>
                                    <div class="col-xs-7">
                                        {{--{!! Form::open(['method' => 'delete', 'class' => 'form-inline', 'url' => route('customer.letter.destroy', ['customer' => $letter->customer, 'letter' => $letter])]) !!}--}}
                                        {{--{!! Form::button('<span class="icon icon-trash"></span>', ['class' => 'btn btn-primary-outline btn-xs', 'type' => 'submit']) !!}--}}
                                        {{--{!! Form::close() !!}--}}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><a href="/customer/{{$letter->customer->id}}/letter/{{$letter->id}}">#{{$letter->id}}</a>
                        </td>
                        <td>{{$letter->customer->last_name}}, {{$letter->customer->first_name}}</td>
                        <td>{{$letter->description}}</td>
                        <td>{{Carbon\Carbon::parse($letter->created_at)->toFormattedDateString()}}</td>
                        <td>{{$letter->amount}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
