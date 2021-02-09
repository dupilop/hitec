<div id="reloadentry">

</div>
<script type="text/javascript">
loadentry();
function loadentry()
    {
      $.ajax({
        url:"../other_controller/reloademiloanentry.php",
        method:"POST",
        data: {},
        success:function(data)
        {
          $('#reloadentry').html(data);
          
        }
      });
    }

  $(document).on("click", ".submitloanentry", function(e){
    e.preventDefault();
    // alert($(this).parent().parent().html());
    var title = $(this).parent().parent().find(".title").val();
    
    var amount = $(this).parent().parent().find(".amount").val();
    var dpayment = $(this).parent().parent().find(".dpayment").val();
    var l_c_id = $(this).parent().parent().find(".l_c_id").val();
    var tvalidation = false;
    var avalidation = false;
    var dvalidation = false;
    if($.trim(title) == ''){ 
        $(".titleerror").html("<p class='text text-danger'>Title is empty</p>"); 
    }else{
        $(".titleerror").html("<p class='text text-success'></p>");
        tvalidation = true;
    }
    if($.trim(amount) == ''){ 
        $(".amounterror").html("<p class='text text-danger'>Amount is empty</p>"); 
    }else{
        $(".amounterror").html("<p class='text text-success'></p>");
        avalidation = true;
    }
    if($.trim(dpayment) == ''){ 
        $(".dpaymenterror").html("<p class='text text-danger'>Amount is empty</p>"); 
    }else{
        $(".dpaymenterror").html("<p class='text text-success'></p>");
        dvalidation = true;
    }
    if(tvalidation == true && avalidation == true && dvalidation == true){
      $.ajax({
        type: "POST",
        url: "../other_controller/emiloanentry_controller.php",
        data: {l_title: title, l_amount: amount, l_down_payment: dpayment, l_c_id: l_c_id, action: 'addloan'},
        success: function(data) {
          loadentry();
          pb.clear();
          pb.success('<i class="fa fa-check-circle fa-lg" aria-hidden="true"></i> Loan Added Successfully');
        }
      });
    }else{
      alert("Some field is empty");
    }
  });
</script>

