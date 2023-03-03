<div class="dropup position-static" wire:key="{{ $row->id }}">
    <button wire:key="client-invoice-{{ $row->id }}" type="button" title="Action"
            class="dropdown-toggle hide-arrow btn px-2 text-primary fs-3 pe-0"
            id="dropdownMenuButton1" data-bs-toggle="dropdown" data-bs-boundary="viewport" aria-expanded="false">
        <i class="fa-solid fa-ellipsis-vertical"></i>
    </button>
    <ul class="dropdown-menu min-w-170px" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="{{route('clients.invoices.pdf', $row->id)}}"
               target="_blank"><?php echo __('messages.invoice.download') ?></a></li>
        @if($row->status_label != 'Paid')
            <li><a class="dropdown-item" href="{{route('clients.payments.show',$row->id)}}"
                   data-id="{{$row->id}}" data-turbo="false"><?php echo __('messages.invoice.make_payment') ?></a></li>
        @endif
    </ul>
</div>

