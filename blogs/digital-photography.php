<?php include '../includes/header.php'; ?>

<main class="pt-20 bg-gray-100">
    <article>
        <header class="blog-header" style="background-image: url('https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2071&q=80');">
            <div class="container mx-auto px-4 py-32 text-center text-white relative z-10">
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight reveal">Capture the Moment: A Guide to Digital Photography</h1>
                <p class="mt-4 text-lg reveal" style="transition-delay: 150ms;">Posted on <time datetime="<?php echo date('Y-m-d'); ?>"><?php echo date('F j, Y'); ?></time></p>
            </div>
        </header>

        <div class="container mx-auto px-4 max-w-5xl -mt-16 relative z-20 mb-16">
            <div class="blog-tilt-wrapper">
                 <div class="p-8 md:p-12 blog-content text-gray-800">
                    <p class="lead reveal">
                        Digital photography is more than just pointing and shooting; it's the art of telling a story, capturing an emotion, and preserving a memory in a single frame. Whether you're a beginner with a smartphone or an aspiring pro with a DSLR, this guide will help you master the fundamentals.
                    </p>

                    <h2 class="reveal">The Exposure Triangle: Aperture, Shutter Speed, ISO</h2>
                    <p class="reveal">
                        The foundation of a good photograph lies in understanding how to control light. The exposure triangle consists of three elements that work together to create a perfectly exposed image.
                    </p>
                    <ul class="reveal">
                        <li><strong>Aperture (f-stop):</strong> Controls the size of the lens opening, affecting both the amount of light and the depth of field (how much of the scene is in focus). A low f-stop (e.g., f/1.8) creates a shallow depth of field, blurring the background.</li>
                        <li><strong>Shutter Speed:</strong> Determines how long the camera's sensor is exposed to light. A fast shutter speed freezes motion, while a slow one creates motion blur, perfect for capturing light trails.</li>
                        <li><strong>ISO:</strong> Measures the sensor's sensitivity to light. A higher ISO is useful in dark situations but can introduce digital noise or "grain" into the image.</li>
                    </ul>

                    <figure class="grid grid-cols-1 md:grid-cols-2 gap-4 my-8 reveal">
                        <img src="https://images.unsplash.com/photo-1519638399535-1b036603ac77?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1931&q=80" alt="A long exposure shot of a starry night sky" class="rounded-lg shadow-lg w-full h-full object-cover">
                        <img src="https://images.unsplash.com/photo-1581456495146-65a71b2c8e52?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1886&q=80" alt="A portrait with a shallow depth of field" class="rounded-lg shadow-lg w-full h-full object-cover">
                        <figcaption class="md:col-span-2">Mastering shutter speed (left) and aperture (right) unlocks creative potential.</figcaption>
                    </figure>

                    <h2 class="reveal">Composition is King</h2>
                    <p class="reveal">A technically perfect photo can still be uninteresting without good composition. Learn the rules to know how to break them:</p>
                    <ul class="reveal">
                        <li><strong>Rule of Thirds:</strong> Place key elements along intersecting lines that divide your frame into thirds.</li>
                        <li><strong>Leading Lines:</strong> Use natural lines (roads, fences, rivers) to guide the viewer's eye through the image.</li>
                        <li><strong>Framing:</strong> Use elements in the foreground (like a window or archway) to frame your subject.</li>
                    </ul>
                    <p class="reveal">
                       The best camera is the one you have with you. Practice these principles daily, and you'll develop an eye for capturing stunning images everywhere you go.
                    </p>
                    
                    <div class="text-center mt-8 reveal">
                        <a href="../register.php" class="btn btn-primary text-lg">Start Your Creative Journey</a>
                    </div>
                </div>
            </div>
        </div>
    </article>
</main>

<?php include '../includes/footer.php'; ?>