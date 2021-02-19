<?php
function pencalc($loan, $loan_date, $down_payment, $pd_amt, $today, $penper)
{
    // $loan = 100000; //total loan amount
    // $penper = 0.16; //penalty percentage divided by 100
    // $loan_date = date_create('2020-11-10'); //initial loan taken date
    // $remaining_loan = 80000; //remaining loan upto now
    // $down_payment = 10000; // initial payment made
    // $pd_amt = 10000; // 1st month paid amt
    // $paid_amount = $loan - $down_payment - $pd_amt; // loan paid upto now
    // $today = date_create(date("Y-m-d")); //today date
    $diff = date_diff($loan_date, $today); //date difference between two date
    $monthuptonow =  $diff->format("%m"); //2 month 
    // echo $monthuptonow;
    $aftermdate = $diff->format("%d"); //17 days
    // echo $aftermdate;
    $adloan = $loan - $down_payment; //after down-payment loan amount will be
    $permonthtopay = $adloan / 12; //7500 monthly is needed to be paid by customer
    $neededtopay = $permonthtopay * $monthuptonow; //15000 is needed to pay by customer in 2 month
    if ($neededtopay > $pd_amt) { //comparing if loan amount needed to pay upto now is greater than loan paid upto now 
        $toapplypenaltyamt = $neededtopay - $pd_amt; // 5000 can be applied for penalty

        if ($aftermdate > 2) { //checking if days obtained from 12 line is greater than 2
            $penaltyamt = $toapplypenaltyamt * $penper; // 800 penalty 
            $penappdate = $aftermdate - 2; //15 days will be charged extra and 2 days will be left as a customer service
            $penaltyamt2 = ($penaltyamt / 30) * $penappdate; //26.66 is daily penalty and multiplied by 15
        } else {
            // echo $toapplypenaltyamt;
            $penaltyamt = $toapplypenaltyamt * ($penper) * ($monthuptonow - 1); // 400 penalty 
            $penaltyamt2 = 0;
        }
        $penalty = $penaltyamt + $penaltyamt2; // monthly penalty and daily penalty is added
    } else {
        $penalty = 0;
    }
    return $penalty; //final penalty is displayed as 1200
}
