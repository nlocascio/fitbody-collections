    <!-- Email Table -->
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

                @foreach($emails as $email)
                    <tr>
                        <td>
                            <div class="pull-left">
                                {!! Form::checkbox('emailCheckbox', $email->id, false, ['class' => 'multiSelectCheckBox']) !!}

                                <div class="row">
                                    <div class="col-xs-5">
                                        {{--<input type="checkbox" name="emailCheckbox" value="{{$email->id}}">--}}
                                    </div>
                                    <div class="col-xs-7">
                                        {{--{!! Form::open(['method' => 'delete', 'class' => 'form-inline', 'url' => route('customer.email.destroy', ['customer' => $email->customer, 'email' => $email])]) !!}--}}
                                        {{--{!! Form::button('<span class="icon icon-trash"></span>', ['class' => 'btn btn-primary-outline btn-xs', 'type' => 'submit']) !!}--}}
                                        {{--{!! Form::close() !!}--}}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><a href="/customer/{{$email->customer->id}}/email/{{$email->id}}">#{{$email->id}}</a>
                        </td>
                        <td>{{$email->customer->last_name}}, {{$email->customer->first_name}}</td>
                        <td>{{$email->description}}</td>
                        <td>{{Carbon\Carbon::parse($email->created_at)->toFormattedDateString()}}</td>
                        <td>{{$email->amount}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>