<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Dashboard')</title> <!-- Dynamic title -->
    
    <!-- External CSS -->
    @vite(['resources/css/app.css', 'resources/css/style.css'])

    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
    <link rel="stylesheet" href="{{ asset('resources/css/alert.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('styles') 
  </head>
  <body>
   

    <div class="main">
      <!-- Header -->
      <div class="header">
        <header>
          <div class="logo">
            <img src="{{ asset('images/eattendance-logo.png') }}" alt="Logo" class="small-logo" />
          </div>
        </header>
      </div>

      <!-- Menu and Dashboard Body -->
      <div class="menuBody">
        <!-- Menu -->
        <div class="menu">
          <div class="sidebar">
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}"
              ><i class="fas fa-home"></i> Dashboard</a
            >
            <br />
            <div class="section">
              <h3>MANAGEMENT</h3>
              <a href="{{ url('/students') }}" class="{{ request()->is('students') ? 'active' : '' }}"
                ><i class="fas fa-user-graduate"></i> Students</a
              >
              <a href="{{ url('/faculty') }}" class="{{ request()->is('faculty') ? 'active' : '' }}"
                ><i class="fas fa-chalkboard-teacher"></i> Faculty</a
              >
              <a href="{{ url('/shift') }}" class="{{ request()->is('shift') ? 'active' : '' }}"
                ><i class="fas fa-calendar-day"></i> Shift</a
              >
            </div>
            <div class="section">
              <h3>ANALYZES</h3>
              <a href="{{ url('/attendance') }}" class="{{ request()->is('attendance') ? 'active' : '' }}"
                ><i class="fas fa-chart-line"></i> Attendance</a
              >
            </div>
            <div class="footer">
              <a href="{{ url('/devicesettings') }}" class="{{ request()->is('devicesettings') ? 'active' : '' }}"
                ><i class="fas fa-cogs"></i> Device Settings</a
              >
              <a href="{{ url('/logout') }}" class="{{ request()->is('logout') ? 'active' : '' }}"
                ><i class="fas fa-sign-out-alt"></i> Logout</a
              >
            </div>
          </div>
        </div>

        <!-- Dashboard Body -->
        <div class="dashboardBody">
          <!-- Content that changes -->
          @yield('content')
        </div>
      </div>
    </div>

    <!-- JavaScript -->
    <script>
      // Function to highlight the selected menu item
      const menuItems = document.querySelectorAll(".sidebar a");

      menuItems.forEach((item) => {
        item.addEventListener("click", function () {
          // Remove active class from all menu items
          menuItems.forEach((el) => el.classList.remove("active"));

          // Add active class to the clicked item
          this.classList.add("active");
        });
      });
    </script>

    @yield('scripts') 
  </body>
</html>
