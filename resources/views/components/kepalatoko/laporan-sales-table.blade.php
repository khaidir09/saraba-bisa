<div class="bg-white shadow-lg rounded-sm border border-slate-200 mt-5 mb-8">
    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="table-auto w-full">
            <!-- Table header -->
            <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-50 border-t border-b border-slate-200">
                <tr>
                    <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                        <div class="font-semibold text-left">Sales</div>
                    </th>
                    <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                        <div class="font-semibold text-left">Produk Terjual</div>
                    </th>
                    <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                        <div class="font-semibold text-left">Bonus</div>
                    </th>
                </tr>
            </thead>
            <!-- Table body -->
            <tbody class="text-sm divide-y divide-slate-200">
                <!-- Row -->
                @foreach($users as $item)                  
                    <tr>
                        <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-medium">{{ $item->name }}</div>
                        </td>
                        <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-medium">0</div>
                        </td>
                        <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-medium">
                                {{-- Rp. {{ $item->servicetransaction->sum('biaya') - $item->servicetransaction->sum('modal_sparepart') }} --}}
                                {{-- @php
                                    $sparepart = $item->spareparttransaction->sum('profit')/100;
                                    $sparepart *= $item->persen;
                                    $accessory = $item->accessorytransaction->sum('profit')/100;
                                    $accessory *= $item->persen;
                                    $phone = $item->phonetransaction->sum('profit')/100;
                                    $phone *= $item->persen;
                                @endphp --}}
                                Rp. 0
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>