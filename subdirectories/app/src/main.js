export function loading(el){
    let prevInner = el.innerHTML;
    el.disabled = true;
    el.innerHTML = '<span class="loading loading-dots loading-md"></span>';
    el.style.filter = 'saturate(0.5)';
    return prevInner;
}
export function closeLoading(el , text){
    el.innerHTML = text;
    el.style.filter = 'saturate(1)';
    el.disabled = false;
}
// export function MakeSlider(s, p = null, n = null) {
//     const slider = document.querySelector(s);
//     const prevSlide = document.querySelector(p);
//     const nextSlide = document.querySelector(n);
//     if (!(p == null || s == null)) {
//         prevSlide.addEventListener("click", () => {
//             slider.style.scrollBehavior = "smooth";
//             slider.scrollBy(-screen.width, 0);
//             slider.style.scrollBehavior = "unset";
//         });
//         nextSlide.addEventListener("click", () => {
//             slider.style.scrollBehavior = "smooth";
//             slider.scrollBy(screen.width, 0);
//             slider.style.scrollBehavior = "unset";
//         });
//     }
//     slider.style.cursor = "grab";
//     let pos = { top: 0, left: 0, x: 0, y: 0 };
//     const mouseDownHandler = function (e) {
//         slider.style.cursor = "grabbing";
//         slider.style.userSelect = "none";
//         pos = {
//             left: slider.scrollLeft,
//             top: slider.scrollTop,
//             x: e.clientX,
//             y: e.clientY,
//         };
//         document.addEventListener("mousemove", mouseMoveHandler);
//         document.addEventListener("mouseup", mouseUpHandler);
//     };
//     const mouseMoveHandler = function (e) {
//         const dx = e.clientX - pos.x;
//         const dy = e.clientY - pos.y;
//         slider.scrollTop = pos.top - dy;
//         slider.scrollLeft = pos.left - dx;
//     };
//     const mouseUpHandler = function () {
//         slider.style.cursor = "grab";
//         slider.style.removeProperty("user-select");
//         document.removeEventListener("mousemove", mouseMoveHandler);
//         document.removeEventListener("mouseup", mouseUpHandler);
//     };
//     slider.addEventListener("mousedown", mouseDownHandler);
// }


export const API_URL = 'https://api.twelvethunder.com/api';
