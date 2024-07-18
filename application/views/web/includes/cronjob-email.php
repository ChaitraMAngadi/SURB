<!DOCTYPE html>
<html>
    <head>
        <title>Pending Orders</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body {
                margin: 0;
                padding: 20px;
                font-family: sans-serif;
            }

            * {
                box-sizing: border-box;
            }

            .table {
                width: 100%;
                border-collapse: collapse;
            }

            .table td,
            .table th {
                padding: 12px 15px;
                border: 1px solid #ddd;
                text-align: center;
                font-size: 16px;
            }

            .table th {
                background-color: #92c9e6;
                color: #ffffff;
            }

            .table tbody tr:nth-child(even) {
                background-color: #d1e8f5;
            }

            /*responsive*/

            @media (max-width: 500px) {
                .table thead {
                    display: none;
                }

                .table,
                .table tbody,
                .table tr,
                .table td {
                    display: block;
                    width: 100%;
                }
                .table tr {
                    margin-bottom: 15px;
                }
                .table td {
                    padding-left: 50%;
                    text-align: left;
                    position: relative;
                }
                .table td::before {
                    content: attr(data-label);
                    position: absolute;
                    left: 0;
                    width: 50%;
                    padding-left: 15px;
                    font-size: 15px;
                    font-weight: bold;
                    text-align: left;
                }
            }
        </style>
    </head>

    <table class="table">
        <thead>
        <th>S.No</th>
        <th>Reference ID</th>
        <th><?= $order_details_list[0]['current_status'] ?></th>
    </thead>
    <tbody>
        <?php foreach ($order_details_list as $key => $list) { ?>
            <tr>
                <td data-label="S.No"><?= $key + 1 ?></td>
                <td data-label="Reference ID"><?= $list['ref_id'] ?></td>
                <td data-label="Time"><?= $list['current_status_time'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>