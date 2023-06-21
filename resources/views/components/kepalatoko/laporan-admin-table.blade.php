<div class="bg-white shadow-lg rounded-sm border border-slate-200 mt-5 mb-8">
    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="table-auto w-full">
            <!-- Table header -->
            <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-50 border-t border-b border-slate-200">
                <tr>
                    <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                        <div class="font-semibold text-left">Admin</div>
                    </th>
                    <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                        <div class="font-semibold text-left">Transaksi Diinput</div>
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
                            <div class="font-medium">{{ $jumlahservis + $jumlahpenjualan }}</div>
                        </td>
                        <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-medium">
                                {{-- @php
                                    $bonus = ($biayaservis + $profitsparepart + $profitaksesoris + $profithandphone) / 100;
                                    $bonus *= $item->persen;
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