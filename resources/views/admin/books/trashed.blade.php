<x-admin-layout title="List Buku terhapus">
    <div class="card shadow mb-4">
        <div class="card-body">
            @if ($success = session()->get('success'))
                <div class="card border-left-success">
                    <div class="card-body">{!! $success !!}</div>
                </div>
            @endif
            <div class="w-100 d-flex justify-content-end">
                <a href="{{ route('admin.books.index') }}" class="btn btn-primary d-block d-sm-inline-block my-3">kembali</a>
             </div>    

            <x-admin.search url="{{ route('admin.books.index') }}" placeholder="Cari buku..." />

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Cover</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Tahun Terbit</th>
                            <th>Jumlah Tersedia</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($trashedBooks as $book)
                            <tr>
                                <td>
                                    <img src="{{ isset($book->cover) ? asset('storage/' . $book->cover) : asset('storage/placeholder.png') }}"
                                        alt="{{ $book->title }}" class="rounded" style="width: 100px;">
                                </td>
                                <td>{{ $book->category }} </td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->writer }}</td>
                                <td>{{ $book->publisher }}</td>
                                <td>{{ $book->publish_year }}</td>
                                <td>{{ $book->amount }} buku</td>
                                <td>
                                    <form action="{{ route('admin.books.restore', $book->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-link">Kembalikan</button>
                                    </form>
                                    <form action="{{ route('admin.books.forceDelete', $book->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-link text-danger" onclick="return confirm('Anda yakin ingin menghapus permanen buku ini?')">Hapus Permanen</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

 
                </div>
            </div>
        </div>
    </x-admin-layout>
