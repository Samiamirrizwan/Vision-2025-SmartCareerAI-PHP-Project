<?php
    // Get the current page filename to apply conditional styling
    $currentPage = basename($_SERVER['PHP_SELF']);

    // --- DYNAMIC CLASSES START ---
    // Default classes for the header element
    $headerClasses = 'absolute top-0 left-0 right-0 z-10 p-4';
    // Default classes for the main container inside the header
    $headerContainerClasses = 'container mx-auto flex justify-between items-center';

    // Check if on login or register page
    if ($currentPage == 'login.php' || $currentPage == 'register.php') {
        // Change header styling for these pages to be thinner with a white background and shadow
        $headerClasses = 'absolute top-0 left-0 right-0 z-10 py-2 px-4 bg-white shadow-md';
        
        // Ensure text inside is dark to be visible on the new white background
        $headerContainerClasses .= ' text-gray-800';
    }
    // --- DYNAMIC CLASSES END ---
?>

    <head> 
        <title>SmartCareerAI</title> 
        <link rel="stylesheet" href="./assets/css/style.css"> 
    </head> 
    <body> 
        <header class="<?php echo $headerClasses; ?>">
        <div class="<?php echo $headerContainerClasses; ?>">
            <h1 class="text-2xl font-bold">Smart Career AI</h1>
            <nav class="hidden md:flex items-center space-x-8">
                <a href="./index.php" class="hover:text-blue-400 transition">Home</a>
                <a href="./index.php#features" class="hover:text-blue-400 transition">Features</a>
                <a href="./index.php#about" class="hover:text-blue-400 transition">About</a>
            </nav>
            <div class="hidden md:flex items-center space-x-4">
                <a href="./login.php" class="px-4 py-2 rounded-md hover:bg-blue-600 transition">Login</a>
                <a href="./register.php" class="bg-blue-500 px-4 py-2 rounded-md hover:bg-blue-600 transition cta-button">Sign Up</a>
            </div>
            <button id="mobile-menu-button" class="md:hidden text-2xl">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <div id="mobile-menu" class="hidden md:hidden bg-gray-900/90 mt-4 rounded-lg">
             <a href="./index.php" class="block px-4 py-3 hover:bg-gray-800">Home</a>
             <a href="./index.php#features" class="block px-4 py-3 hover:bg-gray-800">Features</a>
             <a href="./index.php#about" class="block px-4 py-3 hover:bg-gray-800">About</a>
             <a href="./login.php" class="block px-4 py-3 hover:bg-gray-800">Login</a>
             <a href="./register.php" class="block px-4 py-3 bg-blue-500 hover:bg-blue-600">Sign Up</a>
        </div>
    </header>
