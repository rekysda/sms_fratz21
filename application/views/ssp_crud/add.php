<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Tambah Ekstrakurikuler</h1>
                </div>

                <?= $this->session->flashdata('message'); ?>

                <form class="user" method="post" action="<?= base_url('SSP_CRUD/add'); ?>">
                    <div class="form-group row">
                        <div class="col-sm mb-3 mb-sm-0">
                            <input type="text" class="form-control" id="ssp_nama" name="ssp_nama" placeholder="Nama (Ex: Futsal, Badminton)" value="<?= set_value('ssp_nama') ?>">
                            <?= form_error('ssp_nama','<small class="text-danger pl-3">','</small>'); ?>
                        </div>
                        <div class="col-sm mb-3 mb-sm-0">
                            <select name="ssp_kr_id" id="ssp_kr_id" class="form-control mb-2">
                                <?php
                                $_selected = set_value(ssp_kr_id);

                                echo "<option value= '0'>Pengajar</option>";
                                foreach ($guru_all as $n) :
                                    if ($_selected == $n['kr_id']) {
                                        $s = "selected";
                                    } else {
                                        $s = "";
                                    }
                                    echo "<option value=" . $n['kr_id'] . " " . $s . ">" . $n['kr_nama_depan'] . " " . $n['kr_nama_belakang'][0] . "</option>";
                                endforeach
                                ?>
                            </select>
                        </div>
                        <div class="col-sm mb-sm-0">
                            <select name="ssp_t_id" id="ssp_t_id" class="form-control">
                                <?php
                                $_selected = set_value(ssp_t_id);
                                foreach ($t_all as $m) :
                                    if ($_selected == $m['t_id']) {
                                        $s = "selected";
                                    } else {
                                        $s = "";
                                    }
                                    echo "<option value=" . $m['t_id'] . " " . $s . ">" . $m['t_nama'] . "</option>";
                                endforeach ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Insert
                    </button>
                </form>
                <hr>
            </div>
            </div>
        </div>
        </div>
    </div>

</div>
