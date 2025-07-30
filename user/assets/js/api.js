document.addEventListener('DOMContentLoaded', () => {

    // --- AI Resume Builder Logic ---
    const resumeForm = document.getElementById('resume-form');
    if (resumeForm) {
        const resumeOutput = document.getElementById('resume-output');
        const copyResumeBtn = document.getElementById('copy-resume-btn');

        resumeForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            // Show loader
            resumeOutput.innerHTML = `
                <div class="loader-container">
                    <div class="loader"></div>
                    <p>Crafting your resume...</p>
                </div>`;

            // Collect form data
            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                linkedin: document.getElementById('linkedin').value,
                experience: document.getElementById('experience').value,
                education: document.getElementById('education').value,
                skills: document.getElementById('skills').value,
            };

            // Simulate backend processing with a timeout
            setTimeout(() => {
                const generatedResume = generateResumeTemplate(formData);
                resumeOutput.innerHTML = generatedResume;
            }, 1500); // 1.5-second delay
        });

        copyResumeBtn.addEventListener('click', () => {
            const textToCopy = resumeOutput.innerText;
            navigator.clipboard.writeText(textToCopy).then(() => {
                copyResumeBtn.innerHTML = '<i class="fas fa-check"></i> Copied!';
                setTimeout(() => {
                    copyResumeBtn.innerHTML = '<i class="far fa-copy"></i> Copy';
                }, 2000);
            });
        });
    }

    // --- AI Skill Analyzer Logic ---
    const skillForm = document.getElementById('skill-form');
    if (skillForm) {
        const skillOutput = document.getElementById('skill-output');
        const copySkillsBtn = document.getElementById('copy-skills-btn');

        skillForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            skillOutput.innerHTML = `
                <div class="loader-container">
                    <div class="loader"></div>
                    <p>Analyzing your skills...</p>
                </div>`;
            
            const skillsInput = document.getElementById('skills-input').value;

            setTimeout(() => {
                const generatedAnalysis = generateSkillAnalysis(skillsInput);
                skillOutput.innerHTML = generatedAnalysis;
            }, 1500);
        });
        
        copySkillsBtn.addEventListener('click', () => {
            const textToCopy = skillOutput.innerText;
            navigator.clipboard.writeText(textToCopy).then(() => {
                copySkillsBtn.innerHTML = '<i class="fas fa-check"></i> Copied!';
                setTimeout(() => {
                    copySkillsBtn.innerHTML = '<i class="far fa-copy"></i> Copy';
                }, 2000);
            });
        });
    }

    // --- Template Generation Functions (Client-Side Simulation) ---

    function generateResumeTemplate(data) {
        let resumeHTML = `
${data.name ? `**${data.name.toUpperCase()}**` : ''}
${data.email ? `${data.email}` : ''} ${data.phone ? `| ${data.phone}` : ''} ${data.linkedin ? `| ${data.linkedin}` : ''}

----------------------------------------------------------------------

**SUMMARY**
A motivated and detail-oriented professional seeking to leverage my skills in a challenging new role.

**EXPERIENCE**
${data.experience ? data.experience.split('\n').map(line => `- ${line}`).join('\n') : 'No experience provided.'}

**EDUCATION**
${data.education ? data.education.split('\n').map(line => `- ${line}`).join('\n') : 'No education provided.'}

**SKILLS**
${data.skills ? data.skills : 'No skills provided.'}
        `;
        return resumeHTML.trim();
    }
    
    function generateSkillAnalysis(skills) {
        const skillList = skills.split(',').map(s => s.trim().toLowerCase()).filter(s => s);
        const analysisMap = {
            'javascript': 'Excellent choice! Consider learning **React** for frontend or **Node.js** for backend to complement this skill.',
            'python': 'A versatile language. Explore libraries like **Django** for web development or **TensorFlow** for machine learning.',
            'react': 'Great! To become a full-stack developer, consider learning a backend technology like **Node.js** or **Python with Django**.',
            'sql': 'Fundamental for data roles. Deepen your knowledge with **database optimization** techniques and **NoSQL databases** like MongoDB.',
            'project management': 'A valuable soft skill. Enhance it by getting certified in **Agile** or **Scrum** methodologies.'
        };
        
        if (skillList.length === 0) {
            return 'Please enter at least one skill to receive an analysis.';
        }

        let analysisHTML = `**SKILL ANALYSIS REPORT**\n\n`;
        analysisHTML += `**Strengths Identified:**\n`;
        skillList.forEach(skill => {
            analysisHTML += `- **${skill.charAt(0).toUpperCase() + skill.slice(1)}**: A strong asset in today's job market.\n`;
        });

        analysisHTML += `\n**Growth Recommendations:**\n`;
        let recommendationsFound = false;
        skillList.forEach(skill => {
            if (analysisMap[skill]) {
                analysisHTML += `- Based on your knowledge of **${skill}**, ${analysisMap[skill]}\n`;
                recommendationsFound = true;
            }
        });

        if (!recommendationsFound) {
            analysisHTML += `- Continue to build on your current skill set by seeking out advanced projects and learning opportunities.`;
        }

        return analysisHTML;
    }
});
