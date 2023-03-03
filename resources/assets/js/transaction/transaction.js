document.addEventListener('turbo:load', loadTransaction);

function loadTransaction() {
    initializeSelect2Transaction()
}

function initializeSelect2Transaction() {
    if(!select2NotExists('#paymentModeFilter')){
        return false;
    }
    removeSelect2Container(["#paymentModeFilter"])

    $('#paymentModeFilter').select2({
        placeholder: 'Select Payment Method',
        allowClear: false,
    });
}

listenClick('#resetFilter', function () {
    $('#paymentModeFilter').select2({
        placeholder: 'Select Payment Method',
        allowClear: false,
    });
    $('#paymentModeFilter').val(0).trigger('change');
});

listenClick('.show-payment-notes', function () {
    let paymentId = $(this).attr('data-id');
    paymentData(paymentId);
});

function paymentData(paymentId) {
    $.ajax({
        url: route('payment-notes.show', paymentId),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let notes = isEmpty(result.data) ? 'N/A' : result.data;
                $('#showClientNotesId').text(notes);
                $('#paymentNotesModal').appendTo('body').modal('show');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};

window.hideDropdownManually = function (dropdownBtnEle, dropdownEle) {
    dropdownBtnEle.removeClass('show')
    dropdownEle.removeClass('show')
}

listenChange('.payment-mode-filter', function () {
    window.livewire.emit('changePaymentModeFilter', 'paymentModeFilter', $(this).val())
});

listenChange('.payment-status-filter', function () {
    window.livewire.emit('changePaymentStatusFilter', 'paymentStatusFilter', $(this).val())
});

listen('click', '#transactionResetFilter', function () {
    $('.payment-mode-filter').val(0).trigger('change');
    $('.payment-status-filter').val(3).trigger('change');
    hideDropdownManually($('#transactionFilterBtn'), $('.dropdown-menu'));
});

