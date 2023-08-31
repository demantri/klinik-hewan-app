<?= $this->extend('layouts/app');?>

<?= $this->section('page_title');?>
Pendaftaran Peliharaan
<?= $this->endSection();?>

<?= $this->section('content');?>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success notif" role="alert"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <div class="card-body">
                    <a href="<?= base_url('pendaftaran/form/add') ?>" class="btn btn-primary mb-4">
                        Tambah Data
                    </a>
                    <table class="table table-bordered" id="table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center"></th>
                                <th class="text-center">#</th>
                                <th class="text-center">ID Pendaftaran</th>
                                <th class="text-center">Nama Peliharaan</th>
                                <th class="text-center">Tanggal Lahir</th>
                                <th class="text-center">Jenis Kelamin</th>
                                <th class="text-center">Species</th>
                                <th class="text-center">Ras</th>
                                <th class="text-center">Warna</th>
                                <th class="text-center">Postur Tubuh</th>
                                <th class="text-center">Nama Pemilik</th>
                                <th class="text-center">Tanggal Daftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($pendaftaran as $item) : ?>
                            <tr>
                                <td>
                                    <a href="<?= base_url('pendaftaran/form/edit/' . $item->id_pendaftaran )?>" class="btn btn-light"><i class="fa-solid fa-pencil"></i></a>
                                    <a href="<?= base_url('pendaftaran/hapus/' . $item->id_pendaftaran )?>" class="btn btn-outline-danger" onclick="return confirm('Apakah anda yakin?')"><i class="fa-solid fa-trash"></i></a>
                                </td>
                                <td><?= $no++ ?></td>
                                <td><?= $item->id_pendaftaran ?></td>
                                <td><?= $item->nama_peliharaan ?></td>
                                <td><?= $item->tgl_lahir ?></td>
                                <td><?= $item->jenis_kelamin == 'b' ? 'Betina' : 'Jantan'; ?></td>
                                <td><?= $item->spesies ?></td>
                                <td><?= $item->ras ?></td>
                                <td><?= $item->warna ?></td>
                                <td><?= $item->postur ?></td>
                                <td><?= $item->nama_pemilik ?></td>
                                <td><?= date('d-m-Y H:i:s', strtotime($item->created_at)) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection();?>

<?= $this->section('script');?>
<script>
    $(document).ready(function() {
        $("#table").DataTable({
            destroy: true,
            scrollX: true,
            columnDefs: [{
                orderable: false,
                // className: 'select-checkbox',
                targets:   0
            }],
            order: [[ 1, "asc" ]],
        });
    });
</script>
<?= $this->endSection();?>