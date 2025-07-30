<?php include '../includes/header.php'; ?>

<main class="pt-20 bg-gray-100">
    <article>
        <header class="blog-header" style="background-image: url('https://images.unsplash.com/photo-1626785774573-4b799315345d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2071&q=80');">
            <div class="container mx-auto px-4 py-32 text-center text-white relative z-10">
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight reveal">The Principles of Design: Building Visual Harmony</h1>
                <p class="mt-4 text-lg reveal" style="transition-delay: 150ms;">Posted on <time datetime="<?php echo date('Y-m-d'); ?>"><?php echo date('F j, Y'); ?></time></p>
            </div>
        </header>

        <div class="container mx-auto px-4 max-w-5xl -mt-16 relative z-20 mb-16">
            <div class="blog-tilt-wrapper">
                 <div class="p-8 md:p-12 blog-content text-gray-800">
                    <p class="lead reveal">
                        Graphic design is the art of visual communication. It's about more than making things look pretty; it's about solving problems and conveying messages effectively. Understanding the core principles of design is the first step toward creating compelling and professional work.
                    </p>

                    <h2 class="reveal">The Building Blocks of Visual Design</h2>
                    <p class="reveal">
                        Every design you see, from a website to a business card, is built upon a few fundamental principles. Mastering them will give you control over your compositions.
                    </p>
                    <ul class="reveal">
                        <li><strong>Contrast:</strong> Creates visual interest by making different elements stand out. This can be achieved through color, size, shape, or typography.</li>
                        <li><strong>Hierarchy:</strong> Guides the viewer's eye to the most important elements first. A clear hierarchy ensures your message is understood quickly.</li>
                        <li><strong>Balance:</strong> Gives the design stability. Balance can be symmetrical (mirrored) or asymmetrical (unevenly distributed but visually weighted).</li>
                        <li><strong>Repetition:</strong> Unifies a design by reusing similar elements throughout. It creates consistency and strengthens the overall piece.</li>
                        <li><strong>Whitespace (Negative Space):</strong> The empty space around your design elements. It's not wasted space; it's crucial for reducing clutter and improving readability.</li>
                    </ul>

                    <figure class="reveal">
                        <img src="https://images.unsplash.com/photo-1572044162444-24c95621ec3b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1887&q=80" alt="A designer working on a color palette" class="rounded-lg shadow-lg w-full h-auto object-cover">
                        <figcaption>Color theory and typography are essential tools for every graphic designer.</figcaption>
                    </figure>

                    <h2 class="reveal">Choosing Your Tools</h2>
                    <p class="reveal">While principles are universal, the tools you use can define your workflow:</p>
                    <ul class="reveal">
                        <li><strong>Adobe Creative Suite:</strong> The industry standard, including Photoshop (raster), Illustrator (vector), and InDesign (layout).</li>
                        <li><strong>Figma & Sketch:</strong> Popular for UI/UX design, focusing on collaborative, vector-based work for digital interfaces.</li>
                        <li><strong>Canva:</strong> An accessible, browser-based tool perfect for social media graphics and quick designs.</li>
                    </ul>
                    <p class="reveal">
                        A successful design career is built on a strong foundation of principles, an agile command of your tools, and a never-ending curiosity for visual trends.
                    </p>
                    
                    <div class="text-center mt-8 reveal">
                        <a href="../register.php" class="btn btn-primary text-lg">Design Your Career Path</a>
                    </div>
                </div>
            </div>
        </div>
    </article>
</main>

<?php include '../includes/footer.php'; ?>