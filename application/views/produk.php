<a href="<?= site_url('admin') ?>" class="btn btn-md btn-primary"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
<br> </br>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Buku</h3>
            </div>
            <!-- /.card-header -->
            <?php echo $this->session->flashdata('message') ?>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modal-lg" onclick="tambah()"><i class="fas fa-plus"></i> Tambah Data Buku</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Keterngan</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($list as $al) : ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $al->kodeproduk ?></td>
                                    <td><?php echo $al->nama_produk?></td>
                                    <td><?php echo $al->keterangan ?></td>
                                    <td><?php echo $al->harga ?></td>
                                    <td><?php echo $al->jumlah ?></td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary" title="Edit" onclick="edit(
                                        '<?= $al->kodeproduk ?>',
                                        '<?= $al->nama_produk?>',
                                        '<?= $al->keterangan ?>',
                                        '<?= $al->harga ?>',
                                        '<?= $al->jumlah?>',
                                    )"><i class="fa fa-edit"></i></a> <br> <a href="<?= base_url('delete_buku/' . $al->kodeproduk) ?>" class="btn btn-sm btn-danger m-2"><i class="fa fa-trash"></i></a>
                                        <!-- <br> <a href="#" class="btn btn-sm btn-info mt-2"><i class="fas fa-info-circle"></i></a> -->
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('insert_produk') ?>" enctype="multipart/form-data" method="post" id="formProduk">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <label for="kodeproduk">Kode Produk/label>
                            <input type="text" class="form-control" name="kodeproduk" id="kodeproduk" placeholder="Kode Produk">
                        </div>
                       
                        <div class="col-4">
                            <label for="nama_produk">Nama Produk</label>
                            <input type="text" class="form-control" name="nama_produk" id="nama_produk" placeholder="Nama Produk">
                        </div>

                        <div class="col-4">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="keterangan">
                        </div>

                        <div class="col-4">
                            <label for="harga">Harga</label>
                            <input type="text" class="form-control" name="harga" id="harga" placeholder="Alamat..." required>
                        </div>
                        <div class="col-4">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah..." required>
                        </div>
                        
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    function edit(kodeproduk, nama_produk keterangan,harga,jumlah) {
        let url = "<?= site_url('update_buku') ?>"
        console.log(foto);
        
        $('#formProduk').attr('action', url);
        $('#modal-lg').modal('show');
        $('#formProduk #kodeproduk').val(kodeproduk);
       //$('#formAlumni #foto').val(foto);
        $('#formProduk #nama_produk').val(nama_produk);
        $('#formProduk #keterangan').val(keterangan);
        $('#formProduk #harga').val(harga);
        $('#formProduk #jumlah').val(jumlah);
        

    }

    function tambah() {
        // $('#modal-lg').modal('show');
        $('#formBuku').find('input[type="text"],select').val('');
        let url_tambah = "<?= base_url('insert_buku') ?>"
        $('#formBuku').attr('action', url_tambah);
    }



    $(document).ready(function() {
        $('#formBuku').validate({
            rules: {
                kodeproduk: {
                    required: true,
                    digits: true,
                },
                nama_produk: {
                    required: true
                },
                keterangan: {
                    required: true,
                },
                harga: {
                    required: true

                },
                jumlah: {
                    required: true
                    digits: true
                
                },
                
            },
            messages: {
                kodeproduk: {
                    required: "Inputan tidak boleh kosong",
                    digits: "Inputan harus angka"
                },
                nama_produk: {
                    required: "Inputan tidak boleh kosong"
                },
                keterangan: {
                    required: "Inputan tidak boleh kosong"
                },
                harga: {
                    required: "Inputan tidak boleh kosong"
                },

                jumlah: {
                    required: "Inputan tidak boleh kosong",
                    digits: "Inputan harus angka"
                },
            },
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>