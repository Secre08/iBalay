document.addEventListener('DOMContentLoaded', function () {
    var actionModals = document.querySelectorAll('[data-bs-target="#actionModal"]');
    actionModals.forEach(function (modal) {
        modal.addEventListener('click', function () {
            var landlordDetails = JSON.parse(modal.getAttribute('data-action-details'));
            var modalBody = document.getElementById('landlordDetails');
            modalBody.innerHTML = `
                <p><strong>First Name:</strong> ${landlordDetails.first_name}</p>
                <p><strong>Last Name:</strong> ${landlordDetails.last_name}</p>
                <p><strong>Email:</strong> ${landlordDetails.email}</p>
                <p><strong>Phone Number:</strong> ${landlordDetails.phone_number}</p>
                <p><strong>Address:</strong> ${landlordDetails.address}</p>
            `;
        });
    });
});