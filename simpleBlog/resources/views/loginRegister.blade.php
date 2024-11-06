<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login/Register</title>
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
      </div>
      <div class="form-group">
        <label for="loginPassword">Password</label>
        <input type="password" id="loginPassword" name="password">
      </div>
      <button type="submit">Login</button>
    </form>

    <!-- Register Form -->
    <h2 id="registerTitle" class="hidden">Register</h2>
    <form id="registerForm" class="hidden" action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="registerName">Name</label>
            <input type="text" id="registerName" name="name" required>
        </div>
        <div class="form-group">
            <label for="registerEmail">Email</label>
            <input type="email" id="registerEmail" name="email" required>
        </div>
        <div class="form-group">
            <label for="registerPassword">Password</label>
            <input type="password" id="registerPassword" name="password" required>
        </div>
        <button type="submit">Register</button>
    </form>


    <!-- Toggle Link -->
    <a href="#" class="toggle-link" id="toggleFormLink">Register instead</a>
  </div>

  <script>
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const loginTitle = document.getElementById('loginTitle');
    const registerTitle = document.getElementById('registerTitle');
    const toggleFormLink = document.getElementById('toggleFormLink');
    let isLoginForm = true;

    toggleFormLink.addEventListener('click', (e) => {

      isLoginForm = !isLoginForm;
      toggleForms();
    });

    function toggleForms() {
      if (isLoginForm) {
        loginForm.classList.remove('hidden');
        registerForm.classList.add('hidden');
        loginTitle.classList.remove('hidden');
        registerTitle.classList.add('hidden');
        toggleFormLink.textContent = 'Register instead';
      } else {
        loginForm.classList.add('hidden');
        registerForm.classList.remove('hidden');
        loginTitle.classList.add('hidden');
        registerTitle.classList.remove('hidden');
        toggleFormLink.textContent = 'Login instead';
      }
    }

    loginForm.addEventListener('submit', (e) => {

      const email = document.getElementById('loginEmail').value;
      const password = document.getElementById('loginPassword').value;

      console.log('Login - Email:', email);
      console.log('Login - Password:', password);
    });

    registerForm.addEventListener('submit', (e) => {

      const name = document.getElementById('registerName').value;
      const email = document.getElementById('registerEmail').value;
      const password = document.getElementById('registerPassword').value;

      console.log('Register - Name:', name);
      console.log('Register - Email:', email);
      console.log('Register - Password:', password);
    });
  </script>
</body>
</html>
