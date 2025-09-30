<?php
require_once 'config.php';
requireLogin();

date_default_timezone_set('Asia/Manila');

if (!isset($_SESSION['login_time'])) {
    $_SESSION['login_time'] = date('F j, Y g:i A');
}
include 'data.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name; ?> - Portfolio</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <!-- STICKY NAVIGATION BAR -->
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-left">
                <a href="logout.php" class="navbar-logout">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Logout
                </a>
            </div>
            <div class="navbar-right">
                <div class="navbar-user">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span class="navbar-username"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                </div>
                <div class="navbar-divider"></div>
                <div class="navbar-time">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    <span class="navbar-login-time"><?php echo htmlspecialchars($_SESSION['login_time']); ?></span>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- HERO SECTION -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Hi, I'm <?php echo $nickname; ?></h1>
                <p class="hero-subtitle"><?php echo $title; ?></p>
                
                <!-- CTA Buttons -->
                <div class="hero-buttons">
                    <a href="assets/resume.pdf" class="btn btn-primary" download>Download Resume</a>
                    <a href="#contact" class="btn btn-secondary">Contact Me</a>
                </div>
                
                <!-- Skills Carousel -->
                <div class="skills-carousel-wrapper">
                    <h3 class="carousel-title">Technologies I Work With</h3>
                    <div class="skills-carousel">
                        <div class="skills-track">
                            <?php 
                            // Render skills twice for seamless infinite scroll
                            for ($i = 0; $i < 2; $i++): 
                                foreach ($skills as $skill): 
                            ?>
                                <div class="skill-item">
                                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/<?php 
                                        $skillLower = strtolower($skill['name']);
                                        if ($skillLower == 'c++') {
                                            echo 'cplusplus/cplusplus-original.svg';
                                        } elseif ($skillLower == 'html') {
                                            echo 'html5/html5-original.svg';
                                        } else {
                                            echo $skillLower . '/' . $skillLower . '-original.svg';
                                        }
                                    ?>" 
                                    alt="<?php echo $skill['name']; ?>" 
                                    class="skill-icon"
                                    onerror="this.src='https://via.placeholder.com/50/2563EB/ffffff?text=<?php echo substr($skill['name'], 0, 2); ?>'">
                                    <span class="skill-tooltip"><?php echo $skill['name']; ?></span>
                                </div>
                            <?php 
                                endforeach; 
                            endfor; 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT ME SECTION -->
    <section class="about" id="about">
        <div class="container">
            <h2 class="section-title">About Me</h2>
            <div class="about-content">
                <!-- Left Column: Text -->
                <div class="about-text">
                    <p><?php echo $summary; ?></p>
                    <div class="contact-info">
                        <p><strong>Email:</strong> <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
                        <p><strong>Phone:</strong> <?php echo $phone; ?></p>
                    </div>
                </div>
                
                <!-- Right Column: Profile Image -->
                <div class="about-image">
                    <img src="<?php echo $profileImage; ?>" alt="<?php echo $name; ?>" class="profile-img">
                </div>
            </div>
        </div>
    </section>

    <!-- EXPERIENCE SECTION (Timeline) -->
    <section class="experience" id="experience">
        <div class="container">
            <h2 class="section-title">Experience</h2>
            <div class="timeline">
                <?php foreach ($experience as $index => $exp): ?>
                    <div class="timeline-item <?php echo $index % 2 == 0 ? 'left' : 'right'; ?>">
                        <div class="timeline-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                            </svg>
                        </div>
                        <div class="timeline-content">
                            <span class="timeline-year"><?php echo $exp['year']; ?></span>
                            <h3><?php echo $exp['title']; ?></h3>
                            <p class="timeline-context"><?php echo $exp['context']; ?></p>
                            <p><?php echo $exp['details']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- EDUCATION SECTION (Timeline) -->
    <section class="education" id="education">
        <div class="container">
            <h2 class="section-title">Education</h2>
            <div class="timeline">
                <?php foreach ($education as $edu): ?>
                    <div class="timeline-item">
                        <div class="timeline-icon education-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                                <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                            </svg>
                        </div>
                        <div class="timeline-content">
                            <span class="timeline-year"><?php echo $edu['year']; ?></span>
                            <h3><?php echo $edu['degree']; ?></h3>
                            <p class="timeline-context"><?php echo $edu['school']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CONTACT / FOOTER SECTION -->
    <footer class="footer" id="contact">
        <div class="container">
            <h2 class="footer-title">Let's Connect</h2>
            <p class="footer-text">Feel free to reach out for collaborations or just a friendly chat!</p>
            
            <!-- Social Links -->
            <div class="social-links">
                <?php foreach ($socials as $social): ?>
                    <a href="<?php echo $social['url']; ?>" target="_blank" class="social-link" title="<?php echo $social['name']; ?>">
                        <?php if ($social['name'] == 'GitHub'): ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                        <?php elseif ($social['name'] == 'LinkedIn'): ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        <?php elseif ($social['name'] == 'Email'): ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                            </svg>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>
            
            <p class="footer-copyright">&copy; <?php echo date('Y'); ?> <?php echo $name; ?>. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>