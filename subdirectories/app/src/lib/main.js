// import { getCookie, setCookie, deleteCookie } from 'svelte-cookie';
import axios from "axios";
import { writable } from "svelte/store";
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

export const API_URL = 'https://inova.ir/api';

// export let USER = writable('working');

export function loginUser(token){
    // document.setCookie('api_token' , token);
    // setCookie('api_token' , token);
    document.cookie = `api_token=${token}`;

}

export async function getUser(token){
    
    // console.log(token);
    if(token){
        await axios.get(`${API_URL}/getUser` , {headers: {Authorization:`Bearer ${token}`}})
        .then(function(response){
            USER = response.data.data;
            // USER.set(response.data.data) ;
            // console.log('main' , $USER);

        }).catch(function(error){
            console.log(error);
            USER = null;
        })
    }
}

export let USER;
// export const test2 = writable('یچیزی');

export function getCookie(cname) {
    let name = cname + '=';
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return '';
}
export function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

export function makeSlider(s, p = null, n = null) {
    const slider = s;
    console.log(slider , 'd');
    // const prevSlide = document.querySelector(p);
    // const nextSlide = document.querySelector(n);
    // if (!(p == null || s == null)) {
    //   prevSlide.addEventListener("click", () => {
    //     slider.style.scrollBehavior = "smooth";
    //     slider.scrollBy(-300, 0);
    //     slider.style.scrollBehavior = "unset";
    //   });
    //   nextSlide.addEventListener("click", () => {
    //     slider.style.scrollBehavior = "smooth";
    //     slider.scrollBy(300, 0);
    //     slider.style.scrollBehavior = "unset";
    //   });
    // }
    slider.style.cursor = "grab";
    let pos = { top: 0, left: 0, x: 0, y: 0 };
    const mouseDownHandler = function (e) {
      slider.style.cursor = "grabbing";
      slider.style.userSelect = "none";
      pos = {
        left: slider.scrollLeft,
        top: slider.scrollTop,
        x: e.clientX,
        y: e.clientY,
      };
      document.addEventListener("mousemove", mouseMoveHandler);
      document.addEventListener("mouseup", mouseUpHandler);
    };
    const mouseMoveHandler = function (e) {
      const dx = e.clientX - pos.x;
      const dy = e.clientY - pos.y;
      slider.scrollTop = pos.top - dy;
      slider.scrollLeft = pos.left - dx;
    };
    const mouseUpHandler = function () {
      slider.style.cursor = "grab";
      slider.style.removeProperty("user-select");
      document.removeEventListener("mousemove", mouseMoveHandler);
      document.removeEventListener("mouseup", mouseUpHandler);
    };
    slider.addEventListener("mousedown", mouseDownHandler);
  }


export async function deleteScore(id){
  const api_token = getCookie('api_token');
  await axios.delete(`${API_URL}/deleteScore/${id}` , {headers: {Authorization:`Bearer ${api_token}`}})
  .then(function(response){
      return response.data;
  })
}

export let YEARS = [];
for (let i =1402; i>1300; i--){
	YEARS.push(i);
}