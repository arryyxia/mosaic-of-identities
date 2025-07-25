<div>
    <div>
        <h1 class="text-2xl font-bold mb-4">Riwayat Pemesanan</h1>
    </div>

    <div class="col-span-12 lg:col-span-7 rounded-lg bg-[#303032] p-4">
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
                        <th>ID</th>
                        <th>Harga Item</th>
                        <th>Bayar</th>
                        <th>Kembalian</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>