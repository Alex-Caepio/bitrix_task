<?
$MESS['wizard.steps.begin.title'] = 'Начало';
$MESS['wizard.steps.begin.description'] = 'Добро пожаловать в мастер установки интернет-магазина';
$MESS['wizard.steps.begin.noModule'] = 'Не установлен модуль "<a target="_blank" href="http://marketplace.1c-bitrix.ru/solutions/#MODULE_ID#/">#MODULE_ID#</a>", возможно он уже есть в <a target="_blank" href="/bitrix/admin/partner_modules.php">списке</a> ваших решений, в таком случае вам необходимо просто установить его!';
$MESS['wizard.steps.mode.title'] = 'Режим установки';
$MESS['wizard.steps.mode.description'] = 'Позволяет выбрать режим (обновить или установить)';
$MESS['wizard.steps.dataSite.title'] = 'Данные сайта';
$MESS['wizard.steps.dataSite.description'] = 'Общая информация о сайте';
$MESS['wizard.steps.dataShop.title'] = 'Данные магазина';
$MESS['wizard.steps.dataShop.description'] = 'Общая информация о магазине';
$MESS['wizard.steps.dataShop.categories.common'] = 'Информация о магазине';
$MESS['wizard.steps.dataShop.categories.bank'] = 'Банковские реквизиты';
$MESS['wizard.steps.dataShop.categories.bankUa'] = 'Реквизиты предприятия';
$MESS['wizard.steps.dataShop.categories.bankUa.description'] = 'Внесенная информация используется при формировании украинской первичной документации (счет, акт, накладная, налоговая накладная).<br />Обратите внимание, что согласно украинскому законодательству документооборот должен вестись на государственном языке, поэтому рекомендуем вам заполнять поля с реквизитами для документов на украинском.';
$MESS['wizard.steps.dataShop.errors.catalog'] = 'Не установлен модуль торгового каталога. Для продолжения работы мастера <a href=\'/bitrix/admin/module_admin.php\'>перейдите по ссылке</a> и установите модуль.';
$MESS['wizard.steps.personTypes.title'] = 'Типы плательщиков';
$MESS['wizard.steps.services.title'] = 'Доставка и оплата';
$MESS["wizard.steps.services.paySystems.title"] = "Способы оплаты";
$MESS["wizard.steps.services.paySystems.description"] = "Выберите способы оплаты, которые будут возможны на вашем сайте. В дальнейшем в настройках магазина вы сможете активировать другие платежные системы (Яндекс.Деньги, Ассист, Деньги@mail.ru, ChronoPay и т.п.). Для работы этих платежных систем потребуется заключение с ними договоров.";
$MESS["wizard.steps.services.paySystems.items.cash"] = "Наличные (при доставке курьером и самовывозе)";
$MESS["wizard.steps.services.paySystems.items.sberbank"] = "Квитанция Сбербанк (банковский перевод для физических лиц)";
$MESS["wizard.steps.services.paySystems.items.oshad"] = "Квитанция Ощадбанк (банковский перевод для физических лиц)";
$MESS["wizard.steps.services.paySystems.items.bill"] = "Безналичный расчет (банковский перевод для юридических лиц)";
$MESS["wizard.steps.services.paySystems.items.billUa"] = "Безналичный расчет (банковский перевод для всех типов плательщиков)";
$MESS["wizard.steps.services.paySystems.items.cod"] = "Наложенный платеж";
$MESS["wizard.steps.services.paySystems.errors.unselected"] = "Необходимо выбрать хотя бы один способ оплаты";
$MESS["wizard.steps.services.deliveries.title"] = "Способы доставки";
$MESS["wizard.steps.services.deliveries.description"] = "Выберите способы доставки, которые возможны для вашего магазина. В настройках магазина вы можете активировать  или добавить дополнительные службы доставки (EMS, UPS и т.п.).";
$MESS["wizard.steps.services.deliveries.hint"] = "В дальнейшем вы можете легко изменить и настроить платежные системы и службы доставки в настройках магазина в административной части.";
$MESS["wizard.steps.services.deliveries.items.courier"] = "Курьер";
$MESS["wizard.steps.services.deliveries.items.selfpick"] = "Самовывоз";
$MESS["wizard.steps.services.deliveries.items.rupost"] = "Почта России (расчёт на основании данных с сервера почты)";
$MESS["wizard.steps.services.deliveries.items.rupost2"] = "Почта России (расчёт на основании табличных данных)";
$MESS["wizard.steps.services.deliveries.items.rf"] = "Отправления 1 класса";
$MESS["wizard.steps.services.deliveries.items.ua"] = "Новая почта";
$MESS["wizard.steps.services.deliveries.items.kz"] = "Казпочта";
$MESS["wizard.steps.services.locations.title"] = "Местоположения";
$MESS['wizard.steps.services.locations.items.ussr'] = 'Россия и СНГ (страны и города)';
$MESS['wizard.steps.services.locations.items.ua'] = 'Украина';
$MESS['wizard.steps.services.locations.items.kz'] = 'Казахстан';
$MESS['wizard.steps.services.locations.items.usa'] = 'США (города)';
$MESS['wizard.steps.services.locations.items.country'] = 'Мир (страны)';
$MESS['wizard.steps.services.locations.items.none'] = 'Не загружать';

$MESS['wizard.steps.locations.description'] = 'Выберите типы плательщиков, которым вы будете продавать на сайте. Для разных типов плательщиков возможны различные способы оплаты и доставки, а также различный набор свойств заказа.';

$MESS['wizard.modes.install'] = 'Установка';
$MESS['wizard.modes.update'] = 'Обновление';

$MESS['wizard.persons.fiz'] = 'Физическое лицо';
$MESS['wizard.persons.ur'] = 'Юридическое лицо';

$MESS['wizard.fields.errors.empty'] = 'Поле "#NAME#" не должно быть пустым';
$MESS['wizard.fields.siteName'] = 'Название сайта';
$MESS['wizard.fields.siteName.value'] = 'Universe LITE';
$MESS['wizard.fields.sitePhone'] = 'Телефон';
$MESS['wizard.fields.sitePhone.value'] = '+7 (000) 000 00 00';
$MESS['wizard.fields.siteAddress'] = 'Адрес';
$MESS['wizard.fields.siteAddress.value'] = 'г. Челябинск';
$MESS['wizard.fields.siteMail'] = 'Эл. почта';
$MESS['wizard.fields.siteMail.value'] = 'shop@example.com';
$MESS['wizard.fields.siteMetaDescription'] = 'Описание сайта (Description)';
$MESS['wizard.fields.siteMetaDescription.value'] = 'Интернет-магазин';
$MESS['wizard.fields.siteMetaKeywords'] = 'Ключевые слова (Keywords)';
$MESS['wizard.fields.siteMetaKeywords.value'] = 'Купить, Интернет-магазин';
$MESS['wizard.fields.shopLocalization'] = 'Локализация магазина';
$MESS['wizard.fields.shopLocalization.values.ru'] = 'Россия';
$MESS['wizard.fields.shopLocalization.values.ua'] = 'Украина';
$MESS['wizard.fields.shopLocalization.values.kz'] = 'Казахстан';
$MESS['wizard.fields.shopLocalization.values.bl'] = 'Белоруссия';
$MESS['wizard.fields.shopEmail'] = 'Email для получения информации о заказах';
$MESS['wizard.fields.shopOfName'] = 'Название компании';
$MESS['wizard.fields.shopOfName.value'] = 'ООО "Интернет-магазин"';
$MESS['wizard.fields.shopOfName.valueUa'] = 'ТОВ "Інтернет-магазин"';
$MESS['wizard.fields.shopLocation'] = 'Местоположение магазина';
$MESS['wizard.fields.shopLocation.value'] = 'Челябинск';
$MESS['wizard.fields.shopLocation.valueUa'] = 'Київ';
$MESS['wizard.fields.shopAdr'] = 'Адрес компании';
$MESS['wizard.fields.shopAdr.value'] = 'ул. Пушкина 19';
$MESS['wizard.fields.shopAdr.valueUa'] = 'Київ';
$MESS['wizard.fields.shopINN'] = 'ИНН';
$MESS['wizard.fields.shopKPP'] = 'КПП';
$MESS['wizard.fields.shopNS'] = 'Расчетный счет';
$MESS['wizard.fields.shopBANK'] = 'Банк';
$MESS['wizard.fields.shopBANK.value'] = 'ОАО "Сбербанк России", г. Челябинск';
$MESS['wizard.fields.shopBANKREKV'] = 'Банковские реквизиты';
$MESS['wizard.fields.shopBANKREKV.value'] = 'БИК 044525225';
$MESS['wizard.fields.shopKS'] = 'Корреспондентский счет';
$MESS['wizard.fields.shopEGRPU_ua'] = 'ЕГРПОУ';
$MESS['wizard.fields.shopINN_ua'] = 'ИНН';
$MESS['wizard.fields.shopNDS_ua'] = '№ свидетельства НДС';
$MESS['wizard.fields.shopNS_ua'] = '№ расчетного счета';
$MESS['wizard.fields.shopBank_ua'] = 'Банк';
$MESS['wizard.fields.shopMFO_ua'] = 'МФО банка';
$MESS['wizard.fields.shopPlace_ua'] = 'Место составления документа';
$MESS['wizard.fields.shopFIO_ua'] = 'ФИО и должность ответственного лица за осуществление хозяйственной операции';
$MESS['wizard.fields.shopTax_ua'] = 'Система налогообложения';
$MESS['wizard.fields.siteStamp'] = 'Печать фирмы';
$MESS['wizard.fields.shopPriceBase'] = 'Базовая цена';
$MESS['wizard.fields.shopPriceBase.text1'] = 'В решении используется в качестве публичных цен для просмотра и покупки базовая цена (BASE). В текущий момент для группы "Все пользователи (в том числе неавторизованные)" включено право на данный тип цены. Таким образом данная группа будет видеть цены в решении.';
$MESS['wizard.fields.shopPriceBase.text2'] = 'Добавить для группы "Все пользователи (в том числе неавторизованные)" право на просмотр и на покупку по этому типу цен.';
$MESS['wizard.fields.systemReplaceTemplate'] = 'Заменять шаблон конструктора (если существует)';
$MESS['wizard.fields.systemConfigureRegions'] = 'Настроить регионы мультирегиональности';
$MESS['wizard.fields.systemImportIBlocks'] = 'Импортировать инфоблоки (если не существуют)';