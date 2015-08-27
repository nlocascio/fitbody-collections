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

@endsection

