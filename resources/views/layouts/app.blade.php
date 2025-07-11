<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>HR Software</title>

  <!-- Bootstrap CSS + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>

  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
    }

    .wrapper {
      display: flex;
      height: 100vh;
      overflow: hidden;
    }

    .sidebar {
      width: 250px;
      background-color: #212529; /* Black (old navbar) */
      color: white;
      padding: 80px 20px 20px;
      transition: all 0.3s ease;
      position: relative;
      white-space: nowrap;
    }

    .sidebar.hidden {
      width: 70px;
      padding: 80px 10px 20px;
    }

    .sidebar a {
      color: #ffffff;
      text-decoration: none;
      display: flex;
      align-items: center;
      padding: 10px 15px;
      margin-bottom: 10px;
      border-radius: 5px;
      transition: background-color 0.2s ease;
    }

    .sidebar a:hover {
      background-color: #343a40;
    }

    .sidebar .link-text {
      transition: opacity 0.3s ease;
    }

    .sidebar.hidden .link-text {
      opacity: 0;
      width: 0;
      overflow: hidden;
      display: none;
    }

    .main-content {
      flex-grow: 1;
      padding-top: 100px;
      padding: 100px 20px 20px;
      overflow-y: auto;
      transition: all 0.3s ease;
    }

    .main-content.expanded {
      width: 100%;
    }

    .top-navbar {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1030;
      background-color: #343a40; /* Dark gray (old sidebar) */
      color: white;
      padding: 10px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .top-navbar img {
      height: 30px;
      margin-right: 10px;
    }

    #toggleSidebar {
      position: absolute;
      top: 50%;
      right: -15px;
      transform: translateY(-50%);
      z-index: 1050;
      border-radius: 0 6px 6px 0;
      padding: 2px 8px;
      font-weight: bold;
    }

    @media (max-width: 768px) {
      .sidebar {
        position: fixed;
        top: 56px;
        height: calc(100% - 56px);
        z-index: 1040;
      }

      .main-content {
        padding: 70px 15px 15px;
      }
    }
  </style>
</head>
<body>

  <!-- Top Navbar -->
  <div class="top-navbar">
    <div class="d-flex align-items-center">
      <img src="/images/image.png" alt="Logo" />
    </div>
    <div>
      @auth
        <span class="me-3">Welcome, {{ auth()->user()->name }} ({{ ucfirst(auth()->user()->role) }})</span>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
          @csrf
          <button class="btn btn-sm btn-danger">Logout</button>
        </form>
      @else
        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light">Login</a>
      @endauth
    </div>
  </div>

  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
      <button id="toggleSidebar" class="btn btn-outline-light">></button>

      <a href="{{ route('dashboard') }}">
        <i class="bi bi-speedometer2"></i> <span class="link-text">Dashboard</span>
      </a>

      @if(auth()->check() && auth()->user()->role === 'superadmin')
        <a href="{{ route('employee.index') }}"><i class="bi bi-people-fill"></i> <span class="link-text">Employees</span></a>
        <a href="{{ route('attendance.index') }}"><i class="bi bi-calendar-check"></i> <span class="link-text">Attendance</span></a>
        <a href="{{ route('payroll.index') }}"><i class="bi bi-cash-stack"></i> <span class="link-text">Payroll</span></a>
      @elseif(auth()->user()->role === 'hr')
        <a href="{{ route('employee.index') }}"><i class="bi bi-people-fill"></i> <span class="link-text">Employees</span></a>
        <a href="{{ route('attendance.index') }}"><i class="bi bi-calendar-check"></i> <span class="link-text">Attendance</span></a>
        <a href="{{ route('payroll.index') }}"><i class="bi bi-cash-stack"></i> <span class="link-text">Payroll</span></a>
        <a href="{{ route('certificates.index') }}"><i class="bi bi-file-earmark-text"></i> <span class="link-text">Certificates</span></a>
        <a href="{{ route('hr.requests') }}"><i class="bi bi-envelope-open"></i> <span class="link-text">Leave/Resignations</span></a>
      @elseif(auth()->user()->role === 'staff')
        <a href="{{ route('staff.certificates') }}"><i class="bi bi-file-earmark-text"></i> <span class="link-text">My Certificates</span></a>
      @endif
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
      @yield('content')
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const toggleSidebar = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');

    toggleSidebar.addEventListener('click', () => {
      sidebar.classList.toggle('hidden');
      mainContent.classList.toggle('expanded');
      toggleSidebar.innerText = sidebar.classList.contains('hidden') ? '<' : '>';
    });
  </script>

  @stack('scripts')
</body>
</html>
