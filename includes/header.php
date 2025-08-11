<?php
    // Get the current page filename to apply conditional styling
    $currentPage = basename($_SERVER['PHP_SELF']);
    $isAuthPage = in_array($currentPage, ['login.php', 'register.php', 'admin-login.php', 'admin-register.php', 'forgot-password.php', 'reset-password.php']);

    // --- DYNAMIC CLASSES AND ELEMENTS START ---
    $headerClasses = 'fixed top-0 left-0 right-0 z-50 p-4 transition-all duration-300';
    $headerContainerClasses = 'container mx-auto flex justify-between items-center';
    $mobileMenuClasses = 'hidden md:hidden mt-4 rounded-lg shadow-xl';
    $mobileMenuLinkClasses = 'block px-4 py-3 transition-colors duration-300';
    
    // UPDATED: More robust logic for page type detection
    $isBlogPage = strpos($_SERVER['REQUEST_URI'], '/blogs/') !== false;
    $isAdminPage = in_array($currentPage, ['admin-login.php', 'admin-register.php']);

    if ($isAuthPage || in_array($currentPage, ['contact.php', 'faqs.php']) || $isBlogPage) {
        $headerClasses .= ' bg-white shadow-md';
        $headerContainerClasses .= ' text-gray-800';
        $mobileMenuClasses .= ' bg-white';
        $mobileMenuLinkClasses .= ' text-gray-800 hover:bg-gray-100';
    } else {
        $headerContainerClasses .= ' text-white';
        $mobileMenuClasses .= ' bg-gray-900/95 backdrop-blur-sm';
        $mobileMenuLinkClasses .= ' text-white hover:bg-gray-800';
    }
    // Determine the base path for assets and includes
    $basePath = $isBlogPage ? '../' : './';

    // Logic for the background overlay
    $overlayClass = '';
    if ($currentPage == 'register.php') {
        $overlayClass = 'register-page-overlay';
    } elseif ($currentPage == 'admin-login.php') {
        $overlayClass = 'admin-login-page-overlay';
    } elseif ($currentPage == 'admin-register.php') {
        $overlayClass = 'admin-register-page-overlay';
    }

    // Body class logic
    $bodyClasses = '';
    if ($isBlogPage) {
        $bodyClasses .= 'blog-page ';
    }
   // --- DYNAMIC CLASSES AND ELEMENTS END ---
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartCareerAI - <?php echo ucfirst(str_replace(['.php', '-'], ['', ' '], $currentPage)); ?></title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $basePath; ?>assets/css/style.css">
</head>

<body data-page="<?php echo htmlspecialchars($currentPage); ?>" class="<?php echo trim($bodyClasses); ?>"> 
    
    <?php if (!empty($overlayClass)): ?>
        <div class="page-background-overlay <?php echo $overlayClass; ?>"></div>
    <?php endif; ?>

    <div id="page-loader">
        <div class="loader-dual-ring"></div>
    </div>
    
    <?php if ($currentPage == 'home.php'): ?>
        <div id="particle-container"></div>
    <?php endif; ?>

    <header id="main-header" class="<?php echo $headerClasses; ?>">
        <div class="<?php echo $headerContainerClasses; ?>">
            <a href="<?php echo $basePath; ?>home.php" class="text-2xl font-bold flex items-center site-logo">
                <i class="fas fa-brain mr-2 text-2xl"></i>
                <span>Smart Career AI</span>
            </a>
            
            <nav class="hidden md:flex items-center space-x-6 nav-links">
                <a href="<?php echo $basePath; ?>home.php#home" class="nav-link">Home</a>
                <a href="<?php echo $basePath; ?>home.php#features" class="nav-link">Features</a>
                
                <div class="relative" id="blog-dropdown-container">
                    <button id="blog-dropdown-button" class="nav-link flex items-center <?php if ($isBlogPage) echo 'active'; ?>">
                        Blogs <i class="fas fa-chevron-down text-xs ml-1"></i>
                    </button>
                    <div id="blog-dropdown-menu" class="hidden absolute left-0 mt-2 w-56 bg-white rounded-md shadow-lg py-1 z-50 text-gray-800">
                        <a href="<?php echo $basePath; ?>blogs/web-development-mastery.php" class="block px-4 py-2 text-sm hover:bg-gray-100">Web Development</a>
                        <a href="<?php echo $basePath; ?>blogs/data-science-analytics.php" class="block px-4 py-2 text-sm hover:bg-gray-100">Data Science</a>
                        <a href="<?php echo $basePath; ?>blogs/software-engineering-principles.php" class="block px-4 py-2 text-sm hover:bg-gray-100">Software Engineering</a>
                        <a href="<?php echo $basePath; ?>blogs/project-management-pro.php" class="block px-4 py-2 text-sm hover:bg-gray-100">Project Management</a>
                        <a href="<?php echo $basePath; ?>blogs/graphic-design-fundamentals.php" class="block px-4 py-2 text-sm hover:bg-gray-100">Graphic Design</a>
                        <a href="<?php echo $basePath; ?>blogs/digital-photography.php" class="block px-4 py-2 text-sm hover:bg-gray-100">Digital Photography</a>
                    </div>
                </div>

                <a href="<?php echo $basePath; ?>faqs.php" class="nav-link <?php if($currentPage == 'faqs.php') echo 'active'; ?>">FAQs</a>
                <a href="<?php echo $basePath; ?>contact.php" class="nav-link <?php if($currentPage == 'contact.php') echo 'active'; ?>">Contact</a>
                <a href="<?php echo $basePath; ?>home.php#about" class="nav-link">About</a>
            </nav>
            
            <div class="hidden md:flex items-center space-x-2">
                <a href="<?php echo $basePath; ?>login.php" class="nav-link px-4 py-2 rounded-md <?php if($currentPage == 'login.php') echo 'active-btn'; ?>">Login</a>
                <a href="<?php echo $basePath; ?>register.php" class="bg-blue-500 px-4 py-2 rounded-md hover:bg-blue-600 transition cta-button <?php if($currentPage == 'register.php') echo 'active-btn'; ?>">Sign Up</a>
                
                <div class="relative" id="admin-dropdown-container">
                    <button id="admin-dropdown-button" class="px-4 py-2 rounded-md border border-gray-500/50 hover:bg-gray-500/20 transition <?php if ($isAdminPage) echo 'active-dropdown-btn'; ?>">
                        Admin <i class="fas fa-chevron-down text-xs ml-1"></i>
                    </button>
                    <div id="admin-dropdown-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 text-gray-800">
                        <a href="<?php echo $basePath; ?>admin-login.php" class="block px-4 py-2 text-sm hover:bg-gray-100">Admin Login</a>
                        <a href="<?php echo $basePath; ?>admin-register.php" class="block px-4 py-2 text-sm hover:bg-gray-100">Admin Register</a>
                    </div>
                </div>
            </div>
            
            <button id="mobile-menu-button" class="md:hidden text-2xl">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        
        <div id="mobile-menu" class="<?php echo $mobileMenuClasses; ?>">
             <a href="<?php echo $basePath; ?>home.php#home" class="<?php echo $mobileMenuLinkClasses; ?>">Home</a>
             <a href="<?php echo $basePath; ?>home.php#features" class="<?php echo $mobileMenuLinkClasses; ?>">Features</a>
             <a href="<?php echo $basePath; ?>faqs.php" class="<?php echo $mobileMenuLinkClasses; ?>">FAQs</a>
             <a href="<?php echo $basePath; ?>contact.php" class="<?php echo $mobileMenuLinkClasses; ?>">Contact</a>
             <a href="<?php echo $basePath; ?>home.php#about" class="<?php echo $mobileMenuLinkClasses; ?>">About</a>
             <hr class="border-gray-500/50 my-1">
             <a href="<?php echo $basePath; ?>login.php" class="<?php echo $mobileMenuLinkClasses; ?>">Login</a>
             <a href="<?php echo $basePath; ?>register.php" class="<?php echo $mobileMenuLinkClasses; ?> bg-blue-500 text-white">Sign Up</a>
             <hr class="border-gray-500/50 my-1">
             <a href="<?php echo $basePath; ?>admin-login.php" class="<?php echo $mobileMenuLinkClasses; ?>">Admin Login</a>
        </div>
    </header>