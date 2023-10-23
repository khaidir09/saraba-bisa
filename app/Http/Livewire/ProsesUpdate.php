<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProsesUpdate extends Component
{
    public $created_at;
    public $users_id;
    public $customers_id;
    public $nomor_servis;
    public $types_id;
    public $brands_id;
    public $model_series_id;
    public $service_actions_id;
    public $imei;
    public $warna;
    public $estimasi_biaya;
    public $uang_muka;
    public $capacities_id;
    public $kerusakan;
    public $garansi;
    public $kelengkapan;
    public $estimasi_pengerjaan;
    public $status_servis;
    public $kondisi_servis;
    public $catatan;
    public $cara_pembayaran;
    public $biaya;
    public $tindakan_servis;
    public $modal_sparepart;
    public $serviceTransactionId;
    public $diskon;

    protected $listeners = [
        'getProses' => 'showProses'
    ];

    public function render()
    {
        return view('livewire.proses-update');
    }

    public function showProses($service_transaction)
    {
        $this->created_at = $service_transaction['created_at'];
        $this->customers_id = $service_transaction['customers_id'];
        $this->types_id = $service_transaction['types_id'];
        $this->brands_id = $service_transaction['brands_id'];
        $this->model_series_id = $service_transaction['model_series_id'];
        $this->imei = $service_transaction['imei'];
        $this->warna = $service_transaction['warna'];
        $this->capacities_id = $service_transaction['capacities_id'];
        $this->kelengkapan = $service_transaction['kelengkapan'];
        $this->kerusakan = $service_transaction['kerusakan'];
        $this->created_at = $service_transaction['created_at'];
        $this->estimasi_biaya = $service_transaction['estimasi_biaya'];
        $this->uang_muka = $service_transaction['uang_muka'];
        $this->users_id = $service_transaction['users_id'];
        $this->serviceTransactionId = $service_transaction['serviceTransactionId'];
    }
}
