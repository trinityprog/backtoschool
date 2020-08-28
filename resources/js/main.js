import { Swiper, Navigation, Autoplay } from 'swiper';
import * as $ from 'jquery';
import Cookies from 'js-cookie';
import Inputmask from 'inputmask';
import Dropzone from 'dropzone';
import * as EmailValidator from 'email-validator';
import * as AOS from 'aos';

window.Dropzone = Dropzone;
window.Dropzone.autoDiscover = false;
// export for others scripts to use
window.$ = $;
window.jQuery = $;
Swiper.use([Navigation, Autoplay]);

require('remodal');
require('paginationjs');

let BreakException = {};

let hero = () => {
    let active = {
        index: 0,
    };
    let proxied = new Proxy(active, {
        set: function(target, prop, value) {
            updateActive(value);
            return Reflect.set(target, prop, value);
        }
    });

    let interval = setInterval(function(){
        proxied.index = proxied.index === 1 ? 0 : 1;
    }, 4000);
    let updateActive = (i) => {
        document.getElementById('hero').dataset.show = i;
        document.querySelectorAll('#hero>.container').forEach((el, index) => {
            if(index !== i ){
                el.classList.remove('active');
            }
            else{
                el.classList.add('active');
            }
        });
    };

    setTimeout(function(){
        proxied.index = 0;

    }, 500);
}
let weeklyPrizes = () => {
    let weeklyPrizes = null;
    let el = document.querySelector('#prizes .weekly .container');
    let onResize = () => {
        if (window.innerWidth < 1100 && !weeklyPrizes) {
            weeklyPrizes = new Swiper(el, {
                navigation: {
                    nextEl: el.querySelector('.swiper-button-next'),
                    prevEl: el.querySelector('.swiper-button-prev'),
                },
                loop: true,
                autoplay: {
                    delay: 3000,
                },
                spaceBetween: window.innerWidth/10,
                slidesPerView: 1,
                centeredSlides: true,
                observer: true,
                observeParents: true,
            });
        }
        if(window.innerWidth >= 1100 && weeklyPrizes){
            weeklyPrizes.destroy(true, true);
            weeklyPrizes = null;
        }
    }
    window.addEventListener('resize', onResize);
    onResize();
}

let header = () => {
    let sections = document.querySelectorAll('section:not(#hero)');
    sections = Array.prototype.slice.call(sections).reverse();
    let hero = document.getElementById('hero');
    let header = document.querySelector('header');
    let links = header.querySelectorAll('a:not(.button)');
    let slide = header.querySelector('.slide');
    let activeLink = {
        el: null
    };

    let proxied = new Proxy(activeLink, {
        get: function(target, prop) {
            // console.log({ type: 'get', target, prop });
            return Reflect.get(target, prop);
        },
        set: function(target, prop, value) {
            // console.log("set", value.getAttribute("href"));
            updateLink(value);
            return Reflect.set(target, prop, value);
        }
    });
    let updateLink = (element) => {
        header.querySelectorAll('a.active').forEach(el => {
            if(el != element){
                el.classList.remove('active')
            }
        });
        if(element){
            element.classList.add('active')
            let r = element.getBoundingClientRect();
            slide.style.width = `${ r.width }px`;
            slide.style.height = `${ r.height }px`;

            slide.style.transform = `translateX(${ r.left }px)`;
            if(window.innerWidth > 1100) {
                slide.style.top = `12px`;
            }
            else{
                slide.style.top = `${ r.top }px`;
            }
        }
    };
    links.forEach( el => {
        el.addEventListener('click', () => {
            header.classList.remove('active');
        });
        el.addEventListener('mouseenter', () => {
            proxied.el = el;
        });

    });
    let onScroll = () => {
        try{
            sections.forEach( section => {
                let r = section.getBoundingClientRect();
                if(r.top <= 1){
                    proxied.el = header.querySelector(`a[href="${ window.location.origin }/#${ section.id }"]`);
                    throw BreakException;
                }
            });
        }catch (e) {
            if (e !== BreakException) throw e;
        }
        let heroRect = hero.getBoundingClientRect();
        let headerPosition = heroRect.top + heroRect.height;
        if(headerPosition > 0){
            header.classList.add('hidden');
            header.style.top = `${ headerPosition }px`;
        }
        else{
            header.classList.remove('hidden');
            header.style.top = '0px';
        }

    };
    onScroll();

    header.querySelector('.burger').addEventListener('click', () => {
        header.classList.contains('active') ? header.classList.remove('active') : header.classList.add('active');
        setTimeout(function(){
            updateLink(proxied.el);
        }, 200);

    });
    window.addEventListener('scroll', onScroll);
    window.addEventListener('resize', function(){
        updateLink(proxied.el);
    });
}

let headerSlim = () => {
    let sections = document.querySelectorAll('section:not(#hero)');
    sections = Array.prototype.slice.call(sections).reverse();
    let hero = document.getElementById('hero');
    let header = document.querySelector('header');
    let links = header.querySelectorAll('a:not(.button)');
    let slide = header.querySelector('.slide');
    let activeLink = {
        el: null
    };

    let proxied = new Proxy(activeLink, {
        get: function(target, prop) {
            // console.log({ type: 'get', target, prop });
            return Reflect.get(target, prop);
        },
        set: function(target, prop, value) {
            // console.log("set", value.getAttribute("href"));
            updateLink(value);
            return Reflect.set(target, prop, value);
        }
    });
    let updateLink = (element) => {
        header.querySelectorAll('a.active').forEach(el => {
            if(el != element){
                el.classList.remove('active')
            }
        });
        if(element){
            element.classList.add('active')
            let r = element.getBoundingClientRect();
            slide.style.width = `${ r.width }px`;
            slide.style.height = `${ r.height }px`;

            slide.style.transform = `translateX(${ r.left }px)`;
            if(window.innerWidth > 1100) {
                slide.style.top = `12px`;
            }
            else{
                slide.style.top = `${ r.top }px`;
            }
        }
    };
    links.forEach( el => {
        el.addEventListener('click', () => {
            header.classList.remove('active');
        });
        el.addEventListener('mouseenter', () => {
            proxied.el = el;
        });

    });


    header.querySelectorAll('.burger, .button').forEach(el => {
        el.addEventListener('click', () => {
            header.classList.contains('active') ? header.classList.remove('active') : header.classList.add('active');
            setTimeout(function(){
                updateLink(proxied.el);
            }, 200);

        });
    });
    window.addEventListener('resize', function(){
        updateLink(proxied.el);
    });
}

let faq = () => {
    let faqs = document.querySelectorAll('#faq .faq');
    let onClick = (e) => {
        let faq = e.target.parentElement;
        faqs.forEach( el => {
            if(faq !== el){
                el.classList.add('hidden')
            }
        });
        faq.classList.contains('hidden') ? faq.classList.remove('hidden') : faq.classList.add('hidden');
    };
    faqs.forEach( el => {
        let answer = el.querySelector('.body');
        let question = el.querySelector('.title');
        answer.style.height = `${ answer.offsetHeight }px`;
        question.addEventListener('click', onClick);
        el.classList.add('hidden');
    });
}

let up = () => {
    let hero = document.getElementById('hero');
    let up = document.getElementById('up');
    let footer = document.querySelector('footer');
    let onScroll = () => {
        let heroRect = hero.getBoundingClientRect(), heroBottom = heroRect.top + heroRect.height;
        let footerRect = footer.getBoundingClientRect();
        let upPosition = window.innerHeight - footerRect.top;
        heroBottom > 0 ? up.classList.remove('active') : up.classList.add('active');
        up.style.bottom = `${ upPosition > 0 ? (upPosition ) : 0 }px`;
    };
    onScroll();
    window.addEventListener('scroll', onScroll);
}

let phoneMaskInit = () => {
    let im = new Inputmask("+374 99 99 99 99");
    document.querySelectorAll('input[type="tel"]').forEach( el => {
        im.mask(el);
    });

}


let dropzoneInit = () => {
    let table = document.querySelector('.table .body');
    let messageBox = document.querySelector('.dz-message');

    let message = messageBox.querySelector('span');
    let sendButton = document.querySelector('.box .button');
    let wrongFormat = "Неправильный формат файла!",
        moreThanOne = "Вы не можете загрузить больше 1 файла",
        selected = "Вы выбрали файл. <br>Нажмите кнопку «загрузить чек»<br> для завершения.",
        loading = "Загрузка...",
        initial = message.innerHTML;

    let type = document.querySelector('meta[name="type"]').getAttribute('content');
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let lang = document.querySelector('meta[name="language"]').getAttribute('content');


    let dropzone = new Dropzone("#dropzone", {
        url: '/checks',
        paramName: 'photo',
        autoProcessQueue: false,
        maxFiles: 1,
        resizeWidth: 1000,
        acceptedFiles: '.png, .jpg, .jpeg',
        createImageThumbnails: false,
        headers: { 'X-CSRF-TOKEN': token },
        accept: function(file, done){
            message.innerHTML = selected;
            sendButton.classList.remove('disabled');
            done();
        },
        sending: function(file, xhr, formData){
            formData.append('type', type);
            message.innerHTML = loading;
        },
        success: function(file, response){
            $('.remodal[data-remodal-id="check-success"]').remodal().open();
            messageBox.classList.remove('error');
            message.innerHTML = initial;
            sendButton.classList.add('disabled')
            this.removeAllFiles();
            let row = document.createElement('div');
            row.classList.add('row');
            row.innerHTML = `<div class="column">${ response.check.created_at }</div> <div class="column"><a href="${ window.location }/i/${ response.check.photo }" target="_blank" class="link">посмотреть фото</a></div>`;
            table.prepend(row);
            table.querySelector('.empty.row').remove();
        },
        error: function(file, errorMessage){
            message.innerHTML = initial;
            sendButton.classList.add('disabled')
            this.removeAllFiles();
        }
    });

    sendButton.addEventListener('click', function(e){
        e.preventDefault();
        dropzone.processQueue();
    });
}

let ageFilterInit = () => {
    let ageFilter = $('[data-remodal-id="ageFilter"]').remodal({ closeOnOutsideClick: false, hashTracking: false });

    let cookie = parseInt(Cookies.get('mature'));

    if(cookie === 1 && window.location.pathname != "/restricted" ||
        cookie === 0 && window.location.pathname == "/restricted") {
    }
    else if(cookie === 1 && window.location.pathname == "/restricted") {
        window.open("/", "_self");
    }
    else if(cookie === 0 && window.location.pathname != "/restricted") {
        ageFilter.open();
    }
    else {
        ageFilter.open();
    }

    let remodal = document.querySelector('[data-remodal-id="ageFilter"]');
    remodal.querySelectorAll('.button').forEach( el => {
        el.addEventListener('click', function(){
            let value = parseInt(el.dataset.value);
            Cookies.set('mature', value);
            if(value === 1){
                ageFilter.close();
            }
            else{
                window.open("/restricted", "_self");
            }
        });
    });

    remodal.querySelector('.toggle').addEventListener('click', function(){
        remodal.classList.contains('active') ? remodal.classList.remove('active') : remodal.classList.add('active');
    });
}

let inputsInit = () => {
    document.querySelectorAll('input,textarea').forEach( el => {
        el.addEventListener('change', function(){
            let value = el.value;
            let type = el.type;
            let validated = false;
            if(type == 'tel'){
                value = value.replace(/[\s_]/g, "");
                if(value.length == 12){
                    validated = true;
                } else {
                    el.value = "";
                }
            }
            else if( type == 'email'){
                validated = EmailValidator.validate(value);
            }
            else if(type == 'text'){
                if(value.length >= 2){
                    validated = true;
                }
            }
            else if(el.tagName == 'textarea'){
                if(value.length >= 10){
                    validated = true;
                }
            }
            else{
                return;
            }

            validated ? el.parentElement.classList.add('validated') : el.parentElement.classList.remove('validated');
        });
    });
}

let tableToggleInit = () => {
    let wrapper = document.querySelector('.table-wrapper');
    let button = wrapper.querySelector(' .toggle');

    button.addEventListener('click', () => {
        wrapper.classList.contains('active') ?  wrapper.classList.remove('active') : wrapper.classList.add('active');
    });
}

let dropzoneToggleInit = () => {
    let wrapper = document.querySelector('.dropzone-wrapper');
    let button = wrapper.querySelector(' .toggle');

    button.addEventListener('click', () => {
        wrapper.classList.contains('active') ?  wrapper.classList.remove('active') : wrapper.classList.add('active');
    });
}

let winnersInit = () => {
    let container = document.querySelector('#winners .table .body');
    let paginator = $('#winners .table');

    let paginatorInit = (phone = '') => {
        if(paginator.destroy){
            paginator.destroy();
        }
        paginator = paginator.pagination({
            dataSource: function(done) {
                $.ajax({
                    type: 'GET',
                    url: '/winners',
                    data: {
                        phone : phone,
                    },
                    success: function(response) {
                        done(response);
                    }
                });
            },
            pageSize: 8,
            prevText: '',
            nextText: '',
            callback: function(data, pagination) {
                let html = '';
                data.forEach(el => {
                    html += `
                    <div class="row">
                        <div class="column">${ el.phone.substring(0, 6) } XXXXX${ el.phone.substring(12) }</div>
                        <div class="column">${ el.city }</div>
                        <div class="column">${ el.prize }</div>
                    </div>`;
                });

                if(data.length < 8){
                    html += '<div class="row"></div>'.repeat( 8 - data.length);
                }
                container.innerHTML = html;
                if(pagination.totalNumber / 8 < 1){
                    document.querySelector('#winners .paginationjs').classList.add('hidden');
                }
                else{
                    document.querySelector('#winners .paginationjs').classList.remove('hidden');
                }
            }
        })
    }
    document.querySelector('#winners .form .button').addEventListener('click', () => {
        paginatorInit(document.querySelector('input[name="search"]').value);
    });
    paginatorInit();

}




window.index = () => {
    hero();
    weeklyPrizes();
    header();
    faq();
    up();
    winnersInit();
    ageFilterInit();
    AOS.init();
}

window.profile = () => {
    dropzoneInit();
    headerSlim();
    tableToggleInit();
    ageFilterInit();
}

document.addEventListener('DOMContentLoaded', () => {
    phoneMaskInit();
    inputsInit();
});
