// assets/js/roadmap-3d.js

document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('roadmap-3d-container');
    if (!container || typeof THREE === 'undefined') {
        console.error("3D container not found or Three.js is not loaded.");
        return;
    }

    // --- Scene, Camera, Renderer ---
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.z = 5;

    const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    container.appendChild(renderer.domElement);

    // --- Group for all objects to tilt together ---
    const group = new THREE.Group();
    scene.add(group);

    // --- Lighting ---
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.3);
    group.add(ambientLight);

    const pointLight = new THREE.PointLight(0x4A90E2, 1.2, 100);
    pointLight.position.set(5, 5, 5);
    group.add(pointLight);

    const pointLight2 = new THREE.PointLight(0x58D68D, 1.2, 100);
    pointLight2.position.set(-5, -5, 2);
    group.add(pointLight2);

    // --- Objects ---
    const objects = [];
    const geometryTypes = [
        new THREE.IcosahedronGeometry(1, 0),
        new THREE.TorusKnotGeometry(0.8, 0.25, 100, 16),
        new THREE.DodecahedronGeometry(1.2, 0)
    ];

    for (let i = 0; i < 25; i++) {
        // --- MODIFICATION: Clone material for each object to allow individual highlighting ---
        const material = new THREE.MeshStandardMaterial({
            color: 0x8b949e,
            metalness: 0.8,
            roughness: 0.2,
            wireframe: true
        });

        const geometry = geometryTypes[Math.floor(Math.random() * geometryTypes.length)];
        const object = new THREE.Mesh(geometry, material);

        object.position.x = (Math.random() - 0.5) * 20;
        object.position.y = (Math.random() - 0.5) * 20;
        object.position.z = (Math.random() - 0.5) * 20;

        object.rotation.x = Math.random() * 2 * Math.PI;
        object.rotation.y = Math.random() * 2 * Math.PI;

        const scale = Math.random() * 0.2 + 0.1;
        object.scale.set(scale, scale, scale);
        
        // --- NEW: Store original properties for hover effect ---
        object.userData = {
            initialScale: new THREE.Vector3(scale, scale, scale),
            hoverScale: new THREE.Vector3(scale * 1.5, scale * 1.5, scale * 1.5),
            rotationSpeed: {
                x: (Math.random() - 0.5) * 0.002,
                y: (Math.random() - 0.5) * 0.002
            }
        };

        objects.push(object);
        group.add(object); // Add to group instead of scene
    }

    // --- NEW: Raycaster for Mouse Hover Interaction ---
    const raycaster = new THREE.Raycaster();
    const mouse = new THREE.Vector2();
    let INTERSECTED = null;

    // --- Animation Loop ---
    const clock = new THREE.Clock();
    const animate = () => {
        requestAnimationFrame(animate);
        const elapsedTime = clock.getElapsedTime();

        // Animate objects' base rotation
        objects.forEach(obj => {
            obj.rotation.x += obj.userData.rotationSpeed.x;
            obj.rotation.y += obj.userData.rotationSpeed.y;
        });
        
        // --- NEW: Raycasting logic for hover effects ---
        raycaster.setFromCamera(mouse, camera);
        const intersects = raycaster.intersectObjects(group.children, false);

        // Reset previous intersected object
        if (INTERSECTED && !intersects.find(i => i.object === INTERSECTED)) {
            INTERSECTED.material.emissive.setHex(0x000000); // Remove glow
            INTERSECTED = null;
        }

        // Set new intersected object
        if (intersects.length > 0) {
            const newIntersected = intersects[0].object;
            if (INTERSECTED !== newIntersected) {
                INTERSECTED = newIntersected;
                INTERSECTED.material.emissive.setHex(0x4A90E2); // Add glow
            }
        }
        
        // --- NEW: Animate scale and group tilt ---
        objects.forEach(obj => {
            if (obj === INTERSECTED) {
                obj.scale.lerp(obj.userData.hoverScale, 0.1); // Smoothly scale up
            } else {
                obj.scale.lerp(obj.userData.initialScale, 0.1); // Smoothly scale down
            }
        });
        
        // Smoothly tilt the entire group based on mouse position
        group.rotation.y += (targetRotationY - group.rotation.y) * 0.05;
        group.rotation.x += (targetRotationX - group.rotation.x) * 0.05;


        renderer.render(scene, camera);
    };

    animate();

    // --- Handle Window Resize ---
    window.addEventListener('resize', () => {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    });

    // --- NEW: Enhanced Mouse Interaction ---
    let targetRotationX = 0;
    let targetRotationY = 0;
    document.addEventListener('mousemove', (event) => {
        // Update mouse vector for raycasting
        mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
        mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;
        
        // Set target rotation for the group tilt effect
        targetRotationY = mouse.x * 0.3;
        targetRotationX = mouse.y * -0.3;
    });
});
