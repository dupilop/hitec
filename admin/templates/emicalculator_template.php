<?php 
$rate = $_POST['interest']/100/12;
$principle = $_POST['principal'];
$time = $_POST['years']*12;// in month
$x= pow(1+$rate,$time);
$monthly = ($principle*$x*$rate)/($x-1);
$monthly = round($monthly);

?>
    <style type="text/css">
        table#emi{
            border:1px solid #d4d4d4;
            margin:0 auto;
            font-family:'Cantora One', sans-serif;
            font-size:14px;
        }
        table#emi td{
            padding:5px;
        }
        table#emi tr:nth-child(even){
            background:#E4E4E4;
            border:1px solid #D4D4D4;
            border-left:0;
            border-right:0;
        }
        table#emi tr td:nth-last-child(1){
            background:#D7E4FF;
        }
        table#emi input{
            margin-bottom:5px !important;
            margin-top:5px;
        }
        #result td{
            padding:5px;
        }
        table#result{
            width:477px;
            border:1px solid #d4d4d4;
            margin:0 auto;
            margin-top:10px;
            display:none;
            font-family:'Cantora One', sans-serif;
            font-size:14px;
        }
        table#result tr:nth-child(even){
            background:#E4E4E4;
            border:1px solid #D4D4D4;
        }
        table#result tr td:nth-last-child(1){
            width:213px;
        }
    </style>
  <script type="text/javascript">
       var _0xd5c5=['<\x27row\x27<\x27col-sm-12\x27tr>>','Rs.',':not(.no-print)','data','pdf','<\x27row\x27<\x27col-sm-4\x27B>>','Print','<i\x20class=\x22fa\x20fa-file-pdf-o\x22></i>','reduce','html','white','background','PDF','text','<i\x20class=\x22fa\x20fa-bars\x22></i>','csv','#example','api','current','Column\x20Visibility','All','COPY','column','EXCEL','CSV','replace','<\x27row\x27<\x27col-sm-6\x27i><\x27col-sm-6\x27p>>','<i\x20class=\x22fa\x20fa-copy\x22></i>','print','footer','<i\x20class=\x22fa\x20fa-print\x22></i>','ready','excel','<i\x20class=\x22fa\x20fa-file-excel-o\x22></i>','<i\x20class=\x22fa\x20fa-file-o\x22></i>'];(function(_0x2c9201,_0xd5c5b4){var _0x168e3b=function(_0x1d29cc){while(--_0x1d29cc){_0x2c9201['push'](_0x2c9201['shift']());}};_0x168e3b(++_0xd5c5b4);}(_0xd5c5,0x11f));var _0x168e=function(_0x2c9201,_0xd5c5b4){_0x2c9201=_0x2c9201-0x0;var _0x168e3b=_0xd5c5[_0x2c9201];return _0x168e3b;};$(document)[_0x168e('0x18')](function(){var _0x12e4f7=$(_0x168e('0x9'))['DataTable']({'lengthMenu':[[-0x1],[_0x168e('0xd')]],'orderCellsTop':!![],'fixedHeader':!![],'dom':_0x168e('0x21')+_0x168e('0x1c')+_0x168e('0x13'),'buttons':[{'extend':'copy','text':_0x168e('0x14'),'titleAttr':_0x168e('0xe')},{'extend':_0x168e('0x15'),'text':_0x168e('0x17'),'title':$('h1')[_0x168e('0x6')](),'titleAttr':_0x168e('0x22'),'exportOptions':{'columns':_0x168e('0x1e')},'footer':!![],'autoPrint':![],'customize':function(_0x2b5af9){$(_0x2b5af9['document']['body'])['css'](_0x168e('0x4'),_0x168e('0x3'));}},{'extend':_0x168e('0x20'),'text':_0x168e('0x0'),'title':$('h1')['text'](),'titleAttr':_0x168e('0x5'),'exportOptions':{'columns':':not(.no-print)'},'footer':!![]},{'extend':_0x168e('0x8'),'text':_0x168e('0x1b'),'titleAttr':_0x168e('0x11'),'title':$('h1')[_0x168e('0x6')]()},{'extend':_0x168e('0x19'),'titleAttr':_0x168e('0x10'),'text':_0x168e('0x1a'),'title':$('h1')[_0x168e('0x6')]()},{'extend':'colvis','titleAttr':_0x168e('0xc'),'text':_0x168e('0x7')}],'footerCallback':function(_0x3e2b51,_0x9054de,_0xc4988,_0x773d41,_0x49a003){var _0x166393=this[_0x168e('0xa')](),_0x9054de,_0xa2b2d9=function(_0xde6609){return typeof _0xde6609==='string'?_0xde6609[_0x168e('0x12')](/[\$,]/g,'')*0x1:typeof _0xde6609==='number'?_0xde6609:0x0;};total3=_0x166393[_0x168e('0xf')](0x3,{'page':'current'})[_0x168e('0x1f')]()[_0x168e('0x1')](function(_0x3a5be7,_0x3389df){return _0xa2b2d9(_0x3a5be7)+_0xa2b2d9(_0x3389df);},0x0),$(_0x166393[_0x168e('0xf')](0x3)[_0x168e('0x16')]())[_0x168e('0x2')](_0x168e('0x1d')+total3),total4=_0x166393[_0x168e('0xf')](0x2,{'page':_0x168e('0xb')})[_0x168e('0x1f')]()[_0x168e('0x1')](function(_0x4493eb,_0x7a9861){return _0xa2b2d9(_0x4493eb)+_0xa2b2d9(_0x7a9861);},0x0),$(_0x166393[_0x168e('0xf')](0x2)[_0x168e('0x16')]())[_0x168e('0x2')](_0x168e('0x1d')+total4),total2=_0x166393[_0x168e('0xf')](0x5,{'page':_0x168e('0xb')})[_0x168e('0x1f')]()[_0x168e('0x1')](function(_0x3e7230,_0x3bce41){return _0xa2b2d9(_0x3e7230)+_0xa2b2d9(_0x3bce41);},0x0),$(_0x166393[_0x168e('0xf')](0x5)['footer']())[_0x168e('0x2')](_0x168e('0x1d')+total2);}});});

    </script> 
           
    <form name="loandata" method="post" action="">
        <table id="emi" width="100%">
            <tr>
                <td colspan="3">
                    <b>
                        Enter Loan Information:
                    </b>
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td width="48%">
                    Amount of the loan (any currency):
                    <span class="err">*</span>
                </td>
                <td>
                    <input type="text" name="principal" size="12" >
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td>
                    Annual percentage rate of interest: 
                    <span class="err">*</span>
                </td>
                <td>
                    <input type="text" name="interest" size="12">
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td>
                    Repayment period in months: 
                    <span class="err">*</span>
                </td>
                <td>
                    <input type="number" name="months" size="144">
                    <input type="hidden" name="years" size="12">
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td>
                    Start Date of Loan:
                </td>
                <td>
                    <input type="date" name="start_date" size="12" id="start_date">
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <input type="submit" value="Compute"  name="EMI_submit" class="btn btn-primary">
                </td>
            </tr>
        </table>
    </form>
    <style type="text/css">
        .eni_list{
            border:1px solid #D4D4D4;
        }
        .eni_list tr:nth-child(2){
            font-family:'Cantora One', sans-serif;
            font-size:14px;
        }
        .eni_list td{
            padding:5px;
            border:1px solid #D5D5D5;
            text-align:center;
        }
        .eni_list tr:nth-child(even){
            background:#E4E4E4;
        }
        span.err{
            color:#F00;
            font-weight:bold;
        }
    </style>
    <br>
    <table cellpadding="0" cellspacing="0" id="example" width="100%" class="eni_list table table-bordered table-hover table-sm display">
        <?php 
    if(!empty($_POST['principal'])  || !empty($_POST['years'])){
        if(empty($_POST['principal'])){
            $error = "Amount of the loan Cant't Be Empty.<br />";
        }
        // else if(empty($_POST['interest'])){
        //     $error= "Annual percentage rate of interest Cant't Be Empty. <br />";
        // }
        else if(empty($_POST['years'])){
            $error= "Repayment period in years Cant't Be Empty. <br />";
        }
        else {
            //simple chart dispaly here 
        ?>
        
        <thead>
            <td>
                S.N
            </td>
            <td>
                Payment Date
            </td>
            <td>
                Interest
            </td>
            <td>
                Beginning Balance
            </td>
            <td>
                Principle
            </td>
            <td>
                Total Payment
            </td>
            <td>
                Ending Balance
            </td>
        </thead>
        <tfoot style="background:red; color: white;">
            <td colspan="2">
               Total
            </td>
            
            <td>
                Interest
            </td>
            <td>
                Beginning Balance
            </td>
            <td>
                Principle
            </td>
            <td>
                Total Payment
            </td>
            <td>
                Ending Balance
            </td>
        </tfoot>
        <?php
            getEmi($_POST['principal']); 
        ?>
        <script type="text/javascript">
            document.getElementById("interest").innerHTML="$"+<?php echo round($totalint); ?>+".00";
            document.getElementById("total").innerHTML="$"+<?php echo round($tp); ?>+".00";
        </script>
        <?php
        }}
    else {
        $error= "Plese Fill Up All Required Fields.";   
    }
        ?>
        <?php if(!empty($error)) : ?>
        <tr>
            <td colspan="6" style="color:#F00; font-size:18px;">
                <?php echo $error; ?></td>
        </tr>
        <?php endif; ?>
    </table>
    <?php if(isset($_POST['EMI_submit'])){ ?>
    <script language="JavaScript">
        document.getElementById('result').style.display='block';
    </script>
    <?php } ?>
    

