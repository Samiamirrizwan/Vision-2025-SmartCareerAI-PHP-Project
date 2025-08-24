<?php include 'includes/header.php'; ?>


<link rel="stylesheet" href="<?php echo $basePath; ?>assets/css/contact.css">
<script src="assets/js/contact.js"></script>

<main class="contact-page-main">
    <div class="container mx-auto px-4 py-16 md:py-24">
        
        <div class="max-w-4xl mx-auto text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-4">Get In Touch</h1>
            <p class="text-lg text-gray-600">We're here to help and answer any question you might have. We look forward to hearing from you! 👋</p>
        </div>

        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden md:grid md:grid-cols-12">
            
            <div class="contact-info-panel col-span-5 p-8 md:p-12 text-white">
                <h2 class="text-2xl font-bold mb-4">Contact Information</h2>
                <p class="mb-8">Fill up the form and our team will get back to you within 24 hours.</p>
                
                <div class="space-y-6">
                    <div class="flex items-center">
                        <i class="fas fa-phone fa-lg mr-4 p-3 bg-white/20 rounded-full"></i>
                        <span>+92 (0304) 189-2255</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-envelope fa-lg mr-4 p-3 bg-white/20 rounded-full"></i>
                        <span>contact@smartcareerai.com</span>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-map-marker-alt fa-lg mr-4 p-3 bg-white/20 rounded-full"></i>
                        <span>Pakistan, Karachi, Gulshan-E-Iqbal</span>
                    </div>
                </div>

                <div class="mt-10 pt-8 border-t border-white/20 flex space-x-4">
                     <a href="#" class="text-2xl hover:text-blue-300 transition"><i class="fab fa-facebook"></i></a>
                     <a href="#" class="text-2xl hover:text-blue-300 transition"><i class="fa-brands fa-x-twitter"></i></a>
                     <a href="#" class="text-2xl hover:text-purple-300 transition"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <div class="col-span-7 p-8 md:p-12">
                <form id="contact-form" novalidate>
                    <div id="form-response" class="hidden mb-4 p-4 rounded-md text-sm"></div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="name" class="font-semibold text-gray-700 block mb-2">Full Name</label>
                            <input type="text" id="name" name="name" class="form-input w-full" placeholder="John Doe" required>
                        </div>
                        <div>
                            <label for="email" class="font-semibold text-gray-700 block mb-2">Email Address</label>
                            <input type="email" id="email" name="email" class="form-input w-full" placeholder="hello@example.com" required>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="subject" class="font-semibold text-gray-700 block mb-2">Subject</label>
                        <input type="text" id="subject" name="subject" class="form-input w-full" placeholder="Inquiry about pricing" required>
                    </div>

                    <div class="mb-6">
                         <label for="message" class="font-semibold text-gray-700 block mb-2">Message</label>
                         <textarea id="message" name="message" rows="5" class="form-input w-full" placeholder="Your message here..." required></textarea>
                    </div>

                    <div>
                        <button type="submit" id="submit-button" class="btn-primary w-full flex items-center justify-center text-lg py-3">
                            <span class="btn-text">Send Message</span>
                            <span class="loader hidden"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>