<?php include 'includes/header.php'; ?>


<link rel="stylesheet" href="<?php echo $basePath; ?>assets/css/faqs.css">
<script src="assets/js/faqs.js"></script>

<main class="faqs-page-main">
    <div class="container mx-auto px-4 py-16 md:py-24">
        
        <div class="max-w-3xl mx-auto text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-4">Frequently Asked Questions</h1>
            <p class="text-lg text-gray-600">Find answers to common questions about SmartCareerAI, our features, and how to get started.</p>
        </div>

        <div class="max-w-3xl mx-auto">
            <div class="space-y-4" id="faq-accordion">
                <div class="faq-item bg-white border border-gray-200 rounded-lg overflow-hidden">
                    <button class="faq-question w-full flex justify-between items-center text-left p-5 font-semibold text-gray-700 hover:bg-gray-50 focus:outline-none">
                        <span>What is SmartCareerAI?</span>
                        <i class="fas fa-chevron-down transform transition-transform"></i>
                    </button>
                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <p class="p-5 border-t border-gray-200 text-gray-600">
                            SmartCareerAI is an artificial intelligence-powered web application designed to provide personalized career counseling. It helps users by offering AI-driven resume building, personalized job matching based on skills and personality, and interview preparation tools.
                        </p>
                    </div>
                </div>

                <div class="faq-item bg-white border border-gray-200 rounded-lg overflow-hidden">
                    <button class="faq-question w-full flex justify-between items-center text-left p-5 font-semibold text-gray-700 hover:bg-gray-50 focus:outline-none">
                        <span>How does the AI career suggester work?</span>
                        <i class="fas fa-chevron-down transform transition-transform"></i>
                    </button>
                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <p class="p-5 border-t border-gray-200 text-gray-600">
                            Our AI suggester uses advanced natural language processing (NLP) models. You can input your personality type (like from a Myers-Briggs test), key interests (e.g., "Artistic," "Social"), or skills, and the AI will analyze this input to generate a list of suitable career paths, complete with descriptions and potential roles.
                        </p>
                    </div>
                </div>

                <div class="faq-item bg-white border border-gray-200 rounded-lg overflow-hidden">
                    <button class="faq-question w-full flex justify-between items-center text-left p-5 font-semibold text-gray-700 hover:bg-gray-50 focus:outline-none">
                        <span>Is my data safe and private?</span>
                        <i class="fas fa-chevron-down transform transition-transform"></i>
                    </button>
                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <p class="p-5 border-t border-gray-200 text-gray-600">
                            Absolutely. We prioritize your privacy and data security. All personal information and user data are encrypted and stored securely. We do not share your data with third parties without your explicit consent. Please refer to our Privacy Policy for more details.
                        </p>
                    </div>
                </div>

                <div class="faq-item bg-white border border-gray-200 rounded-lg overflow-hidden">
                    <button class="faq-question w-full flex justify-between items-center text-left p-5 font-semibold text-gray-700 hover:bg-gray-50 focus:outline-none">
                        <span>What is the cost of using SmartCareerAI?</span>
                        <i class="fas fa-chevron-down transform transition-transform"></i>
                    </button>
                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <p class="p-5 border-t border-gray-200 text-gray-600">
                           SmartCareerAI operates on a freemium model. You can get started for free with access to basic features like the AI career suggester. Our premium plans unlock advanced features such as in-depth resume analysis, unlimited interview practice sessions, and direct mentor connections.
                        </p>
                    </div>
                </div>
                
                 <div class="faq-item bg-white border border-gray-200 rounded-lg overflow-hidden">
                    <button class="faq-question w-full flex justify-between items-center text-left p-5 font-semibold text-gray-700 hover:bg-gray-50 focus:outline-none">
                        <span>Who are the mentors I can connect with?</span>
                        <i class="fas fa-chevron-down transform transition-transform"></i>
                    </button>
                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <p class="p-5 border-t border-gray-200 text-gray-600">
                          Our mentor network consists of experienced professionals and industry experts from a wide range of fields. They are vetted by our team to ensure they can provide valuable, real-world advice and guidance to our users. This feature is available in our premium subscription.
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</main>

<?php include 'includes/footer.php'; ?>