<div>
    <div>
        <h1 class="text-2xl font-bold mb-4">Produk</h1>
    </div>

    <form wire:submit="save" class="space-y-2 grid grid-cols-12 gap-4">
        <div class="col-span-4 rounded-lg h-fit bg-[#303032] p-4">
            <div class="flex items-center justify-between mb-4">
                <p class="text-lg font-semibold">Jumlah Produk</p>
            </div>

            @if (session()->has('success'))
                <div class="text-green-500 text-sm mb-2">
                    {{ session('success') }}
                </div>
            @endif

            {{-- <fieldset class="fieldset col-span-12 md:col-span-4 mb-2">
                <legend class="fieldset-legend">Penjual</legend>
                <select class="select w-full" wire:model="form.penjual_id">
                    <option selected>Pilih penjual dari daftar</option>
                    @foreach ($penjual as $item)
                        <option value="{{ $item->id }}" wire:click="clickPenjual({{ $item->id }})">{{ $item->nama }}</option>
                    @endforeach
                </select>
                @error('form.penjual_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </fieldset> --}}

            @foreach ($produk as $item)
                <div class="col-span-12 grid grid-cols-12 bg-zinc-700 p-3 rounded-md items-center justify-between mb-2">
                    <div class="col-span-8 grid grid-cols-12 gap-2 w-">
                        <p class="font-semibold col-span-12">{{ $item->nama }}</p>
                        <p class="col-span-12 text-sm text-gray-300">Harga : Rp. {{ number_format($item->harga) }}</p>
                        <p class="col-span-6 text-sm text-gray-300">J. Penjual: Rp. {{ number_format($item->jatah_penjual) }}</p>
                        <p class="col-span-6 text-sm text-gray-300">J. PUSDIS : Rp. {{ number_format($item->jatah_pusdis) }}</p>
                    </div>

                    <input type="number" class="input col-span-4" placeholder="Jumlah" wire:model="form.jumlah.{{ $item->id }}" />
                </div>
            @endforeach

        </div>

        <div class="col-span-8 rounded-lg h-fit bg-[#303032] p-4">
            <div class="flex items-center justify-between mb-4">
                <p class="text-lg font-semibold">Daftar Pesanan</p>
            </div>

            <div class="grid grid-cols-12 gap-2">

                <fieldset class="fieldset col-span-12 md:col-span-6">
                    <legend class="fieldset-legend">Jatah Penjual</legend>
                    <label class="w-full input">
                        Rp
                        <input type="text" class="w-full" placeholder="000" readonly wire:model="form.jatah_penjual" />
                    </label>
                </fieldset>

                <fieldset class="fieldset col-span-12 md:col-span-6">
                    <legend class="fieldset-legend">Jatah PUSDIS</legend>
                    <label class="w-full input">
                        Rp
                        <input type="text" class="w-full" placeholder="000" readonly wire:model="form.jatah_pusdis" />
                    </label>
                </fieldset>

                <fieldset class="fieldset col-span-12 md:col-span-4">
                    <legend class="fieldset-legend">Harga Total</legend>
                    <label class="w-full input">
                        Rp
                        <input type="text" class="w-full" placeholder="000" readonly wire:model="form.total_harga" />
                    </label>
                </fieldset>


                <fieldset class="fieldset col-span-12 md:col-span-4">
                    <legend class="fieldset-legend">Bayar</legend>
                    <input type="number" class="input w-full" placeholder="Bayar berapa" wire:model="form.bayar" />
                    @error('form.bayar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </fieldset>                

                <fieldset class="fieldset col-span-12 md:col-span-4">
                    <legend class="fieldset-legend">Kembalian</legend>
                    <input type="number" class="input w-full" placeholder="Kembalian" wire:model="form.kembalian" />
                    @error('form.kembalian') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </fieldset>                
            </div>

        </div>
    </form>
</div>
