<?php include '../includes/header.php'; ?>

<main class="pt-20 bg-gray-100">
    <article>
        <header class="blog-header" style="background-image: url('../assets/img/web-development-5.jpg');">
            <div class="container mx-auto px-4 py-32 text-center text-white relative z-10">
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight reveal">Web Development Mastery: From Zero to Full-Stack</h1>
                <p class="mt-4 text-lg reveal" style="transition-delay: 150ms;">Posted on <time datetime="<?php echo date('Y-m-d'); ?>"><?php echo date('F j, Y'); ?></time></p>
            </div>
        </header>

        <div class="container mx-auto px-4 max-w-5xl -mt-16 relative z-20 mb-16">
            <div class="blog-tilt-wrapper">
                 <div class="p-8 md:p-12 blog-content text-gray-800">
                    <p class="lead reveal">
                        Web development is one of the most in-demand and rewarding careers in the tech industry. It's a field that combines creativity with problem-solving, allowing you to build anything from a simple personal blog to a complex, data-driven web application. This guide will walk you through the essential steps to becoming a proficient web developer.
                    </p>

                    <h2 class="reveal">The Core Foundations: HTML, CSS, and JavaScript</h2>
                    <p class="reveal">Every web developer's journey begins with the three fundamental technologies of the web. They are the building blocks of virtually every website you visit.</p>
                    <ul class="reveal">
                        <li><strong>HTML (HyperText Markup Language):</strong> This is the skeleton of your webpage. It provides the structure and content, such as headings, paragraphs, images, and links.</li>
                        <li><strong>CSS (Cascading Style Sheets):</strong> This is the skin. CSS is used to style the HTML content, controlling everything from colors and fonts to layouts and animations.</li>
                        <li><strong>JavaScript:</strong> This is the brain. JavaScript adds interactivity and dynamic functionality to your websites, enabling features like interactive forms, dropdown menus, and real-time content updates.</li>
                    </ul>

                    <figure class="reveal">
                        <img src="../assets/img/web-development-6.jpg" alt="Clean code on a modern computer screen" class="rounded-lg shadow-lg w-full h-auto object-cover">
                        <figcaption>Mastering the front-end trio is crucial for modern web development.</figcaption>
                    </figure>

                    <h2 class="reveal">Choosing a Path: Front-End, Back-End, or Full-Stack</h2>
                    <p class="reveal">Once you have a solid grasp of the basics, you can specialize:</p>
                    <ul class="reveal">
                        <li><strong>Front-End Development:</strong> Focuses on the user-facing side of a website. Front-end developers use frameworks like React, Angular, or Vue.js to build rich, interactive user interfaces.</li>
                        <li><strong>Back-End Development:</strong> Deals with the server, database, and application logic. Back-end developers work with languages like PHP, Python, Node.js, or Java to power the website from behind the scenes.</li>
                        <li><strong>Full-Stack Development:</strong> A full-stack developer is a jack-of-all-trades who is comfortable working on both the front-end and back-end parts of an application.</li>
                    </ul>
                    <p class="reveal">No matter which path you choose, continuous learning is key. The web development landscape is always evolving, so staying curious and up-to-date with new technologies will ensure a long and successful career.</p>
                    
                    <div class="text-center mt-8 reveal">
                        <a href="../register.php" class="btn btn-primary text-lg">Start Your Journey Today</a>
                    </div>
                </div>
            </div>
        </div>
    </article>
</main>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/vanilla-tilt@1.7.2/dist/vanilla-tilt.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add 'blog-page' class to the body to enable mouse glow effect
        document.body.classList.add('blog-page');

        // Initialize Vanilla Tilt for the 3D card effect
        VanillaTilt.init(document.querySelector(".blog-tilt-wrapper"), {
            max: 5,       // Max tilt rotation (degrees)
            speed: 400,   // Speed of the enter/exit transition
            glare: true,  // If it should have a "glare" effect
            "max-glare": 0.2 // The opacity of the glare
        });
    });
</script>
<?php include '../includes/footer.php'; ?>