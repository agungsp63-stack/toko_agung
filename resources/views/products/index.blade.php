
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Toko Agung</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-6xl mx-auto px-6 py-10">
        <!-- JUDUL -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Daftar Barang Toko Agung</h1>
            <p class="text-gray-500 mt-2">Data barang yang tersedia di toko</p>
        </div>
        <div class="bg-white p-5 rounded-lg shadow-sm mb-5 flex flex-col md:flex-row gap-4 md:items-center md:justify-between">
            <button onclick="toggle_modal()" class="bg-green-600 text-white px-4 py-2 rounded-lg text-center"> + Tambah Barang</button>
            <input type="text" id="search" placeholder="Cari nama barang..." class="border border-gray-300 rounded-lg px-4 py-2 w-full md:w-72 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- TABEL -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="px-5 py-4 border text-center">No</th>
                            <th class="px-5 py-4 border text-center">Nama Barang</th>
                            <th class="px-5 py-4 border text-center">Harga</th>
                            <th class="px-5 py-4 border text-center">Stok</th>
                            <th class="px-5 py-4 border text-center">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody id="productTable" class="divide-y">
                        @forelse ($products as $product)
                        <tr class="hover:bg-blue-50">
                            <td class="px-5 py-4">{{ $loop->iteration }}</td>
                            <td class="px-5 py-4 font-semibold text-gray-800">{{ $product->nama_barang }} </td>
                            <td class="px-5 py-4">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                            <td class="px-5 py-4">{{ $product->stok }}</td>
                            <td class="px-5 py-4 text-gray-600"> {{ $product->deskripsi }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-5 py-10 text-center text-gray-500">
                                Belum ada data barang. Silakan klik tombol Tambah Barang.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
                    <div class="bg-white p-6 rounded-2xl shadow-lg w-96">
                        <h2 class="text-lg font-bold mb-4">Tambah Barang</h2>
                        <form action="{{ route('products.store') }}" method="POST">
                        @csrf

                        <label for="nama_barang" class="text-sm">Nama Barang</label>
                        <input type="text" name="nama_barang"
                            class="w-full border p-2 mb-3 rounded" required>

                        <label for="harga" class="text-sm">Harga Barang</label>
                        <input type="number" name="harga"
                            class="w-full border p-2 mb-3 rounded" required>

                        <label for="stok" class="text-sm">Stock Barang</label>
                        <input type="number" name="stok"
                            class="w-full border p-2 mb-3 rounded" required>

                        <label for="deskripsi" class="text-sm">Deskripsi</label>
                        <textarea name="deskripsi"
                                class="w-full border p-2 mb-3 rounded"
                                required></textarea>

                        <div class="flex justify-end gap-3 mt-2">

                            <button type="button"
                                    onclick="toggle_modal()"
                                    class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">
                                Cancel
                            </button>

                            <button type="submit"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                                Submit
                            </button>

                        </div>
                    </form>
                    </div>
                </div>
                <script>
                    function toggle_modal() {
                        const modal = document.getElementById('modalTambah');
                        modal.classList.toggle('hidden');
                        modal.classList.toggle('flex');
                    }
                </script>
            </div>
        </div>
    </div>

    <!-- PENCARIAN -->
    <script>
        document.getElementById('search').addEventListener('keyup', function() {
            let keyword = this.value.toLowerCase();
            document.querySelectorAll('#productTable tr').forEach(function(row) {
                row.style.display = row.innerText.toLowerCase().includes(keyword)
                    ? ''
                    : 'none';
            });
        });
    </script>
</body>
</html>
