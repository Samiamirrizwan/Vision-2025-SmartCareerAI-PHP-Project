<?php
    // Get the current page filename to apply conditional styling
    $currentPage = basename($_SERVER['PHP_SELF']);
    $isAuthPage = in_array($currentPage, ['login.php', 'register.php', 'admin-login.php', 'admin-register.php', 'forgot-password.php', 'reset-password.php']);

    // --- DYNAMIC CLASSES START ---
    $headerClasses = 'fixed top-0 left-0 right-0 z-50 p-4 transition-all duration-300';
    $headerContainerClasses = 'container mx-auto flex justify-between items-center';
    $mobileMenuClasses = 'hidden md:hidden mt-4 rounded-lg shadow-xl';
    $mobileMenuLinkClasses = 'block px-4 py-3 transition-colors duration-300';

    if ($currentPage == 'login.php' || $currentPage == 'register.php' || $currentPage == 'admin-login.php' || $currentPage == 'admin-register.php') {
        $headerClasses .= ' bg-white shadow-md';
        $headerContainerClasses .= ' text-gray-800';
        $mobileMenuClasses .= ' bg-white';
        $mobileMenuLinkClasses .= ' text-gray-800 hover:bg-gray-100';
    } else {
        $headerContainerClasses .= ' text-white';
        $mobileMenuClasses .= ' bg-gray-900/95 backdrop-blur-sm';
        $mobileMenuLinkClasses .= ' text-white hover:bg-gray-800';
    }
    // --- DYNAMIC CLASSES END ---
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartCareerAI - <?php echo ucfirst(str_replace('.php', '', $currentPage)); ?></title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body data-page="<?php echo htmlspecialchars($currentPage); ?>"> 
    <div id="particle-container"></div>

    <header id="main-header" class="<?php echo $headerClasses; ?>">
        <div class="<?php echo $headerContainerClasses; ?>">
            <h1 class="text-2xl font-bold">Smart Career AI</h1>
            
            <nav class="hidden md:flex items-center space-x-8 nav-links">
                <a href="./home.php#home" data-section="home" class="nav-link <?php if($currentPage == 'home.php') echo 'active'; ?>">Home</a>
                <a href="./home.php#features" data-section="features" class="nav-link">Features</a>
                <a href="./home.php#about" data-section="about" class="nav-link">About</a>
            </nav>
            
            <div class="hidden md:flex items-center space-x-2">
                <a href="./login.php" class="nav-link px-4 py-2 rounded-md <?php if($currentPage == 'login.php') echo 'active-btn'; ?>">Login</a>
                <a href="./register.php" class="bg-blue-500 px-4 py-2 rounded-md hover:bg-blue-600 transition cta-button <?php if($currentPage == 'register.php') echo 'active-btn'; ?>">Sign Up</a>
                
                <!-- Admin Dropdown -->
                <div class="relative" id="admin-dropdown-container">
                    <button id="admin-dropdown-button" class="px-4 py-2 rounded-md border border-gray-500/50 hover:bg-gray-500/20 transition">
                        Admin <i class="fas fa-chevron-down text-xs ml-1"></i>
                    </button>
                    <div id="admin-dropdown-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 text-gray-800">
                        <a href="admin-login.php" class="block px-4 py-2 text-sm hover:bg-gray-100">Admin Login</a>
                        <a href="admin-register.php" class="block px-4 py-2 text-sm hover:bg-gray-100">Admin Register</a>
                    </div>
                </div>
            </div>
            
            <button id="mobile-menu-button" class="md:hidden text-2xl">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        
        <div id="mobile-menu" class="<?php echo $mobileMenuClasses; ?>">
             <a href="./home.php#home" data-section="home" class="<?php echo $mobileMenuLinkClasses; ?> <?php if($currentPage == 'home.php') echo 'active'; ?>">Home</a>
             <a href="./home.php#features" data-section="features" class="<?php echo $mobileMenuLinkClasses; ?>">Features</a>
             <a href="./home.php#about" data-section="about" class="<?php echo $mobileMenuLinkClasses; ?>">About</a>
             <hr class="border-gray-500/50 my-1">
             <a href="./login.php" class="<?php echo $mobileMenuLinkClasses; ?> <?php if($currentPage == 'login.php') echo 'active'; ?>">Login</a>
             <a href="./register.php" class="<?php echo $mobileMenuLinkClasses; ?> bg-blue-500 text-white <?php if($currentPage == 'register.php') echo 'active'; ?>">Sign Up</a>
             <hr class="border-gray-500/50 my-1">
             <a href="./admin-login.php" class="<?php echo $mobileMenuLinkClasses; ?>">Admin Login</a>
        </div>
    </header>
