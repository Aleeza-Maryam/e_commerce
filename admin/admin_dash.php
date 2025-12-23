<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartify - Admin Dashboard</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- External CSS -->
    <link rel="stylesheet" href="admin_dash.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="brand-section">
                <a class="nav-brand">
                    <i class="fas fa-shopping-cart"></i>
                    Cartify Admin
                </a>
            </div>
            <div class="admin-section">
                <div class="admin-info">
                    <i class="fas fa-user-tie"></i>
                    <span class="admin-greeting">Hello, Admin</span>
                </div>
                <div class="nav-links">
                    <a href="../Home/main_page.html" class="nav-link logout">
                        <i class="fas fa-arrow-right-from-bracket"></i>
                        Logout
                    </a>
                    <a href="#" class="nav-link user-panel">
                        <i class="fas fa-users"></i>
                        User Panel
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Dashboard -->
    <div class="main-container">
        <header class="dashboard-header">
            <h1>Cartify Dashboard</h1>
            <p class="dashboard-subtitle">Manage your online store efficiently</p>
        </header>

        <!-- Dashboard Options -->
        <div class="dashboard-options">
            <a href="add_post.php" class="option-card create-post">
                <div class="option-icon">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <h3 class="option-title">Create Product</h3>
                <p class="option-description">Add new products to your store</p>
                <span class="option-link">Add New →</span>
            </a>

            <a href="update_products.html" class="option-card update-post">
                <div class="option-icon">
                    <i class="fas fa-edit"></i>
                </div>
                <h3 class="option-title">Update Product</h3>
                <p class="option-description">Edit product details and pricing</p>
                <span class="option-link">Edit Items →</span>
            </a>

            <a href="view_products.php" class="option-card see-posts">

                <div class="option-icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <h3 class="option-title">View Products</h3>
                <p class="option-description">See all products in your inventory</p>
                <span class="option-link">View All →</span>
            </a>

            <a href="delete_products.html" class="option-card delete-post">
                <div class="option-icon">
                    <i class="fas fa-trash-alt"></i>
                </div>
                <h3 class="option-title">Remove Product</h3>
                <p class="option-description">Delete products from your store</p>
                <span class="option-link">Manage →</span>
            </a>
        </div>

        <!-- Additional E-commerce Options -->
        <div class="dashboard-options secondary-options">
            <a href="#" class="option-card manage-orders">
                <div class="option-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <h3 class="option-title">Manage Orders</h3>
                <p class="option-description">View and process customer orders</p>
                <span class="option-link">View Orders →</span>
            </a>

            <a href="#" class="option-card manage-users">
                <div class="option-icon">
                    <i class="fas fa-user-cog"></i>
                </div>
                <h3 class="option-title">Manage Users</h3>
                <p class="option-description">Administer customer accounts</p>
                <span class="option-link">View Users →</span>
            </a>

            <a href="#" class="option-card analytics">
                <div class="option-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="option-title">Analytics</h3>
                <p class="option-description">Sales data and store statistics</p>
                <span class="option-link">View Reports →</span>
            </a>

            <a href="#" class="option-card settings">
                <div class="option-icon">
                    <i class="fas fa-cog"></i>
                </div>
                <h3 class="option-title">Settings</h3>
                <p class="option-description">Store configuration and settings</p>
                <span class="option-link">Configure →</span>
            </a>
        </div>

        <!-- Quick Stats Section -->
        <div class="stats-section">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <h4>Total Products</h4>
                <p class="stat-number">156</p>
                <p class="stat-change"><i class="fas fa-arrow-up"></i> 12 this week</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <h4>Total Orders</h4>
                <p class="stat-number">342</p>
                <p class="stat-change"><i class="fas fa-arrow-up"></i> 24 today</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h4>Active Users</h4>
                <p class="stat-number">1,284</p>
                <p class="stat-change"><i class="fas fa-arrow-up"></i> 48 today</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <h4>Revenue</h4>
                <p class="stat-number">$12,480</p>
                <p class="stat-change"><i class="fas fa-arrow-up"></i> $1,240 today</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>Cartify E-commerce Admin Dashboard &copy; 2023 | Store Management System</p>
        <p class="footer-links">
            <a href="#">Privacy Policy</a> | 
            <a href="#">Terms of Service</a> | 
            <a href="#">Support</a>
        </p>
    </footer>
</body>
</html>

<!-- 
http://localhost/myproject/index.php -->
