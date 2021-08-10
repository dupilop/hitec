<form class="" id="form1" action="" method="post" novalidate>
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel2">Loan Update</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">

        <div class="field item form-group">
            <label class="col-form-label col-md-4 col-sm-3  label-align">Description<span class="required">*</span></label>
            <div class="col-md-6 col-sm-6">

                <input class="form-control title" type="text" name="l_title" value="<?php echo $abc2['l_title'] ?>" />
            </div>
            <div class="titleerror"></div>
        </div>

        <div class="field item form-group">
            <label class="col-form-label col-md-4 col-sm-3  label-align">Loan Date</label>
            <div class="col-md-6 col-sm-6">
                <input class="form-control lupdatetime" name="l_upload_date_time" type="datetime-local" value="<?php echo $abc2['l_upload_date_time'] ?>" />
            </div>
            <div class="ldatetimeerror"></div>
        </div>

        <div class="modal-footer">
            <input type="hidden" name="l_id" value="<?php echo $abc2['l_id'] ?>">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success submitloanentry" name="update">Apply</button>
        </div>
</form>