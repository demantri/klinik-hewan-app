<?= $this->extend('layouts/app');?>

<?= $this->section('page_title');?>
User
<?= $this->endSection();?>

<?= $this->section('content');?>

<?php 
    $validation = \Config\Services::validation();
?>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success notif" role="alert"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="row">
    <div class="col-sm-8">
        <div class="card card-primary">
            <div class="card-body">
                <table class="table table-bordered" id="table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center">#</th>
                            <th class="text-center">Username</th>
                            <th class="text-center">Password</th>
                            <th class="text-center">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($user as $item) : ?>
                        <tr>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-light btn-sm btn-edit mr-2" 
                                    data-toggle="modal" 
                                    data-target="#edit"
                                    data-id="<?= $item->id ?>"
                                    data-username="<?= $item->username ?>"
                                    data-password="<?= $item->password ?>"
                                    data-role="<?= $item->role_name ?>"
                                    ><i class="fa-solid fa-pencil"></i></button>

                                    <a href="<?= base_url('masterdata/user/hapus/' . $item->id)?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-outline-danger btn-sm"
                                    ><i class="fa-solid fa-trash"></i></a>
                                </div>
                            </td>
                            <td><?= $no++ ?></td>
                            <td><?= $item->username ?></td>
                            <td><?= $item->password ?></td>
                            <td><?= $item->role_name ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card card-primary">
            <form action="<?= base_url('masterdata/user/simpan')?>" method="post">
                <div class="card-header">
                    <h4>Form Tambah</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" id="username" class="form-control <?= $validation->hasError('username') ? 'is-invalid' : ''?>" placeholder="Masukan username" value="<?= set_value('username') ?>">
                        <?php if ($validation->getError('username')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="form-control <?= $validation->hasError('password') ? 'is-invalid' : ''?>" placeholder="Masukan password" value="<?= set_value('password') ?>">
                        <?php if ($validation->getError('password')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('password'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <input type="text" name="role" id="role" class="form-control <?= $validation->hasError('role') ? 'is-invalid' : ''?>" placeholder="Masukan role" value="<?= set_value('role') ?>">
                        <?php if ($validation->getError('role')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('role'); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection();?>

<?= $this->section('modal');?>
    <?= $this->include('masterdata/user/edit');?>
<?= $this->endSection();?>

<?= $this->section('script');?>
<script>

    $(document).on("click", ".btn-edit", function() {
        let id = $(this).data('id');
        let username = $(this).data('username');
        let password = $(this).data('password');
        let role = $(this).data('role');

        $("#id_edit").val(id);
        $("#username_edit").val(username);
        $("#password_edit").val(password);
        $("#role_edit").val(role);
    });
    
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