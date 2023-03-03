<?php

namespace App\Http\Controllers;

use App\Repositories\paymentGatewayRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class PaymentGatewayController extends Controller
{
    private $paymentGatewayRepository;

    public function __construct(paymentGatewayRepository $paymentGatewayRepo)
    {
        $this->paymentGatewayRepository = $paymentGatewayRepo;
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request)
    {
        $paymentGateway = $this->paymentGatewayRepository->edit();
        $sectionName = ($request->section === null) ? 'payment-gateway' : $request->section;

        return view("settings.$sectionName", ['paymentGateway' => $paymentGateway, 'section' => $sectionName]);
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();

        try {
            $this->paymentGatewayRepository->store($input);
            Flash::success('Setting updated successfully.');
        } catch (\Exception $exception) {
            Flash::error($exception->getMessage());
        }

        return redirect(route('payment-gateway.show'));
    }
}
