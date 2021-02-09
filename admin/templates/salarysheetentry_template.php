<?php

require('../db/connect.php');
$userid = $_SESSION['id'];
?>

    <div class="">
                  
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Salary Sheet</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="#">Settings 1</a>
                                                <a class="dropdown-item" href="#">Settings 2</a>
                                            </div>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <form class="" action="" method="post" id="form1" novalidate>
                                       
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Employee Name<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" id="a" name="sal_emp_name" required="required" />
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Designation<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" id="b" name="sal_designation" required="required" />
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Month & Year<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" id="c" type="month" name="sal_mon_year" required="required" />
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Earnings<span class="required">*</span></label>
                                            <div class="col-md-3 col-sm-3">
                                                <input class="form-control" type="text"  id="e_desc" required="required" />
                                            </div>
                                            <div class="col-md-2 col-sm-2">
                                                <input class="form-control" type="number"  id="e_price" required="required" />
                                            </div>
                                            <div class="col-md-1 col-sm-1">
                                                <button class="btn-danger" type="button" id="eadd"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Deductions<span class="required">*</span></label>
                                            <div class="col-md-3 col-sm-3">
                                                <input class="form-control" type="text"  id="d_desc" required="required" />
                                            </div>
                                            <div class="col-md-2 col-sm-2">
                                                <input class="form-control" type="number"  id="d_price" required="required" />
                                            </div>
                                            <div class="col-md-1 col-sm-1">
                                                <button class="btn-danger" type="button"  id="dadd"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Cheque No<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" id="d" class='optional' name="sal_cheque_no" type="text" /></div>
                                        </div>
                                      <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Name of Bank<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" id="e" class='optional' name="sal_bank_name" type="text" /></div>
                                        </div>
                                     <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Date<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" id="f" class='date' type="date" name="sal_date" required='required'></div>
                                        </div>

                                      <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align text-danger"><b>Earnings</b></label>
                                        <div class="col-md-6 col-sm-6">
                                           <table id="table1">
                                             
                                           </table>
                                         </div>
                                        </div>
                                        <div class="field item form-group">
                                          <label class="col-form-label col-md-3 col-sm-3  label-align text-danger"><b>Deductions </b></label>
                                        <div class="col-md-6 col-sm-6">
                                           <table id="table2">
                                             
                                           </table>
                                        </div>
                                        </div> 
                                        <div class="field item form-group">
                                          <label class="col-form-label col-md-3 col-sm-3  label-align text-danger"><b>Total Income </b></label>
                                        <div class="col-md-6 col-sm-6">
                                           <input type="text" readonly name="sal_tincome" id="t_income" class="form-control-plaintext text-danger">
                                        </div>
                                        </div> 
                                       
                                       
                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-3">
                                                  <input type="hidden" readonly name="sal_earnings" id="sal_earnings">
                                                  <input type="hidden" readonly name="sal_deductions" id="sal_deductions">
                                                   <button type='submit' name="add" id="add" class="btn btn-primary add">Add</button>
                                                    <button type='reset' class="btn btn-success">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

 
  <div id="user_data">          
               
  </div>
  <script type="text/javascript">
    var arr = [];
    var arr11 = [];
    var arr2 = [];
    var arr22 = [];
  load_data();
    
  function load_data()
  {
    $.ajax({
      url:"../other_controller/viewsalarysheet.php",
      method:"POST",
      success:function(data)
      {
        $('#user_data').html(data);
      }
    });
  }
  $("#eadd").on("click", function(){
   var edesc = $("#e_desc").val();
   var eprice = $("#e_price").val();
   if($.trim(edesc) == ''){
           $("#e_desc").css("border", "2px solid red");
       }else{
        $("#e_desc").css("border", "");
       }
       if($.trim(eprice) == ''){
        $("#e_price").css("border", "2px solid red");
       }else{
        $("#e_price").css("border", "");
       }
   if($.trim(edesc) == '' || $.trim(eprice) == ''){
       
    pb.clear();
        pb.error('<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> Empty Value cannot be added');
   }else{
   var tincome = $("#t_income").val();
   var ecomb = edesc + '- Rs.'+eprice;
   tincome = Number(tincome) + Number(eprice);
   var tds = '<tr>';
   tds += '<td id="ll">'+ecomb+'</td>';
   tds += '<td><button type="button" name="rem2" class="btn btn-danger btn-sm remove"><span><i class="fa fa-times-circle"></i></span></button></td>'; 
   tds += '</tr>';
   $("#table1").append(tds);
   $("#e_comb").val(ecomb);
   $("#e_desc").val('');
   $("#e_price").val('');
   $("#t_income").val(tincome);
   arr.push(eprice); 
   arr11.push(ecomb);
   $("#sal_earnings").val(arr11);
   }
  });

  $(document).on('click', '.remove', function(){
    var tot = t_income.value;
    
    var d = $(this).closest('td').prev('#ll').text();
    const originalString = d;
    const splitString = originalString.split("- Rs.");
    var res = splitString[1];
    var abc = splitString[0].split(' of ');
   
      tot = tot - Number(res);
    arr.splice( $.inArray(res,arr) ,1 );  
    arr11.splice($.inArray(d, arr11), 1); 
    $(this).closest('tr').remove(); 
    $("#t_income").val(tot);
    $("#sal_earnings").val(arr11);
    });


  $("#dadd").on("click", function(){
   var ddesc = $("#d_desc").val();
   var dprice = $("#d_price").val();
   if($.trim(ddesc) == ''){
       $("#d_desc").css("border", "2px solid red");
   }else{
    $("#d_desc").css("border", "");
   }
   if($.trim(dprice) == ''){
    $("#d_price").css("border", "2px solid red");
   }else{
    $("#d_price").css("border", "");
   }
   if($.trim(ddesc) == '' || $.trim(dprice) == ''){
    pb.clear();
        pb.error('<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> Empty Value cannot be reduced');
   }else{
   var tincome2 = $("#t_income").val();
   var dcomb = ddesc + '- Rs.'+dprice;
   tincome2 = Number(tincome2) - Number(dprice);
   var tds2 = '<tr>';
   tds2 += '<td id="ll2">'+dcomb+'</td>';
   tds2 += '<td><button type="button" name="rem2" class="btn btn-danger btn-sm remove2"><span><i class="fa fa-times-circle"></i></span></button></td>'; 
   tds2 += '</tr>';
   $("#table2").append(tds2);
   $("#d_comb").val(dcomb);
   $("#d_desc").val('');
   $("#d_price").val('');
   $("#t_income").val(tincome2);
   arr2.push(dprice);
   arr22.push(dcomb);
   $("#sal_deductions").val(arr22);
   }
  });
  $(document).on('click', '.remove2', function(){
    var tot2 = t_income.value;
    var d2 = $(this).closest('td').prev('#ll2').text();
    const originalString = d2;
    const splitString = originalString.split("- Rs.");
    var res2 = splitString[1];
    var abc2 = splitString[0].split(' of ');
   
      tot2 = Number(tot2) + Number(res2);
    arr2.splice( $.inArray(res2,arr2) ,1 );
    arr22.splice($.inArray(d2, arr22), 1);    
    $(this).closest('tr').remove(); 
    $("#t_income").val(tot2);
    $("#sal_deductions").val(arr22);
    });


  $(document).on('submit', '#form1', function(e){
    e.preventDefault();
    var a=$("#a").val();
    var b=$("#b").val();
    var c=$("#c").val();
    var d=$("#d").val();
    var e=$("#e").val();
    var f=$("#f").val();
    var avalid = false;
    var bvalid = false;
    var cvalid = false;
    var dvalid = false;
    var evalid = false;
    var fvalid = false;

    if($.trim(a) == ''){
        $("#a").css("border", "2px solid red");
        avalid = false;
    }else{
        $("#a").css("border", "");
        avalid = true;
    }
    if($.trim(b) == ''){
        $("#b").css("border", "2px solid red");
        bvalid = false;
    }else{
        $("#b").css("border", "");
        bvalid = true;
    }
    if($.trim(c) == ''){
        $("#c").css("border", "2px solid red");
        cvalid = false;
    }else{
        $("#c").css("border", "");
        cvalid = true;
    }
    if($.trim(d) == ''){
        $("#d").css("border", "2px solid red");
        dvalid = false;
    }else{
        $("#d").css("border", "");
        dvalid = true;
    }
    if($.trim(e) == ''){
        $("#e").css("border", "2px solid red");
        evalid = false;
    }else{
        $("#e").css("border", "");
        evalid = true;
    }
    if($.trim(f) == ''){
        $("#f").css("border", "2px solid red");
        fvalid = false;
    }else{
        $("#f").css("border", "");
        fvalid = true;
    }
    if((avalid && bvalid && cvalid && dvalid && evalid && fvalid) == true){
    $.ajax({
                    type: "POST",
                    url: "../other_controller/addsalarydetails.php",
                    data: new FormData(document.getElementById("form1")),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                       $("#form1")[0].reset();
                        load_data();
                        pb.clear();
                        pb.success('<i class="fa fa-check-circle fa-lg" aria-hidden="true"></i> Sheet Recorded Successfully');
                        $("#table1").html("");
                        $("#table2").html("");
                        $("#t_income").val("");
                    }
                });
            }else{
                pb.clear();
                pb.error('<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> Some Field is empty');
            }
  });

   $(document).on('click', '.delete', function(e){
    var id = $(this).attr('id');
    var data = 'id=' + id;
    e.preventDefault();
    pb.confirm(
        function (outcome) {
         if(outcome){
    $.ajax({
                    type: "GET",
                    url: "../other_controller/deletesalary.php?did="+id,
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                     load_data();
                     pb.clear();
                      pb.error('<i class="fa fa-trash fa-lg" aria-hidden="true"></i>   Deleted Successfully');
                   
                    }
                });
    
            }
        },
        '<h4 class="text text-danger">Are you sure you want to delete?</h4>',
        'Yes',
        'No'
        
    );
    
  });
 
  

</script>                  