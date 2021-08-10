<?php
require('../../db/connect.php');


$comkey = $_POST['id'];
$dat = $pdo->query("SELECT * FROM loans l
INNER JOIN customers c ON c.c_id=l.l_c_id
                    WHERE l.l_id='$comkey'")->fetch();
?>
<script type="text/javascript">
    // $('#printInvoice').click(function() {
    //     Popup($('.invoice')[0].outerHTML);

    //     function Popup(data) {
    //         window.print();
    //         return true;
    //     }
    // });
</script>
<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<style type="text/css">
    #invoice {
        padding: 30px;
    }

    .invoice {
        position: relative;
        background-color: #FFF;
        min-height: 680px;
        padding: 15px
    }

    .invoice header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #3989c6
    }

    .invoice .company-details {
        text-align: right
    }

    .invoice .company-details .name {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .contacts {
        margin-bottom: 20px
    }

    .invoice .invoice-to {
        text-align: left
    }

    .invoice .invoice-to .to {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .invoice-details {
        text-align: right
    }

    .invoice .invoice-details .invoice-id {
        margin-top: 0;
        color: #3989c6
    }

    .invoice main {
        padding-bottom: 50px
    }

    .invoice main .thanks {
        margin-top: -100px;
        font-size: 2em;
        margin-bottom: 50px
    }

    .invoice main .notices {
        padding-left: 6px;
        border-left: 6px solid #3989c6
    }

    .invoice main .notices .notice {
        font-size: 1.2em
    }

    .invoice table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px
    }

    .invoice table td,
    .invoice table th {
        padding: 15px;
        background: #eee;
        border-bottom: 1px solid #fff
    }

    .invoice table th {
        white-space: nowrap;
        font-weight: 400;
        font-size: 16px
    }

    .invoice table td h3 {
        margin: 0;
        font-weight: 400;
        color: #3989c6;
        font-size: 1.2em
    }

    .invoice table .qty,
    .invoice table .total,
    .invoice table .unit {
        text-align: right;
        font-size: 1.2em
    }

    .invoice table .no {
        color: #fff;
        font-size: 1.6em;
        background: #3989c6
    }

    .invoice table .unit {
        background: #ddd
    }

    .invoice table .total {
        background: #3989c6;
        color: #fff
    }

    .invoice table tbody tr:last-child td {
        border: none
    }

    .invoice table tfoot td {
        background: 0 0;
        border-bottom: none;
        white-space: nowrap;
        text-align: right;
        padding: 10px 20px;
        font-size: 1.2em;
        border-top: 1px solid #aaa
    }

    .invoice table tfoot tr:first-child td {
        border-top: none
    }

    .invoice table tfoot tr:last-child td {
        color: #3989c6;
        font-size: 1.4em;
        border-top: 1px solid #3989c6
    }

    .invoice table tfoot tr td:first-child {
        border: none
    }

    .invoice footer {
        width: 100%;
        text-align: center;
        color: #777;
        border-top: 1px solid #aaa;
        padding: 8px 0
    }

    @media print {
        .invoice {
            font-size: 11px !important;
            overflow: hidden !important
        }

        .invoice footer {
            position: absolute;
            bottom: 10px;
            page-break-after: always
        }

        .invoice>div:last-child {
            page-break-before: always
        }
    }
</style>
<div id="invoice">
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">

                    <div class="col">
                        <a target="_blank" href="https://hitecvision.com.np">
                            <img src="https://hitecnepal.com/images/logo/hitechvision.jpg" data-holder-rendered="true" height="100rem" width="100rem" />
                        </a>
                    </div>

                    <div class="col company-details">
                        <h1 class="name">
                            <a target="_blank" href="https://hitecnepal.com">
                                HITEC VISION PVT. LTD.
                            </a>

                        </h1>
                        <div>
                            <h3>पान नं ६०५८४१७२</h3>
                        </div>
                        <div>
                            <h3>सामाखुसी, काठमाडौँ <h3>
                        </div>
                        <div>
                            <h3>९८४१९९६४९०</h3>
                        </div>
                        <div>
                            <h3>www.hitecnepal.com</h3>
                        </div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">
                            <h2>INVOICE TO:</h2>
                        </div>
                        <h2 class="to"><?php echo $dat['c_name']; ?></h2>
                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id">INVOICE #<?php echo $dat['l_id'];  ?></h1>
                        <div class="date">
                            <h3>Date of Invoice: <?php echo date("Y-m-d"); ?></h3>
                        </div>
                        <div class="date">
                            <h3>Loan Period: <?php echo $dat['l_period']; ?></h3>
                        </div>
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left" colspan="2">
                                <h3><b>Description</b></h3>
                            </th>
                            <th class="text-right" colspan="2">
                                <h3><b>Amount</b></h3>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php




                        echo '<tr>';
                        echo '<td class="no">1</td>';
                        echo '<td class="text-left" style="color:white;" colspan="2"><h3>Loan Amount</h3></td>';
                        echo '<td class="total"  colspan="2">' . $dat['l_amount'] . '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td class="no">2</td>';
                        echo '<td class="text-left" style="color:white;" colspan="2"><h3>Down Amount</h3></td>';
                        echo '<td class="total"  colspan="2">' . $dat['l_down_payment'] . '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td class="no">3</td>';
                        echo '<td class="text-left" style="color:white;" colspan="2"><h3>Service Charge</h3></td>';
                        echo '<td class="total"  colspan="2">' . $dat['l_service_charge'] . '</td>';
                        echo '</tr>';

                        $total = $dat['l_amount'] - $dat['l_down_payment'] + $dat['l_service_charge'];
                        ?>



                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td>Rs.<?php echo $total; ?></td>
                        </tr>
                        <!-- <tr>
                            <td colspan="2"></td>
                            <td colspan="2">TAX 25%</td>
                            <td>$1,300.00</td>
                        </tr> -->
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td>Rs.<?php echo $total;   ?></td>
                        </tr>
                    </tfoot>
                </table><br><br><br><br><br>
                <div class="thanks">Thank you!</div>

            </main>

        </div>

    </div>
</div>