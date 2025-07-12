<div>
    <div>
        <h1 class="text-2xl font-bold mb-4">Produk</h1>
    </div>

    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12 md:col-span-4 rounded-lg h-fit bg-[#303032] p-4">
            <div class="flex items-center justify-between mb-4">
                <p class="text-lg font-semibold">Tambah Penjual</p>
                {{-- @if ($id_penjual)
                    <a href="/produk" wire:navigate class="btn btn-primary"">Tambah</a>
                @endif --}}
            </div>

            @if (session()->has('success'))
                <div class="text-green-500 text-sm mb-2">
                    {{ session('success') }}
                </div>
            @endif

            <form wire:submit="save" class="space-y-2">
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Nama</legend>
                    <input type="text" class="input w-full" placeholder="Type here" wire:model="form.nama" />
                </fieldset>
                <button class="btn" type="submit">Tambah</button>
            </form>
        </div>

        <div class="col-span-12 md:col-span-8 rounded-lg bg-[#303032] p-4">
            <p class="text-lg font-semibold mb-4">Daftar Penjual</p>
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
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($penjual as $item)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $item->nama }}</td>
                                <td>
                                    <a href="/penjual/{{$item->id}}" wire:navigate class="btn">
                                        <flux:icon.pencil-square />
                                    </a>
                                    <button class="btn btn-error" wire:click.prevent="delete({{ $item->id }})">
                                        <flux:icon.trash />
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody> --}}
                </table>
            </div>
        </div>
    </div>
</div>
