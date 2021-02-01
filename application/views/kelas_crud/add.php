<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4"><u><?= $title ?></u></h1>
            </div>

            <?= $this->session->flashdata('message'); ?>
            <form class="user" method="post" action="<?= base_url('Kelas_CRUD/add'); ?>">
              <div class="form-group row">
                <div class="col-sm-6">

                  <input type="hidden" name="kelas_sk_id" class="form-control" value="<?= $kr['kr_sk_id'] ?>">
                  <label for="kelas_t_id"><b><u>Tahun Ajaran</u>:</b></label>
                  <select name="kelas_t_id" id="kelas_t_id" class="form-control form-control-sm">
                    <?php
                    $_selected = set_value('kelas_t_id');

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

                  <label for="kelas_t_id" class="mt-2"><b><u>Program</u>:</b></label>
                  <select name="kelas_program_id" id="kelas_program_id" class="form-control form-control-sm">
                    <?php
                    $_selected = set_value('kelas_program_id');

                    foreach ($program_all as $m) :
                      if ($_selected == $m['program_id']) {
                        $s = "selected";
                      } else {
                        $s = "";
                      }
                      echo "<option value=" . $m['program_id'] . " " . $s . ">" . $m['program_nama'] . "</option>";
                    endforeach
                    ?>
                  </select>

                  <label for="kelas_t_id" class="mt-2"><b><u>Jenjang</u>:</b></label>
                  <select name="jenj_id" id="jenj_id" class="form-control form-control-sm">
                    <?php
                    $_selected = set_value('jenj_id');

                    foreach ($jenj_all as $m) :
                      if ($_selected == $m['jenj_id']) {
                        $s = "selected";
                      } else {
                        $s = "";
                      }
                      echo "<option value=" . $m['jenj_id'] . " " . $s . ">" . $m['jenj_nama'] . "</option>";
                    endforeach
                    ?>
                  </select>
                </div>
                <div class="col-sm-6">
                  <label for="kelas_nama"><b><u>Nama Kelas</u>:</b></label>
                  <input type="text" class="form-control form-control-sm" id="kelas_nama" name="kelas_nama" value="<?= set_value('kelas_nama') ?>" required>
                  <?= form_error('kelas_nama', '<small class="text-danger pl-3">', '</small>'); ?>

                  <label for="kelas_nama_singkat" class="mt-2"><b><u>Singkatan Kelas (Contoh: XMIPA1)</u>:</b></label>
                  <input type="text" class="form-control form-control-sm" id="kelas_nama_singkat" name="kelas_nama_singkat" required value="<?= set_value('kelas_nama_singkat') ?>">
                  <?= form_error('kelas_nama_singkat', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
              </div>

              <button type="submit" class="btn btn-primary btn-user btn-block">
                Tambah
              </button>
            </form>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
