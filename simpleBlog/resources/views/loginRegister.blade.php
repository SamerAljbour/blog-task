<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login/Register</title>
  <!-- SweetAlert2 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    .form-container {
      max-width: 400px;
      margin: 0 auto;
      padding: 2rem;
      background-color: #f4f4f4;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 0.5rem;
    }

    input {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      display: block;
      width: 100%;
      padding: 0.75rem;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }

    .toggle-link {
      display: block;
      text-align: center;
      margin-top: 1rem;
      color: #007bff;
      text-decoration: none;
    }

    .toggle-link:hover {
      color: #0056b3;
    }

    .hidden {
      display: none;
    }

    .error-message {
      color: red;
      font-size: 0.875rem;
      margin-top: 0.5rem;
    }
  </style>
</head>
<body>
  <div class="form-container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Login Form -->
    <h2 id="loginTitle">Login</h2>
    <form id="loginForm" method="POST" action="{{ route('login') }}">
        @csrf
      <div class="form-group">
        <label for="loginEmail">Email</label>
        <input type="email" id="loginEmail" name="email">
        <div id="loginEmailError" class="error-message"></div> <!-- Error message for email -->
      </div>
      <div class="form-group">
        <label for="loginPassword">Password</label>
        <input type="password" id="loginPassword" name="password">
        <div id="loginPasswordError" class="error-message"></div> <!-- Error message for password -->
      </div>
      <button type="submit">Login</button>
    </form>

    <!-- Register Form -->
    <h2 id="registerTitle" class="hidden">Register</h2>
    <form id="registerForm" class="hidden" action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="registerName">Name</label>
            <input type="text" id="registerName" name="name">
            <div id="registerNameError" class="error-message"></div> <!-- Error message for name -->
        </div>
        <div class="form-group">
            <label for="registerEmail">Email</label>
            <input type="email" id="registerEmail" name="email">
            <div id="registerEmailError" class="error-message"></div> <!-- Error message for email -->
        </div>
        <div class="form-group">
            <label for="registerPassword">Password</label>
            <input type="password" id="registerPassword" name="password">
            <div id="registerPasswordError" class="error-message"></div> <!-- Error message for password -->
        </div>
        <button type="submit">Register</button>
    </form>

    <!-- Toggle Link -->
    <a href="#" class="toggle-link" id="toggleFormLink">Register instead</a>
  </div>

  <!-- Include jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  @if(session('success'))
  <script>
      Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: '{{ session('success') }}',
          showConfirmButton: true,
      });
  </script>
  @endif

  @if(session('error'))
  <script>
      Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: '{{ session('error') }}',
          showConfirmButton: true
      });
  </script>
  @endif

  <script>
    const loginForm = $('#loginForm');
    const registerForm = $('#registerForm');
    const loginTitle = $('#loginTitle');
    const registerTitle = $('#registerTitle');
    const toggleFormLink = $('#toggleFormLink');
    let isLoginForm = true;

    toggleFormLink.click((e) => {
      e.preventDefault();
      isLoginForm = !isLoginForm;
      toggleForms();
    });

    function toggleForms() {
      if (isLoginForm) {
        loginForm.removeClass('hidden');
        registerForm.addClass('hidden');
        loginTitle.removeClass('hidden');
        registerTitle.addClass('hidden');
        toggleFormLink.text('Register instead');
      } else {
        loginForm.addClass('hidden');
        registerForm.removeClass('hidden');
        loginTitle.addClass('hidden');
        registerTitle.removeClass('hidden');
        toggleFormLink.text('Login instead');
      }
    }

    // Regex for Email and Password validation
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    function validateLoginForm() {
      let valid = true;

      // Clear previous errors
      $('.error-message').text('');

      const email = $('#loginEmail').val();
      const password = $('#loginPassword').val();

      // Email validation
      if (!email) {
        $('#loginEmailError').text('Email is required');
        valid = false;
      } else if (!emailRegex.test(email)) {
        $('#loginEmailError').text('Please enter a valid email address');
        valid = false;
      }

      // Password validation
      if (!password) {
        $('#loginPasswordError').text('Password is required');
        valid = false;
      } else if (!passwordRegex.test(password)) {
        $('#loginPasswordError').text('Password must be at least 8 characters long, include uppercase, lowercase, a number, and a special character');
        valid = false;
      }

      return valid;
    }

    function validateRegisterForm() {
      let valid = true;

      // Clear previous errors
      $('.error-message').text('');

      const name = $('#registerName').val();
      const email = $('#registerEmail').val();
      const password = $('#registerPassword').val();

      // Name validation
      if (!name) {
        $('#registerNameError').text('Name is required');
        valid = false;
      }

      // Email validation
      if (!email) {
        $('#registerEmailError').text('Email is required');
        valid = false;
      } else if (!emailRegex.test(email)) {
        $('#registerEmailError').text('Please enter a valid email address');
        valid = false;
      }

      // Password validation
      if (!password) {
        $('#registerPasswordError').text('Password is required');
        valid = false;
      } else if (!passwordRegex.test(password)) {
        $('#registerPasswordError').text('Password must be at least 8 characters long, include uppercase, lowercase, a number, and a special character');
        valid = false;
      }

      return valid;
    }

    // Handle Login Form Validation
    loginForm.submit(function (e) {
      e.preventDefault();

      if (validateLoginForm()) {
        this.submit(); // Submit form if valid
      }
    });

    // Handle Register Form Validation
    registerForm.submit(function (e) {
      e.preventDefault();

      if (validateRegisterForm()) {
        this.submit(); // Submit form if valid
      }
    });
  </script>
</body>
</html>
