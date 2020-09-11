<?php
return [
    'not_magnum' => 'купил не в magnum?',
    'rules' => 'ПОЛНЫЕ ПРАВИЛА',
    'actions' => [
        'upload' => 'загрузить чек',
        'send' => 'отправить',
        'up' => 'Вернуться наверх',
        'register_check' => 'Зарегистрировать чек',
        'register' => 'Зарегистрировать'
    ],
    'form' => [
        'name' => 'Имя',
        'email' => 'E-mail',
        'phone' => 'Телефон',
        'question' => 'Напиши свой вопрос...',
        'city' => 'Город',
        'prize' => 'Приз',
        'search' => 'Поиск по номеру телефона',
    ],

    'hero' => [
        'top' => [
            'magnum' => 'Во всех магазинах торговой сети MAGNUM <br>с 01.09.2020 по 16.09.2020',
            'small' => 'Во всех магазинах торговой сети Small&Skif <br>с 31.08.2020 по 11.10.2020'
        ],
        'containers' => '
        <div class="container column">
            <div class="text header huge impact">На учебу</div>
            <div class="text header huge impact yellow">зарядись!</div>
        </div>
        <div class="container column">
            <div class="text header huge impact">лови <span class="text yellow">крутые</span></div>
            <div class="text header huge impact yellow">призы!</div>
        </div>',

    ],
    'mechanics' => [
        'magnum' => [
            '1' => '<div class="title header big text yellow impact">Купи</div>
                    <div class="body medium header text din">три любых больших батона Snickers<sup>®</sup>, Twix<sup>®</sup> или Bounty<sup>®</sup></div>',
            '2' => '<div class="title header big text yellow impact">Загрузи чек</div>
                     <div class="body medium header text din">на сайте</div>',
            '3' => '<div class="title header big text yellow impact">Участвуй</div>
                    <div class="body medium header text din">в еженедельном розыгрыше призов!</div>',
        ],
        'small' => [],
    ],
    'prizes' => [
        'magnum' => 'каждую неделю разыгрываются:',
        'small' => 'Еженедельные призы'
    ],
    'faq' => [
        'header' => 'вопросы и ответы',
        'text' => 'Перед тем как задать вопрос, просмотри наиболее часто задаваемые вопросы.<br>
                   Если не нашел ответа - пиши нам, мы обязательно ответим. <br>
                   Не забудь написать e-mail и мобильный, которые указал при регистрации.'
    ],

    'footer' => [
        'period_magnum' => 'Сроки акции: с 20 августа по 16 сентября 2020 г.',
        'period_small' => 'Сроки акции: с 31 августа 2020 по 11 октября 2020 г.',
        'join' => 'Присоединяйся!',
        'rights' => '<sup>©</sup>2020 Mars, Incorporated. Все права защищены. | <sup>©</sup>TM Snickers, Торговая марка Mars Incorporated и её филиалов',
        'links' => '<a href="#privacy">Конфиденциальность</a>&nbsp;|&nbsp;
                    <a href="#owner">Владелец сайта</a>&nbsp;|&nbsp;
                    <a href="#parents">Для родителей</a>&nbsp;|&nbsp;
                    <a href="#terms">Юридические условия</a>&nbsp;|&nbsp;
                    <a href="#contacts">Контакты</a>',

    ],
    'header' => [
        'about' => 'Об акции',
        'prizes' => 'Призы',
        'winners' => 'Победители',
        'profile' => 'ЛИЧНЫЙ КАБИНЕТ',
        'logout' => 'выход',

    ],

    'profile' => [
        'top' => '<h1 class="text header impact toggle big">Регистрация чека</h1>
                <p class="text tiny din">
                    Внимание! Изображение чека должно быть четким: на нём обязательно должны <br>
                    присутствовать и хорошо читаться <span class="text yellow">название магазина, дата чека,<br>
                    общая сумма чека, название и количество купленных батонов Mars<sup>®</sup></span>
                </p>',
        'message' => 'Нажми, чтобы выбрать <br>
                        файл с устройства',
        'alert' => 'Обязательно сохрани зарегистрированный чек!',
        'table' => [
            'alert' => 'обязательно сохраняй зарегистрированные чеки',
            'date' => 'Дата регистрации',
            'photo' => 'фото чека',
            'see' => 'посмотреть фото'
        ],

    ],
    'modals' => [
        'age' => [
            'header' => 'Тебе исполнилось 14 лет?',
            'no' => 'НЕТ',
            'yes' => 'да',
            'promise' => 'наше обещание',
            'text' => 'В компании МАРС мы ответственно подходим к вопросам маркетингового продвижения наших брендов. У нас есть внутренний Маркетинговый кодекс, который представляет собой свод правил по продвижению нашей продукции. Кодекс содержит положение, согласно которому рекламные кампании ООО МАРС адресованы лицам, достигшим 13-летнего возраста. Мы считаем, что начиная с этого возраста люди делают осознанный выбор относительно того, как надо разумно потреблять кондитерскую продукцию. Мы используем Маркетинговый кодекс при планировании и осуществлении рекламных кампаний. Мы хотим, чтобы вы и ваша семья обладали самой полной и достоверной информацией о нашей продукции. Если вы хотите узнать больше о том, как мы ответственно рекламируем свою продукцию, используйте ссылку, чтобы ознакомиться с <a class="link" href="/docs/codex.pdf" target="_blank">Маркетинговым кодексом компании Mars</a>.'
        ],
        'faq' => '<h1 class="text yellow impact">Твой вопрос принят!</h1>
                    <h2 class="text medium din">Мы ответим тебе в самое <br> ближайшее время.</h2>',
        'auth' => [
            'header' => 'вход',
            'action' => 'войти',
            'bottom' => '<h2>Не зарегистрирован?</h2>
                        <a href="#registration" class="button yellow transparent">зарегистрироваться</a>'
        ],
        'reg' => [
            'header' => 'регистрация',
            'action' => 'зарегистрироваться',
            'text' => 'Нажимая кнопку «Зарегистрироваться», я <br>
                        подтверждаю, что согласен с <a href="#" class="link">Правилами Акции </a><br>
                        и <a href="#privacy" class="link">Политикой конфиденциальности</a>',
            'bottom' => '<h2 >Уже зарегистрировался?</h2>
                        <a href="#authorization" class="button yellow transparent">Войти</a>'
        ],
        'check' => '<h1 class="text yellow impact">Ура! Чек зарегистрирован.</h1>
                    <h2 class="text medium din">Ты участвуешь в розыгрыше крутых призов на этой неделе!</h2>
                    <div class="alert text small din">Обязательно сохрани зарегистрированный чек!</div>
                    <p class="text medium din">
                        Больше чеков – больше шансов
                        выиграть призы. <span class="text yellow">Есть ещё один чек? </span>
                        Регистрируй его, чтобы увеличить свои шансы на победу!
                    </p>',
        'privacy' => '<h1 class="text impact header big yellow">Конфиденциальность</h1>
                    <p class="text tiny din">
                        Посещая наши веб-сайты, помните, что мы уважаем ваше право на неприкосновенность частной жизни и всегда внимательно относимся к персональной информации, которую вы нам доверяете. Мы хотим обеспечить вас понятной и точной информацией о том, как мы защищаем вашу конфиденциальность онлайн.
                        <br><br>Чтобы узнать больше, следуйте <a class="link" href="https://www.mars.com/global/policies/privacy/pp-russian" target="_blank">по ссылке</a>
                    </p>',
        'owner' => '<h1 class="text impact header big yellow">Владелец сайта</h1>
                    <p class="text tiny din">
                        Mars Центральная Евразия и Беларусь <br>
                        Эл. почта: <a class="link" href="mailto:contact.ceab@mars.com">contact.ceab@mars.com</a> <br>
                        Телефоны: <a class="link" href="tel:88000801331">8-800-080-1331</a> <br>
                        <a class="link" href="https://mars.com" target="_blank">www.mars.com</a>
                    </p>',
        'parents' => '<h1 class="text impact header big yellow">Для родителей</h1>
                    <p class="text tiny din">
                        Как ответственный производитель и в соответствии с нашим Маркетинговым Кодексом, мы рекламируем продукцию только для лиц, достигших 13 летнего возраста, поскольку в этом возрасте люди начинают делать осознанный выбор относительно того, как надо разумно потреблять кондитерскую продукцию.
                        В соответствии с нашим Маркетинговым Кодексом, наша коммуникация направлена на взрослых и подростков. Мы гарантируем, что предоставляем вам полную информацию о своей продукции для осознанного выбора.
                        <br>Мы объединяемся с другими производителями, чтобы научить школьников разбираться в информации о продуктах и принимать взвешанные и осознанные решения в отношении их потребления.
                        <br><br>Чтобы узнать больше, следуйте
                        <a class="link" href="http://mars.com/global/policies/note-to-parents/np-russian" target="_blank">по ссылке</a>
                    </p>',
        'terms' => '<h1 class="text impact header big yellow">Юридические условия</h1>
                    <p class="text tiny din">
                        Наши юридические условия объясняют, как пользоваться нашим веб-сайтом. <br><br>
                        <a class="link" href="https://www.mars.com/global/policies/legal/ld-russian" target="_blank">Прочитать полностью юридические условия компании Mars</a>
                    </p>',
        'contacts' => '<h1 class="text impact header big yellow">Контакты</h1>
                    <p class="text tiny din">
                        Обратная связь с потребителем очень важна для нас. Если вам не удалось найти на этом веб-сайте интересующую вас информацию или у вас есть идеи, с которыми вы хотите поделиться с нами, пожалуйста, сообщите нам.
                        <br>
                        <br>
                        <a class="link" href="https://www.mars.com/global/about-us/contact-us" target="_blank">Узнайте, как связаться с нами</a>
                    </p>',
        ],
];
