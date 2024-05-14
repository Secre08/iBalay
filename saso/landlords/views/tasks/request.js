$(document).ready(function() {
    // Initialize DataTable
    $('#bhTable').DataTable();

    // Event listener for view documents button
    $(document).on('click', '.view-documents', function() {
        const doc1 = $(this).data('doc1');
        const doc2 = $(this).data('doc2');
        $('#documentFrame').attr('src', doc1);
        $('#documentModal').modal('show');
    });

    // Event listener for confirm/decline button
    $(document).on('click', '.confirm-decline', function() {
        const bhId = $(this).data('id');
        const status = $(this).data('status');
        $('#confirmDeclineModal').modal('show');

        $('#confirmBtn').off('click').on('click', function() {
            // Update status to 2 (Confirmed)
            $.ajax({
                url: '../tasks/update_status.php',
                type: 'POST',
                data: { bh_id: bhId, status: 2 },
                success: function(response) {
                    alert(response.message);
                    $(`button[data-id=${bhId}]`).text('Confirmed').data('status', 2);
                    $('#confirmDeclineModal').modal('hide');
                }
            });
        });

        $('#declineBtn').off('click').on('click', function() {
            // Update status to 0 (Declined)
            $.ajax({
                url: '../tasks/update_status.php',
                type: 'POST',
                data: { bh_id: bhId, status: 0 },
                success: function(response) {
                    alert(response.message);
                    $(`button[data-id=${bhId}]`).text('Confirm/Decline').data('status', 0);
                    $('#confirmDeclineModal').modal('hide');
                }
            });
        });
    });
});
