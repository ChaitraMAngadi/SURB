<ul class="step d-flex flex-nowrap">

    <li class="step-item <?php if ($display_status == '1') { ?>active <?php } ?>">
        <a class="">Pending</a>
    </li>
    <li class="step-item <?php if ($display_status == '2') { ?>active <?php } ?>">
        <a class="">Accepted</a>
    </li>
    <li class="step-item <?php if ($display_status == '3') { ?>active <?php } ?>">
        <a class="">Assign to Courier</a>
    </li>
    <li class="step-item <?php if ($display_status == '4') { ?>active <?php } ?>">
        <a class="">Shipped</a>
    </li>
    <li class="step-item <?php if ($display_status == '5') { ?>active <?php } ?>">
        <a class="">Delivered</a>
    </li>
</ul>
<style>
    .step .step-item.active a::before {
        background: #081f66 !important;
        border: 0.1rem solid #081f66;
    }
</style>