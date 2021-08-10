<?php
require('../../db/connect.php');
require './penaltycalculator.php';
if (isset($_POST['id'])) {
    $lid = $_POST['id'];
    $dat2 = $pdo->query("SELECT * FROM customers c 
            LEFT JOIN loans l ON c.c_id=l.l_c_id
            WHERE l.l_id ='$lid'")->fetch();

    //this month collection
    $tmc = $pdo->prepare("SELECT SUM(lt_principal) FROM loan_transactions WHERE month(lt_uploaddate) = :date");
    $tmc->execute(['date' => date('m')]);
    $tmc2 = $tmc->fetchAll();
    $monthlycollected = $tmc2[0];

    //this month estimated emi calculator collection
    $loan = ($dat2['l_amount'] - $dat2['l_down_payment']) / $dat2['l_period'];

    echo '<div class="row">
    <div class="col-xl-4 col-md-2 mb-4">
      <div class="card shadow h-30 py-2" style="background:#2a3f54;color:white;">
        <div class="card-body" style="color:white;">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <b>Account No:<br>
                Name:<br>
                Occupation: <br>
                Contact No: <br>
                Address: <br>
                Total Savings: <br>
                Loan Date: <br>
                Loan Time: <br></b>
            </div>
            <div class="col-auto">
              ' . $dat2['c_number'] . '<br>
              ' . $dat2['c_name'] . '<br>
              ' . $dat2['c_occupation'] . '<br>
              ' . $dat2['c_mobile'] . '<br>
              ' . $dat2['c_current_address'] . '<br>
              Rs ' . $dat2['c_total_saving_amount'] . '<br>
              ' . date('Y-m-d', strtotime($dat2['l_upload_date_time'])) . '<br>
              ' . date('h:i:sa', strtotime($dat2['l_upload_date_time'])) . '<br>
            </div>
          </div>
        </div>

      </div>
    </div>



    <div class="col-xl-8 col-md-2 mb-4">
      <div class="card shadow h-100 py-2" style="background:white;">
        <div class="card-body" style="color:black;">
          <div class="row no-gutters">
          <div class="col-xl-8 col-md-2 mb-4">
            <form enctype="multipart/form-data" id="payform" method="POST">
            <div class="col mr-2 form-group row">
                <label for="total_amount" class="col-lg-7 col-form-label"><b>Total Description :</b></label>
                <div class="col-sm-5">
                  <input type="text" readonly class="form-control-plaintext" value="' . $dat2['l_title'] . '" style="width: 100%;">
                </div>
              </div>
              <div class="col mr-2 form-group row">
                <label for="total_amount" class="col-lg-7 col-form-label"><b>Total loan (in Rs):</b></label>
                <div class="col-sm-5">
                  <input type="text" readonly class="form-control-plaintext" id="total_amount" value="' . $dat2['l_amount'] . '" style="width: 100%;">
                </div>
              </div>
              
              <div class="col mr-2 form-group row">
                <label for="total_amount" class="col-lg-7 col-form-label"><b>Loan period: </b></label>
                <div class="col-sm-5">
                  <input type="text" readonly class="form-control-plaintext" id="total_amount" value="' . $dat2['l_period'] . ' months" style="width: 100%;">
                </div>
              </div>

            <div class="col mr-2 form-group row">
                <label for="total_amount" class="col-lg-7 col-form-label"><b>Monthly Collected: </b></label>
                <div class="col-sm-5">
                  <input type="text" readonly class="form-control-plaintext font-weight-bold" id="total_amount" value="' . $monthlycollected[0] . '" style="width: 100%;">
                </div>
              </div>
            
              <div class="col mr-2 form-group row">
                <label for="total_amount" class="col-lg-7 col-form-label"><b>Estimated Collection: </b></label>
                <div class="col-sm-5">
                  <input type="text" readonly class="form-control-plaintext text-success font-italic" id="total_amount" value="' . $loan . '" style="width: 100%;">
                </div>
              </div>

              <div class="col mr-2 form-group row">
                <label for="total_amount" class="col-lg-7 col-form-label"><b>Remaining Payments (in Rs):</b></label>
                <div class="col-sm-5">
                  <input type="text" readonly class="form-control-plaintext" id="total_remaining_amount" value="' . $dat2['l_remaining_loan'] . '" style="width: 100%;">
                  <input type="text" readonly class="form-control-plaintext" id="total_new_remaining_amount" name="total_new_remaining_amount" value="' . $dat2['l_remaining_loan'] . '" style="width: 100%;color:red;">
                </div>
              </div>
              <div class="col mr-2 form-group row">
                <label for="total_amount" class="col-lg-7 col-form-label"><b>Principal (in Rs):</b></label>
                <div class="col-sm-5">
                  <input type="number" class="form-control" id="principal" name="lt_principal" value="0" style="width: 100%;">
                </div>
              </div>


              <div class="col mr-2 form-group row">
                <label for="tender" class="col-lg-7 col-form-label"><b>Special Offer (in Rs):</b></label>
                <div class="col-sm-5">
                  <input type="number" name="lt_discount" class="form-control" id="discount_amount" value="0" style="width: 100%;" required>
                </div>
              </div>
              <div class="col mr-2 form-group row">
                <label for="tender" class="col-lg-7 col-form-label"><b>Interest (in Rs): </b></label>
                <div class="col-sm-5">
                  <input type="number" name="lt_interest" class="form-control" id="interest_amount" value="0" style="width: 100%;" required>
                </div>
              </div>
              <div class="col mr-2 form-group row">
                <label for="tender" class="col-lg-7 col-form-label"><b>Penalty (in Rs):</b></label>
                <div class="col-sm-5">';

    $pdamt = $dat2['l_amount'] - $dat2['l_remaining_loan'] - $dat2['l_down_payment'];
    $penalty = pencalc($dat2['l_amount'], date_create(date('Y-m-d', strtotime($dat2['l_upload_date_time']))), $dat2['l_down_payment'], $pdamt, date_create(date('Y-m-d')), 0.16);

    echo '<input type="number" name="lt_penalty" id="penalty_amount" value="' . round($penalty, 2) . '" class="form-control-plaintext" style="width: 100%;" required>
                </div>
              </div>
              <div class="col mr-2 form-group row">
                <label for="tender" class="col-lg-7 col-form-label"><b>Grand Total (in Rs):</b></label>
                <div class="col-sm-5">
                  <input type="number" readonly name="lt_grand_total" id="grand_total" class="form-control-plaintext" value="0" style="width: 100%;" required>
                </div>
              </div>
              <input type="hidden" name="lt_l_id" value="' . $dat2['l_id'] . '" class="form-control">
              <input type="hidden" name="c_id" value="' . $dat2['c_id'] . '" class="form-control">
              <div class="row no-gutters align-items-center relbtn" style="margin-left: 300px;">
                <button id="pay" class="form-control btn-outline-success pay">Pay</button>
              </div>

            </form>
          </div>
          <div class="col-xl-4 col-md-2">
         
          <button id="' . $dat2['l_id'] . '" class="btn btn-lg btn-outline-success showmodaloverview" style="margin-left:9rem"><i class="fas fa-balance-scale"></i></button>
      
          </div>
          </div>



        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12 col-md-2 mb-4">
      <div class="card shadow h-100 py-2" style="background:white;">
        <div class="card-body" style="color:black;">
          <div class="row no-gutters align-items-center">
            <div class="table-responsive">';

    $asd = $pdo->query("SELECT * FROM loan_transactions lt
              LEFT JOIN customers c ON lt.c_id=c.c_id 
              INNER JOIN loans l ON lt.lt_l_id=l.l_id WHERE l.l_id='$lid'
              ");
    $asd2 = $pdo->query("SELECT * FROM loans WHERE l_id='$lid'
              ");
    $asdd2 = $asd2->fetch();
    $rcasd2 = $asd2->rowCount();

    echo '<table class="table table-bordered table-striped table-hover table-sm example2" id="example2" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Principal</th>
                    <th>Discount</th>
                    <th>Interest</th>
                    <th>Penalty</th>
                    <th>Grand Total</th>
                  </tr>

                </thead>
                <tfoot>
                  <tr style="color:white;background: red;">
                    <th colspan="2">Total</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>

                </tfoot>';

    if ($rcasd2 > 0) {
        $vall =  intval($asdd2['l_down_payment']);
    } else {
        $vall = intval(0);
    }

    echo '<tbody>
                  <tr style="background:blanchedalmond;">
                    <td></td>
                    <td><b style="color:red;">Down Payment</b></td>
                    <b style="color:red;">
                      <td>' . $vall . '</td>
                    </b>
                    <td></td>
                    <td></td>
                    <td></td>
                    <b style="color:red;">
                      <td>' . $vall . '</td>
                    </b>

                  </tr>';
    $vv = 1;
    foreach ($asd as $a) {
        $s = $a['lt_uploaddate'];

        echo '<tr>';
        echo '<td>' . $vv . '</td>';
        echo '<td>' . $s . '</td>';
        echo '<td>' . $a['lt_principal'] . '</td>';
        echo '<td>' . $a['lt_discount'] . '</td>';
        echo '<td>' . $a['lt_interest'] . '</td>';
        echo '<td>' . $a['lt_penalty'] . '</td>';
        echo '<td>' . $a['lt_grand_total'] . '</td>';
        echo '</tr>';
        $vv++;
    }
    echo '</tbody>

              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>';
}
?>
<script type="text/javascript">
    var principal = $("#principal").val();
    var discount_amount = $("#discount_amount").val();
    var interest_amount = $("#interest_amount").val();
    var penalty_amount = $("#penalty_amount").val();
    var gtotal = Number(principal) - Number(discount_amount) + Number(interest_amount) + Number(penalty_amount);
    $("#grand_total").val(gtotal);

    $("#principal").on("change keyup", function() {
        var principal = $("#principal").val();
        var discount_amount = $("#discount_amount").val();
        var interest_amount = $("#interest_amount").val();
        var penalty_amount = $("#penalty_amount").val();
        var gtotal = Number(principal) - Number(discount_amount) + Number(interest_amount) + Number(penalty_amount);
        $("#grand_total").val(gtotal);
        var rempayment = $("#total_remaining_amount").val();
        var diff = Number(rempayment) - Number(principal);
        $("#total_new_remaining_amount").val(diff);

    });

    $("#discount_amount").on("change keyup", function() {
        var principal = $("#principal").val();
        var discount_amount = $("#discount_amount").val();
        var interest_amount = $("#interest_amount").val();
        var penalty_amount = $("#penalty_amount").val();
        var gtotal = Number(principal) - Number(discount_amount) + Number(interest_amount) + Number(penalty_amount);
        $("#grand_total").val(gtotal);

    });

    $("#interest_amount").on("change keyup", function() {
        var principal = $("#principal").val();
        var discount_amount = $("#discount_amount").val();
        var interest_amount = $("#interest_amount").val();
        var penalty_amount = $("#penalty_amount").val();
        var gtotal = Number(principal) - Number(discount_amount) + Number(interest_amount) + Number(penalty_amount);
        $("#grand_total").val(gtotal);

    });

    $("#penalty_amount").on("change keyup", function() {
        var principal = $("#principal").val();
        var discount_amount = $("#discount_amount").val();
        var interest_amount = $("#interest_amount").val();
        var penalty_amount = $("#penalty_amount").val();
        var gtotal = Number(principal) - Number(discount_amount) + Number(interest_amount) + Number(penalty_amount);
        $("#grand_total").val(gtotal);

    });
</script>