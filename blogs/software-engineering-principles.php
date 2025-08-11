<?php include '../includes/header.php'; ?>

<main class="pt-20 bg-gray-100">
    <article>
        <header class="blog-header" style="background-image: url('../assets/img/software-engineering-banner-1.jpg');">
            <div class="container mx-auto px-4 py-32 text-center text-white relative z-10">
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight reveal">SOLID Foundations: Principles of Great Software Engineering</h1>
                <p class="mt-4 text-lg reveal" style="transition-delay: 150ms;">Posted on <time datetime="<?php echo date('Y-m-d'); ?>"><?php echo date('F j, Y'); ?></time></p>
            </div>
        </header>

        <div class="container mx-auto px-4 max-w-5xl -mt-16 relative z-20 mb-16">
            <div class="blog-tilt-wrapper">
                 <div class="p-8 md:p-12 blog-content text-gray-800">
                    <p class="lead reveal">
                        Writing code that works is one thing; writing code that is clean, maintainable, and scalable is the mark of a true software engineer. The principles of software engineering provide a framework for building robust and high-quality systems that stand the test of time.
                    </p>

                    <h2 class="reveal">The SOLID Principles of Object-Oriented Design</h2>
                    <p class="reveal">
                        Coined by Robert C. Martin, the SOLID principles are a cornerstone of modern software development, guiding engineers to create more understandable and flexible systems.
                    </p>
                    <ul class="reveal">
                        <li><strong>(S) Single Responsibility Principle:</strong> A class should have only one reason to change, meaning it should have only one job.</li>
                        <li><strong>(O) Open/Closed Principle:</strong> Software entities (classes, modules) should be open for extension but closed for modification.</li>
                        <li><strong>(L) Liskov Substitution Principle:</strong> Subtypes must be substitutable for their base types without altering the correctness of the program.</li>
                        <li><strong>(I) Interface Segregation Principle:</strong> Clients should not be forced to depend on interfaces they do not use.</li>
                        <li><strong>(D) Dependency Inversion Principle:</strong> High-level modules should not depend on low-level modules. Both should depend on abstractions.</li>
                    </ul>

                    <figure class="reveal">
                        <img src="../assets/img/software-engineering-2.jpg" alt="Clean, well-structured code on a monitor" class="rounded-lg shadow-lg w-full h-auto object-cover">
                        <figcaption>Applying principles like DRY (Don't Repeat Yourself) leads to cleaner codebases.</figcaption>
                    </figure>

                    <h2 class="reveal">Beyond Code: The Software Development Life Cycle (SDLC)</h2>
                    <p class="reveal">Engineering is a process. The SDLC provides a structured model for delivering high-quality software:</p>
                    <ol class="list-decimal pl-5 reveal">
                        <li class="mb-2"><strong>Requirement Analysis:</strong> Understanding what the software needs to do.</li>
                        <li class="mb-2"><strong>Design:</strong> Architecting the system's structure and components.</li>
                        <li class="mb-2"><strong>Implementation:</strong> Writing the code.</li>
                        <li class="mb-2"><strong>Testing:</strong> Verifying that the software works as intended and is free of defects.</li>
                        <li class="mb-2"><strong>Deployment:</strong> Releasing the software to users.</li>
                        <li class="mb-2"><strong>Maintenance:</strong> Supporting and updating the software after release.</li>
                    </ol>
                    <p class="reveal">
                       Adopting these principles and processes will elevate your work from simply coding to engineering sophisticated, reliable software solutions.
                    </p>
                    
                    <div class="text-center mt-8 reveal">
                        <a href="../register.php" class="btn btn-primary text-lg">Engineer Your Success</a>
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