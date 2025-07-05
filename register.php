<?php 

include('includes/header.php'); 

?> 

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Smart Career AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="register-page text-white">

    <div class="min-h-screen flex items-start justify-center p-4 pt-16 md:pt-24">
        <div class="w-full max-w-md mx-auto">
            <div class="form-container p-8 md:p-10 rounded-2xl shadow-2xl">
                <h2 class="text-3xl font-bold text-center mb-6">Create an account</h2>

                <div class="flex flex-col sm:flex-row gap-4 mb-6">
                    <button class="w-full flex items-center justify-center py-3 px-4 bg-gray-700/50 rounded-lg hover:bg-gray-600/50 transition">
                        <img src="https://www.google.com/favicon.ico" alt="Google icon" class="w-5 h-5 mr-3">
                        <span>Google</span>
                    </button>
                    <button class="w-full flex items-center justify-center py-3 px-4 bg-gray-700/50 rounded-lg hover:bg-gray-600/50 transition">
                        <i class="fab fa-facebook text-xl mr-3 text-[#1877F2]"></i>
                        <span>Facebook</span>
                    </button>
                </div>

                <div class="my-6 flex items-center">
                    <div class="flex-grow border-t border-gray-600"></div>
                    <span class="mx-4 text-sm text-gray-400">Or</span>
                    <div class="flex-grow border-t border-gray-600"></div>
                </div>

                <form action="#" method="POST">
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-3 bg-gray-800/60 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="your.email@example.com" required>
                    </div>

                    <div class="mb-6">
                         <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                            <a href="#" class="text-sm text-blue-400 hover:underline">Forgot?</a>
                        </div>
                        <div class="password-container">
                            <input type="password" id="password" name="password" class="w-full px-4 py-3 bg-gray-800/60 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your password" required>
                             <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-300">Create account</button>
                </form>

                <p class="text-center text-gray-400 mt-8">
                    Already have an account? <a href="login.php" class="text-blue-400 font-semibold hover:underline">Log in</a>
                </p>
            </div>
        </div>
    </div>

<?php 
include('includes/footer.php'); 
?>
