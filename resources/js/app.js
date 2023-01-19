import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import { translations } from "./translations";
import AOS from "aos";
import Swiper, { Navigation } from "swiper";
Swiper.use([Navigation]);

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    progress: { color: "#fbbf24" },
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({
            render: () => h(App, props),
            mounted() {
                AOS.init({
                    once: true,
                    disable: "phone",
                    duration: 700,
                    easing: "ease-out-cubic",
                });
                const carouselEl = document.querySelectorAll(".carousel");
                if (carouselEl.length > 0) {
                    const carousel = new Swiper(".carousel", {
                        slidesPerView: "auto",
                        grabCursor: true,
                        loop: false,
                        centeredSlides: false,
                        initialSlide: 0,
                        spaceBetween: 24,
                        watchSlidesProgress: true,
                        navigation: {
                            nextEl: ".carousel-next",
                            prevEl: ".carousel-prev",
                        },
                    });
                }

                const clientsEl =
                    document.querySelectorAll(".clients-carousel");
                if (clientsEl.length > 0) {
                    const clients = new Swiper(".clients-carousel", {
                        slidesPerView: "auto",
                        spaceBetween: 16,
                        centeredSlides: true,
                        loop: true,
                        speed: 5000,
                        noSwiping: true,
                        noSwipingClass: "swiper-slide",
                        autoplay: {
                            delay: 0,
                            disableOnInteraction: true,
                        },
                    });
                }
            },
        })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .mixin(translations)
            .mount(el);
    },
});
