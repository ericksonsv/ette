<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use App\Models\Driver;
use App\Models\Service;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $drivers = [];
    public $orderServices = [];

    public $company;
    public $client_name;
    public $client_email;
    public $client_phone;

    public function mount()
    {
        $this->drivers = Driver::whereNotIn('id', [1])->where('active', true)->pluck('name', 'id');
    }

    public function addServiceRow()
    {
        $this->orderServices[] = [
            'user_id' => '',
            'order_id' => '',
            'driver' => 1,
            'date' => '',
            'time' => '',
            'flight' => '',
            'flight_time' => '',
            'passengers' => '',
            'amount' => 0,
            'pickup' => '',
            'dropoff' => '',
            'note' => '',
            'currency' => '',
            'type' => '',
            'status' => 'pendiente',
        ];
    }

    public function removeServiceRow($index)
    {
        unset($this->orderServices[$index]);
        $this->orderServices = array_values($this->orderServices);
    }

    protected function rules()
    {
        return [
            'company' => ['required_if:client_name,null'],
            'client_name' => ['required_if:company,null'],
            'client_email' => ['nullable', 'email'],
        ];
    }

    public function store()
    {

        $this->validate();
        $this->resetErrorBag();

        if(!count($this->orderServices)){
            return redirect()->route('orders.create')->with('warning', __('You need to add a least one service to the order.'));
        }

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'company' => $this->company,
            'client_name' => $this->client_name,
            'client_email' => $this->client_email,
            'client_phone' => $this->client_phone
        ]);

        if (count($this->orderServices)) {
            foreach ($this->orderServices as $service) {

                if ($service['amount'] == '') {
                    $service['amount'] = 0;
                }


                $service = Service::create([
                    'user_id' => Auth::user()->id,
                    'order_id' => $order->id,
                    'driver_id' => $service['driver'],
                    'date' => $service['date'],
                    'time' => $service['time'],
                    'flight' => $service['flight'],
                    'flight_time' => $service['flight_time'],
                    'passengers' => $service['passengers'],
                    'currency' => $service['currency'],
                    'amount' => $service['amount'],
                    'pickup' => $service['pickup'],
                    'dropoff' => $service['dropoff'],
                    'note' => $service['note'],
                    'type' => $service['type'],
                    'status' => $service['status'],
                ]);
                $service->url = '/services/' . $service->id;
                $service->save();
            }
        }

        return redirect()->route('orders.index')->with('success', __('Service created.'));
    }

    public function render()
    {
        return view('livewire.order.create');
    }
}
