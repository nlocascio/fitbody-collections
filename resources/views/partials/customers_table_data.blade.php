@foreach ($customers as $customer)
    <tr>
        <td class="text-center">
            {!! Form::checkbox('listCheckbox', $customer->id, false, ['class' => 'multiSelectCheckBox']) !!}
        </td>
        <td>
            <a href="{{ route('customer.show', $customer) }}">
                {{ $customer['last_name'] }}, {{ $customer['first_name'] }}
            </a>
        </td>
        <td class="">{{ $customer['mobile_phone'] }}&nbsp;&nbsp;&nbsp;</td>
        <td class="text-right">${{ $customer['account_balance'] }}&nbsp;&nbsp;&nbsp;</td>
        <td class="text-right">{{ ($customer->emails()->count()) ?: null }}&nbsp;&nbsp;&nbsp;</td>
        <td class="text-right">{{ ($customer->letters()->count()) ?: null }}&nbsp;&nbsp;&nbsp;</td>
        <td></td>
    </tr>
@endforeach
