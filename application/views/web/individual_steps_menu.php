<ul class="step d-flex flex-nowrap">
    <li class="step-item <?php if ($data['display_status'] == '1') { ?>active <?php } ?>">
        <a class="step_text">Pending</a>
        <br><span class="step_text"><?= date('D,jS M', strtotime($data['created_date'])) ?></span>
    </li>
    <li class="step-item <?php if ($data['display_status'] == '2') { ?>active <?php } ?>">
        <a class="step_text">Accepted</a>
        <br><span class="step_text"><?php if ($data['placed_at']) { echo date('D,jS M', $data['placed_at']); } ?></span>
    </li>
    <?php if ($data['display_status'] == '6') { ?>
    <li class="step-item active">
        <a class="step_text">Cancelled</a>
        <br><span class="step_text"><?php if ($data['cancelled_at']) { echo date('D,jS M', $data['cancelled_at']); } ?></span>
    </li>
    <?php } else { ?>
    <li class="step-item <?php if ($data['display_status'] == '3') { ?>active <?php } ?>">
        <a class="step_text">Assign Courier</a>
        <br><span class="step_text"><?php if ($data['assign_courier_at']) { echo date('D,jS M', $data['assign_courier_at']); } ?></span>
    </li>
    <li class="step-item <?php if ($data['display_status']== '4') { ?>active <?php } ?>">
        <a class="step_text">Shipped</a>
        <br><span class="step_text"><?php if ($data['shipped_at']) { echo date('D,jS M', $data['shipped_at']); } ?></span>
    </li>
    <li class="step-item <?php if ($data['display_status'] == '5') { ?>active <?php } ?>">
        <a class="step_text">Delivered</a>
        <br><span class="step_text"><?php if ($data['delivered_at']) { echo date('D,jS M', $data['delivered_at']); } ?></span>
    </li>
    <?php if ($data['display_status'] == '7') { ?>
    <li class="step-item active">
        <a class="step_text">Returned</a>
        <br><span class="step_text"><?php if ($data['returned_at']) { echo date('D,jS M', $data['returned_at']); } ?></span>
    </li>
    <?php } ?>
    <?php } ?>
</ul>
<style>
    .step .step-item.active a::before {
        /* background: #2556B9 !important; */
        /* color: #2556B9; */
        /* border: 0.1rem solid #2556B9; */
    }
    .step .step-item {
        /* -ms-flex: 1 1 0; */
        /* flex: 1 1 0; */
        /* margin-top: 0; */
        /* min-height: 1rem; */
        /* width: 110px; */
        /* position: relative; */
        /* text-align: center; */
    }
    .step_text {
        /* font-size: 11px; */
        /* color: black; */
    }
    a:active{
        /* color: #2556B9; */
    }
</style>