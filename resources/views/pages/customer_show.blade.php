@extends('layout')

@section('dashhead-subtitle', 'Customer')
@section('dashhead-title', "$customer->first_name $customer->last_name")

@section('content')
    <div class="hr-divider">
        <h3 class="hr-divider-content hr-divider-heading">Quick stats</h3>
    </div>
    <div class="row statcards text-xs-center">
        <div class="col-xs-4 col-sm-4 statcard">
            <h3 class="statcard-number text-success">
                {{ $customer->emails()->count() }}
                {{--<small class="delta-indicator delta-positive">{{ \Carbon\Carbon::parse($customer->emails()->max('created_at'))->diffInDays() }} days since last</small>--}}
            </h3>
            <span class="statcard-desc">Emails</span>
        </div>
        <div class="col-xs-4 col-sm-4 statcard">
            <h3 class="statcard-number text-success">
                {{ $customer->letters()->count() }}
            </h3>
            <span class="statcard-desc">Letters</span>
        </div>
        <div class="col-xs-4 col-sm-4 statcard">
            <h3 class="statcard-number text-danger">
                ${{ abs($customer->account_balance) }}
            </h3>
            <span class="statcard-desc">Owed</span>
        </div>
    </div>

    <div class="col-md-6">
    <div class="list-group">
        <h4 class="list-group-header">
            Emails
        </h4>

        @foreach($emails as $email)
        <a class="list-group-item" href="/customer/{{$email->customer->id}}/email/{{$email->id}}">
            {{ $email->subject }} ({{ \Carbon\Carbon::parse($email->created_at)->diffInDays() }} days ago)

        </a>
        @endforeach

        <a class="list-group-item" href="#">
            <span class="list-group-progress" style="width: 15.0%;"></span>
            <span class="pull-right text-muted">15.0%</span>
            India
        </a>

        <a class="list-group-item" href="#">
            <span class="list-group-progress" style="width: 5.0%;"></span>
            <span class="pull-right text-muted">5.0%</span>
            United Kingdom
        </a>

        <a class="list-group-item" href="#">
            <span class="list-group-progress" style="width: 5.0%;"></span>
            <span class="pull-right text-muted">5.0%</span>
            Canada
        </a>

        <a class="list-group-item" href="#">
            <span class="list-group-progress" style="width: 4.5%;"></span>
            <span class="pull-right text-muted">4.5%</span>
            Russia
        </a>

        <a class="list-group-item" href="#">
            <span class="list-group-progress" style="width: 2.3%;"></span>
            <span class="pull-right text-muted">2.3%</span>
            Mexico
        </a>

        <a class="list-group-item" href="#">
            <span class="list-group-progress" style="width: 1.7%;"></span>
            <span class="pull-right text-muted">1.7%</span>
            Spain
        </a>

        <a class="list-group-item" href="#">
            <span class="list-group-progress" style="width: 1.5%;"></span>
            <span class="pull-right text-muted">1.5%</span>
            France
        </a>

        <a class="list-group-item" href="#">
            <span class="list-group-progress" style="width: 1.4%;"></span>
            <span class="pull-right text-muted">1.4%</span>
            South Africa
        </a>

        <a class="list-group-item" href="#">
            <span class="list-group-progress" style="width: 1.2%;"></span>
            <span class="pull-right text-muted">1.2%</span>
            Japan
        </a>

    </div>
    </div>

    <h3>Letters</h3>
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
                    <th class="header col-sm-7">Description</th>
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
                        <td>{{$letter->description}}</td>
                        <td>{{Carbon\Carbon::parse($letter->created_at)->toFormattedDateString()}}</td>
                        <td>{{$letter->amount}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <h3>Emails</h3>
    @include('partials.emails_table')

@endsection

