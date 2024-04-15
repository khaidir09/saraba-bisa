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
                    <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                        <div class="font-semibold text-left">Target Penjualan</div>
                    </th>
                    <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                        <div class="font-semibold text-left">Progres</div>
                    </th>
                    <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                        <div class="font-semibold text-left">Bonus Pencapaian Target</div>
                    </th>
                </tr>
            </thead>
            <!-- Table body -->
            <tbody class="text-sm divide-y divide-slate-200">
                <!-- Row -->
                @foreach($users as $item)
                    @php
                        $bonus = $item->sale->sum('profit')/100;
                        $bonus *= $item->persen;
                    @endphp                  
                    <tr>
                        <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-medium">{{ $item->name }}</div>
                        </td>
                        <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-medium">{{ $item->sale->sum('quantity') }}</div>
                        </td>
                        <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-medium">
                                Rp. {{ number_format($bonus) }}
                            </div>
                        </td>
                        <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-medium">
                                @if ($item->targetSale->sum('item') != 0)
                                    {{ $item->targetSale->sum('item') }}
                                @else
                                    -
                                @endif
                            </div>
                        </td>
                        <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-medium">
                                @if ($item->targetSale->sum('item') != 0)
                                    {{ ($item->sale->sum('quantity') / $item->targetSale->sum('item')) * 100 }}%
                                @else
                                    -
                                @endif
                            </div>
                        </td>
                        <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                            <div class="font-medium">
                                @if ($item->targetSale->sum('item') != 0)
                                    @php
                                        $reward = $bonus * (($item->sale->sum('quantity') / $item->targetSale->sum('item')) * 100) / 100;
                                    @endphp
                                    @if ($item->sale->sum('quantity') < $item->targetSale->sum('item'))
                                    Rp. {{ number_format($reward) }}
                                    @else
                                    Rp. {{ number_format($bonus) }}
                                    @endif
                                @else
                                    -
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>