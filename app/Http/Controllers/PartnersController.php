<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Supplier;
use App\Contracts\PartnerInterface;
use App\Enums\PartnerType;
use Illuminate\Validation\Rule;

class PartnersController extends Controller implements PartnerInterface {

    public function partners(Request $request) {

        $flag = $request->route('flag');
        if(!$flag) {
            return redirect()->route('dashboard');
        }

        if(PartnerType::isEqual($flag, PartnerType::CUSTOMER)) {
            $partners = Customer::orderBy('created_at', 'desc')->paginate(25);
        } else if(PartnerType::isEqual($flag, PartnerType::SUPPLIER)) {
            $partners = Supplier::orderBy('created_at', 'desc')->paginate(25);
        } else {
            return redirect()->route('dashboard');
        }

        if($request->method() == 'POST') {
            $valid = $request->validate([
                'name' => ['required', 'string'],
                'email' => ['required', 'email', Rule::unique($flag, 'email')],
                'mobile_no' => ['required', 'numeric', Rule::unique($flag, 'mobile_no')],
                'address' => ['required']
            ]);

            if(PartnerType::isEqual($flag, PartnerType::CUSTOMER)) {
                Customer::create($valid);
            } else {
                Supplier::create($valid);
            }
            return redirect()->route('partner.all', ['flag' => $flag])->with('success', $flag." created successfully");
        }

        $data = [
            'title' => ucwords($flag),
            'partners' => $partners,
            'flag' => $flag
        ];

        return parent::render($data, 'partners.partners');
    }


    public function edit(Request $request) {
        (int)$id = $request->route('id');
        $flag = $request->route('flag');
        if(!$id || !$flag) {
            return redirect()->route('partner.partners');
        }
        $partner = PartnerType::isEqual($flag, PartnerType::CUSTOMER) ? $this->customer($id) : $this->supplier($id);
        if($partner == null) {
            return redirect()->route('partner.partners');
        }

        if($request->method() == 'POST') {
            
            $valid = $request->validate([
                'name' => ['required', 'string'],
                'email' => ['required', 'email', Rule::exists($flag, 'email')],
                'mobile_no' => ['required', 'numeric', Rule::exists($flag, 'mobile_no')],
                'address' => ['required']
            ]);

            $valid['status'] = ($request->input('status') == 'on') ? true : false;
            $partner->update($valid);
            return redirect()->route('partner.all', ['flag' => $flag])->with('success', 'Action completed successfully');
        }

        $data = [
            'title' => 'Edit '.ucwords($flag),
            'partner' => $partner,
            'flag' => $flag,
        ];

        return parent::render($data, 'partners.edit_partner');
    }

    public function toggle(Request $request) {
        (int)$id = $request->route('id');
        (string)$action = $request->route('action');
        (string)$flag = $request->route('flag');
        if(!$id || !$action || !$flag) {
            return redirect()->route('partner.customers');
        }

        $partner = PartnerType::isEqual($flag, PartnerType::CUSTOMER) ? $this->customer($id) : $this->supplier($id);
        if($partner == null) {
            return redirect()->route('partner.customers');
        }

        switch($action) {
            case 'activate':
                $partner->status = true;
                break;
            case 'suspend':
                $partner->status = false;
                break;
        }
        $partner->save();
        return redirect()->back()->with('success', 'Action completed successfully');
    }

    public function delete(Request $request) {
        (int)$id = $request->route('id');
        (string)$flag = $request->route('flag');
        if(!$id || !$flag) {
            return redirect()->route('partner.customers');
        }

        $partner = PartnerType::isEqual($flag, PartnerType::CUSTOMER) ? $this->customer($id) : $this->supplier($id);
        if($partner == null) {
            return redirect()->route('partner.customers');
        }
        $partner->delete();
        return redirect()->back()->with('success', 'Action completed successfully');
    }

    public function customer(int $id): Customer {
        return Customer::find($id);
    }

    public function supplier(int $id): Supplier {
        return Supplier::find($id);
    }
}
