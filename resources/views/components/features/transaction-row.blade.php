@props(['transaction', 'type' => 'sale'])

<tr>
    <td style="color: var(--color-text-primary);">#{{ $transaction['id'] }}</td>
    <td><x-ui.date-display :date="$transaction['date']" format="short" /></td>
    
    @if($type === 'sale')
        <td>
            <div>
                <div style="color: var(--color-text-primary); font-weight: 500;">{{ $transaction['customer_name'] }}</div>
                <small style="color: var(--color-text-secondary);">{{ $transaction['customer_phone'] }}</small>
            </div>
        </td>
    @else
        <td>
            <div>
                <div style="color: var(--color-text-primary); font-weight: 500;">{{ $transaction['supplier_name'] }}</div>
                <small style="color: var(--color-text-secondary);">{{ $transaction['supplier_phone'] }}</small>
            </div>
        </td>
    @endif
    
    <td style="color: var(--color-text-primary);">{{ $transaction['medicine_name'] }}</td>
    <td style="color: var(--color-text-primary);">{{ $transaction['quantity'] }}</td>
    <td><x-ui.price-display :amount="$transaction['total_price']" /></td>
    <td><x-ui.status-badge :status="$transaction['status']" /></td>
    
    @if($type === 'sale')
        <td style="color: var(--color-text-primary);">{{ $transaction['payment_method'] }}</td>
        <td style="color: var(--color-text-primary);">{{ $transaction['cashier'] }}</td>
    @else
        <td>
            <div>
                <div style="color: var(--color-text-primary);">{{ $transaction['payment_method'] }}</div>
                <small style="color: var(--color-text-secondary);">{{ $transaction['payment_status'] }}</small>
            </div>
        </td>
        <td><x-ui.date-display :date="$transaction['delivery_date']" format="short" /></td>
    @endif
    
    <td>
        <x-tables.action-buttons 
            :viewUrl="route($type === 'sale' ? 'transactions.show' : 'buy-transactions.show', $transaction['id'])"
            :editUrl="route($type === 'sale' ? 'transactions.edit' : 'buy-transactions.edit', $transaction['id'])"
            :deleteId="$transaction['id']" />
    </td>
</tr> 