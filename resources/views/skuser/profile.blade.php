<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    :root {
        --primary-color: #4e73df;
        --secondary-color: #f8f9fc;
        --accent-color: #2e59d9;
        --text-color: #5a5c69;
    }

    body {
        background-color: #f8f9fc;
        font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        color: var(--text-color);
    }

    .profile-container {
        max-width: 600px;
        margin: 2rem auto;
    }

    .profile-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 2rem 0 rgba(58, 59, 69, 0.2);
    }

    .card-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
        color: white;
        padding: 1.5rem;
        text-align: center;
        border-bottom: none;
    }

    .card-header h4 {
        font-weight: 600;
        margin: 0;
        font-size: 1.5rem;
    }

    .card-body {
        padding: 2rem;
    }

    .profile-img-container {
        position: relative;
        width: fit-content;
        margin: 0 auto 1.5rem;
    }

    .profile-img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .profile-img:hover {
        transform: scale(1.05);
    }

    .profile-upload-btn {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background: var(--primary-color);
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .profile-upload-btn:hover {
        background: var(--accent-color);
        transform: scale(1.1);
    }

    .form-label {
        font-weight: 600;
        color: var(--text-color);
        margin-bottom: 0.5rem;
    }

    .form-control {
        border-radius: 0.35rem;
        padding: 0.75rem 1rem;
        border: 1px solid #d1d3e2;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }

    .btn-save {
        background: var(--primary-color);
        border: none;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        transition: all 0.3s ease;
        margin-top: 1rem;
    }

    .btn-save:hover {
        background: var(--accent-color);
        transform: translateY(-2px);
    }

    .btn-back {
        color: var(--primary-color);
        background: transparent;
        border: 1px solid var(--primary-color);
        padding: 0.5rem 1.25rem;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-top: 1.5rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-back:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-2px);
    }

    .file-input-label {
        display: block;
        text-align: center;
        margin-top: 1rem;
        color: var(--primary-color);
        cursor: pointer;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .file-input-label:hover {
        color: var(--accent-color);
        text-decoration: underline;
    }

    .success-message {
        border-left: 4px solid #1cc88a;
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="container profile-container">
    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success success-message text-center mb-4">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Profile Card -->
    <div class="card profile-card">
        <div class="card-header">
            <h4><i class="fas fa-user-edit me-2"></i>Edit Profile</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('partials.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <!-- Profile Image with Upload Button -->
                <div class="profile-img-container">
                    <img src="{{ isset($user) && $user->image ? asset('storage/profile_images/' . $user->image) : asset('images/default-avatar.png') }}"
                         class="profile-img" alt="Profile Image" id="profileImagePreview">
                    <label for="image" class="profile-upload-btn" title="Change photo">
                        <i class="fas fa-camera"></i>
                    </label>
                </div>

                <label for="image" class="file-input-label">Change Profile Picture</label>
                <input type="file" class="d-none" id="image" name="image" accept="image/*">

                <!-- Form Fields -->
                <div class="mb-4">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                           value="{{ $user->name }}" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email"
                           value="{{ $user->email }}" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-save">
                        <i class="fas fa-save me-2"></i>Save Changes
                    </button>
                </div>
                  <!-- Back Button -->
    <div class="text-center">
        <a href="{{ route('dashboard') }}" class="btn btn-back">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
    </div>
</div>
            </form>
        </div>
    </div>



<script>
    // Preview image when selected
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('profileImagePreview').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
