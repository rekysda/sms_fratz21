<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Update Siswa</h1>
            </div>

            <?= $this->session->flashdata('message'); ?>

            <form class="user" method="post" action="<?= base_url('Siswa_CRUD/update'); ?>">
              <div class="form-group row">
                <div class="col-sm mb-3 mb-sm-0">
                  <input type="hidden" name="_id" value="<?= set_value('_id', $siswa_update['sis_id']); ?>">
                  <input type="hidden" name="_sis_nisn" value="<?= set_value('_sis_nisn',$siswa_update['sis_nisn']); ?>">
                  <input type="text" class="form-control" id="sis_no_induk" name="sis_no_induk" placeholder="Nomor Induk" value="<?= set_value('sis_no_induk', $siswa_update['sis_no_induk']) ?>">
                  <?= form_error('sis_no_induk', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="col-sm mb-3 mb-sm-0">
                  <input type="number" class="form-control" id="sis_nisn" name="sis_nisn" placeholder="NISN" min="1" value="<?= set_value('sis_nisn', $siswa_update['sis_nisn']) ?>">
                  <?= form_error('sis_nisn', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <select name="sis_t_id" id="sis_t_id" class="form-control">
                    <?php
                      $_selected = set_value('sis_t_id', $siswa_update['sis_t_id']);

                      foreach ($tahun_all as $m) :
                        if ($_selected == $m['t_id']) {
                          $s = "selected";
                        } else {
                          $s = "";
                        }
                        echo "<option value=" . $m['t_id'] . " " . $s . ">" . $m['t_nama'] . "</option>";
                      endforeach
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm mb-3 mb-sm-0">
                  <input type="text" class="form-control" id="sis_nama_depan" name="sis_nama_depan" placeholder="Nama Depan" value="<?= set_value('sis_nama_depan', $siswa_update['sis_nama_depan']) ?>">
                  <?= form_error('sis_nama_depan', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="col-sm mb-3 mb-sm-0">
                  <input type="text" class="form-control" id="sis_nama_bel" name="sis_nama_bel" placeholder="Nama Belakang" value="<?= set_value('sis_nama_bel', $siswa_update['sis_nama_bel']) ?>">
                  <?= form_error('sis_nama_bel', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm mb-3 mb-sm-0">
                  <select class="form-control" name="sis_jk" id="sis_jk">
                    <?php
                      $_selected = set_value('sis_jk', $siswa_update['sis_jk']);

                      if($_selected == "Male"){
                        echo "<option value='1' selected>Laki-Laki</option>";
                      }
                      else{
                        echo "<option value='1'>Laki-Laki</option>";
                      }

                      if($_selected == "Female"){
                        echo "<option value='2' selected>Perempuan</option>";
                      }
                      else{
                        echo "<option value='2'>Perempuan</option>";
                      }
                    ?>
                  </select>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <select name="sis_agama_id" id="sis_agama_id" class="form-control">
                    <?php
                      $_selected = set_value('sis_agama_id', $siswa_update['sis_agama_id']);
                      foreach ($agama_all as $m) :
                        if ($_selected == $m['agama_id']) {
                          $s = "selected";
                        } else {
                          $s = "";
                        }
                        echo "<option value=" . $m['agama_id'] . " " . $s . ">" . $m['agama_nama'] . "</option>";
                      endforeach
                    ?>
                  </select>
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-user btn-block">
                Update
              </button>
            </form>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
