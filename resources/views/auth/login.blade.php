<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Seamless Attendance Tracking</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        /* Your existing CSS styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body,
        html {
            height: 100%;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f0f2f5;
        }
        .container {
            display: flex;
            width: 85%;
            height: 85%;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .left-section,
        .right-section {
            flex: 1;
            padding: 40px;
        }
        .left-section {
            background-color: #316cec;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .left-section h1 {
            font-size: 2rem;
            margin-bottom: 10px;
            text-align: center;
            line-height: 1.2;
        }
        .left-section h1 span {
            display: block;
        }
        .left-section p {
            font-size: 0.875rem;
            margin-top: 10px;
            opacity: 0.8;
            text-align: center;
        }
        .left-section img {
            width: 80%;
            margin-top: 20px;
        }
        .right-section {
            background-color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .right-section img {
            width: 320px;
            margin-bottom: 20px;
        }
        .right-section h2 {
            margin-left: 15px;
            margin-bottom: 20px;
            color: black;
            text-align: left;
            width: 100%;
        }
        form {
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label {
            margin-bottom: 8px;
            color: black;
            text-align: left;
            width: 100%;
        }
        .password-container {
            position: relative;
            width: 100%;
            display: flex;
            align-content: center; /* Vertically centers the content */
        }
        input {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
            width: 100%;
        }
        input:focus {
            border-color: #316cec;
        }
        .eye-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-90%);
            cursor: pointer;
            color: #999;
        }
        .login-btn {
            background-color: #316cec;
            color: white;
            font-weight: bold;
            padding: 8px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .login-btn:hover {
            background-color: #204ba9;
        }
        .additional-text {
            margin-top: 10px;
            font-size: 0.875rem;
            text-align: center;
            color: #333;
        }
        .additional-text p {
            color: white;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-section">
            <h1>
                <span>Seamless and</span>
                <span>Secure Attendance</span>
                <span>Tracking</span>
            </h1>
            <p>Automate Attendance with NFC Technology</p>
            <img src="{{ asset('images/loginpage.png') }}" alt="Logo" class="small-logo" />
            <div class="additional-text">
                <p>Enhance efficiency with modern tools.</p>
                <p>Track attendance with just a tap.</p>
            </div>
        </div>
        <div class="right-section">
            <img src="{{ asset('images/eattendance-logo.png') }}" alt="Logo" class="small-logo" />
            <h2>Welcome,</h2>
            <form id="loginForm" action="{{ route('admin.login') }}" method="post">
                @csrf
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required />

                <label for="password">Password</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" required />
                    <i class="eye-icon fas fa-eye" id="togglePassword"></i>
                </div>
                @if ($errors->has('login_error'))
                <div style="color: red; margin-bottom: 20px;">
                    {{ $errors->first('login_error') }}
                </div>
                @endif
                <button type="submit" class="login-btn">Sign in</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {

        $('#username').val('');
        $('#password').val('');
          $('#togglePassword').on('click', function() {
              const passwordInput = $('#password');
              const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
              passwordInput.attr('type', type);
              $(this).toggleClass('fa-eye fa-eye-slash');
          });

          $('#loginForm').on('submit', function(event) {
              event.preventDefault(); // Prevent the default form submission

              // Use AJAX to submit the form
              $.ajax({
                  url: $(this).attr('action'), // Use the form's action URL
                  type: 'POST',
                  data: $(this).serialize(), // Serialize the form data
                  success: function(response) {
                      // Clear the input fields upon successful login
                      $('#username').val('');
                      $('#password').val('');

                      // Redirect or do something else after successful login
                      window.location.href = '/'; // Change to your intended route
                  },
                  error: function(xhr, status, error) {
                      // Handle login errors (e.g., show an error message)
                      if (xhr.responseJSON && xhr.responseJSON.message) {
                          $('.error-message').text(xhr.responseJSON.message);
                      } else {
                          $('.error-message').text('An error occurred. Please try again.');
                      }
                  }
              });
          });
      });
  </script>
</body>
</html>
