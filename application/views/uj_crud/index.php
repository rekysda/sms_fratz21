<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg">
          <div class="p-5 overflow-auto">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Pilih Kelas dan Mapel</h1>
            </div>

            <?= $this->session->flashdata('message'); ?>

            <form class="user" action="<?= base_url('Uj_CRUD/input') ?>" method="POST">

              <input type="hidden" name="" id="uj_flag" value="0">
              <select name="t_all_tes" id="t_all_tes" class="form-control">
                <option value="0">Pilih Tahun Ajaran</option>
                <?php foreach ($t_all as $m) : ?>
                  <option value='<?=$m['t_id'] ?>'>
                    <?=  $m['t_nama']; ?>
                  </option>
                <?php endforeach ?>
              </select>
              <input type="hidden" name="cek_agama" value="0">

              <div id="kelas_tes">

              </div>

              <div id="mapel_tes">

              </div>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

</div>
