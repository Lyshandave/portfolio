document.addEventListener("DOMContentLoaded", function () {
  // === CONTACT FORM RESET ===
  const form = document.getElementById("contactForm");
  if (form) {
    form.addEventListener("submit", function () {
      setTimeout(() => {
        form.reset(); // Clear all fields after submit finishes
      }, 100);
    });
  }

  // === SWIPER INIT ===
  if (typeof Swiper !== "undefined" && document.querySelector(".swiper")) {
    new Swiper(".swiper", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      coverflowEffect: {
        rotate: 20,
        stretch: 0,
        depth: 250,
        modifier: 1,
        slideShadows: true,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      slideToClickedSlide: true, // ✅ click card para siya maging front
    });
  }
});