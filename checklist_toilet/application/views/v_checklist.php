<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">

        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Checklist</h3>
                        </div>
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Tambah</button>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="card-body p-0">
                                    <table class="table table-bordered" id="datatables">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">No</th>
                                                <th>Tanggal</th>
                                                <th>Lokasi Toilet</th>
                                                <th>Nama User</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($checklist_data as $checklist) { ?>
                                                <tr>
                                                    <td style="width: 10px"><?= $i ?></td>
                                                    <td><?= $checklist->tanggal ?></td>
                                                    <td><?= $checklist->toilet_lokasi ?></td>
                                                    <td><?= $checklist->user_nama ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-view" data-id="<?= $checklist->id; ?>" data-tanggal="<?= $checklist->tanggal; ?>" data-toilet_lokasi="<?= $checklist->toilet_lokasi; ?>" data-kloset="<?= $checklist->kloset; ?>" data-wastafel="<?= $checklist->wastafel; ?>" data-lantai="<?= $checklist->lantai; ?>" data-dinding="<?= $checklist->dinding; ?>" data-kaca="<?= $checklist->kaca; ?>" data-bau="<?= $checklist->bau; ?>" data-sabun="<?= $checklist->sabun; ?>" data-user_nama="<?= $checklist->user_nama; ?>"><i class="fa fa-eye"></i></a>
                                                        <a href="#" class="btn btn-info btn-edit" data-id="<?= $checklist->id; ?>" data-tanggal="<?= $checklist->tanggal; ?>" data-toilet_id="<?= $checklist->toilet_id; ?>" data-kloset="<?= $checklist->kloset; ?>" data-wastafel="<?= $checklist->wastafel; ?>" data-lantai="<?= $checklist->lantai; ?>" data-dinding="<?= $checklist->dinding; ?>" data-kaca="<?= $checklist->kaca; ?>" data-bau="<?= $checklist->bau; ?>" data-sabun="<?= $checklist->sabun; ?>" data-users_id="<?= $checklist->users_id; ?>"><i class="fa fa-marker"></i></a>
                                                        <a href="#" class="btn btn-danger btn-delete" data-id="<?= $checklist->id; ?>"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <?php
                            if ($this->session->userdata('role') == 'admin') {
                            ?>
                                <a href="checklist/cetak_pdf" class="btn btn-info">Cetak Data Semua Toilet</a>
                                <a href="checklist/cetak_pdf_belum_diperiksa" class="btn btn-primary">Cetak Data Toilet Belum Diperiksa</a>
                                <a href="checklist/cetak_pdf_rusak" class="btn btn-success">Cetak Data Toilet Rusak</a>
                                <a href="checklist/cetak_pdf_kotor" class="btn btn-secondary">Cetak Data Toilet Kotor</a>
                            <?php
                            } 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Add Product-->
<form action="<?php echo base_url("checklist/save"); ?>" method="post">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Checklist</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Toilet</label>
                            <select name="toilet_id" id="toilet_id" class="form-control" required>
                            <option value="">-- Pilih Toilet --</option>
                            <?php foreach ($toilet_data as $toilet) : ?>
                            <option value="<?= $toilet->id; ?>"><?= $toilet->lokasi; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kloset</label>
                            <select name="kloset" id="kloset" class="form-control" required>
                            <option value="">-- Pilih Kloset --</option>
                            <option value="1">Bersih</option>
                            <option value="2">Kotor</option>
                            <option value="3">Rusak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Wastafel</label>
                            <select name="wastafel" id="wastafel" class="form-control" required>
                            <option value="">-- Pilih Wastafel --</option>
                            <option value="1">Bersih</option>
                            <option value="2">Kotor</option>
                            <option value="3">Rusak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Lantai</label>
                            <select name="lantai" id="lantai" class="form-control" required>
                            <option value="">-- Pilih Lantai --</option>
                            <option value="1">Bersih</option>
                            <option value="2">Kotor</option>
                            <option value="3">Rusak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Dinding</label>
                            <select name="dinding" id="dinding" class="form-control" required>
                            <option value="">-- Pilih Dinding --</option>
                            <option value="1">Bersih</option>
                            <option value="2">Kotor</option>
                            <option value="3">Rusak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kaca</label>
                            <select name="kaca" id="kaca" class="form-control" required>
                            <option value="">-- Pilih Kaca --</option>
                            <option value="1">Bersih</option>
                            <option value="2">Kotor</option>
                            <option value="3">Rusak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Bau</label>
                            <select name="bau" id="bau" class="form-control" required>
                            <option value="">-- Pilih Bau --</option>
                            <option value="1">Ya</option>
                            <option value="2">Tidak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sabun</label>
                            <select name="sabun" id="sabun" class="form-control" required>
                            <option value="">-- Pilih Sabun --</option>
                            <option value="1">Ada</option>
                            <option value="2">Habis</option>
                            <option value="3">Hilang</option>
                        </select>
                    </div>
                    <?php
                        if ($this->session->userdata('role') == 'admin') {
                    ?>
                        <div class="form-group">
                            <label>User</label>
                                <select name="users_id" id="users_id" class="form-control" required>
                                <option value="">-- Pilih User --</option>
                                <?php foreach ($users_data as $users) : ?>
                                <option value="<?= $users->id; ?>"><?= $users->nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Add Product-->

<!-- Modal Edit Product-->
<form action="<?php echo base_url("checklist/update"); ?>" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Checklist</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Toilet</label>
                            <select name="toilet_id" id="toilet_id" class="form-control toilet_id" required>
                            <option value="">-- Pilih Toilet --</option>
                            <?php foreach ($toilet_data as $toilet) : ?>
                            <option value="<?= $toilet->id; ?>"><?= $toilet->lokasi; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kloset</label>
                            <select name="kloset" id="kloset" class="form-control kloset" required>
                            <option value="">-- Pilih Kloset --</option>
                            <option value="1">Bersih</option>
                            <option value="2">Kotor</option>
                            <option value="3">Rusak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Wastafel</label>
                            <select name="wastafel" id="wastafel" class="form-control wastafel" required>
                            <option value="">-- Pilih Wastafel --</option>
                            <option value="1">Bersih</option>
                            <option value="2">Kotor</option>
                            <option value="3">Rusak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Lantai</label>
                            <select name="lantai" id="lantai" class="form-control lantai" required>
                            <option value="">-- Pilih Lantai --</option>
                            <option value="1">Bersih</option>
                            <option value="2">Kotor</option>
                            <option value="3">Rusak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Dinding</label>
                            <select name="dinding" id="dinding" class="form-control dinding" required>
                            <option value="">-- Pilih Dinding --</option>
                            <option value="1">Bersih</option>
                            <option value="2">Kotor</option>
                            <option value="3">Rusak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kaca</label>
                            <select name="kaca" id="kaca" class="form-control kaca" required>
                            <option value="">-- Pilih Kaca --</option>
                            <option value="1">Bersih</option>
                            <option value="2">Kotor</option>
                            <option value="3">Rusak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Bau</label>
                            <select name="bau" id="bau" class="form-control bau" required>
                            <option value="">-- Pilih Bau --</option>
                            <option value="1">Ya</option>
                            <option value="2">Tidak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sabun</label>
                            <select name="sabun" id="sabun" class="form-control sabun" required>
                            <option value="">-- Pilih Sabun --</option>
                            <option value="1">Ada</option>
                            <option value="2">Habis</option>
                            <option value="3">Hilang</option>
                        </select>
                    </div>
                    <?php
                        if ($this->session->userdata('role') == 'admin') {
                    ?>
                        <div class="form-group">
                            <label>User</label>
                                <select name="users_id" id="users_id" class="form-control users_id" required>
                                <option value="">-- Pilih User --</option>
                                <?php foreach ($users_data as $users) : ?>
                                <option value="<?= $users->id; ?>"><?= $users->nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" class="id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Product-->

<!-- Modal Edit Product-->
<form>
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lihat Checklist</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="text" class="form-control tanggal" name="tanggal" placeholder="Tanggal" disabled>
                    </div>
                    <div class="form-group">
                        <label>Toilet</label>
                        <input type="text" class="form-control toilet_lokasi" name="toilet_lokasi" placeholder="Toilet Lokasi" disabled>
                    </div>
                    <div class="form-group">
                        <label>Kloset</label>
                        <input type="text" class="form-control kloset" name="kloset" placeholder="Kloset" disabled>
                    </div>
                    <div class="form-group">
                        <label>Wastafel</label>
                        <input type="text" class="form-control wastafel" name="wastafel" placeholder="Wastafel" disabled>
                    </div>
                    <div class="form-group">
                        <label>Lantai</label>
                        <input type="text" class="form-control lantai" name="lantai" placeholder="Lantai" disabled>
                    </div>
                    <div class="form-group">
                        <label>Dinding</label>
                        <input type="text" class="form-control dinding" name="dinding" placeholder="Dinding" disabled>
                    </div>
                    <div class="form-group">
                        <label>Kaca</label>
                        <input type="text" class="form-control kaca" name="kaca" placeholder="Kaca" disabled>
                    </div>
                    <div class="form-group">
                        <label>Bau</label>
                        <input type="text" class="form-control bau" name="bau" placeholder="Bau" disabled>
                    </div>
                    <div class="form-group">
                        <label>Sabun</label>
                        <input type="text" class="form-control sabun" name="sabun" placeholder="Sabun" disabled>
                    </div>
                    <?php
                        if ($this->session->userdata('role') == 'admin') {
                    ?>
                        <div class="form-group">
                            <label>User</label>
                            <input type="text" class="form-control user_nama" name="user_nama" placeholder="User Nama" disabled>
                        </div>
                    <?php
                        }
                    ?>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Product-->

<!-- Modal Delete Product-->
<form action="<?php echo base_url("checklist/delete"); ?>" method="post">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Checklist</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Apa anda yakin ingin menghapus data checklist?</h5>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" class="id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-primary">Ya</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Delete Product-->

<script src="<?php echo base_url('templates/plugins/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('templates/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script>

    $(document).ready(function() {
        $('.btn-edit').on('click', function() {
            const id = $(this).data('id');
            const tanggal = $(this).data('tanggal');
            const toilet_id = $(this).data('toilet_id');
            const kloset = $(this).data('kloset');
            const wastafel = $(this).data('wastafel');
            const lantai = $(this).data('lantai');
            const dinding = $(this).data('dinding');
            const kaca = $(this).data('kaca');
            const bau = $(this).data('bau');
            const sabun = $(this).data('sabun');
            const users_id = $(this).data('users_id');
            $('.id').val(id);
            $('.tanggal').val(tanggal);
            $('.toilet_id').val(toilet_id);
            $('.kloset').val(kloset);
            $('.wastafel').val(wastafel);
            $('.lantai').val(lantai);
            $('.dinding').val(dinding);
            $('.kaca').val(kaca);
            $('.bau').val(bau);
            $('.sabun').val(sabun);
            $('.users_id').val(users_id);
            $('#editModal').modal('show');
        });

        $('.btn-view').on('click', function() {
            const id = $(this).data('id');
            const tanggal = $(this).data('tanggal');
            const toilet_lokasi = $(this).data('toilet_lokasi');
            const kloset = $(this).data('kloset');
            const wastafel = $(this).data('wastafel');
            const lantai = $(this).data('lantai');
            const dinding = $(this).data('dinding');
            const kaca = $(this).data('kaca');
            const bau = $(this).data('bau');
            const sabun = $(this).data('sabun');
            const user_nama = $(this).data('user_nama');
            $('.id').val(id);
            $('.tanggal').val(tanggal);
            $('.toilet_lokasi').val(toilet_lokasi);
            $('.kloset').val(kloset == 1 ? "Bersih" : (kloset== 2 ? "Kotor" : "Rusak"));
            $('.wastafel').val(wastafel == 1 ? "Bersih" : (wastafel == 2 ? "Kotor" : "Rusak"));
            $('.lantai').val(lantai == 1 ? "Bersih" : (lantai == 2 ? "Kotor" : "Rusak"));
            $('.dinding').val(dinding == 1 ? "Bersih" : (dinding == 2 ? "Kotor" : "Rusak"));
            $('.kaca').val(kaca == 1 ? "Bersih" : (kaca == 2 ? "Kotor" : "Rusak"));
            $('.bau').val(bau == 1 ? "Ya" : "Tidak");
            $('.sabun').val(sabun == 1 ? "Ada" : (sabun == 2 ? "Habis" : "Hilang"));
            $('.user_nama').val(user_nama);
            $('#viewModal').modal('show');
        });

        $('.btn-delete').on('click', function() {
            const id = $(this).data('id');
            $('.id').val(id);
            $('#deleteModal').modal('show');
        });
        $('#datatables').DataTable();

    });
</script>