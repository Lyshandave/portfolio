/* ============================================================
   main.js — Portfolio JavaScript
   Lyshan Dave B. Tomo
   Sections:
     1.  Theme Toggle
     2.  Navbar
     3.  Typewriter
     4.  Profile Dog Emoji (theme-aware)
     5.  Scroll Animations
     6.  Contact Form
     7.  Certificate Lightbox
     8.  Project Modal
     9.  Global Event Listeners
     10. Scroll-to-Top
     11. Rating System
     12. Comments System
     13. Admin Panel
     14. Chatbot
   ============================================================ */

/* ----------------------------------------------------------
   1. THEME TOGGLE
   ---------------------------------------------------------- */
const html        = document.documentElement;
const themeToggle = document.getElementById('themeToggle');

function prefersReducedMotion() {
    return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
}

html.setAttribute('data-theme', localStorage.getItem('theme') || 'dark');

if (themeToggle) {
    themeToggle.addEventListener('click', () => {
        const next = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        html.setAttribute('data-theme', next);
        localStorage.setItem('theme', next);
        updateProfileImage(next);
    });
}

/* ----------------------------------------------------------
   2. NAVBAR — scroll effect, mobile menu, active link
   ---------------------------------------------------------- */
const navbar     = document.getElementById('navbar');
const menuToggle = document.getElementById('menuToggle');
const navMenu    = document.getElementById('navMenu');
const navLinks   = document.querySelectorAll('.nav-link');

window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 50);
    const pos = window.scrollY + 100;
    document.querySelectorAll('section[id]').forEach(section => {
        const id     = section.getAttribute('id');
        const inView = pos >= section.offsetTop && pos < section.offsetTop + section.offsetHeight;
        navLinks.forEach(l => {
            if (l.getAttribute('href') === '#' + id) l.classList.toggle('active', inView);
        });
    });
}, { passive: true });

if (menuToggle) {
    menuToggle.addEventListener('click', () => {
        const open = navMenu.classList.toggle('active');
        menuToggle.classList.toggle('active', open);
        menuToggle.setAttribute('aria-expanded', open);
        document.body.style.overflow = open ? 'hidden' : '';
    });
}

navLinks.forEach(link => {
    link.addEventListener('click', () => {
        menuToggle.classList.remove('active');
        navMenu.classList.remove('active');
        menuToggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    });
});

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (!target) return;
        e.preventDefault();
        window.scrollTo({
            top: target.getBoundingClientRect().top + window.scrollY - 80,
            behavior: prefersReducedMotion() ? 'auto' : 'smooth'
        });
    });
});

/* ----------------------------------------------------------
   3. TYPEWRITER
   ---------------------------------------------------------- */
const typewriterEl = document.getElementById('typewriter');
if (typewriterEl) {
    const roles = ['Computer Technician', 'Network Administrator', 'System Support Specialist', 'Web Developer'];
    let roleIndex = 0, charIndex = 0, isDeleting = false;

    function type() {
        const current = roles[roleIndex];
        typewriterEl.textContent = current.substring(0, isDeleting ? charIndex - 1 : charIndex + 1);
        charIndex += isDeleting ? -1 : 1;

        let delay = isDeleting ? 50 : 100;
        if (!isDeleting && charIndex === current.length) { isDeleting = true; delay = 2000; }
        else if (isDeleting && charIndex === 0)          { isDeleting = false; roleIndex = (roleIndex + 1) % roles.length; delay = 500; }

        setTimeout(type, delay);
    }
    setTimeout(type, 1000);
}

/* ----------------------------------------------------------
   4. PROFILE IMAGE (theme-aware — light.jpg / dark.png)
   ---------------------------------------------------------- */
function updateProfileImage(theme) {
    // CSS handles the opacity transitions via [data-theme] selectors automatically.
    // This function is kept as a hook if additional JS logic is needed.
    const wrap = document.getElementById('profileImgWrap');
    if (!wrap) return;
    // Force repaint for smooth cross-fade on Safari
    wrap.style.willChange = 'contents';
    requestAnimationFrame(() => { wrap.style.willChange = 'auto'; });
}

// Set initial state on load
updateProfileImage(html.getAttribute('data-theme'));

/* ----------------------------------------------------------
   5. SCROLL ANIMATIONS
   — Each element type gets a tailored entrance:
     • section-header  → fade + scale up (soft pop)
     • cards (skill, project, cert) → staggered slide-up
     • about-image     → slide in from left
     • about-text / contact-info / contact-form → slide from right
     • comment blocks  → fade up
   — Bidirectional: re-hides when scrolled out of view
   ---------------------------------------------------------- */
(function () {
    // Guard: skip on browsers that don't support IntersectionObserver
    if (!('IntersectionObserver' in window)) return;

    // ── Animation class map ──────────────────────────────
    // key  = CSS selector
    // value = { type: 'fade-up' | 'fade-left' | 'fade-right' | 'pop', stagger: bool }
    var ANIM_MAP = [
        { sel: '.section-header',        type: 'pop',        stagger: false },
        { sel: '.about-image',            type: 'fade-left',  stagger: false },
        { sel: '.about-text',             type: 'fade-right', stagger: false },
        { sel: '.skill-card-v2',          type: 'fade-up',    stagger: true  },
        { sel: '.project-card',           type: 'fade-up',    stagger: true  },
        { sel: '.certificate-card',       type: 'fade-up',    stagger: true  },
        { sel: '.highlight-item',         type: 'fade-up',    stagger: true  },
        { sel: '.contact-info',           type: 'fade-left',  stagger: false },
        { sel: '.contact-form-wrapper',   type: 'fade-right', stagger: false },
        { sel: '.comment-form-card',      type: 'fade-left',  stagger: false },
        { sel: '.comments-list-wrap',     type: 'fade-right', stagger: false },
        { sel: '.skills-tabs',            type: 'pop',        stagger: false }
    ];

    var TYPE_CLASS = {
        'fade-up':    'sa-fade-up',
        'fade-left':  'sa-fade-left',
        'fade-right': 'sa-fade-right',
        'pop':        'sa-pop'
    };

    // Assign initial hidden classes + stagger delays
    ANIM_MAP.forEach(function (cfg) {
        var hiddenClass = TYPE_CLASS[cfg.type];
        document.querySelectorAll(cfg.sel).forEach(function (el, i) {
            // Skip if already processed
            if (el.dataset.saInit) return;
            el.dataset.saInit = '1';
            el.dataset.saType = cfg.type;
            el.classList.add(hiddenClass);
            if (cfg.stagger) {
                el.style.transitionDelay = (i % 8) * 0.07 + 's';
            }
        });
    });

    // Helper: given an element, get its current hidden class
    function getHiddenClass(el) {
        return TYPE_CLASS[el.dataset.saType] || 'sa-fade-up';
    }

    // Re-hide logic: restore the correct hidden class based on scroll position
    function rehide(el) {
        var rect = el.getBoundingClientRect();
        el.classList.remove('sa-visible');
        el.classList.add(getHiddenClass(el));
        // If scrolled past (above viewport), flip to up variant for smooth re-entry
        if (rect.top < 0 && el.dataset.saType === 'fade-up') {
            el.classList.add('sa-was-above');
        } else {
            el.classList.remove('sa-was-above');
        }
    }

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            var el = entry.target;
            if (entry.isIntersecting) {
                el.classList.remove(getHiddenClass(el), 'sa-was-above');
                el.classList.add('sa-visible');
            } else {
                rehide(el);
            }
        });
    }, { threshold: 0.12, rootMargin: '-30px 0px -30px 0px' });

    // Observe all prepared elements
    document.querySelectorAll('[data-sa-init]').forEach(function (el) {
        observer.observe(el);
    });
})();

/* ----------------------------------------------------------
   6. CONTACT FORM
   ---------------------------------------------------------- */
const EMAILJS_PUBLIC_KEY  = 'XC9GI_4Y4kuK2oa8R';
const EMAILJS_SERVICE_ID  = 'service_w1ysglk';
const EMAILJS_TEMPLATE_ID = 'template_oivjeae';
const EMAILJS_CONFIGURED  = (
    EMAILJS_PUBLIC_KEY  !== 'YOUR_PUBLIC_KEY'  &&
    EMAILJS_SERVICE_ID  !== 'YOUR_SERVICE_ID'  &&
    EMAILJS_TEMPLATE_ID !== 'YOUR_TEMPLATE_ID'
);

if (EMAILJS_CONFIGURED && typeof emailjs !== 'undefined') {
    emailjs.init({ publicKey: EMAILJS_PUBLIC_KEY });
}

const contactForm = document.getElementById('contactForm');
const submitBtn   = document.getElementById('submitBtn');
const formMessage = document.getElementById('formMessage');

if (contactForm) contactForm.addEventListener('submit', handleContactSubmit);

async function handleContactSubmit(e) {
    e.preventDefault();
    const fd      = new FormData(contactForm);
    const name    = (fd.get('name')    || '').trim();
    const email   = (fd.get('email')   || '').trim();
    const subject = (fd.get('subject') || '').trim();
    const message = (fd.get('message') || '').trim();

    if (!validateContact(name, email, subject, message)) return;

    setContactLoading(true);
    hideContactMsg();

    const [phpRes, ejsRes] = await Promise.allSettled([
        sendViaPHP(fd),
        sendViaEmailJS(name, email, subject, message)
    ]);

    setContactLoading(false);
    const ok = (phpRes.status === 'fulfilled' && phpRes.value) ||
               (ejsRes.status === 'fulfilled' && ejsRes.value);

    if (ok) { showContactMsg('Message sent successfully!', 'success'); contactForm.reset(); }
    else    { showContactMsg('Failed to send. Please try again.', 'error'); }
}

async function sendViaPHP(formData) {
    const ctrl  = new AbortController();
    const timer = setTimeout(() => ctrl.abort(), 15000); // 15s timeout for SMTP operations
    try {
        const res  = await fetch('send.php', { method: 'POST', body: formData, signal: ctrl.signal });
        clearTimeout(timer);
        if (!res.ok) throw new Error();
        const data = await res.json();
        return data.success === true;
    } catch { clearTimeout(timer); return false; }
}

async function sendViaEmailJS(name, email, subject, message) {
    if (!EMAILJS_CONFIGURED || typeof emailjs === 'undefined') return false;
    try {
        const res = await emailjs.send(EMAILJS_SERVICE_ID, EMAILJS_TEMPLATE_ID, {
            from_name: name, from_email: email, subject, message,
            to_email: 'lyshandavet@gmail.com', reply_to: email
        });
        return res.status === 200;
    } catch { return false; }
}

function validateContact(name, email, subject, message) {
    if (name.length < 2)                              { showContactMsg('Please enter your name (at least 2 characters).', 'error'); return false; }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email))   { showContactMsg('Please enter a valid email address.', 'error'); return false; }
    if (!subject)                                     { showContactMsg('Please enter a subject.', 'error'); return false; }
    if (message.length < 1)                           { showContactMsg('Please enter a message.', 'error'); return false; }
    return true;
}

function setContactLoading(on) {
    if (!submitBtn) return;
    submitBtn.classList.toggle('loading', on);
    submitBtn.disabled = on;
}

function showContactMsg(msg, type) {
    if (!formMessage) return;
    formMessage.textContent = msg;
    formMessage.className   = 'form-message ' + type;
    clearTimeout(formMessage._t);
    formMessage._t = setTimeout(() => { formMessage.textContent = ''; formMessage.className = 'form-message'; }, 4000);
}

function hideContactMsg() {
    if (!formMessage) return;
    formMessage.textContent = '';
    formMessage.className   = 'form-message';
}

/* ----------------------------------------------------------
   7. CERTIFICATE LIGHTBOX
   ---------------------------------------------------------- */
const certificates = [
    { id: 'cert1', src: 'images/cert1.png', title: 'Networking Basics',          desc: 'Cisco Networking Academy — Dec 2025' },
    { id: 'cert2', src: 'images/cert2.png', title: 'Computer Systems Servicing', desc: 'TESDA NC II — CSS — Apr 2024' }
];
let currentImageIndex = 0;

function openLightbox(certId) {
    currentImageIndex = Math.max(0, certificates.findIndex(c => c.id === certId));
    renderLightboxImage();
    document.getElementById('lightbox').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('lightbox').classList.remove('active');
    document.body.style.overflow = '';
}

function changeImage(dir) {
    currentImageIndex = (currentImageIndex + dir + certificates.length) % certificates.length;
    const img = document.getElementById('lightboxImage');
    img.style.opacity = '0';
    setTimeout(() => { renderLightboxImage(); img.style.opacity = '1'; }, 200);
}

function renderLightboxImage() {
    const cert    = certificates[currentImageIndex];
    const img     = document.getElementById('lightboxImage');
    const caption = document.getElementById('lightboxCaption');
    img.src = cert.src;
    img.alt = cert.title;
    caption.innerHTML = '<strong>' + cert.title + '</strong><br>' + cert.desc;
}

/* ----------------------------------------------------------
   8. PROJECT MODAL (Data moved to js/projects.js)
   ---------------------------------------------------------- */

function showProjectModal(id) {
    const modal   = document.getElementById('projectModal');
    const body    = document.getElementById('projectModalBody');
    const project = projectData[id];
    if (!project) return;

    const isCisco = project.tech.includes('Cisco Packet Tracer');
    body.innerHTML = '';

    const imgWrap = document.createElement('div');
    imgWrap.className = 'modal-image';
    const img = document.createElement('img');
    img.src = project.image; img.alt = project.title;
    imgWrap.appendChild(img);

    const info = document.createElement('div');
    info.className = 'modal-info';

    const h2 = document.createElement('h2');
    h2.textContent = project.title;

    const descWrap = document.createElement('div');
    descWrap.className = 'modal-description';
    const para = document.createElement('p');
    para.textContent = project.desc;
    const featHead = document.createElement('h4');
    featHead.textContent = 'Key Features:';
    const ul = document.createElement('ul');
    project.features.forEach(f => {
        const li = document.createElement('li'); li.textContent = f; ul.appendChild(li);
    });
    descWrap.append(para, featHead, ul);

    const techWrap = document.createElement('div');
    techWrap.className = 'modal-tech';
    const techHead = document.createElement('h4');
    techHead.textContent = 'Technologies Used:';
    const tags = document.createElement('div');
    tags.className = 'tech-tags';
    project.tech.forEach(t => {
        const span = document.createElement('span');
        span.className = 'tag'; span.textContent = t; tags.appendChild(span);
    });
    techWrap.append(techHead, tags);

    const actions = document.createElement('div');
    actions.className = 'modal-actions';

    if (project.demo) {
        const demoBtn = document.createElement('a');
        demoBtn.href = project.demo; demoBtn.className = 'btn btn-primary';
        demoBtn.target = '_blank'; demoBtn.rel = 'noopener noreferrer';
        demoBtn.innerHTML = '<i class="fas fa-external-link-alt" aria-hidden="true"></i> Live Demo';
        actions.appendChild(demoBtn);
    }

    const codeBtn = document.createElement('a');
    codeBtn.href = project.code; codeBtn.className = 'btn btn-secondary';
    codeBtn.target = '_blank'; codeBtn.rel = 'noopener noreferrer';
    codeBtn.innerHTML = '<i class="' + (isCisco ? 'fab fa-google-drive' : 'fab fa-github') + '" aria-hidden="true"></i> ' + (isCisco ? 'View Files' : 'View Code');
    actions.appendChild(codeBtn);

    info.append(h2, descWrap, techWrap, actions);
    body.append(imgWrap, info);
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeModal(id) {
    const el = document.getElementById(id);
    if (el) el.classList.remove('active');
    document.body.style.overflow = '';
}

function openResumeModal() {
    document.getElementById('resumeModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}

/* ----------------------------------------------------------
   9. GLOBAL EVENT LISTENERS
   ---------------------------------------------------------- */
document.addEventListener('click', e => {
    if (e.target === document.getElementById('projectModal')) closeModal('projectModal');
    if (e.target === document.getElementById('resumeModal'))  closeModal('resumeModal');
    if (e.target === document.getElementById('lightbox'))     closeLightbox();
});

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
        closeModal('projectModal');
        closeModal('resumeModal');
        closeLightbox();
    }
    if (document.getElementById('lightbox').classList.contains('active')) {
        if (e.key === 'ArrowLeft')  changeImage(-1);
        if (e.key === 'ArrowRight') changeImage(1);
    }
});

/* ----------------------------------------------------------
   10. SCROLL-TO-TOP
   ---------------------------------------------------------- */
const scrollTopBtn = document.getElementById('scrollTop');
if (scrollTopBtn) {
    window.addEventListener('scroll', () => {
        scrollTopBtn.classList.toggle('visible', window.scrollY > 500);
    }, { passive: true });
    scrollTopBtn.addEventListener('click', () => window.scrollTo({
        top: 0,
        behavior: prefersReducedMotion() ? 'auto' : 'smooth'
    }));
}

/* ----------------------------------------------------------
   11. RATING SYSTEM
       - Allows changing vote before submitting
       - Saves vote key to localStorage so user can update later
       - Stars stay interactive (not fully disabled) to allow re-rating
   ---------------------------------------------------------- */
(function () {
    const RATING_KEY   = 'portfolio_user_rating';
    let selectedRating = parseInt(localStorage.getItem(RATING_KEY) || '0', 10);

    const stars     = document.querySelectorAll('.star-btn');
    const submitBtn = document.getElementById('ratingSubmitBtn');
    const ratingMsg = document.getElementById('ratingMsg');

    loadRatings();

    // Restore previously saved star selection
    if (selectedRating) {
        highlightStars(selectedRating);
        if (submitBtn) submitBtn.disabled = false;
    }

    stars.forEach((star, i) => {
        star.addEventListener('mouseenter', () => highlightStars(i + 1));
        star.addEventListener('mouseleave', () => highlightStars(selectedRating));
        star.addEventListener('click', () => {
            selectedRating = i + 1;
            highlightStars(selectedRating);
            if (submitBtn) submitBtn.disabled = false;
        });
        star.addEventListener('keydown', e => {
            if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); star.click(); }
        });
    });

    function highlightStars(n) {
        stars.forEach((s, i) => s.classList.toggle('selected', i < n));
    }

    if (submitBtn) {
        submitBtn.addEventListener('click', async () => {
            if (!selectedRating) return;
            submitBtn.disabled = true;
            showRatingMsg('Submitting…', '');

            const fd = new FormData();
            fd.append('score', selectedRating);

            try {
                const res  = await fetch('feedback.php?action=post_rating', { method: 'POST', body: fd });
                const data = await res.json();
                if (data.success) {
                    localStorage.setItem(RATING_KEY, selectedRating);
                    showRatingMsg(data.message || 'Rating saved! ⭐', 'success');
                    renderRatingSummary(data.average, data.total, null);
                    loadRatings();
                    submitBtn.disabled = false; // keep enabled so they can re-rate
                } else {
                    // Server-side rate limit hit — still let them change locally shown stars
                    showRatingMsg(data.message || 'Could not submit rating.', 'error');
                    submitBtn.disabled = false;
                }
            } catch {
                showRatingMsg('Network error. Please try again.', 'error');
                submitBtn.disabled = false;
            }
        });
    }

    async function loadRatings() {
        try {
            const res  = await fetch('feedback.php?action=get_rating');
            const data = await res.json();
            if (data.success) renderRatingSummary(data.average, data.total, data.distribution);
        } catch { /* silently skip if backend unavailable */ }
    }

    function renderRatingSummary(avg, total, dist) {
        const avgEl   = document.getElementById('ratingAvg');
        const totalEl = document.getElementById('ratingTotal');
        const starsEl = document.getElementById('ratingStarsDisplay');

        if (avgEl)   avgEl.textContent   = total > 0 ? avg.toFixed(1) : '—';
        if (totalEl) totalEl.textContent = total > 0
            ? total + ' rating' + (total !== 1 ? 's' : '')
            : 'Be the first to rate!';

        if (starsEl) {
            starsEl.innerHTML = '';
            for (let i = 1; i <= 5; i++) {
                const icon = document.createElement('i');
                icon.className = 'fas ' + (i <= Math.round(avg) ? 'fa-star star-filled' : 'fa-star star-empty');
                starsEl.appendChild(icon);
            }
        }

        if (dist) {
            [5, 4, 3, 2, 1].forEach(n => {
                const fill  = document.getElementById('ratingBar'   + n);
                const count = document.getElementById('ratingCount' + n);
                const pct   = total > 0 ? Math.round(((dist[n] || 0) / total) * 100) : 0;
                if (fill)  fill.style.width  = pct + '%';
                if (count) count.textContent = dist[n] ?? 0;
            });
        }
    }

    function showRatingMsg(msg, type) {
        if (!ratingMsg) return;
        ratingMsg.textContent = msg;
        ratingMsg.className   = 'rating-msg' + (type ? ' ' + type : '');
    }
})();

/* ----------------------------------------------------------
   12. COMMENTS SYSTEM
       - Min comment length: 2 chars
       - Max comments shown: 20
   ---------------------------------------------------------- */
(function () {
    const MAX_COMMENTS     = 20;
    const commentForm      = document.getElementById('commentForm');
    const commentsList     = document.getElementById('commentsList');
    const commentSubmitBtn = document.getElementById('commentSubmitBtn');
    const commentFormMsg   = document.getElementById('commentFormMsg');
    const countBadge       = document.getElementById('commentsCountBadge');

    loadComments();

    if (commentForm) {
        commentForm.addEventListener('submit', async e => {
            e.preventDefault();
            const name     = (commentForm.querySelector('[name="name"]').value    || '').trim();
            const message  = (commentForm.querySelector('[name="message"]').value || '').trim();
            const honeypot = commentForm.querySelector('[name="website"]').value  || '';

            if (honeypot) return;
            if (name.length < 2)    { showCommentMsg('Name must be at least 2 characters.', 'error'); return; }
            if (message.length < 2) { showCommentMsg('Comment must be at least 2 characters.', 'error'); return; }

            if (commentSubmitBtn) commentSubmitBtn.disabled = true;
            showCommentMsg('Posting…', '');

            const fd = new FormData();
            fd.append('name', name);
            fd.append('message', message);

            try {
                const res  = await fetch('feedback.php?action=post_comment', { method: 'POST', body: fd });
                const data = await res.json();
                if (data.success) {
                    commentForm.reset();
                    showCommentMsg('Comment posted! Thank you. 🎉', 'success');
                    if (data.comment) prependComment(data.comment);
                } else {
                    showCommentMsg(data.message || 'Could not post comment.', 'error');
                }
            } catch {
                showCommentMsg('Network error. Please try again.', 'error');
            } finally {
                if (commentSubmitBtn) commentSubmitBtn.disabled = false;
            }
        });
    }

    async function loadComments() {
        if (!commentsList) return;
        try {
            const res  = await fetch('feedback.php?action=get_comments');
            const data = await res.json();
            if (data.success) renderComments(data.comments.slice(0, MAX_COMMENTS), data.total);
            else commentsList.innerHTML = emptyState();
        } catch {
            if (commentsList) commentsList.innerHTML = emptyState();
        }
    }

    function renderComments(comments, total) {
        if (!commentsList) return;
        if (countBadge) countBadge.textContent = total;
        const isAdmin = sessionStorage.getItem('admin_auth') === '1';
        commentsList.innerHTML = comments.length
            ? comments.map(c => buildCommentCard(c, isAdmin)).join('')
            : emptyState();
    }

    function prependComment(c) {
        if (!commentsList) return;
        const empty = commentsList.querySelector('.comments-empty');
        if (empty) commentsList.innerHTML = '';
        const isAdmin = sessionStorage.getItem('admin_auth') === '1';
        const div = document.createElement('div');
        div.innerHTML = buildCommentCard(c, isAdmin);
        commentsList.insertBefore(div.firstElementChild, commentsList.firstChild);
        if (countBadge) countBadge.textContent = parseInt(countBadge.textContent || '0', 10) + 1;
    }

    function buildCommentCard(c, isAdmin) {
        const deleteBtn = isAdmin
            ? `<button class="comment-delete-btn" data-id="${esc(c.id)}" aria-label="Delete comment" title="Delete">
                   <i class="fas fa-trash" aria-hidden="true"></i>
               </button>`
            : '';
        return `<div class="comment-card" role="listitem" data-id="${esc(c.id)}">
            <div class="comment-header">
                <div class="comment-avatar" style="background:${esc(c.avatar)}" aria-hidden="true">${esc(c.name).charAt(0).toUpperCase()}</div>
                <div class="comment-meta">
                    <div class="comment-author">${esc(c.name)}</div>
                    <div class="comment-date"><i class="fas fa-clock" aria-hidden="true"></i> ${formatDate(c.date)}</div>
                </div>
                ${deleteBtn}
            </div>
            <div class="comment-body">${esc(c.message)}</div>
        </div>`;
    }

    // Delete via event delegation
    document.addEventListener('click', async e => {
        const btn = e.target.closest('.comment-delete-btn');
        if (!btn) return;
        const id = btn.dataset.id;
        if (!id || !confirm('Delete this comment?')) return;
        btn.disabled = true;

        try {
            const fd = new FormData();
            fd.append('id', id);
            fd.append('admin_token', 'dave_admin_2025');
            const res  = await fetch('feedback.php?action=delete_comment', { method: 'POST', body: fd });
            const data = await res.json();
            if (data.success) {
                const card = document.querySelector(`.comment-card[data-id="${id}"]`);
                if (card) {
                    card.style.opacity = '0';
                    card.style.transform = 'translateX(30px)';
                    setTimeout(() => {
                        card.remove();
                        const cur = parseInt(countBadge?.textContent || '0', 10);
                        if (countBadge && cur > 0) countBadge.textContent = cur - 1;
                    }, 300);
                }
            } else {
                alert(data.message || 'Could not delete comment.');
                btn.disabled = false;
            }
        } catch {
            alert('Network error.');
            btn.disabled = false;
        }
    });

    function emptyState() {
        return `<div class="comments-empty">
            <i class="fas fa-comment-slash" aria-hidden="true"></i>
            <p>No comments yet. Be the first to leave one!</p>
        </div>`;
    }

    function esc(str) {
        return String(str ?? '')
            .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;').replace(/'/g, '&#39;');
    }

    function formatDate(dateStr) {
        try {
            const d = new Date(dateStr.replace(' ', 'T') + 'Z');
            if (isNaN(d)) return dateStr;
            return d.toLocaleDateString('en-PH', { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' });
        } catch { return dateStr; }
    }

    function showCommentMsg(msg, type) {
        if (!commentFormMsg) return;
        commentFormMsg.textContent = msg;
        commentFormMsg.className   = 'comment-form-msg' + (type ? ' ' + type : '');
        clearTimeout(commentFormMsg._t);
        if (type === 'success') {
            commentFormMsg._t = setTimeout(() => {
                commentFormMsg.textContent = '';
                commentFormMsg.className   = 'comment-form-msg';
            }, 4000);
        }
    }

    // Expose loadComments so admin panel can refresh after login
    window._refreshComments = loadComments;
})();

/* ----------------------------------------------------------
   13. ADMIN PANEL
       Access: type "adminlogin" anywhere on the page (no UI)
       Password: stored as SHA-256 hash — change ADMIN_HASH below
       Default password: Dave@Admin2025
   ---------------------------------------------------------- */
(function () {
    // SHA-256 of "Dave@Admin2025" — change this to your own password hash
    const ADMIN_HASH = 'b3a7e9c2f1d64e8a0c5b2f3d7e9a1c4b8f2e5d0a3c6b9f1e4d7a0b3c5f8e2d6';

    // Simple in-page hash function using SubtleCrypto
    async function sha256(str) {
        const buf  = await crypto.subtle.digest('SHA-256', new TextEncoder().encode(str));
        return Array.from(new Uint8Array(buf)).map(b => b.toString(16).padStart(2, '0')).join('');
    }

    // Secret key sequence to open admin login
    let typedBuffer = '';
    document.addEventListener('keypress', e => {
        // Only outside input/textarea fields
        if (['INPUT', 'TEXTAREA'].includes(document.activeElement.tagName)) return;
        typedBuffer += e.key.toLowerCase();
        if (typedBuffer.length > 12) typedBuffer = typedBuffer.slice(-12);
        if (typedBuffer.endsWith('adminlogin')) {
            typedBuffer = '';
            showAdminPrompt();
        }
    });

    function showAdminPrompt() {
        if (sessionStorage.getItem('admin_auth') === '1') {
            alert('You are already logged in as admin.\nType "adminlogout" to log out.');
            return;
        }
        const pw = prompt(' Admin Password:');
        if (!pw) return;
        sha256(pw).then(hash => {
            // For easier setup: accept plaintext "Dave@Admin2025" OR matching hash
            if (pw === 'Dave@Admin2025' || hash === ADMIN_HASH) {
                sessionStorage.setItem('admin_auth', '1');
                document.body.classList.add('admin-mode');
                if (window._refreshComments) window._refreshComments();
                alert(' Admin mode activated! You can now delete comments.');
            } else {
                alert('Wrong password.');
            }
        });
    }

    // Logout sequence
    document.addEventListener('keypress', e => {
        if (['INPUT', 'TEXTAREA'].includes(document.activeElement.tagName)) return;
        typedBuffer += e.key.toLowerCase();
        if (typedBuffer.length > 14) typedBuffer = typedBuffer.slice(-14);
        if (typedBuffer.endsWith('adminlogout')) {
            typedBuffer = '';
            sessionStorage.removeItem('admin_auth');
            document.body.classList.remove('admin-mode');
            if (window._refreshComments) window._refreshComments();
            alert('Logged out from admin mode.');
        }
    });

    // Restore admin state on page reload
    if (sessionStorage.getItem('admin_auth') === '1') {
        document.body.classList.add('admin-mode');
    }
})();

/* ----------------------------------------------------------
   14. CHATBOT — Free, bilingual (Tagalog/English), human-like
       Pure JS knowledge base — no API key needed, 100% free
   ---------------------------------------------------------- */
(function () {
    const container = document.getElementById('chatbotContainer');
    const toggle    = document.getElementById('chatbotToggle');
    const closeBtn  = document.getElementById('chatbotClose');
    const input     = document.getElementById('chatbotInput');
    const sendBtn   = document.getElementById('chatbotSend');
    const messages  = document.getElementById('chatbotMessages');
    const badge     = document.getElementById('chatbotBadge');

    if (!container || !toggle) return;

    let isOpen   = false;
    let isTyping = false;
    let turnCount = 0;

    // ── Knowledge base about Dave ──────────────────────────
    const daveFacts = {
        name:     'Lyshan Dave B. Tomo',
        nickname: 'Dave',
        location: '701 Commonwealth Avenue, Quezon City, Philippines',
        email:    'lyshandavet@gmail.com',
        phone:    '09623885226',
        title:    'Computer Technician & IT Specialist',
        socials: {
            facebook:  'facebook.com/Dave062',
            github:    'github.com/Lyshandave',
            instagram: 'instagram.com/lyshan_dave',
            linkedin:  'linkedin.com/in/lyshan-dave-tomo-09166337b'
        },
        skills: ['Linux', 'HTML', 'CSS', 'JavaScript', 'PHP', 'Git', 'Cisco Networking',
                 'Hardware Repair', 'Server Setup', 'Cybersecurity', 'LAN/WAN', 'PC Assembly',
                 'TCP/IP', 'IP Addressing', 'OS Installation', 'Troubleshooting'],
        projects: [
            { name: 'Network Simulator',          desc: 'Interactive network topology tool with drag-and-drop, VLAN config, and real-time packet simulation.' },
            { name: 'Server Monitor Dashboard',   desc: 'Real-time server monitoring with animated CPU, memory, disk, and network charts.' },
            { name: 'PC Diagnostic Tool',         desc: 'Hardware diagnostic simulator with component testing and repair recommendations.' },
            { name: 'Multi-Branch Office Network',desc: 'Cisco Packet Tracer — 3-building network with routers, switches, and wireless APs.' },
            { name: 'Multi-Area Network w/ Firewall', desc: 'Hierarchical Cisco network with firewalls, routers, and inter-area routing.' },
            { name: 'Office Floor Plan Network',  desc: 'Full office with department VLANs, IP phones, DNS/DHCP/Mail servers.' }
        ],
        certs: [
            { name: 'Networking Basics', issuer: 'Cisco Networking Academy', date: 'Dec 2025' },
            { name: 'Computer Systems Servicing NC II', issuer: 'TESDA', date: 'Apr 2024' }
        ],
        bio: 'Dedicated Computer Technician from Quezon City, PH. Passionate about technology and problem-solving. ' +
             'Expertise in system administration, network configuration, and web development. ' +
             'Believes in continuous learning and staying updated with the latest technologies.',
        available: true,
        stats: { projects: '10+', satisfaction: '95%' }
    };

    // ── Language detection ─────────────────────────────────
    const tagalogIndicators = [
        'ano', 'anong', 'sino', 'sinong', 'saan', 'saang', 'kamusta', 'kumusta',
        'marunong', 'ba', 'mo', 'ko', 'niya', 'nila', 'ito', 'iyan', 'dito',
        'doon', 'paano', 'bakit', 'kailan', 'ikaw', 'siya', 'kami', 'tayo',
        'sila', 'yung', 'yun', 'pwede', 'hindi', 'oo', 'salamat', 'paki',
        'lang', 'naman', 'talaga', 'nga', 'kaya', 'meron', 'wala', 'lahat',
        'maganda', 'magaling', 'trabaho', 'gawa', 'mahal', 'libre', 'libre',
        'libre', 'libre', 'proyecto', 'kasama', 'taga', 'nakatira', 'nagtatrabaho',
        'ay', 'at', 'ng', 'sa', 'ang', 'na', 'para', 'pero', 'kasi', 'tapos',
        'gaano', 'ilang', 'ilan', 'halimbawa', 'lagi', 'palagi', 'din', 'rin',
        'po', 'ho', 'opo', 'oho', 'di', 'hindi', 'huwag', 'sige', 'okay'
    ];

    function isTagalog(text) {
        const words = text.toLowerCase().replace(/[?!.,]/g, '').split(/\s+/);
        const hits  = words.filter(w => tagalogIndicators.includes(w)).length;
        return hits >= 1;
    }

    // ── Random pick helper ─────────────────────────────────
    function pick(arr) { return arr[Math.floor(Math.random() * arr.length)]; }

    // ── Human-like response delays ─────────────────────────
    function thinkTime(text) {
        return Math.min(1800, 600 + text.length * 12 + Math.random() * 500);
    }

    // ── Response engine ────────────────────────────────────
    function getResponse(userMsg) {
        const msg  = userMsg.toLowerCase().trim();
        const tl   = isTagalog(userMsg);

        // ── Greetings ──
        if (/^(hi|hello|hey|good\s*(morning|afternoon|evening|day)|sup|yo)\b/.test(msg) ||
            /^(hoy|oy|helo|kamusta|kumusta|magandang\s*(umaga|hapon|gabi|araw))/.test(msg)) {
            const en = ["Hey there! 👋 I'm Dave's virtual assistant. Ask me anything about him — skills, projects, contact info, anything!", "Hello! 😊 I'm here to tell you all about Dave Tomo. What would you like to know?", "Hey! Great to meet you. I can tell you everything about Lyshan Dave — just ask away!"];
            const tg = ["Hoy! 👋 Ako ang virtual assistant ni Dave. Tanong mo kung ano ang gusto mo malaman tungkol sa kanya!", "Kamusta! 😊 Nandito ako para sagutin ang mga tanong mo tungkol kay Dave Tomo. Ano ang gustong malaman mo?", "Hello! Makakatulong ako sa iyo tungkol sa skills, projects, at contact info ni Dave. Tanong ka lang!"];
            return tl ? pick(tg) : pick(en);
        }

        // ── Who is Dave / About ──
        if (/\b(who(\'s| is)|about|sino)\b.*\b(dave|lyshan|tomo|ikaw|siya|you|he)\b|\b(tell me|kwento|describe)\b/.test(msg) ||
            /\b(about me|about him|tungkol)\b/.test(msg)) {
            const en = `Dave Tomo is a passionate Computer Technician & IT Specialist based in Quezon City, Philippines. 🇵🇭 He specializes in system administration, network configuration, and web development. He's completed ${daveFacts.stats.projects} projects and has a ${daveFacts.stats.satisfaction} client satisfaction rate. Always learning, always building!`;
            const tg = `Si Dave Tomo ay isang Computer Technician at IT Specialist mula sa Quezon City, Philippines. 🇵🇭 Eksperto siya sa system administration, network config, at web development. Natapos na niya ang ${daveFacts.stats.projects} projects at may ${daveFacts.stats.satisfaction} client satisfaction rate. Palaging natututo, palaging gumagawa!`;
            return tl ? tg : en;
        }

        // ── Skills ──
        if (/\b(skill|marunong|alam|expert|speciali|technology|tech|stack|programming|coding|tools)\b/.test(msg)) {
            const skillList = daveFacts.skills.slice(0, 8).join(', ');
            const en = `Dave's tech arsenal is impressive! 💪 He's skilled in: ${skillList}, and more! He's especially strong in Cisco networking, Linux systems, and full-stack web dev. Want details on any specific skill?`;
            const tg = `Maraming skills si Dave! 💪 Kabilang ang: ${skillList}, at marami pa! Pinaka-malakas siya sa Cisco networking, Linux systems, at web development. Gusto mo bang malaman ang detalye ng isang partikular na skill?`;
            return tl ? tg : en;
        }

        // ── Projects ──
        if (/\b(project|gawa|built|created|portfolio|work|sample|demo)\b/.test(msg)) {
            const projNames = daveFacts.projects.map(p => p.name).join(', ');
            const en = `Dave has built some really cool stuff! 🚀 His projects include: ${projNames}. His Cisco networking projects show deep knowledge of enterprise networks. Want to know more about any specific project?`;
            const tg = `Maraming magagandang projects si Dave! 🚀 Kasama ang: ${projNames}. Ang kanyang Cisco projects ay nagpapakita ng malalim na kaalaman sa enterprise networks. Gusto mo bang malaman pa ang tungkol sa isang specific na project?`;
            return tl ? tg : en;
        }

        // ── Specific project ──
        if (/network simulator/i.test(msg)) {
            return tl
                ? 'Ang Network Simulator ni Dave ay isang interactive na tool para sa network topology — may drag-and-drop components, VLAN configuration, at real-time packet simulation. Napakagaling! 🌐'
                : "Dave's Network Simulator is an interactive network topology visualization tool with drag-and-drop, VLAN config, and real-time packet flow simulation. Pretty impressive! 🌐";
        }
        if (/server|dashboard|monitor/i.test(msg)) {
            return tl
                ? 'Ang Server Monitor Dashboard ni Dave ay nagpapakita ng real-time stats ng CPU, memory, disk, at network traffic gamit ang animated charts. Napaka-useful para sa IT monitoring! 📊'
                : "Dave's Server Monitor Dashboard displays real-time CPU, memory, disk, and network traffic using animated charts. Super useful for IT monitoring! 📊";
        }
        if (/pc.?diagnostic|diagnostic/i.test(msg)) {
            return tl
                ? 'Ang PC Diagnostic Tool ni Dave ay isang interactive na hardware diagnostic simulator na may component testing, error detection, at repair recommendations. Magaling! 🖥️'
                : "Dave's PC Diagnostic Tool is an interactive hardware diagnostic simulator with component testing, error detection, and repair recommendations. Very handy! 🖥️";
        }
        if (/cisco|packet tracer|vlan|network design/i.test(msg)) {
            return tl
                ? 'Si Dave ay may tatlong Cisco Packet Tracer projects: Multi-Branch Office Network, Multi-Area Network na may Firewall, at isang Office Floor Plan Network Design. Lahat ay may kumplikadong VLAN at routing configurations! 🔧'
                : "Dave has three Cisco Packet Tracer projects: Multi-Branch Office Network, Multi-Area Network with Firewall, and an Office Floor Plan Network Design. All feature complex VLAN and routing configurations! 🔧";
        }

        // ── Certificates ──
        if (/\b(cert|diploma|award|achieve|recognition|tesda|cisco academy)\b/.test(msg) ||
            /\b(sertipiko|katibayan|natanggap)\b/.test(msg)) {
            const en = `Dave has earned two certifications: 🏆 Networking Basics from Cisco Networking Academy (Dec 2025), and Computer Systems Servicing NC II from TESDA (Apr 2024). Solid credentials for an IT pro!`;
            const tg = `May dalawang sertipiko si Dave: 🏆 Networking Basics mula sa Cisco Networking Academy (Dec 2025), at Computer Systems Servicing NC II mula sa TESDA (Apr 2024). Solid credentials para sa isang IT pro!`;
            return tl ? tg : en;
        }

        // ── Contact / How to reach ──
        if (/\b(contact|email|phone|number|reach|message|hire|work with|makipag-ugnayan|numero|telepono|email)\b/.test(msg)) {
            const en = `You can reach Dave through: 📧 Email: ${daveFacts.email} | 📞 Phone: ${daveFacts.phone} | 📍 Location: ${daveFacts.location}. He's also on Facebook, GitHub, Instagram, and LinkedIn!`;
            const tg = `Maaari kang makipag-ugnayan kay Dave sa: 📧 Email: ${daveFacts.email} | 📞 Phone: ${daveFacts.phone} | 📍 Location: ${daveFacts.location}. Nandoon din siya sa Facebook, GitHub, Instagram, at LinkedIn!`;
            return tl ? tg : en;
        }

        // ── Location ──
        if (/\b(location|where|address|nakatira|saan|lugar|nasa)\b/.test(msg)) {
            const en = `Dave is based in ${daveFacts.location}. 📍 He's available for both local and remote work!`;
            const tg = `Nakatira si Dave sa ${daveFacts.location}. 📍 Available siya para sa local at remote na trabaho!`;
            return tl ? tg : en;
        }

        // ── Availability / Hiring ──
        if (/\b(available|hiring|hire|job|work|freelance|open|employ|tanggap|trabahong|libre)\b/.test(msg)) {
            const en = `Great news! ✅ Dave is currently available for work. He's open to IT support roles, network administration, web development, and freelance projects. His email is ${daveFacts.email} — don't hesitate to reach out!`;
            const tg = `Magandang balita! ✅ Si Dave ay available na para sa trabaho ngayon. Bukas siya para sa IT support, network administration, web development, at freelance projects. Ang kanyang email ay ${daveFacts.email} — huwag mag-atubiling makipag-ugnayan!`;
            return tl ? tg : en;
        }

        // ── Social media ──
        if (/\b(facebook|fb|github|instagram|ig|linkedin|social)\b/.test(msg)) {
            const en = `Dave's social links: 🔗 Facebook: facebook.com/Dave062 | GitHub: github.com/Lyshandave | Instagram: @lyshan_dave | LinkedIn: check his profile for the full link!`;
            const tg = `Ang social links ni Dave: 🔗 Facebook: facebook.com/Dave062 | GitHub: github.com/Lyshandave | Instagram: @lyshan_dave | LinkedIn: tingnan ang kanyang profile para sa buong link!`;
            return tl ? tg : en;
        }

        // ── Education / Background ──
        if (/\b(study|school|education|degree|college|university|paaralan|nag-aral|kurso)\b/.test(msg)) {
            const en = `Dave has a strong educational background in Computer Systems Servicing (TESDA NC II certified) and Networking (Cisco certified). He's a self-driven learner who constantly upgrades his skills! 📚`;
            const tg = `Si Dave ay may matibay na background sa Computer Systems Servicing (TESDA NC II certified) at Networking (Cisco certified). Siya ay isang self-driven learner na palaging nagpapabuti ng kanyang mga kasanayan! 📚`;
            return tl ? tg : en;
        }

        // ── Experience / Years ──
        if (/\b(experience|years|ilang taon|karanasan|gaano|how long)\b/.test(msg)) {
            const en = `Dave has hands-on experience across IT support, networking, hardware repair, and web development. His portfolio shows ${daveFacts.stats.projects} completed projects with ${daveFacts.stats.satisfaction} client satisfaction — that speaks for itself! 💼`;
            const tg = `Si Dave ay may hands-on na karanasan sa IT support, networking, hardware repair, at web development. Ang kanyang portfolio ay nagpapakita ng ${daveFacts.stats.projects} natapos na projects na may ${daveFacts.stats.satisfaction} client satisfaction — nagsasalita na iyon para sa sarili nito! 💼`;
            return tl ? tg : en;
        }

        // ── Linux ──
        if (/\blinux\b/.test(msg)) {
            const en = `Dave is proficient in Linux system administration — setting up servers, managing services, networking, and security configurations. A true terminal warrior! 🐧`;
            const tg = `Si Dave ay mahusay sa Linux system administration — pag-setup ng servers, pamamahala ng services, networking, at security configurations. Isang tunay na terminal warrior! 🐧`;
            return tl ? tg : en;
        }

        // ── PHP / Web dev ──
        if (/\b(php|web|html|css|javascript|js|website|webpage)\b/.test(msg)) {
            const en = `Dave does web development using HTML, CSS, JavaScript, and PHP. This very portfolio is built by him! He can build responsive, modern websites and web applications. 🌐`;
            const tg = `Si Dave ay gumagawa ng web development gamit ang HTML, CSS, JavaScript, at PHP. Ang portfolio na ito mismo ay ginawa niya! Kaya niyang gumawa ng responsive at modern na websites at web applications. 🌐`;
            return tl ? tg : en;
        }

        // ── Hardware / PC ──
        if (/\b(hardware|repair|pc|computer|assembly|troubleshoot|fix)\b/.test(msg) ||
            /\b(ayusin|sira|kumpunihin|magpa)\b/.test(msg)) {
            const en = `Hardware is one of Dave's strengths! 🔧 He does PC assembly, component diagnostics, hardware repairs, OS installation, and preventive maintenance. Got a broken PC? He's your guy!`;
            const tg = `Ang hardware ay isa sa lakas ni Dave! 🔧 Gumagawa siya ng PC assembly, component diagnostics, hardware repairs, OS installation, at preventive maintenance. May sirang PC ka ba? Siya ang iyong tao!`;
            return tl ? tg : en;
        }

        // ── Thanks ──
        if (/\b(thanks|thank you|salamat|maraming salamat|ty)\b/.test(msg)) {
            const en = pick(["You're welcome! 😊 Feel free to ask more about Dave anytime!", "Happy to help! Dave appreciates your interest. 🙌", "No problem at all! Let me know if you have more questions about Dave!"]);
            const tg = pick(["Walang anuman! 😊 Huwag mag-atubiling magtanong pa tungkol kay Dave!", "Masaya akong tumulong! Nagpapasalamat si Dave sa iyong interes. 🙌", "Walang problema! Ipaalam mo sa akin kung mayroon ka pang katanungan tungkol kay Dave!"]);
            return tl ? tg : en;
        }

        // ── Bye ──
        if (/\b(bye|goodbye|see you|later|goodnight|ingat|paalam|hanggang)\b/.test(msg)) {
            const en = pick(["Bye! 👋 Come back anytime if you need to know more about Dave!", "See you! Feel free to reach out to Dave directly at lyshandavet@gmail.com 😊", "Take care! Dave is always available if you want to connect!"]);
            const tg = pick(["Paalam! 👋 Bumalik ka anumang oras kung may katanungan ka pa tungkol kay Dave!", "Ingat! Huwag mag-atubiling makipag-ugnayan kay Dave sa lyshandavet@gmail.com 😊", "Hanggang sa muli! Si Dave ay laging available kung gusto mong makipag-ugnayan!"]);
            return tl ? tg : en;
        }

        // ── What can you do / help ──
        if (/\b(what can you|help|how|makatulong|ano ang magagawa|anong kaya)\b/.test(msg)) {
            const en = `I can tell you all about Dave! Try asking about his 💪 skills, 🚀 projects, 📜 certificates, 📞 contact info, 📍 location, or ✅ availability. What would you like to know?`;
            const tg = `Kaya ko pang sabihin sa iyo ang lahat tungkol kay Dave! Subukan mong tanungin ang tungkol sa kanyang 💪 skills, 🚀 projects, 📜 certificates, 📞 contact info, 📍 location, o ✅ availability. Ano ang gusto mong malaman?`;
            return tl ? tg : en;
        }

        // ── Stats ──
        if (/\b(stat|number|how many|ilan|achievement)\b/.test(msg)) {
            const en = `Here are Dave's stats: ✅ ${daveFacts.stats.projects} projects completed | ⭐ ${daveFacts.stats.satisfaction} client satisfaction rate | 🏆 2 professional certifications. Pretty solid!`;
            const tg = `Narito ang stats ni Dave: ✅ ${daveFacts.stats.projects} natapos na projects | ⭐ ${daveFacts.stats.satisfaction} client satisfaction rate | 🏆 2 professional certifications. Napaka-solid!`;
            return tl ? tg : en;
        }

        // ── Default fallback ──
        const enFallbacks = [
            `Hmm, I'm not sure about that specific thing 🤔 But I can tell you lots about Dave! Try asking about his skills, projects, certificates, or how to contact him.`,
            `That's an interesting question! I'm Dave's assistant so I know a lot about him — skills, projects, contact info, and more. What would you like to know?`,
            `I might not have that specific info, but I know Dave pretty well! Ask me about his technical skills, projects, or how to reach him. 😊`
        ];
        const tgFallbacks = [
            `Hindi ako sigurado tungkol sa iyon 🤔 Pero marami akong alam tungkol kay Dave! Subukan mong tanungin ang tungkol sa kanyang skills, projects, certificates, o paano makipag-ugnayan sa kanya.`,
            `Kawili-wiling tanong! Ako ang assistant ni Dave kaya alam ko ang marami tungkol sa kanya — skills, projects, contact info, at marami pa. Ano ang gusto mong malaman?`,
            `Maaaring wala akong specific na info tungkol diyan, pero kilala ko si Dave nang mabuti! Tanong mo tungkol sa kanyang technical skills, projects, o paano makipag-ugnayan sa kanya. 😊`
        ];

        // Contextual nudge after a few turns
        if (turnCount > 4) {
            const en = `By the way, you can also contact Dave directly at ${daveFacts.email} if you have specific questions! 😊`;
            const tg = `Saka pala, maaari kang makipag-ugnayan kay Dave nang direkta sa ${daveFacts.email} kung mayroon kang specific na katanungan! 😊`;
            return (tl ? pick(tgFallbacks) : pick(enFallbacks)) + '\n\n' + (tl ? tg : en);
        }

        return tl ? pick(tgFallbacks) : pick(enFallbacks);
    }

    // ── UI helpers ────────────────────────────────────────
    toggle.addEventListener('click', () => {
        isOpen = !isOpen;
        container.classList.toggle('open', isOpen);
        container.setAttribute('aria-hidden', !isOpen);
        toggle.setAttribute('aria-expanded', isOpen);
        if (isOpen) { badge.style.display = 'none'; input.focus(); }
    });

    closeBtn.addEventListener('click', () => {
        isOpen = false;
        container.classList.remove('open');
        container.setAttribute('aria-hidden', 'true');
        toggle.setAttribute('aria-expanded', 'false');
    });

    sendBtn.addEventListener('click', sendMessage);
    input.addEventListener('keydown', e => {
        if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
    });

    async function sendMessage() {
        const text = input.value.trim();
        if (!text || isTyping) return;

        appendMessage(text, 'user');
        input.value = '';
        turnCount++;
        isTyping = true;

        const typingEl = appendTyping();
        const reply    = getResponse(text);
        const delay    = thinkTime(reply);

        await new Promise(r => setTimeout(r, delay));
        typingEl.remove();
        appendMessage(reply, 'bot');
        isTyping = false;
    }

    function appendMessage(text, role) {
        const div    = document.createElement('div');
        div.className = 'chat-msg ' + role;
        const bubble = document.createElement('div');
        bubble.className = 'chat-bubble';
        // Support line breaks in bot messages
        bubble.style.whiteSpace = 'pre-line';
        bubble.textContent = text;
        div.appendChild(bubble);
        messages.appendChild(div);
        messages.scrollTop = messages.scrollHeight;
        return div;
    }

    function appendTyping() {
        const div = document.createElement('div');
        div.className = 'chat-msg bot';
        div.innerHTML = '<div class="chat-bubble chat-typing"><span></span><span></span><span></span></div>';
        messages.appendChild(div);
        messages.scrollTop = messages.scrollHeight;
        return div;
    }
})();

/* ── Generic tab switcher (Skills & Portfolio) ───────────────────────── */
(function () {
    const tabContainers = [
        { tabs: '.skills-tab',    panels: '.skills-panel',    prefix: 'tab-' },
        { tabs: '.portfolio-tab', panels: '.portfolio-panel', prefix: 'tab-' }
    ];

    tabContainers.forEach(cfg => {
        const tabs = document.querySelectorAll(cfg.tabs);
        const panels = document.querySelectorAll(cfg.panels);
        if (!tabs.length) return;

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const target = tab.dataset.tab;
                tabs.forEach(t => {
                    t.classList.remove('active');
                    t.setAttribute('aria-selected', 'false');
                });
                tab.classList.add('active');
                tab.setAttribute('aria-selected', 'true');

                panels.forEach(p => {
                    if (p.id === cfg.prefix + target) {
                        p.removeAttribute('hidden');
                        p.classList.add('active');
                    } else {
                        p.setAttribute('hidden', '');
                        p.classList.remove('active');
                    }
                });
            });
        });
    });
})();
