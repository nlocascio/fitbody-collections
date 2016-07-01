@extends('layout')

@section('dashhead-subtitle','Dashboard')
@section('dashhead-title','Customers')

@section('dashhead-toolbar')
    <div class="btn-toolbar-item input-with-icon">
        <div class="btn-group pull-right">

        </div>
    </div>
@endsection

@section('content')
<app-customers inline-template>
    <!-- Stats -->
    <div class="hr-divider">
        <h3 class="hr-divider-content hr-divider-heading">Quick stats</h3>
    </div>
    <div class="row statcards text-xs-center">
        <div class="col-xs-12 col-sm-6 statcard">
            <h3 class="statcard-number text-success">
                @{{ customers.length }}
            </h3>
            <span class="statcard-desc">Delinquent Accounts</span>
        </div>
        <div class="col-xs-12 col-sm-6 statcard">
            <h3 class="statcard-number text-danger">
                $@{{ totalBalances }}
            </h3>
            <span class="statcard-desc">Owed</span>
        </div>
    </div>

    <!-- Flextable Actions -->
    <div class="flextable table-actions">
        <div class="flextable-item flextable-primary">
            <div class="btn-toolbar-item input-with-icon">

                <!-- Search Customers -->
                <input type="text" class="form-control input-block" placeholder="Search customers">
                <span class="icon icon-magnifying-glass"></span>
            </div>
        </div>
        <div class="flextable-item">
            <div class="form-group">
                <div class="btn-group">

                    <!-- Dropdown -->
                    <button type="button" class="btn btn-primary-outline dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        <span class="icon icon-export"></span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">

                        <!-- Create Letters -->
                        <li>
                            <a href="#" @click.stop.prevent="createLetters">
                                <span class="icon icon-newsletter"></span>

                                    Create Letters
                            </a>
                        </li>

                        <!-- Create Emails -->
                        <li>
                            <a href="#" @click.stop.prevent="createEmails">
                                <span class="icon icon-mail"></span>

                                    Create Emails
                            </a>
                        </li>

                    </ul>

                    <!-- Refresh Button -->
                    <button class="btn btn-default-outline" @click.stop.prevent="resyncCustomers()">
                        <i class="fa fa-refresh"></i>
                    </button>

                </div>
            </div>
        </div>
    </div>

    <div class="table-full">
        <div class="table-responsive">
            <table class="table" data-sort="table" id="customerTable">
                <thead>
                <tr>
                    <th class="col-sm-1 text-center"><input type="checkbox" @click="checkAll"></th>
                    <th class="col-sm-3" >
                        Name
                    </th>
                    <th class="col-sm-2">Phone</th>
                    <th class="col-sm-1 text-right">Balance</th>
                    <th class="col-sm-1">Emails</th>
                    <th class="col-sm-1">Letters</th>
                    <th class="col-sm-3"></th>
                </tr>
                </thead>
                <tbody>

                <!-- Customers -->
                <tr v-for="customer in customers | orderBy order desc" class="customer">
                    <td class="text-center">
                        <input type="checkbox"
                               class="customer-checkbox"
                               :value="customer"
                               v-model="checkedCustomers"
                        >
                    </td>
                    <td>
                        <a :href="'/customers/' + customer.id">
                            @{{ customer.last_name }}, @{{ customer.first_name }}
                        </a>
                    </td>
                    <td class="">@{{ customer.mobile_phone }}&nbsp;&nbsp;&nbsp;</td>
                    <td class="text-right">@{{ accountBalance(customer.account_balance) }}&nbsp;&nbsp;&nbsp;</td>
                    <td class="text-right">@{{ customer.emails_count }}&nbsp;&nbsp;&nbsp;</td>
                    <td class="text-right">@{{ customer.letters_count }}&nbsp;&nbsp;&nbsp;</td>
                    <td></td>
                </tr>
                </tbody>
                <tfoot>
                <tr class="working hide">
                    <th colspan="6" class="text-center btn-default-outline"><i class="fa fa-refresh fa-5x fa-spin" style="font-size:10em;"></i></th>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>

    <div class="fullScreenBusy" v-show="fullScreenBusy">
        <div class="center">
            <i class="fa fa-circle-o-notch fa-spin fa-5x"></i>
            <span class="sr-only">Loading...</span>
        </div>
    </div>

</app-customers>
@endsection
