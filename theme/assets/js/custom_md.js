document.addEventListener("DOMContentLoaded", () => {
  const slides = document.querySelectorAll(".md-hero-slider li");
  const navLinks = document.querySelectorAll("a[data-no]");
  const modal = document.getElementById("imageModal");
  const modalImage = document.getElementById("modalImage");
  const closeModalBtn = document.getElementById("closeModal");
  const navbar = document.querySelector("nav");
  const footer = document.querySelector("footer");
  let currentPage = 1;

  const setActiveLink = (currentNo) => {
    navLinks.forEach((link) => {
      const no = link.getAttribute("data-no");
      if (no === currentNo) {
        link.classList.add("text-pink-500", "font-bold");
        link.classList.remove("text-black");
      } else {
        link.classList.remove("text-pink-500", "font-bold");
        link.classList.add("text-black");
      }
    });
  };

  const getOffset = () => (window.innerWidth >= 992 ? 120 : 80);

  const calculateTotalPageHeight = (contentHeight, offset) =>
    15 + navbar.offsetHeight + contentHeight + offset + footer.offsetHeight;

  const setSlideHeight = (pageNo) => {
    if (pageNo === currentPage) return;

    const currentSlide = slides[currentPage - 1];
    const nextSlide = slides[pageNo - 1];
    const targetContent = document.querySelector(`[data-page-no="${pageNo}"]`);

    currentSlide.classList.remove("selected");
    currentSlide.classList.add("move-left");
    nextSlide.classList.remove("move-left");
    nextSlide.classList.add("selected");

    setTimeout(() => {
      if (!targetContent) return;

      imagesLoaded(targetContent, () => {
        const pageContentHeight = targetContent.offsetHeight;
        const offset = getOffset();
        const totalHeight = calculateTotalPageHeight(pageContentHeight, offset);
        nextSlide.style.minHeight = `${totalHeight}px`;
        currentPage = pageNo;
        setActiveLink(pageNo.toString());
      });
    }, 100);
  };

  const setNavGapPadding = () => {
    const navHeight = navbar.offsetHeight;
    const extra = 40;
    document.querySelectorAll(".nav_gap").forEach((el) => {
      el.style.paddingTop = `${navHeight + extra}px`;
    });
  };

  const setBottomPadding = () => {
    const padding = window.innerWidth < 768 ? 80 : 0;
    document
      .querySelectorAll(".md-hero-slider [data-page-no] .flex")
      .forEach((el) => {
        el.style.paddingBottom = `${padding}px`;
      });
  };

  const openModal = (imgSrc) => {
    modalImage.src = imgSrc;
    modal.classList.remove("hidden");
  };

  const closeModal = () => {
    modal.classList.add("hidden");
    modalImage.src = "";
  };

  const init = () => {
    slides.forEach((slide) => slide.classList.remove("selected", "move-left"));
    slides[0].classList.add("selected");
    setSlideHeight(1);
    document.body.classList.add("loaded");
    setNavGapPadding();
    setBottomPadding();
  };

  navLinks.forEach((link) => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      const pageNo = Number(link.dataset.no);
      if (window.innerWidth < 1024) {
        document.getElementById("dmNavbar")?.classList.add("hidden");
      }
      setSlideHeight(pageNo);
    });
    // console.log("Navbar exists?", document.getElementById("dmNavbar"));
  });

  document.querySelectorAll(".view-more").forEach((link) => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      openModal(link.dataset.img);
    });
  });

  closeModalBtn?.addEventListener("click", closeModal);
  modal?.addEventListener("click", (e) => {
    if (e.target === modal) closeModal();
  });

  window.addEventListener("resize", () => {
    setSlideHeight(currentPage);
    setNavGapPadding();
    setBottomPadding();
  });

  window.addEventListener("load", init);
});

// -------------------------------------------------------------------

document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".dropdown-menu a").forEach((link) => {
    link.addEventListener("click", () => {
      const dropdown = link.closest(".dropdown-menu");
      if (dropdown) {
        dropdown.classList.add("opacity-0", "scale-95", "pointer-events-none");
        dropdown.classList.remove(
          "opacity-100",
          "scale-100",
          "pointer-events-auto"
        );
      }
    });
  });
});
// -------------------------------------------------------------------

document.addEventListener("DOMContentLoaded", () => {
  const parents = document.querySelectorAll(".nav-item.menu-item-has-children");

  parents.forEach((parent) => {
    const trigger = parent.querySelector("a");
    const submenu = parent.querySelector(".dropdown-menu");

    if (trigger && submenu) {
      parent.addEventListener("mouseenter", () => {
        submenu.classList.remove(
          "opacity-0",
          "scale-95",
          "pointer-events-none"
        );
        submenu.classList.add(
          "opacity-100",
          "scale-100",
          "pointer-events-auto"
        );
      });

      parent.addEventListener("mouseleave", () => {
        submenu.classList.add("opacity-0", "scale-95", "pointer-events-none");
        submenu.classList.remove(
          "opacity-100",
          "scale-100",
          "pointer-events-auto"
        );
      });
    }
  });
});
// -------------------------------------------------------------------
document.addEventListener("DOMContentLoaded", function () {
  const toggles = document.querySelectorAll('[data-toggle="dropdown"]');

  toggles.forEach(function (toggle) {
    toggle.addEventListener("click", function (e) {
      const dropdown = toggle.nextElementSibling;

      if (window.innerWidth <= 1024) {
        e.preventDefault();

        document.querySelectorAll(".dropdown-menu").forEach((menu) => {
          if (menu !== dropdown) {
            menu.classList.add("hidden");
          }
        });

        dropdown.classList.toggle("hidden");
      }
    });
  });

  document.addEventListener("click", function (e) {
    const isToggle = e.target.closest('[data-toggle="dropdown"]');
    const isDropdown = e.target.closest(".dropdown-menu");

    if (!isToggle && !isDropdown) {
      document.querySelectorAll(".dropdown-menu").forEach((menu) => {
        menu.classList.add("hidden");
      });
    }
  });
});
