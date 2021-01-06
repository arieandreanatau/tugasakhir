<a href="<?= site_url('admin') ?>" class="btn btn-md btn-primary"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
<br> </br>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Penjualan</h3>
            </div>
            <!-- /.card-header -->
            <?php echo $this->session->flashdata('message') ?>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modal-lg" onclick="tambah()"><i class="fas fa-plus"></i> Tambah Data Penjualan</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>ID Penjualan</th>
                                <th>Judul Buku</th>
                                <th>Harga</th>
                                <th>Jumlah Beli</th>
                                <th>Total</th>
                             
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($join as $al) :
                        ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $al->id_penjualan?></td>
                                    <td><?php echo $al->judul?></td>
                                    <td><?php echo $al->harga?></td>
                                    <td><?php echo $al->jumlah_beli?></td>
                                    <td><?php echo $al->total_beli?></td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary" title="Edit" onclick="edit(
                                     '<?= $al->id_penjualan ?>',
                                        '<?= $al->judul?>',
                                        '<?= $al->harga ?>',
                                        '<?= $al->jumlah_beli ?>',
                                        '<?= $al->total_beli ?>',
                                    )"><i class="fa fa-edit"></i></a> <br> <a href="<?= base_url('delete_penjualan/' . $al->id_penjualan) ?>" class="btn btn-sm btn-danger m-2"><i class="fa fa-trash"></i></a>
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
                <h4 class="modal-title">Tambah Penjualan Buku</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('insert_penjualan') ?>" enctype="multipart/form-data" method="post" id="formBuku">
            <div class="modal-body">
                    <!-- <div class="row"> -->
                    <div class="form-group">

                    <div class="form-group">
                        <label for="id_penjualan">IDPenjualan</label>
                        <input type="text" class="form-control" name="id_penjualan" id="id_penjualan" placeholder="ID Penjualan..." required>
                    </div>
                    <div class="form-group">
                            <label for="tanggal_penjualan">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal_penjualan" id="tanggal_penjualan" placeholder="Tanggal" required>
                    </div>
                    
                        <label for="nama_perusahaan">Nama Buku</label>
                        <input type="hidden" class="form-control" name="id" id="id">
                        <select name="id_judul" id="id_judul" class="form-control">
                            <option value="" selected disabled>Pilih Buku ....</option>
                            <?php foreach ($buku as $ph) : ?>
                                <option value="<?= $ph->id_buku ?>"><?= $ph->judul ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bagian">Harga</label>
                        <input type="text" class="form-control" name="bagian" id="bagian" <?php foreach ($join as $ph) :?>
                        placeholder="<?- $ph->harga?>" <?php endforeach;?> required>
                    </div>
                    <div class="form-group">
                        <label for="nama_hrd">Jumlah Beli</label>
                        <input type="text" class="form-control" name="nama_hrd" id="nama_hrd" placeholder="nama_hrd..." required>
                    </div>
                    <div class="form-group">
                        <label for="no_hrd">Total</label>
                        <input type="text" class="form-control" name="no_hrd" id="no_hrd" placeholder="No_hrd..." required>
                    </div>
                </div>
                <!-- </div> -->
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
    $("#kendaraan").change(function(){

// variabel dari nilai combo box kendaraan
var id_buku = $("#buku").val();

// Menggunakan ajax untuk mengirim dan dan menerima data dari server
$.ajax({
    url : "<?php echo base_url();?>/penjualan/get_all",
    method : "POST",
    data : {id_buku:id_buku},
    async : false,
    dataType : 'json',
    success: function(data){
        var html = '';
        var i;

        for(i=0; i<data.length; i++){
            html += '<option value='+data[i].id_buku+'>'+data[i].buku+'</option>';
        }
        $('#merk').html(html);

    }
});
});
$(document).ready(function(){
 
 $('#buku').change(function(){ 
     var id=$(this).val();
     $.ajax({
         url : "<?php echo site_url('penjualan/get_buku');?>",
         method : "POST",
         data : {id:_buku id_buku},
         async : true,
         dataType : 'json',
         success: function(data){
              
             var html = '';
             var i;
             for(i=0; i<data.length; i++){
                 html += '<option value='+data[i].buku+'>'+data[i].harga+'</option>';
             }
             $('#sub_category').html(html);

         }
     });
     return false;
 }); 
  
});
</script>