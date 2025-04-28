/**
 * File: custom.js
 * Lokasi: /assets/home/js/custom.js
 * Deskripsi: File JavaScript untuk fungsi kustom website
 */

// Dokumen siap
document.addEventListener("DOMContentLoaded", function () {
	// Fungsi untuk navigasi mobile
	initMobileNav();

	// Fungsi untuk carousel hero
	initHeroCarousel();

	// Fungsi untuk tombol kembali ke atas
	initBackToTop();
});

/**
 * Fungsi untuk navigasi mobile
 */
function initMobileNav() {
	// Dapatkan tombol toggle navigasi mobile
	const mobileNavToggle = document.querySelector(".mobile-nav-toggle");

	if (mobileNavToggle) {
		mobileNavToggle.addEventListener("click", function () {
			const navbar = document.querySelector("#navbar");
			navbar.classList.toggle("navbar-mobile");
			this.classList.toggle("bi-list");
			this.classList.toggle("bi-x");
		});
	}

	// Tangani klik menu dropdown pada perangkat mobile
	const navbarDropdowns = document.querySelectorAll("#navbar .dropdown > a");
	navbarDropdowns.forEach((dropdown) => {
		dropdown.addEventListener("click", function (e) {
			if (
				document.querySelector("#navbar").classList.contains("navbar-mobile")
			) {
				e.preventDefault();
				this.nextElementSibling.classList.toggle("dropdown-active");
			}
		});
	});
}

/**
 * Fungsi untuk carousel hero
 */
// Fungsi untuk carousel hero yang diperbaiki
function initHeroCarousel() {
	// Inisialisasi indikator carousel hero
	const heroCarouselIndicators = document.querySelector(
		"#hero-carousel-indicators"
	);
	const heroCarouselItems = document.querySelectorAll(
		"#heroCarousel .carousel-item"
	);

	if (heroCarouselIndicators && heroCarouselItems.length > 0) {
		// Hapus indikator yang sudah ada
		heroCarouselIndicators.innerHTML = "";

		// Buat indikator baru untuk semua slide
		heroCarouselItems.forEach((item, index) => {
			const indicator = document.createElement("button");
			indicator.type = "button";
			indicator.dataset.bsTarget = "#heroCarousel";
			indicator.dataset.bsSlideTo = index;
			if (index === 0) indicator.classList.add("active");
			indicator.setAttribute("aria-current", index === 0 ? "true" : "false");
			indicator.setAttribute("aria-label", `Slide ${index + 1}`);
			heroCarouselIndicators.appendChild(indicator);
		});
	}

	// Aktifkan carousel dengan Bootstrap 5
	if (typeof bootstrap !== "undefined") {
		const carousel = new bootstrap.Carousel(
			document.querySelector("#heroCarousel"),
			{
				interval: 5000,
				ride: "carousel",
				wrap: true,
			}
		);
	}
}
// Kode untuk memperbaiki carousel dan slider
document.addEventListener("DOMContentLoaded", function () {
	// Inisialisasi carousel indicators
	const heroCarousel = document.querySelector("#heroCarousel");
	if (heroCarousel) {
		const indicators = document.querySelector("#hero-carousel-indicators");
		const slides = heroCarousel.querySelectorAll(".carousel-item");

		if (indicators && slides.length > 0) {
			// Hapus indikator yang sudah ada
			indicators.innerHTML = "";

			// Buat indikator baru
			slides.forEach((_, index) => {
				const button = document.createElement("button");
				button.type = "button";
				button.dataset.bsTarget = "#heroCarousel";
				button.dataset.bsSlideTo = index;
				if (index === 0) button.classList.add("active");
				button.setAttribute("aria-current", index === 0 ? "true" : "false");
				button.setAttribute("aria-label", `Slide ${index + 1}`);
				indicators.appendChild(button);
			});
		}
	}

	// Konfigurasi Swiper untuk product sliders
	if (typeof Swiper !== "undefined") {
		const recentPhotosSlider = new Swiper(".recent-photos-slider", {
			// Perlambat kecepatan transisi untuk efek yang lebih smooth
			speed: 1200, // Nilai lebih tinggi = transisi lebih lambat dan smooth
			loop: true,
			autoplay: {
				delay: 5000, // Waktu jeda antar slide (5 detik)
				disableOnInteraction: false, // Tetap autoplay meski user berinteraksi
				reverseDirection: false, // Pastikan hanya maju (false = maju)
			},
			slidesPerView: "auto",
			// Tambahkan efek transisi yang lebih smooth
			effect: "slide", // Bisa gunakan "fade" juga untuk efek berbeda
			// Tambahkan easing untuk gerakan lebih smooth
			cssMode: false,
			// Untuk sentuhan yang lebih smooth di mobile
			touchRatio: 1,
			longSwipes: true,
			longSwipesRatio: 0.5,
			pagination: {
				el: ".swiper-pagination",
				type: "bullets",
				clickable: true,
				dynamicBullets: true,
			},
			breakpoints: {
				320: {
					slidesPerView: 1,
					spaceBetween: 20,
				},
				768: {
					slidesPerView: 3,
					spaceBetween: 20,
				},
				992: {
					slidesPerView: 4,
					spaceBetween: 20,
				},
			},
		});

		// Sembunyikan pagination bullets
		const paginationElements = document.querySelectorAll(
			".swiper-pagination-bullet"
		);
		paginationElements.forEach(function (element) {
			element.style.display = "none";
		});
	}

	// Perbaikan untuk active link di navbar
	const currentLocation = window.location.pathname;
	const navLinks = document.querySelectorAll("#navbar ul li a");

	navLinks.forEach((link) => {
		link.classList.remove("active");

		// Bandingkan segmen URL untuk highlighting yang tepat
		const linkPath = new URL(link.href, window.location.origin).pathname;

		if (
			(currentLocation === "/" && linkPath === "/") ||
			(currentLocation !== "/" &&
				linkPath !== "/" &&
				currentLocation.includes(linkPath))
		) {
			link.classList.add("active");
		}
	});
});

/**
 * Fungsi untuk tombol kembali ke atas
 */
function initBackToTop() {
	const backToTop = document.querySelector(".back-to-top");

	if (backToTop) {
		window.addEventListener("scroll", () => {
			if (window.scrollY > 100) {
				backToTop.classList.add("active");
			} else {
				backToTop.classList.remove("active");
			}
		});

		backToTop.addEventListener("click", function (e) {
			e.preventDefault();
			window.scrollTo({
				top: 0,
				behavior: "smooth",
			});
		});
	}
}

// Tambahkan ke dalam file custom.js
document.addEventListener("DOMContentLoaded", function () {
	// Add loading class to all menu images initially
	const menuImages = document.querySelectorAll(".menu-img");
	menuImages.forEach((img) => {
		img.classList.add("loading");

		// Remove loading class when image loads successfully
		img.onload = function () {
			this.classList.remove("loading");
		};

		// Handle error with proper class
		img.onerror = function () {
			// Karena di file terpisah, kita tidak bisa menggunakan PHP base_url
			// Gunakan path relatif atau absolute untuk default image
			this.src = "/assets/dataresto/menu/default.jpg";
			this.classList.add("error");
			this.classList.remove("loading");
		};
	});

	// Ensure uniform height after images load
	function adjustCardHeights() {
		const cards = document.querySelectorAll(".menu-card");
		let maxHeight = 0;

		// Reset heights first
		cards.forEach((card) => {
			card.style.height = "auto";
		});

		// Find max height
		cards.forEach((card) => {
			if (card.offsetHeight > maxHeight) {
				maxHeight = card.offsetHeight;
			}
		});

		// Apply uniform height
		cards.forEach((card) => {
			card.style.height = maxHeight + "px";
		});
	}

	// Run height adjustment after images load and on window resize
	window.addEventListener("load", adjustCardHeights);
	window.addEventListener("resize", adjustCardHeights);
});

// Katalog Menu Scripts - Add to custom.js

// Handle Pesan button click for katalog menu
$(document).ready(function () {
	$(".pesan-btn").on("click", function (e) {
		// If disabled, prevent default action
		if ($(this).hasClass("disabled")) {
			e.preventDefault();
			alert("Maaf, stok menu ini sedang kosong");
			return;
		}

		// Get menu ID from the nearest detail link
		const detailLink = $(this).closest(".card").find('a[href*="detail"]');
		const href = detailLink.attr("href");
		const id_menu = href.substring(href.lastIndexOf("/") + 1);

		// Add to cart logic or redirect to order form
		window.location.href = base_url + "katalog/detail/" + id_menu;
	});
});
