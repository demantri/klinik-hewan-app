<?= $this->extend('layouts/app');?>

<?= $this->section('page_title');?>
Input Rekam Medis
<?= $this->endSection();?>

<?= $this->section('content');?>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success notif" role="alert"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <form id="myform">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h4>
                                    Detail
                                </h4>
                                <hr>
                                <div class="form-group">
                                    <label>ID Rekam Medis</label>
                                    <input type="text" name="id_rekam_medis" id="id_rekam_medis" class="form-control" value="<?= $kode ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= date('Y-m-d')?>">
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Pemilik</label>
                                            <select name="pemilik" id="pemilik" class="form-control" required>
                                                <option value="" selected disabled>Pilih</option>
                                                <?php foreach ($pemilik as $row) { ?>
                                                <option value="<?= $row->id_pemilik ?>"><?= $row->nama_lengkap ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Peliharaan</label>
                                            <select name="peliharaan" id="peliharaan" class="form-control" required>
                                                <option value="">-</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Dokter</label>
                                    <select name="dokter" id="dokter" class="form-control" required>
                                        <option value="" selected disabled>Pilih Dokter</option>
                                        <?php foreach ($dokter as $item) { ?>
                                        <option value="<?= $item->id_dokter ?>"><?= $item->nama_lengkap ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <!-- <hr> -->
                                <h4>
                                    Pembayaran
                                </h4>
                                <hr>
                                <div class="form-group">
                                    <label>Jasa Dokter</label>
                                    <input type="text" class="form-control" value="<?= number_format('150000')?>" readonly>
                                    <input type="hidden" value="150000" name="jasa_dokter" id="jasa_dokter">
                                </div>
                                <div class="form-group">
                                    <label>Total Transaksi</label>
                                    <input type="text" class="form-control" value="<?= number_format('200000')?>" readonly>
                                    <input type="hidden" value="200000" name="total_transaksi" id="total_transaksi">
                                </div>
                                <div class="form-group">
                                    <label>Grand Total</label>
                                    <input type="text" class="form-control" value="<?= number_format('350000')?>" readonly>
                                    <input type="hidden" value="350000" name="grandtotal" id="grandtotal">
                                </div>
                            </div>
                            <div class="col">
                                <h4>Rekam medis</h4>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Temperatur Rektal</label>
                                            <input type="text" value="0" name="temperatur_rektal" id="temperatur_rektal" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Frekuensi Pulsus</label>
                                            <input type="text" value="0" name="frekuensi_pulsus" id="frekuensi_pulsus" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Frekuensi Nafas</label>
                                            <input type="text" value="0" name="frekuensi_nafas" id="frekuensi_nafas" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Berat Badan</label>
                                            <input type="text" value="0" name="berat_badan" id="berat_badan" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Kondisi Umum</label>
                                            <input type="text" value="0" name="kondisi_umum" id="kondisi_umum" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Kulit Bulu</label>
                                            <input type="text" value="0" name="kulit_bulu" id="kulit_bulu" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Membran Mukosa</label>
                                            <input type="text" value="0" name="membran_mukosa" id="membran_mukosa" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Kelenjar Limfa</label>
                                            <input type="text" value="0" name="kelenjar_limfa" id="kelenjar_limfa" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Muskuloskeletal</label>
                                            <input type="text" value="0" name="muskuloskeletal" id="muskuloskeletal" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Sistem Sirkulasi</label>
                                            <input type="text" value="0" name="sistem_sirkulasi" id="sistem_sirkulasi" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Sistem Respirasi</label>
                                            <input type="text" value="0" name="sistem_respirasi" id="sistem_respirasi" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Sistem Digesti</label>
                                            <input type="text" value="0" name="sistem_digesti" id="sistem_digesti" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Sistem Urogenital</label>
                                            <input type="text" value="0" name="sistem_urogenital" id="sistem_urogenital" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Sistem Saraf</label>
                                            <input type="text" value="0" name="sistem_saraf" id="sistem_saraf" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Mata Telinga</label>
                                            <input type="text" value="0" name="mata_telinga" id="mata_telinga" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary" type="submit">Proses</button>
                        <!-- <button class="btn btn-outline-success" type="button">Simpan & Print</button> -->
                    </div>
                </form>
            </div>
        </div>
        <!-- <div class="col-sm-6 col-md-6">
            <div class="card card-primary">
                <form action="<?= base_url('rekam-medis/simpan')?>" method="post">
                    <div class="card-header">
                        <h4>Obat/Tindakan</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="d-flex">
                                <select name="" id="" class="form-control mr-2">
                                    <option value="" selected disabled>Pilih Obat</option>
                                </select>
                                <input type="text" class="form-control mr-2" placeholder="Qty">
                                <input type="text" class="form-control mr-2" placeholder="Harga">
                                <a href=""
                                class="btn btn-outline-success">
                                <i class="fas fa-plus"></i>
                                </a>
                            </div>
                            <div class="content-table mt-3">
                                <table class="table table-hover table-striped table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Nama Obat</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>        
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-outline-primary" type="submit">Tambah</button>
                    </div>
                </form>
            </div>
        </div> -->
    </div>
<?= $this->endSection();?>

<?= $this->section('script');?>
<script>
    function prosesSimpan() {
        let params = {
            id_rekam_medis : $("#id_rekam_medis").val(),
            tanggal : $("#tanggal").val(),
            pemilik : $("#pemilik").val(),
            peliharaan : $("#peliharaan").val(),
            dokter : $("#dokter").val(),
            jasa_dokter : $("#jasa_dokter").val(),
            total_transaksi : $("#total_transaksi").val(),
            grandtotal : $("#grandtotal").val(),
            temperatur_rektal : $("#temperatur_rektal").val(),
            frekuensi_pulsus : $("#frekuensi_pulsus").val(),
            frekuensi_nafas : $("#frekuensi_nafas").val(),
            berat_badan : $("#berat_badan").val(),
            kondisi_umum : $("#kondisi_umum").val(),
            kulit_bulu : $("#kulit_bulu").val(),
            membran_mukosa : $("#membran_mukosa").val(),
            kelenjar_limfa : $("#kelenjar_limfa").val(),
            muskuloskeletal : $("#muskuloskeletal").val(),
            sistem_sirkulasi : $("#sistem_sirkulasi").val(),
            sistem_respirasi : $("#sistem_respirasi").val(),
            sistem_digesti : $("#sistem_digesti").val(),
            sistem_urogenital : $("#sistem_urogenital").val(),
            sistem_saraf : $("#sistem_saraf").val(),
            mata_telinga : $("#mata_telinga").val(),
        }

        $.ajax({
            url: '<?= base_url('rekam-medis/simpan')?>',
            type: 'post',
            dataType: 'json',
            data: params,
            success: function(response) {
                swal({
                    title: 'Berhasil!',
                    text: response.msg,
                    icon: 'success',
                }).then(function() {
                    location.reload();
                })
            }  
        });
    }

    function prosesSimpanPrint() {
        let params = {
            id_rekam_medis : $("#id_rekam_medis").val(),
            tanggal : $("#tanggal").val(),
            pemilik : $("#pemilik").val(),
            peliharaan : $("#peliharaan").val(),
            dokter : $("#dokter").val(),
            jasa_dokter : $("#jasa_dokter").val(),
            total_transaksi : $("#total_transaksi").val(),
            grandtotal : $("#grandtotal").val(),
            temperatur_rektal : $("#temperatur_rektal").val(),
            frekuensi_pulsus : $("#frekuensi_pulsus").val(),
            frekuensi_nafas : $("#frekuensi_nafas").val(),
            berat_badan : $("#berat_badan").val(),
            kondisi_umum : $("#kondisi_umum").val(),
            kulit_bulu : $("#kulit_bulu").val(),
            membran_mukosa : $("#membran_mukosa").val(),
            kelenjar_limfa : $("#kelenjar_limfa").val(),
            muskuloskeletal : $("#muskuloskeletal").val(),
            sistem_sirkulasi : $("#sistem_sirkulasi").val(),
            sistem_respirasi : $("#sistem_respirasi").val(),
            sistem_digesti : $("#sistem_digesti").val(),
            sistem_urogenital : $("#sistem_urogenital").val(),
            sistem_saraf : $("#sistem_saraf").val(),
            mata_telinga : $("#mata_telinga").val(),
        }

        $.ajax({
            url: '<?= base_url('rekam-medis/simpan')?>',
            type: 'post',
            dataType: 'json',
            data: params,
            success: function(response) {
                swal({
                    title: 'Berhasil!',
                    text: response.msg,
                    icon: 'success',
                }).then(function() {
                    cetak();
                })
            }  
        });
    }

    function cetak() {
        let id_rekam_medis = $("#id_rekam_medis").val();

        $.ajax({
            url: '<?= base_url('rekam-medis/cetak')?>',
            method: 'post',
            // dataType: 'text',
            xhr: function() {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 2) {
                        if (xhr.status == 200) {
                            xhr.responseType = "blob";
                        } else {
                            xhr.responseType = "text";
                        }
                    }
                };
                return xhr;
            },
            data: {
                id_rekam_medis: id_rekam_medis
            },
            success: function(data, status, xhr) {
                // swal.close();
                var fileName = xhr.getResponseHeader('content-disposition').split('filename=')[
                    1].split(';')[0];
                var a = document.createElement('a');
                var url = window.URL.createObjectURL(data);
                a.href = url;
                a.download = fileName.replace(/\"/g, '');
                document.body.append(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);

                // prosesSimpan();
                location.reload();
            },
        });
    }

    $(document).ready(function() {
        $("#table").DataTable();

        $("#pemilik").on("change", function() {
            let value = $(this).val();
            console.log(value);
            $.ajax({
                url: '<?= base_url('rekam-medis/get-peliharaan')?>',
                type: 'post',
                data: {
                    id_pemilik : value
                },
                success: function(response) {
                    let data = response;
                    let option = '';
                    if (data.length > 0) {
                        for (let i = 0; i < data.length; i++) {
                            option += `<option value="${data[i].nama_peliharaan}">${data[i].nama_peliharaan}</option>`;
                        }
                        $("#peliharaan").html(option);
                    }
                }
            })
        });

        $("#myform").on("submit", function(e) {
            e.preventDefault();
            swal({
                text: "Apakah anda yakin?",
                icon: "info",
                buttons: {
                    confirm: {
                        text: 'Bayar',
                        value: 'selesai',
                    },
                    print: {
                        text: 'Bayar & print',
                        value: 'selesai_print',
                    }
                },
            }).then((value) => {
                if (value == 'selesai') {
                    prosesSimpan();
                } else if (value == 'selesai_print') {
                    prosesSimpanPrint();
                }
            });
        })
    });
</script>
<?= $this->endSection();?>