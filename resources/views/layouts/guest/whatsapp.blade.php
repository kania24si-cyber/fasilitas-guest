<!-- ===== FLOATING WHATSAPP BUTTON ===== -->
<style>
    .whatsapp-float {
        position: fixed;
        bottom: 25px;
        right: 25px;
        z-index: 1050;
        width: 60px;
        height: 60px;
        background-color: #25D366;
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
        transition: all 0.3s ease;
        animation: bounceIn 1s;
    }

    .whatsapp-float:hover {
        transform: scale(1.1);
        background-color: #1ebe5d;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }

    .whatsapp-float i {
        font-size: 30px;
    }

    .whatsapp-float.hidden {
        opacity: 0;
        transform: translateY(100px);
        pointer-events: none;
    }

    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: scale(0.3);
        }

        50% {
            opacity: 1;
            transform: scale(1.05);
        }

        70% {
            transform: scale(0.9);
        }

        100% {
            transform: scale(1);
        }
    }

    .whatsapp-tooltip {
        position: fixed;
        bottom: 90px;
        right: 35px;
        background-color: #25D366;
        color: #fff;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 13px;
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.3s ease;
    }

    .whatsapp-float:hover+.whatsapp-tooltip {
        opacity: 1;
        transform: translateY(0);
    }
</style>

<a href="https://wa.me/6282261042427?text=Halo%20BinaDesa!%20Saya%20ingin%20bertanya%20tentang%20aplikasi%20ini."
    class="whatsapp-float hidden" id="whatsappButton" target="_blank" title="Chat via WhatsApp">
    <i class="bi bi-whatsapp"></i>
</a>
<div class="whatsapp-tooltip">Hubungi Saya</div>

<script>
    let lastScrollTop = 0;
    const whatsappBtn = document.getElementById("whatsappButton");

    window.addEventListener("scroll", function () {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop) {
            whatsappBtn.classList.remove("hidden");
        } else {
            whatsappBtn.classList.add("hidden");
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    }, false);
</script>