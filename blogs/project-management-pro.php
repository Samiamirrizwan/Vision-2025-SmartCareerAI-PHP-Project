<?php include '../includes/header.php'; ?>

<main class="pt-20 bg-gray-100">
    <article>
        <header class="blog-header" style="background-image: url('../assets/img/project-management-banner-1.jpg');">
            <div class="container mx-auto px-4 py-32 text-center text-white relative z-10">
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight reveal">From Plan to Launch: Becoming a Project Management Pro</h1>
                <p class="mt-4 text-lg reveal" style="transition-delay: 150ms;">Posted on <time datetime="<?php echo date('Y-m-d'); ?>"><?php echo date('F j, Y'); ?></time></p>
            </div>
        </header>

        <div class="container mx-auto px-4 max-w-5xl -mt-16 relative z-20 mb-16">
            <div class="blog-tilt-wrapper">
                 <div class="p-8 md:p-12 blog-content text-gray-800">
                    <p class="lead reveal">
                        Project management is the backbone of every successful initiative. It's the discipline of planning, executing, and monitoring work to achieve specific goals within a set timeframe and budget. Effective project managers are master organizers, communicators, and problem-solvers.
                    </p>

                    <h2 class="reveal">Key Methodologies: Agile vs. Waterfall</h2>
                    <p class="reveal">
                       Understanding different project management frameworks allows you to choose the best approach for your team and project.
                    </p>
                    <ul class="reveal">
                        <li><strong>Waterfall:</strong> A traditional, linear approach where each phase of the project must be completed before the next begins. It's best suited for projects with fixed requirements and a clear end goal.</li>
                        <li><strong>Agile:</strong> An iterative approach focused on flexibility and collaboration. Work is broken down into small increments called "sprints," allowing for continuous feedback and adaptation. Scrum and Kanban are popular Agile frameworks.</li>
                    </ul>

                    <figure class="reveal">
                        <img src="../assets/img/project-management-pro-5.jpg" alt="A team collaborating around a Kanban board with sticky notes" class="rounded-lg shadow-lg w-full h-auto object-cover">
                        <figcaption>Agile methodologies promote teamwork and rapid iteration.</figcaption>
                    </figure>

                    <h2 class="reveal">The Five Phases of Project Management</h2>
                    <p class="reveal">Regardless of the methodology, most projects follow a similar lifecycle:</p>
                    <ol class="list-decimal pl-5 reveal">
                        <li class="mb-2"><strong>Initiation:</strong> Defining the project's objectives, scope, and stakeholders.</li>
                        <li class="mb-2"><strong>Planning:</strong> Creating a detailed roadmap, including timelines, resources, budget, and risk assessment.</li>
                        <li class="mb-2"><strong>Execution:</strong> The project team carries out the work defined in the plan.</li>
                        <li class="mb-2"><strong>Monitoring & Controlling:</strong> Tracking progress, managing changes, and ensuring the project stays on course.</li>
                        <li class="mb-2"><strong>Closure:</strong> Delivering the final product, archiving documents, and conducting a post-mortem to learn from successes and failures.</li>
                    </ol>
                    <p class="reveal">
                       Great project managers are essential in every industry. By mastering these concepts, you can steer complex projects to success and become an invaluable asset to any team.
                    </p>
                    
                    <div class="text-center mt-8 reveal">
                        <a href="../register.php" class="btn btn-primary text-lg">Lead Your Next Project</a>
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