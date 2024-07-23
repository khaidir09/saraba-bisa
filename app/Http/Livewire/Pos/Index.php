<?php

declare(strict_types=1);

namespace App\Http\Livewire\Pos;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use App\Enums\SaleStatus;
use App\Enums\MovementType;
use App\Models\OrderDetail;
use App\Models\SalePayment;
use App\Enums\PaymentStatus;
use App\Models\StoreSetting;
use App\Jobs\PaymentNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use LivewireAlert;

    /** @var array<string> */
    public $listeners = [
        'refreshIndex' => '$refresh',
        'refreshCustomers',
    ];

    public $cart_instance;

    public $discountModal;

    public $global_discount;

    public $global_tax;

    public $quantity;

    public $check_quantity;

    public $price;

    public $discount_type;

    public $item_discount;

    public $data;

    public $customer_id;

    public $total_amount;

    public $checkoutModal;

    public $product;

    public $paid_amount;

    public $tax_percentage;

    public $discount_percentage;

    public $discount_amount;

    public $tax_amount;

    public $grand_total;

    public $payment_method;

    public $note;
    public $tgl_disetujui;

    public $refreshCustomers;

    public function rules(): array
    {
        return [
            'customer_id'         => 'required|numeric',
            'total_amount'        => 'required|numeric',
            'paid_amount'         => 'nullable|numeric',
            'price'               => 'nullable|numeric',
            'note'                => 'nullable|string|max:1000',
        ];
    }

    public function mount($cartInstance): void
    {
        $this->cart_instance = $cartInstance;
        $this->global_discount = 0;
        $this->global_tax = 0;

        $this->check_quantity = [];
        $this->quantity = [];
        $this->discount_type = [];
        $this->item_discount = [];
        $this->payment_method = 'Tunai';

        $this->tax_percentage = 0;
        $this->paid_amount = 0;
    }

    public function hydrate(): void
    {
        if ($this->payment_method === 'Tunai') {
            $this->paid_amount = $this->total_amount;
        }
        $this->total_amount = $this->calculateTotal();
    }

    public function render()
    {
        $cart_items = Cart::instance($this->cart_instance)->content();
        $toko = StoreSetting::find(1);

        return view('livewire.pos.index', [
            'cart_items' => $cart_items,
            'toko' => $toko,
        ]);
    }

    public function store(): void
    {
        DB::transaction(function () {
            $this->validate();

            // Determine payment status
            $due_amount = $this->total_amount - $this->paid_amount;

            if ($due_amount === $this->total_amount) {
                $payment_status = PaymentStatus::PENDING;
            } elseif ($due_amount > 0) {
                $payment_status = PaymentStatus::PARTIAL;
            } else {
                $payment_status = PaymentStatus::PAID;
            }

            $nama_pelanggan = Customer::find($this->customer_id);

            $sale = Order::create([
                'order_date'          => \Carbon\Carbon::today()->locale('id')->translatedFormat('d F Y'),
                'customers_id'         => $this->customer_id,
                'users_id'             => Auth::user()->id,
                'discount_amount'     => Cart::instance('sale')->discount(),
                'pay'             => $this->paid_amount,
                'due'          => $due_amount,
                'sub_total'        => $this->total_amount,
                'total_products'          => Cart::instance($this->cart_instance)->count(),
                'invoice_no'          => intval(date('Ymd') . mt_rand(0, 999)),
                'nama_pelanggan'          => $nama_pelanggan->nama,
                'payment_status'      => $payment_status,
                'payment_method'      => $this->payment_method,
                'note'                => $this->note,
                'is_approve'      => 'Setuju',
                'tgl_disetujui'      => date('Y-m-d'),
            ]);

            // foreach ($this->cart_instance as cart_items) {}
            foreach (Cart::instance('sale')->content() as $cart_item) {

                $garansi = Carbon::now();
                if ($cart_item->options->garansi != null) {
                    $expired = $garansi->addDays(
                        $cart_item->options->garansi
                    );
                } else {
                    $expired = null;
                }

                $garansi_imei = Carbon::now();
                if ($cart_item->options->garansi_imei != null) {
                    $expired_imei = $garansi_imei->addDays(
                        $cart_item->options->garansi_imei
                    );
                } else {
                    $expired_imei = null;
                }

                OrderDetail::create([
                    'orders_id'                 => $sale->id,
                    'users_id'            => Auth::user()->id,
                    'products_id'              => $cart_item->id,
                    'product_name'                    => $cart_item->name,
                    'quantity'                => $cart_item->qty,
                    'price'                   => $cart_item->price,
                    'total'               => $cart_item->options->sub_total,
                    'sub_total'               => $cart_item->options->unit_price * $cart_item->qty,
                    'product_discount_amount' => $cart_item->options->product_discount,
                    'modal'               => $cart_item->options->modal * $cart_item->qty,
                    'profit'               => $cart_item->options->sub_total - ($cart_item->options->modal * $cart_item->qty),
                    'profit_toko'               => $cart_item->options->sub_total - ($cart_item->options->modal * $cart_item->qty),
                    // 'profit_toko'               => ($cart_item->options->sub_total - ($cart_item->options->modal * $cart_item->qty)) - ($cart_item->options->sub_total - ($cart_item->options->modal * $cart_item->qty)) / 100 * ,
                    'ppn'      => $cart_item->options->product_tax,
                    'garansi'      => $expired,
                    'garansi_imei'      => $expired_imei,
                    'payment_method'      => $this->payment_method,
                ]);

                $product = Product::findOrFail($cart_item->id);

                $new_quantity = $product->stok - $cart_item->qty;

                $product->update([
                    'stok' => $new_quantity,
                ]);
            }

            Cart::instance('sale')->destroy();

            if ($sale->paid_amount > 0) {
                SalePayment::create([
                    'date'           => date('Y-m-d'),
                    'amount'         => $sale->paid_amount,
                    'orders_id'        => $sale->id,
                    'payment_method' => $this->payment_method,
                    'users_id'        => Auth::user()->id,
                ]);
            }

            $this->alert('success', 'Transaksi penjualan berhasil dibuat!');

            $this->checkoutModal = false;

            Cart::instance('sale')->destroy();

            return redirect()->route('show-print-order', $sale->id);
        });
    }

    // can you solve that issue please
    // customer should provoke checkout
    public function proceed(): void
    {
        if ($this->customer_id !== null) {
            $this->checkoutModal = true;
            $this->cart_instance = 'sale';
        } else {
            $this->alert('error', 'Please select a customer!');
        }
    }

    public function calculateTotal(): mixed
    {
        return Cart::instance($this->cart_instance)->total();
    }

    public function resetCart(): void
    {
        Cart::instance($this->cart_instance)->destroy();
    }

    public function getCustomersProperty()
    {
        return Customer::select(['nama', 'id'])->get();
    }
}
