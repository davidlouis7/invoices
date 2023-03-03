<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingRequest;
use App\Models\InvoiceSetting;
use App\Repositories\SettingRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;

class SettingController extends AppBaseController
{
    /** @var SettingRepository */
    private $settingRepository;

    public function __construct(SettingRepository $settingRepo)
    {
        $this->settingRepository = $settingRepo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request  $request
     * @return Application|Factory|View
     */
    public function edit(Request $request)
    {
        $defaultSettings = $this->settingRepository->editSettingsData();
        $sectionName = ($request->section === null) ? 'general' : $request->section;

        return view("settings.$sectionName", compact('sectionName'), $defaultSettings);
    }

    /**
     * @param  UpdateSettingRequest  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateSettingRequest $request)
    {
        $this->settingRepository->updateSetting($request->all());
        Flash::success('Setting updated successfully.');

        return redirect()->back();
    }   

    //Invoice Update
    public function invoiceUpdate(Request $request)
    {
        $this->settingRepository->updateInvoiceSetting($request->all());
        Flash::success('Invoice template updated successfully');

        return redirect('admin/settings?section=setting-invoice');
    }

    /**
     * @param $key
     * @return mixed
     */
    public function editInvoiceTemplate($key)
    {
        $invoiceTemplate = InvoiceSetting::where('key', $key)->get();

        return $this->sendResponse($invoiceTemplate, 'InvoiceTemplate retrieved successfully.');
    }

    /**
     * @return string
     */
    public function invoiceSettings()
    {
        $data['settings'] = $this->settingRepository->getSyncList();

        return view('settings.invoice-settings', $data);
    }
}
