<div class="modal fade" id="addListModal" tabindex="-1" aria-labelledby="addListModalLabel" aria-hidden="true">
<!-- Membuat sebuah modal dialog Bootstrap dengan ID addListModal.
fade: Memberikan efek transisi muncul dan hilang.
tabindex="-1": Menyembunyikan modal dari tab browser.
aria-labelledby: Menghubungkan modal dengan judul modal.
aria-hidden="true": Mengindikasikan bahwa modal awalnya tersembunyi. -->
    <div class="modal-dialog">
        <form action="{{ route('lists.store') }}" method="POST" class="modal-content">
            @method('POST')
            @csrf
            <!-- modal-dialog: Mengatur lebar dialog modal.
action="{{ route('lists.store') }}": Endpoint untuk menyimpan data list di server.
method="POST": Metode HTTP yang digunakan untuk mengirimkan data form.
@method('POST'): Laravel Blade directive untuk menentukan metode form.
@csrf: Token keamanan Laravel untuk mencegah CSRF (Cross-Site Request Forgery). -->
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addListModalLabel">Tambah List</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Menampilkan judul modal.
Tombol close dengan Bootstrap class btn-close, yang berfungsi menutup modal. -->

            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Masukkan nama list">
                </div>
                <!-- mb-3: Margin bawah untuk spasi antar elemen.
Label input untuk nama list.
Input field (<input>) dengan tipe teks untuk mengisi nama list. -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>
</div>
<!-- Tombol Batal untuk menutup modal tanpa menyimpan.
Tombol Tambah untuk submit form. -->

<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
<!-- Membuat modal dialog untuk menambahkan task baru dengan ID addTaskModal. -->
    <div class="modal-dialog">
        <form action="{{ route('tasks.store') }}" method="POST" class="modal-content">
            @method('POST')
            @csrf
            <!-- Endpoint untuk menyimpan task.
Menggunakan metode POST dan Laravel CSRF protection. -->
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addTaskModalLabel">Tambah Task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Header modal dengan judul Tambah Task dan tombol close. -->
            <div class="modal-body">
                <input type="text" id="taskListId" name="list_id" hidden>
                <!-- Input tersembunyi (hidden) untuk menyimpan ID list terkait. -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Masukkan nama list">
                </div>
                <!-- Input teks untuk nama task. -->
                <div class="mb-3">
                    <label for="Deskripsi" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control" id="Deskripsi" name="deskripsi"
                        placeholder="Masukkan Deskripsi">
                </div>
                <!-- Input teks untuk deskripsi task. -->
                <div class="mb-3">
                    <label for="Priority" class="form-label">Priority</label>
                    <select class="form-select" aria-label="priority" id="Priority" name="priority">
                        <option value="low">low</option>
                        <option value="medium">medium</option>
                        <option value="high">high</option>
                    </select>
                </div>
            </div>
            <!-- Dropdown (select) untuk memilih prioritas task: low, medium, atau high. -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
<!-- Tombol Batal untuk menutup modal.
Tombol Tambah untuk menyimpan task baru. -->
        </form>
    </div>
</div>