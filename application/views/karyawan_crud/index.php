<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg">
              <div class="p-5 overflow-auto">
                  <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4">Daftar Guru</h1>
                  </div>

                  <?= $this->session->flashdata('message'); ?>

                  <a href="<?= base_url('karyawan_crud/add') ?>" class="btn btn-sm btn-primary mb-3">&plus; Guru</a>
                  <a href="<?= base_url('karyawan_crud/add_csv') ?>" class="btn btn-sm btn-success mb-3">&plus; Guru CSV</a>

                  <table class="table table-sm display compact table-hover dt" style="font-size:13px;">
                    <thead>
                      <tr>
                        <th>Nama Depan</th>
                        <th>Nama Belakang</th>
                        <th>Username</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($kr_all as $m) : ?>
                        <tr>
                          <td><?= $m['kr_nama_depan'] ?></td>
                          <td><?= $m['kr_nama_belakang'] ?></td>
                          <td><?= $m['kr_username'] ?></td>
                          <td><?= $m['jabatan_nama'] ?></td>
                          <td><?= $m['st_nama'] ?></td>
                          <td>
                            <div class="form-group row m-0">
                              <form class="" action="<?= base_url('Karyawan_CRUD/update') ?>" method="get">
                                <input type="hidden" name="_id" value=<?= $m['kr_id'] ?>>
                                <button type="submit" class="badge badge-warning">
                                    Edit
                                </button>
                              </form>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>
                  <hr>
              </div>
            </div>
        </div>
        </div>
    </div>

</div>
