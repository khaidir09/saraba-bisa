<?php

namespace App\Http\Controllers\KepalaToko;

use Carbon\Carbon;
use App\Models\Term;
use App\Models\User;
use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderDetail;
use App\Models\StoreSetting;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Product;

class TransaksiProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jumlah_semua = Order::all()->count();
        $jumlah_lunas = Order::where('due', '0')->count();
        $jumlah_tidaklunas = Order::where('due', '>', '0')->count();

        return view('pages/kepalatoko/produk/transaksi', compact(
            'jumlah_semua',
            'jumlah_lunas',
            'jumlah_tidaklunas'
        ));
    }

    public function deleteSelected(Request $request)
    {
        $selectedIds  = $request->input('selectedIds');
        Order::whereIn('id', $selectedIds)->delete();
        OrderDetail::whereIn('orders_id', $selectedIds)->delete();
        return response()->json(['message' => 'Data transaksi produk berhasil dihapus.']);
    }

    public function approveSelected(Request $request)
    {
        $tanggal = Carbon::now()->translatedFormat('Y-m-d');
        $selectedIds = $request->input('selectedIds');
        Order::whereIn('id', $selectedIds)->update(['is_approve' => 'Setuju', 'tgl_disetujui' => $tanggal]);

        return response()->json(['message' => 'Data transaksi produk berhasil disetujui.']);
    }

    public function rejectSelected(Request $request)
    {
        $tanggal = Carbon::now()->translatedFormat('Y-m-d');
        $selectedIds = $request->input('selectedIds');
        Order::whereIn('id', $selectedIds)->update(['is_approve' => 'Ditolak', 'tgl_disetujui' => $tanggal]);

        return response()->json(['message' => 'Data transaksi produk berhasil ditolak.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($orders_id)
    {
        $order = Order::with('customer')->where('id', $orders_id)->first();

        $orderItem = OrderDetail::with('product')->where('orders_id', $orders_id)->orderBy('id', 'DESC')->get();
        $total = $orderItem->sum('total');
        $subtotal = $orderItem->sum('sub_total');
        $totalTax = $orderItem->sum('ppn');
        return view('pages.kepalatoko.produk.transaksi-detail', compact('order', 'orderItem', 'total', 'subtotal', 'totalTax'));
    }

    public function OrderDueAjax($id)
    {
        $orders = Order::findOrFail($id);
        return response()->json($orders);
    } // End Method

    public function UpdateDue(Request $request)
    {

        $id = $request->id;
        $due_amount = $request->due;

        $allorder = Order::findOrFail($id);
        $maindue = $allorder->due;
        $mainpay = $allorder->pay;

        $paid_due = $maindue - $due_amount;
        $paid_pay = $mainpay + $due_amount;

        Order::findOrFail($id)->update([
            'due' => $paid_due,
            'pay' => $paid_pay,
        ]);

        return redirect()->route('transaksi-produk.index');
    } // End Method 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function cetaktermal($orders_id)
    {
        $order = Order::with('customer', 'user')->where('id', $orders_id)->first();
        $orderItem = OrderDetail::with('product')->where('orders_id', $orders_id)->orderBy('id', 'DESC')->get();
        $total = $orderItem->sum('total');
        $subtotal = $orderItem->sum('sub_total');
        $totalTax = $orderItem->sum('ppn');
        $totalWithoutTax = $order->sub_total - $totalTax;
        $users = User::find(1);

        $logo = $users->profile_photo_path;
        $imagePath = public_path('storage/' . $logo);

        // Ambil nomor invoice dari database
        $invoiceNumber = $order->invoice_no;
        $namaPelanggan = $order->customer->nama;

        $pdf = PDF::loadView('pages.kepalatoko.produk.cetak-termal', [
            'order' => $order,
            'users' => $users,
            'orderItem' => $orderItem,
            'total' => $total,
            'subtotal' => $subtotal,
            'imagePath' => $imagePath,
            'totalTax' => $totalTax,
            'totalWithoutTax' => $totalWithoutTax,
        ]);

        $filename = 'Nota Penjualan ' . $invoiceNumber . ' ' . '(' . $namaPelanggan . ')' . '.pdf';

        return $pdf->setOption('isRemoteEnabled', true)->stream($filename);
    }

    public function cetakinkjet($orderId)
    {
        $order = Order::with('customer')->where('id', $orderId)->first();
        $orderItem = OrderDetail::with('product')->where('orders_id', $orderId)->orderBy('id', 'DESC')->get();
        $total = $orderItem->sum('total');
        $subtotal = $orderItem->sum('sub_total');
        $users = User::find(1);
        $terms = Term::find(3);
        $toko = StoreSetting::find(1);

        $logo = $users->profile_photo_path;
        $imagePath = public_path('storage/' . $logo);

        // Ambil nomor invoice dari database
        $invoiceNumber = $order->invoice_no;
        $namaPelanggan = $order->customer->nama;

        $pdf = PDF::loadView('pages.kepalatoko.produk.lunas-cetak-inkjet', [
            'order' => $order,
            'users' => $users,
            'terms' => $terms,
            'orderItem' => $orderItem,
            'total' => $total,
            'subtotal' => $subtotal,
            'imagePath' => $imagePath,
            'toko' => $toko,
        ]);

        $filename = 'Nota Penjualan ' . $invoiceNumber . ' ' . '(' . $namaPelanggan . ')' . '.pdf';

        return $pdf->setOption('isRemoteEnabled', true)->stream($filename);
    }

    public function edit($id)
    {
        $item = Order::with('detailOrders')->findOrFail($id);
        $customers = Customer::all();
        $products = Product::all();
        $users = User::where('role', 'Sales')->get();

        return view('pages.kepalatoko.produk.transaksi-edit', [
            'item' => $item,
            'customers' => $customers,
            'products' => $products,
            'users' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Order::findOrFail($id);
        $nama_pelanggan = Customer::find($request->customers_id);

        // Loop untuk mengupdate order_details
        foreach ($request->input('order_details', []) as $orderDetailId => $orderDetailData) {
            $orderDetail = OrderDetail::findOrFail($orderDetailId);

            $profit = $orderDetailData['total'] - $orderDetailData['modal'];
            $profit_toko = $profit - ($profit / 100 * ($orderDetailData['persen_sales'] + $orderDetailData['persen_admin']));

            // Update order_details termasuk profit
            $orderDetail->update([
                'modal' => $orderDetailData['modal'],
                'total' => $orderDetailData['total'],
                'profit' => $profit,
                'profit_toko' => $profit_toko,
            ]);
        }

        // Transaction update
        $item->update([
            'customers_id' => $request->customers_id,
            'nama_pelanggan' => $nama_pelanggan->nama,
            'users_id' => $request->users_id,
            'payment_method' => $request->payment_method,
            'pay' => $request->pay,
            'due' => $request->due,
            'created_at' => $request->created_at,
        ]);

        return redirect()->route('transaksi-produk.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Order::findOrFail($id);

        $item->delete();

        OrderDetail::where('orders_id', $item->id)->delete();

        return redirect()->route('transaksi-produk.index');
    }
}
