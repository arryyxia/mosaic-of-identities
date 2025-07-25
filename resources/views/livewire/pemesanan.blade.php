<div>
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold mb-4">Pemesanan</h1>
        <a href="/riwayat-pemesanan" class="btn">Riwayat Pemesanan</a>
    </div>

    <div class="flex items-center justify-between mb-4">

        <label class="input">
            <input type="text"
                class="w-full bg-transparent"
                wire:model="search"
                placeholder="Search produk...">
        </label>

        <div>
            <button class="btn" wire:click="loadProduk">Search</button>
            <button class="btn" wire:click="resetProduk">Reset</button>
        </div>
    </div>

    <form wire:submit="save" class="space-y-2 grid grid-cols-12 gap-4">
        <div class="col-span-12 lg:col-span-4 rounded-lg h-fit bg-[#303032] p-4 max-h-[80vh] overflow-y-auto">
            <p class="text-lg font-semibold mb-4">Jumlah Produk</p>


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
                        <p class="font-semibold col-span-12">{{ $item->nama }} <span class="font-normal">- {{ $item->penjual->nama }}</span></p>
                        <p class="col-span-12 text-sm text-gray-300">Harga : Rp. {{ number_format($item->harga) }}</p>
                        <p class="col-span-6 text-sm text-gray-300">J. Penjual: Rp. {{ number_format($item->jatah_penjual) }}</p>
                        <p class="col-span-6 text-sm text-gray-300">J. PUSDIS : Rp. {{ number_format($item->jatah_pusdis) }}</p>
                    </div>

                    <input type="number" class="input col-span-4" placeholder="Jumlah" 
                    wire:model.live="form.jumlah.{{ $item->id }}"
                    wire:key="qty-{{ $item->id }}" />
                </div>
            @endforeach

        </div>

        <div class="col-span-12 lg:col-span-8 rounded-lg h-fit bg-[#303032] p-4">
            <div class="flex items-center justify-between mb-4">
                <p class="text-lg font-semibold">Daftar Pemesanan</p>
            </div>

            @if (session()->has('ok'))
            <div class="text-green-500 text-sm mb-2">
                {{ session('ok') }}
            </div>
        @endif

            <div class="grid grid-cols-12 gap-2">

                {{-- -------- Jatah Penjual -------- --}}
                <fieldset class="fieldset col-span-12 md:col-span-6">
                    <legend class="fieldset-legend">Jatah Penjual</legend>
                    <label class="w-full input">Rp
                        <input  type="text" class="w-full bg-transparent"
                                value="{{ number_format($form->jatah_penjual) }}"
                                readonly>
                    </label>
                    @error('form.jatah_penjual') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </fieldset>

                {{-- -------- Jatah PUSDIS -------- --}}
                <fieldset class="fieldset col-span-12 md:col-span-6">
                    <legend class="fieldset-legend">Jatah PUSDIS</legend>
                    <label class="w-full input">Rp
                        <input  type="text" class="w-full bg-transparent"
                                value="{{ number_format($form->jatah_pusdis) }}"
                                readonly>
                    </label>
                    @error('form.jatah_pusdis') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </fieldset>

                {{-- -------- Total Harga -------- --}}
                <fieldset class="fieldset col-span-12 md:col-span-4">
                    <legend class="fieldset-legend">Harga Total</legend>
                    <label class="w-full input">Rp
                        <input  type="text" class="w-full bg-transparent"
                                value="{{ number_format($form->total_harga) }}"
                                readonly>
                    </label>
                    @error('form.total_harga') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </fieldset>

                {{-- -------- Bayar (punya formatter) -------- --}}
                <fieldset class="fieldset col-span-12 md:col-span-4">
                    <legend class="fieldset-legend">Bayar</legend>

                    <label class="w-full input relative"
                        x-data="{
                                shown: '',
                                init() {
                                    // inisialisasi dari Livewire ke tampilan
                                    this.$watch('$wire.form.bayar', v => {
                                        this.shown = v ? Number(v).toLocaleString('en-US') : ''
                                    })
                                },
                                format(e) {
                                    // hapus semua koma → kirim ke Livewire
                                    const raw = e.target.value.replace(/[^0-9]/g,'');
                                    this.$wire.set('form.bayar', raw);
                                    // lalu tampilkan lagi formatted
                                    this.shown = raw ? Number(raw).toLocaleString('en-US') : '';
                                }
                        }">

                        {{-- input yang dilihat user --}}
                        <input  type="text" class="w-full bg-transparent pr-2"
                                placeholder="Bayar berapa"
                                x-model="shown"
                                x-on:input.debounce.300ms="format($event)">

                    </label>
                    @error('form.bayar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </fieldset>

                {{-- -------- Kembalian (readonly) -------- --}}
                <fieldset class="fieldset col-span-12 md:col-span-4">
                    <legend class="fieldset-legend">Kembalian</legend>
                    <label class="w-full input">Rp
                        <input  type="text" class="w-full bg-transparent"
                                value="{{ number_format($form->kembalian) }}"
                                readonly>
                    </label>
                    @error('form.kembalian') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </fieldset>

                <button class="btn col-span-12 md:col-span-4" type="submit">
                    Selesai
                </button>
            </div>
        </div>
    </form>
</div>
