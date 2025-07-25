<?php

namespace App\Livewire\Forms;

use App\Models\Pemesanan;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Livewire\Form;

class PemesananForm extends Form
{
    /* ----------  properti utama  ---------- */
    public $jumlah      = [];          // [produk_id => qty]
    public $total_harga = 0;           // ≥ 0
    public $bayar       = 0;           // ≥ 0
    public $kembalian   = 0;           // ≥ 0

    public $jatah_penjual = 0;
    public $jatah_pusdis  = 0;

    /* ----------  RULES & MESSAGES  ---------- */
    public function rules(): array
    {
        return [
            'jumlah'         => 'array',
            'jumlah.*'       => 'integer|min:0',
            'total_harga'    => 'integer|min:0',
            'bayar'          => 'integer|min:0',
            'kembalian'      => 'integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'jumlah.array'        => 'Format jumlah tidak valid',
            'jumlah.*.integer'    => 'Jumlah harus angka',
            'jumlah.*.min'        => 'Jumlah minimal 0',
            'total_harga.integer' => 'Total harga tidak valid',
            'total_harga.min'     => 'Total harga tidak valid',
            'bayar.integer'       => 'Bayar harus angka positif',
            'bayar.min'           => 'Bayar harus angka positif',
            'kembalian.integer'   => 'Kembalian tidak valid',
            'kembalian.min'       => 'Kembalian tidak valid',
        ];
    }

    /* ----------  helper recalculate(), save(), dst.  ---------- */
    // … sisanya (recalculate, save, setPemesanan, dll.) tetap persis
    //   seperti yang sudah Anda punya. Tidak ada perubahan logika.


    /* ----------  helpers  ---------- */
    public function setPemesanan(int $id): void
    {
        $p = Pemesanan::with('produk')->findOrFail($id);

        $this->total_harga  = $p->total_harga;
        $this->bayar        = $p->bayar;
        $this->kembalian    = $p->kembalian;

        $this->jumlah = $p->produk
            ->pluck('pivot.jumlah', 'id')
            ->toArray();                     // contoh: [3 => 2, 7 => 1]

        $this->recalculate();
    }

    public function updated($field): void
    {
        if (str_contains($field, 'jumlah') || $field === 'bayar') {
            $this->recalculate();
        }
    }

    private function recalculate(): void
    {
        $total      = 0;
        $totalSell  = 0;
        $totalPus   = 0;

        foreach ($this->jumlah as $produkId => $qty) {
            if ($qty < 1) {
                unset($this->jumlah[$produkId]);
                continue;
            }

            $p = Produk::find($produkId);
            if (!$p) {
                continue;
            }

            $total     += $p->harga * $qty;
            $totalSell += $p->jatah_penjual * $qty;
            $totalPus  += $p->jatah_pusdis  * $qty;
        }

        $this->total_harga    = $total;
        $this->jatah_penjual  = $totalSell;
        $this->jatah_pusdis   = $totalPus;
        $this->kembalian      = max(0, $this->bayar - $total);
    }

    /* ----------  simpan / update  ---------- */
    public function save($id = null): void
    {
        $this->recalculate();    // pastikan angka konsisten
        $this->validate();

        DB::transaction(function () use ($id) {

            $pemesanan = Pemesanan::updateOrCreate(
                ['id' => $id],
                [
                    'jatah_pusdis' => $this->jatah_pusdis,
                    'jatah_penjual' => $this->jatah_penjual,
                    'total_harga' => $this->total_harga,
                    'bayar'       => $this->bayar,
                    'kembalian'   => $this->kembalian,
                ]
            );

            /* sinkron pivot: hanya produk dengan qty > 0 */
            $sync = collect($this->jumlah)
                ->filter(fn($qty) => $qty > 0)
                ->map(fn($qty)  => ['jumlah' => $qty])
                ->all();                   // hasil: [produk_id => ['jumlah' => 2], …]

            $pemesanan->produk()->sync($sync);
        });
    }
}
