<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Invoice</title>
        <style>
            .clearfix:after {
                content: "";
                display: table;
                clear: both;
            }

            a {
                color: #5D6975;
                text-decoration: underline;
            }

            body {
                position: relative;
                width: 21cm;
                height: auto;
                margin: 0 auto;
                color: #001028;
                background: #FFFFFF;
                font-family: Arial, sans-serif;
                font-size: 12px;
                font-family: Arial;
            }

            header {
                padding: 10px 0;
                margin-bottom: 30px;
            }

            #logo {
                text-align: center;
                margin-bottom: 10px;
            }

            #logo img {
                width: 90px;
            }

            h1 {
                border-top: 1px solid  #5D6975;
                border-bottom: 1px solid  #5D6975;
                color: #5D6975;
                font-size: 2.4em;
                line-height: 1.4em;
                font-weight: normal;
                text-align: center;
                margin: 0 0 20px 0;
                background: url(<?= base_url('web_assets/img/') ?>dimension.png);
            }

            #project {
                float: left;
            }

            #project span {
                color: #5D6975;
                text-align: right;
                width: 87px;
                margin-right: 10px;
                display: inline-block;
                font-size: 0.9em;
            }

            #company {
                float: right;
                text-align: right;
            }

            #project div,
            #company div {
                white-space: nowrap;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 20px;
            }

            table tr:nth-child(2n-1) td {
                background: #F5F5F5;
            }

            table th,
            table td {
                text-align: center;
            }

            table th {
                padding: 5px 20px;
                color: #5D6975;
                border-bottom: 1px solid #C1CED9;
                white-space: nowrap;
                font-weight: normal;
            }

            table .service,
            table .desc {
                text-align: left;
            }

            table td {
                padding: 20px;
                text-align: right;
            }

            table td.service,
            table td.desc {
                vertical-align: top;
            }

            table td.unit,
            table td.qty,
            table td.total {
                font-size: 1.2em;
            }

            table td.grand {
                border-top: 1px solid #5D6975;
                ;
            }

            #notices .notice {
                color: #5D6975;
                font-size: 1.2em;
            }

            footer {
                color: #5D6975;
                width: 100%;
                height: 30px;
                position: absolute;
                bottom: 0;
                border-top: 1px solid #C1CED9;
                padding: 8px 0;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <header class="clearfix">
            <div id="logo">
                <img src="<?= base_url('uploads/images/') . $this->data['site']->logo ?>">
            </div>
            <h1>[ <?= $title ?> ]</h1>
            <div id="company" class="clearfix">
                <div><span>Name</span> <?= $order_details['ordersdetails']['customer_name'] ?></div>
                <div><span>Email</span> <a href="mailto:<?= $order_details['ordersdetails']['email'] ?>"><?= $order_details['ordersdetails']['email'] ?></a></div>
                <div><span>Mobile</span> <?= $order_details['ordersdetails']['mobile'] ?></div>
                <div><span>Address</span> <?= $order_details['ordersdetails']['useraddress'] ?></div>
            </div>
            <div id="project">
                <div><span>Order ID</span> #<?= $order_details['ordersdetails']['id'] ?></div>
                <div><span>Placed On</span> <?= $order_details['ordersdetails']['placed_on'] ?></div>
                <div><span>Order Status</span> <?= $order_details['ordersdetails']['order_status'] ?></div>
                <div><span>Payment Status</span> <?= $order_details['ordersdetails']['payment_status'] ?></div>
                <div><span>Payment Method</span> <?= $order_details['ordersdetails']['payment_type'] ?></div>
            </div>
        </header>
        <main>
            <table>
                <thead>
                    <tr>
                        <th class="service">#</th>
                        <th class="service">Image</th>
                        <th class="desc">Item</th>
                        <th>Attribute</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    foreach ($order_details['ordersdetails']['cartdetails'] as $item) {
                        ?>
                        <tr>
                            <td class="service"><?= $count ?></td>
                            <td class="service"><img src ="<?= $item['image'] ?>" style="width:50px;height:50px" /></td>
                            <td class="desc">
                                <?= $item['productname'] ?><br>
                                <?= ucfirst($item['attributes'][0]['attribute_type']) ?>: <?= $item['attributes'][0]['attribute_values'] ?>
                            </td>
                            <td class="desc"><?= $item['quantity'] ?></td>
                            <td class="desc"><?= DEFAULT_CURRENCY ?> <?= $item['total_price'] ?></td>

                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="4">Subtotal</td>
                        <td class="total"><?= DEFAULT_CURRENCY ?> <?= $order_details['ordersdetails']['sub_total'] ?></td>
                    </tr>
                    <tr>
                    <tr>
                        <td colspan="4" class="grand total">GRAND TOTAL</td>
                        <td class="grand total"><?= DEFAULT_CURRENCY ?> <?= $order_details['ordersdetails']['amount'] ?></td>
                    </tr>
                </tbody>
            </table>
        </main>
        <<footer>
            <?= $footer ?>
        </footer>
    </body>
</html>