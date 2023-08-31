<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Data Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('masterdata/dokter/update')?>" method="post">
                <div class="modal-body">
                <div class="form-group">
                        <label>ID Dokter</label>
                        <input type="text" class="form-control" name="id_dokter" id="id_dokter_edit" value="<?= $kode ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input name="nama_lengkap" id="nama_lengkap_edit" class="form-control" placeholder="Masukan nama_lengkap">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin_edit" class="form-control">
                            <option value="" disabled selected>- Pilih -</option>
                            <option value="L" <?= set_select('jenis_kelamin', 'L')?>>Laki laki</option>
                            <option value="P" <?= set_select('jenis_kelamin', 'P')?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input name="alamat" id="alamat_edit" class="form-control" placeholder="Masukan alamat">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>