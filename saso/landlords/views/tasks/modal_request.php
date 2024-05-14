<!-- Modal for viewing documents -->
<div class="modal fade" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="documentModalLabel">Documents</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="documentFrame" width="100%" height="500px"></iframe>
            </div>
        </div>
    </div>
</div>

<!-- Modal for confirm/decline -->
<div class="modal fade" id="confirmDeclineModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeclineModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeclineModalLabel">Confirm or Decline</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to confirm or decline this BH?</p>
                <button id="confirmBtn" class="btn btn-success">Confirm</button>
                <button id="declineBtn" class="btn btn-danger">Decline</button>
            </div>
        </div>
    </div>
</div>
