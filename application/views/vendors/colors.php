<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?= $title ?></h5>
                    <div class="ibox-tools">
                        <a href="<?= base_url() ?>vendors/colors/add">
                            <button class="btn btn-primary">+ Add Color</button>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Color Name</th>
                                <th>Color Code</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($colors as $color) {
                                ?>
                                <tr class="gradeX">
                                    <td><?= $i ?></td>
                                    <td><?= $color->color_name ?>
                                    </td>
                                    <td><?= $color->color_code ?>
                                        <div style="border-radius:50%;background-color:<?= $color->color_code; ?>;height:50px;width:50px"></div>
                                    </td>
                                    <td>
                                        <?php
                                        if ($color->status == 1) {
                                            ?>
                                            <button class="btn btn-xs btn-success">
                                                Active
                                            </button>
                                            <?php
                                        } else {
                                            ?>
                                            <button class="btn btn-xs btn-danger">
                                                InActive
                                            </button>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url() ?>vendors/colors/add/<?= $color->id ?>">
                                            <button class="btn btn-xs btn-primary">
                                                Edit
                                            </button>
                                        </a>
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
    </div>


</div>

