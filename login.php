<?php 
include('includes/header.php'); 

?> 

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Smart Career AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Left Panel: Branding -->
        <div class="left-panel md:w-1/2 text-white p-12 flex flex-col justify-center items-start">
            <h1 class="text-3xl font-bold mb-4">Smart Career AI</h1>
            <h2 class="text-5xl font-bold mb-4">Login page</h2>
            <p class="text-xl text-blue-200">Start your journey now with us</p>
        </div>

        <!-- Right Panel: Form -->
        <div class="w-full md:w-1/2 bg-white p-8 md:p-12 flex items-center justify-center">
            <div class="w-full max-w-md">
                <h3 class="text-3xl font-bold text-gray-800 mb-6">Login to your account</h3>

                <form action="#" method="POST">
                    <!-- Email Input -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-600 mb-2">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="your.email@example.com" required>
                    </div>

                    <!-- Password Input -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                            <a href="#" class="text-sm text-blue-600 hover:underline">Forgot?</a>
                        </div>
                        <div class="password-container">
                            <input type="password" id="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your password" required>
                            <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-300">Login now</button>
                </form>

                <!-- Separator -->
                <div class="my-6 flex items-center">
                    <div class="flex-grow border-t border-gray-300"></div>
                    <span class="mx-4 text-sm text-gray-500">Or</span>
                    <div class="flex-grow border-t border-gray-300"></div>
                </div>

                <!-- Google Login -->
                <button class="w-full flex items-center justify-center py-3 px-4 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    <img src="https://www.google.com/favicon.ico" alt="Google icon" class="w-6 h-6 mr-3">
                    <span class="font-semibold text-gray-700">Continue with Google</span>
                </button>

                <!-- Sign Up Link -->
                <p class="text-center text-gray-600 mt-8">
                    Don't have an account? <a href="register.html" class="text-blue-600 font-semibold hover:underline">Sign up</a>
                </p>
            </div>
        </div>
    </div>


<?php 

include('includes/footer.php'); 

?>
