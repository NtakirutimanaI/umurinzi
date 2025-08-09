<!-- Hamburger Toggle Button -->
<button id="adminSidebarToggle" class="admin-sidebar-toggle-btn">
    ☰
</button>

<aside class="admin-sidebar" id="adminSidebar">
    <nav class="admin-menu">
        <a href="{{ route('mediator.index') }}" class="admin-menu-item active">
            <i class="fa fa-dashboard"></i>
            <span class="admin-label">Dashboard</span>
        </a>
        <a href="/clients" class="admin-menu-item">
            <i class="fa fa-user"></i>
            <span class="admin-label">Clients</span>
        </a>
        <a href="/meetings" class="admin-menu-item">
            <i class="fa fa-calendar-alt"></i>
            <span class="admin-label">Meetings</span>
        </a>
        <a href="/bookings" class="admin-menu-item">
            <i class="fa fa-calendar-check"></i>
            <span class="admin-label">Bookings & Services</span>
        </a>
        <a href="/notifications" class="admin-menu-item">
            <i class="fa fa-bell"></i>
            <span class="admin-label">Notifications / SMS</span>
        </a>
        <a href="/feedback" class="admin-menu-item">
            <i class="fa fa-comments"></i>
            <span class="admin-label">User Feedback</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="admin-menu-item bg-transparent border-0 text-left w-full">
                <i class="fas fa-sign-out-alt"></i>
                <span class="admin-label">Logout</span>
            </button>
        </form>
    </nav>
</aside>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Styles -->
<style>
.admin-sidebar {
    width: 80px;
    background: #0A1128;
    height: 100vh;
    position: fixed;
    display: flex;
    flex-direction: column;
    align-items: center;
    transition: width 0.3s ease;
    overflow-x: hidden;
    z-index: 1000;
    top: 80px;
    left: 0;
    height: calc(100vh - 80px);
    margin-left: 0px;
}

.admin-sidebar-toggle-btn {
    position: fixed;
    top: 100px;
    left: 90px;
    z-index: 1100;
    font-size: 26px;
    background: #0A1128;
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 5px;
    display: none;
}

.admin-sidebar:hover {
    width: 250px;
}

.admin-menu {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding-top: 20px;
}

.admin-menu-item {
    display: flex;
    align-items: center;
    width: 100%;
    padding: 10px;
    border-radius: 10px;
    color: #ffff;
    text-decoration: none;
    transition: background 0.3s, color 0.3s;
    position: relative;
    background: none;
    border: none;
}

.admin-menu-item i.fa,
.admin-menu-item i.fas {
    font-size: 18px;
    margin-left: 0px;
    color: #FFB700;
    width: 24px;
    text-align: center;
}

.admin-menu-item .admin-label {
    margin-left: 20px;
    white-space: nowrap;
    opacity: 0;
    transition: opacity 0.3s, margin-left 0.3s;
    color: #ffff;
}

.admin-sidebar:hover .admin-menu-item .admin-label {
    opacity: 1;
}

.admin-menu-item.active {
    background-color: #00c060;
    color: white;
}

.admin-menu-item.active i.fa,
.admin-menu-item.active .admin-label {
    color: white;
}

.admin-menu-item:hover {
    background: #ebe9ff;
    color: #4f46e5;
}

.admin-menu-item:hover i.fa,
.admin-menu-item:hover .admin-label {
    color: #4f46e5;
}

/* Mobile responsive sidebar */
@media (max-width: 768px) {
    .admin-sidebar {
        transform: translateX(-100%);
        width: 250px;
        transition: transform 0.3s ease;
    }

    .admin-sidebar.show {
        transform: translateX(0);
    }

    .admin-sidebar-toggle-btn {
        display: block;
    }

    .admin-sidebar:hover {
        width: 250px;
    }
}
</style>

<!-- JS Toggle Script -->
<script>
document.getElementById('adminSidebarToggle').addEventListener('click', function () {
    document.getElementById('adminSidebar').classList.toggle('show');
});
</script>
