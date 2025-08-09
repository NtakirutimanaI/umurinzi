@include('layouts.header')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register - YourApp</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #e0e2f1;
      margin: 0;
    }

    .register-container {
      display: flex;
      min-height: 100vh;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      max-width: 900px;
      margin: 3rem auto;
      border-radius: 10px;
      overflow: hidden;
      background-color: #fff;
    }

    .register-left {
      flex: 1;
      padding: 3rem 2.5rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .form-title {
      font-size: 1.75rem;
      font-weight: 700;
      color: #1f1f1f;
      margin-bottom: 0.25rem;
    }

    .form-subtitle {
      font-size: 0.95rem;
      color: #555a75;
      margin-bottom: 1.5rem;
    }

    form {
      max-width: 350px;
      width: 100%;
    }

    label {
      font-weight: 600;
      font-size: 0.9rem;
      display: block;
      margin-bottom: 6px;
      color: #4a4a4a;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    select {
      width: 100%;
      padding: 0.55rem 0.75rem;
      margin-bottom: 0.25rem;
      border: 1px solid #d1d5db;
      border-radius: 6px;
      font-size: 1rem;
      transition: border-color 0.2s ease;
    }

    input:focus, select:focus {
      border-color: #6c63ff;
      outline: none;
    }

    .phone-group {
      display: flex;
      gap: 8px;
    }

    .phone-group select,
    .phone-group input {
      flex: 1;
    }

    .password-rules {
      font-size: 0.75rem;
      color: #666;
      margin-top: -1rem;
      margin-bottom: 1rem;
    }

    .password-rules span {
      display: block;
      padding: 2px 0;
    }

    .feedback {
      font-size: 0.8rem;
      margin-bottom: 1rem;
    }

    .accepted {
      color: green;
    }

    .not-accepted {
      color: red;
    }

    button[type="submit"] {
      background-color: rgb(255, 182, 0);
      color: white;
      border: none;
      border-radius: 6px;
      padding: 0.75rem 0;
      width: 100%;
      font-weight: 700;
      font-size: 1.05rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
      background-color: #0A1128;
    }

    .divider {
      text-align: center;
      margin: 1.5rem 0;
      font-size: 0.9rem;
      color: #9ca3af;
      position: relative;
    }

    .divider::before,
    .divider::after {
      content: '';
      height: 1px;
      background-color: #d1d5db;
      position: absolute;
      top: 50%;
      width: 40%;
    }

    .divider::before {
      left: 0;
    }

    .divider::after {
      right: 0;
    }

    .google-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid #d1d5db;
      border-radius: 6px;
      padding: 0.5rem;
      cursor: pointer;
      font-weight: 600;
      color: #444;
      text-decoration: none;
      transition: background-color 0.2s ease;
    }

    .google-btn img {
      height: 20px;
      margin-right: 0.5rem;
    }

    .google-btn:hover {
      background-color: #f3f4f6;
    }

    .login-link {
      margin-top: 1.5rem;
      font-size: 0.9rem;
      color: #555a75;
      text-align: center;
    }

    .login-link a {
      color: rgb(255, 182, 0);
      font-weight: 700;
      text-decoration: none;
      margin-left: 6px;
    }

    .login-link a:hover {
      text-decoration: underline;
    }

    .register-right {
      flex: 1;
      background-image: url('{{asset('images/banner.jpeg')}}');
      background-size: cover;
      background-position: center;
    }

    @media (max-width: 768px) {
      .register-container {
        flex-direction: column;
        max-width: 100%;
        margin: 1rem;
        box-shadow: none;
        border-radius: 0;
      }

      .register-right {
        height: 250px;
      }
    }
  </style>
</head>
<body>
  <div class="register-container">
    <div class="register-left">
      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-title">Create your account</div>
        <div class="form-subtitle">Join us and get unlimited access to data &amp; information.</div>

        <label for="name">Full Name *</label>
        <input id="name" type="text" name="name" required placeholder="Enter your full name" oninput="validateField(this, /^[a-zA-Z\s]{3,}$/)" />
        <div id="name-feedback" class="feedback"></div>

        <label for="username">Username *</label>
        <input id="username" type="text" name="username" required placeholder="Choose a username" oninput="validateField(this, /^[a-zA-Z0-9_]{3,}$/)" />
        <div id="username-feedback" class="feedback"></div>

        <label for="phone">Phone Number *</label>
        <div class="phone-group">
          <select name="country_code" required>
            <option value="RW - 250" selected>RW - 250</option>
            <option value="US - 1">US - 1</option>
            <option value="KE - 254">KE - 254</option>
          </select>
          <input type="text" name="phone" placeholder="e.g. 787832490" required oninput="validateField(this, /^[0-9]{9}$/)" />
        </div>
        <div id="phone-feedback" class="feedback"></div>

        <label for="email">Email *</label>
        <input id="email" type="email" name="email" required placeholder="Enter your email address" oninput="validateEmail()" />
        <div id="email-feedback" class="feedback"></div>

        <label for="password">Password *</label>
        <input id="password" type="password" name="password" required placeholder="Enter a secure password" oninput="validatePassword()" />
        <div class="password-rules">
          <span>• At least 8 characters</span>
          <span>• At least 1 lowercase letter</span>
          <span>• At least 1 uppercase letter</span>
          <span>• At least 1 number</span>
          <span>• At least 1 special character</span>
        </div>
        <div id="password-feedback" class="feedback"></div>

        <label for="password_confirmation">Confirm Password *</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Re-enter your password" oninput="validateConfirmPassword()" />
        <div id="confirm-feedback" class="feedback"></div>

        <button type="submit">Register</button>

        <div class="divider">Or, Sign up with</div>

        <a href="{{ route('google.redirect') }}" class="google-btn">
          <img src="{{asset('images/google_img.png')}}" alt="Google Icon" />
          Sign up with Google
        </a>

        <div class="login-link">
          Already have an account?
          <a href="{{ route('login') }}">Log in here</a>
        </div>
      </form>
    </div>
    <div class="register-right"></div>
  </div>

  <script>
    const registeredEmails = ["test@example.com", "admin@domain.com", "user@site.org"]; // Simulated existing emails

    function validateField(input, regex) {
      const feedback = document.getElementById(input.id + '-feedback');
      if (regex.test(input.value)) {
        feedback.textContent = '✔ Accepted';
        feedback.className = 'feedback accepted';
      } else {
        feedback.textContent = '✖ Not Accepted';
        feedback.className = 'feedback not-accepted';
      }
    }

    function validateEmail() {
      const emailInput = document.getElementById('email');
      const feedback = document.getElementById('email-feedback');
      const value = emailInput.value.trim();
      const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (!regex.test(value)) {
        feedback.textContent = '✖ Not Accepted';
        feedback.className = 'feedback not-accepted';
      } else if (registeredEmails.includes(value.toLowerCase())) {
        feedback.textContent = '✖ Email Already Taken! Try Other Email.';
        feedback.className = 'feedback not-accepted';
      } else {
        feedback.textContent = '✔ Accepted';
        feedback.className = 'feedback accepted';
      }
    }

    function validatePassword() {
      const input = document.getElementById('password');
      const feedback = document.getElementById('password-feedback');
      const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

      if (regex.test(input.value)) {
        feedback.textContent = '✔ Accepted';
        feedback.className = 'feedback accepted';
      } else {
        feedback.textContent = '✖ Not Accepted';
        feedback.className = 'feedback not-accepted';
      }
    }

    function validateConfirmPassword() {
      const pass = document.getElementById('password').value;
      const confirm = document.getElementById('password_confirmation').value;
      const feedback = document.getElementById('confirm-feedback');

      if (confirm && pass === confirm) {
        feedback.textContent = '✔ Accepted';
        feedback.className = 'feedback accepted';
      } else {
        feedback.textContent = '✖ Not Accepted';
        feedback.className = 'feedback not-accepted';
      }
    }
  </script>
</body>
</html>

@include('layouts.footer')
