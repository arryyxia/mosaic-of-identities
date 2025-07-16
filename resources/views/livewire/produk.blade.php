<div>
    <div>
        <h1 class="text-2xl font-bold mb-4">Produk</h1>
    </div>

    <form wire:submit.prevent="save" class="grid grid-cols-12 gap-4">
        <div class="col-span-12 md:col-span-5 rounded-lg h-fit bg-[#303032] p-4">
            <div class="flex items-center justify-between mb-4">
                <p class="text-lg font-semibold">Tambah Produk</p>
                @if ($id)
                    <a href="/produk" wire:navigate class="btn btn-primary"">Tambah</a>
                @endif
            </div>

            @if (session()->has('success'))
                <div class="text-green-500 text-sm mb-2">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-12 gap-2">
                <fieldset class="fieldset col-span-12 md:col-span-4">
                    <legend class="fieldset-legend">Penjual</legend>
                    <select class="select w-full" wire:model="form.penjual_id">
                        <option selected>Pilih penjual dari daftar</option>
                        @foreach ($penjual as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    @error('form.penjual_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </fieldset>

                <fieldset class="fieldset col-span-12 md:col-span-4">
                    <legend class="fieldset-legend">Nama Produk</legend>
                    <input type="text" class="input w-full" placeholder="Masukkan nama produk" wire:model="form.nama" />
                    @error('form.nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </fieldset>

                <fieldset class="fieldset col-span-12 md:col-span-4">
                    <legend class="fieldset-legend">Deskripsi Produk</legend>
                    <input type="text" class="input w-full" placeholder="Tuliskan deskripsi produk" wire:model="form.deskripsi" />
                    @error('form.deskripsi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </fieldset>

                <fieldset class="fieldset col-span-12 md:col-span-4">
                    <legend class="fieldset-legend">Harga Produk</legend>
                    <input type="number" class="input w-full" placeholder="Tuliskan harga produk" wire:model="form.harga" />
                    @error('form.harga') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </fieldset>                

                <fieldset class="fieldset col-span-12 md:col-span-4">
                    <legend class="fieldset-legend">Tipe Pembagian</legend>
                    <select class="select w-full" wire:model="form.pembagian">
                        <option selected>Pilih tipe pembagian hasil</option>
                        <option value="persen">Persen</option>
                        <option value="fixed">Fixed</option>
                    </select>
                    @error('form.pembagian') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </fieldset>

                <fieldset class="fieldset col-span-12 md:col-span-4">
                    <legend class="fieldset-legend">Value Pembagian</legend>
                    <input type="number" class="input w-full" placeholder="10 untuk Persen atau 10000 untuk Fixed" wire:model="form.pembagian_value" />
                    @error('form.pembagian_value') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </fieldset>

                <button class="btn col-span-12" wire:click.prevent="hitungJatah">Hitung Jatah Otomatis</button>

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

                <button class="btn col-span-12 w-fit" type="submit">Tambah</button>
            </div>
        </div>

        <div class="col-span-12 md:col-span-7 rounded-lg bg-[#303032] p-4">
            <p class="text-lg font-semibold mb-4">Daftar Produk</p>
            @if (session()->has('message'))
                <div class="text-red-500 text-sm mb-2">
                    {{ session('message') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nama Produk</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Value Pembagian</th>
                            <th>Jatah Penjual</th>
                            <th>Jatah PUSDIS</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produk as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>Rp. {{ number_format($item->harga) }}</td>
                                <td>
                                    {{ $item->pembagian === 'persen' ? $item->pembagian_value . '%' : 'Rp' . number_format($item->pembagian_value) }}
                                </td>
                                <td>{{ 'Rp' . number_format($item->jatah_penjual) }}</td>
                                <td>{{ 'Rp' . number_format($item->jatah_pusdis) }}</td>
                                <td class="flex items-center gap-2">
                                    <a href="/produk/{{$item->id}}" wire:navigate class="btn">
                                        <flux:icon.pencil-square />
                                    </a>
                                    <button class="btn btn-error" wire:click.prevent="delete({{ $item->id }})">
                                        <flux:icon.trash />
                                    </button>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>
