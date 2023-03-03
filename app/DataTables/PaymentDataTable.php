<?php

namespace App\DataTables;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

/**
 * Class PaymentDataTable
 */
class PaymentDataTable
{
    /**
     * @return Builder
     */
    public function get($input): Builder
    {
        $query = Payment::with('invoice.client.user')->select('payments.*');
        $query->when(isset($input['payment_mode']),
            function (Builder $q) use ($input) {
                $q->where('payments.payment_mode', $input['payment_mode']);
            });

        /** @var User $user */
        $user = Auth::user();
        if ($user->hasRole('client')) {
            $query->whereHas('invoice.client', function ($q) use ($user) {
                $q->where('user_id', $user->client->user_id);
            });
        }

        return $query;
    }
}
