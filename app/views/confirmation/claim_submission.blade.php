@section("claim_submission")
<!-- Submit for approval confirmation -->
<div class="margin-bottom-40">
    <div class="modal fade" id="confirm_submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>Submit for approval?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-u btn-u-default" data-dismiss="modal"><i class="fa fa-thumbs-down"></i> No</button>
                    <button type="submit" name="btn_yes_submit" value="btn_yes_submit" class="btn-u"><i class="fa fa-thumbs-up"></i> Yes</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Submit for approval confirmation -->
@show
