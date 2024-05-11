<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                    <p class="text-center small">Enter your email & password to login</p>
                                </div>

                                <!-- Login Form -->
                                <form id="loginForm" class="row g-3 needs-validation" novalidate>

                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label">Email</label>
                                        <div class="input-group has-validation">
                                            <input type="email" name="email" class="form-control" id="yourEmail" required>
                                            <div class="invalid-feedback">Please enter your email address.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="yourPassword" required>
                                        <div class="invalid-feedback">Please enter your password!</div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Login</button>
                                    </div>

                                    <div class="col-12">
                                        <p class="small mb-0">Don't have an account? <a href="/iBalay/landlord/authreg/register.php">Create an account</a></p>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <!-- Message Section -->
                        <div id="loginMessage" class="text-center mt-3"></div>

                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<script>
    document.getElementById("loginForm").addEventListener("submit", function(event) {
        event.preventDefault();
        
        var formData = new FormData(this);

        fetch('login_process.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Redirect to dashboard or another page upon successful login
                window.location.replace("/dashboard.php");
            } else {
                // Update message with error feedback
                document.getElementById("loginMessage").innerHTML = '<div class="alert alert-danger" role="alert">' + data.message + '</div>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
</script>
