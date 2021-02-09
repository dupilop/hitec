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
       var _0x1ada=['ready','DataTable','background','print','<\x27row\x27<\x27col-sm-6\x27i><\x27col-sm-6\x27p>>','EXCEL','Rs.','<i\x20class=\x22fa\x20fa-copy\x22></i>','document','current','All','text','colvis','PDF','body','#example','Print','footer','COPY','api','<i\x20class=\x22fa\x20fa-file-excel-o\x22></i>','number','white','column','excel',':not(.no-print)','CSV','<\x27row\x27<\x27col-sm-4\x27B>>','css','<i\x20class=\x22fa\x20fa-file-pdf-o\x22></i>','string','replace','reduce','<i\x20class=\x22fa\x20fa-print\x22></i>','Column\x20Visibility','html','<i\x20class=\x22fa\x20fa-bars\x22></i>'];(function(_0xd09b89,_0x1adaca){var _0x2a8fd3=function(_0x38b487){while(--_0x38b487){_0xd09b89['push'](_0xd09b89['shift']());}};_0x2a8fd3(++_0x1adaca);}(_0x1ada,0x9a));var _0x2a8f=function(_0xd09b89,_0x1adaca){_0xd09b89=_0xd09b89-0x0;var _0x2a8fd3=_0x1ada[_0xd09b89];return _0x2a8fd3;};$(document)[_0x2a8f('0x1f')](function(){var _0x2cb93f=$(_0x2a8f('0x9'))[_0x2a8f('0x20')]({'lengthMenu':[[-0x1],[_0x2a8f('0x4')]],'orderCellsTop':!![],'fixedHeader':!![],'dom':_0x2a8f('0x15')+'<\x27row\x27<\x27col-sm-12\x27tr>>'+_0x2a8f('0x23'),'buttons':[{'extend':'copy','text':_0x2a8f('0x1'),'titleAttr':_0x2a8f('0xc')},{'extend':_0x2a8f('0x22'),'text':_0x2a8f('0x1b'),'title':$('h1')['text'](),'titleAttr':_0x2a8f('0xa'),'exportOptions':{'columns':':not(.no-print)'},'footer':!![],'autoPrint':![],'customize':function(_0x147553){$(_0x147553[_0x2a8f('0x2')][_0x2a8f('0x8')])[_0x2a8f('0x16')](_0x2a8f('0x21'),_0x2a8f('0x10'));}},{'extend':'pdf','text':_0x2a8f('0x17'),'title':$('h1')['text'](),'titleAttr':_0x2a8f('0x7'),'exportOptions':{'columns':_0x2a8f('0x13')},'footer':!![]},{'extend':'csv','text':'<i\x20class=\x22fa\x20fa-file-o\x22></i>','titleAttr':_0x2a8f('0x14'),'title':$('h1')[_0x2a8f('0x5')]()},{'extend':_0x2a8f('0x12'),'titleAttr':_0x2a8f('0x24'),'text':_0x2a8f('0xe'),'title':$('h1')[_0x2a8f('0x5')]()},{'extend':_0x2a8f('0x6'),'titleAttr':_0x2a8f('0x1c'),'text':_0x2a8f('0x1e')}],'responsive':!![],'footerCallback':function(_0x157c79,_0x446936,_0x3aa9c9,_0xfe060e,_0x86b6c4){var _0x1495e8=this[_0x2a8f('0xd')](),_0x446936,_0x39418e=function(_0x52eed3){return typeof _0x52eed3===_0x2a8f('0x18')?_0x52eed3[_0x2a8f('0x19')](/[\$,]/g,'')*0x1:typeof _0x52eed3===_0x2a8f('0xf')?_0x52eed3:0x0;};total3=_0x1495e8[_0x2a8f('0x11')](0x3,{'page':_0x2a8f('0x3')})['data']()[_0x2a8f('0x1a')](function(_0x34fdcd,_0x10a1e3){return _0x39418e(_0x34fdcd)+_0x39418e(_0x10a1e3);},0x0),$(_0x1495e8['column'](0x3)['footer']())[_0x2a8f('0x1d')]('Rs.'+total3),total4=_0x1495e8[_0x2a8f('0x11')](0x2,{'page':_0x2a8f('0x3')})['data']()[_0x2a8f('0x1a')](function(_0xad2ec0,_0x5b96f7){return _0x39418e(_0xad2ec0)+_0x39418e(_0x5b96f7);},0x0),$(_0x1495e8['column'](0x2)[_0x2a8f('0xb')]())[_0x2a8f('0x1d')](_0x2a8f('0x0')+total4),total2=_0x1495e8[_0x2a8f('0x11')](0x5,{'page':'current'})['data']()[_0x2a8f('0x1a')](function(_0x463061,_0x44d528){return _0x39418e(_0x463061)+_0x39418e(_0x44d528);},0x0),$(_0x1495e8[_0x2a8f('0x11')](0x5)[_0x2a8f('0xb')]())[_0x2a8f('0x1d')]('Rs.'+total2);}});});
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
    

