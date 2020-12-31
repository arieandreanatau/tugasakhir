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
                                <th>ID Buku</th>
                                <th>Judul Buku</th>
                                <th>Penulis</th>
                                <th>Genre</th>
                                <th>Foto</th>
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
                                    <td><?php echo $al->id_buku ?></td>
                                    <td><?php echo $al->judul ?></td>
                                    <td><?php echo $al->penulis ?></td>
                                    <td><?php echo $al->genre ?></td>
                                    <td><img src="<?php echo base_url('./assets/buku/'). $al->foto?>" width="120px"></td>
                                    <td><?php echo $al->harga ?></td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary" title="Edit" onclick="edit(
                                        '<?= $al->id_buku ?>',
                                        '<?= $al->judul?>',
                                        '<?= $al->penulis ?>',
                                        '<?= $al->genre ?>',
                                        '<?= $al->foto ?>',
                                        '<?= $al->harga ?>',
                                    )"><i class="fa fa-edit"></i></a> <br> <a href="<?= base_url('delete_buku/' . $al->id_buku) ?>" class="btn btn-sm btn-danger m-2"><i class="fa fa-trash"></i></a>
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
                <h4 class="modal-title">Tambah Buku</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('insert_buku') ?>" enctype="multipart/form-data" method="post" id="formBuku">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <label for="nim">ID Buku</label>
                            <input type="text" class="form-control" name="id_buku" id="id_buku" placeholder="ID Buku">
                        </div>
                       
                        <div class="col-4">
                            <label for="judul">Judul Buku</label>
                            <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul Buku">
                        </div>

                        <div class="col-4">
                            <label for="penulis">Penulis</label>
                            <input type="text" class="form-control" name="penulis" id="penulis" placeholder="Judul Buku">
                        </div>

                        <div class="row mt-3">
                        <div class="col-4">
                            <label for="genre">Genre Buku</label>
                            <select name="genre" id="genre" class="form-control" required>
                                <option value="" selected disabled>Pilih ....</option>
                                <option value="Horor">Horor</option>
                                <option value="Fantasi">Fantasi</option>
                                <option value="Romantis">Romantis</option>
                                <option value="Sci-Fi">Sci-Fi</option>
                                <option value="Komedi">Komedi</option>
                                <option value="Misteri">Misteri</option>
                                <option value="Petulangan">Petulangan</option>
                                <option value="Biografi">Biografi</option>
                                <option value="Pendidikan">Pendidikan</option>
                                <option value="Ensklopedia">Ensklopedia</option>
                                <option value="Jurnal">Jurnal</option>
                                <option value="Filsafat">Filsafat</option>
                                <option value="Agama">Agama</option>
                                                            </select>
                        </div>

                        <div class="form-group">
                        <label for="foto">Upload Foto Profil</label>
                        <input type="file" class="form-control" name="foto" id="foto"  required>
                    </div>
                        <div class="col-4">
                            <label for="harga">Harga</label>
                            <input type="text" class="form-control" name="harga" id="harga" placeholder="Alamat..." required>
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
    function edit(id_buku,foto, judul penulis,genre,harga) {
        let url = "<?= site_url('update_buku') ?>"
        console.log(foto);
        
        $('#formBuku').attr('action', url);
        $('#modal-lg').modal('show');
        $('#formBuku #id_buku').val(id_buku);
       //$('#formAlumni #foto').val(foto);
        $('#formBuku #judul').val(judul);
        $('#formBuku #alamat').val(penulis);
        $('#formBuku #no_telp').val(genre);
        $('#formBuku #email').val(harga);
        

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
                id_buku: {
                    required: true,
                    digits: true,
                },
                judul: {
                    required: true
                },
                penulis: {
                    required: true,
                },
                genre: {
                    required: true

                },
                harga: {
                    required: true
                    digits: true
                
                },
                
            },
            messages: {
                id-buku: {
                    required: "Inputan tidak boleh kosong",
                    digits: "Inputan harus angka"
                },
                judul: {
                    required: "Inputan tidak boleh kosong"
                },
                penulis: {
                    required: "Inputan tidak boleh kosong"
                },
                genre: {
                    required: "Inputan tidak boleh kosong"
                },

                harga: {
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