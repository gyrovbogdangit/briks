<div class="product-info bg-white rounded shadow-sm p-4">
    <ul class="nav nav-tabs mb-3" id="productTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc" type="button"
                role="tab">Описание</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="chars-tab" data-bs-toggle="tab" data-bs-target="#chars" type="button"
                role="tab">Характеристики</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="howbuy-tab" data-bs-toggle="tab" data-bs-target="#how-buy" type="button"
                role="tab">Как заказать</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pay-tab" data-bs-toggle="tab" data-bs-target="#pay" type="button"
                role="tab">Оплата</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="delivery-tab" data-bs-toggle="tab" data-bs-target="#delivery" type="button"
                role="tab">Доставка</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="garanty-tab" data-bs-toggle="tab" data-bs-target="#garanty" type="button"
                role="tab">Гарантия и возврат</button>
        </li>
    </ul>
    <div class="tab-content" id="productTabContent">
        <div class="tab-pane fade show active" id="desc" role="tabpanel">
            <div class="mb-3">
                <p>{!! str_replace(
                    ['{NAME}', 'ptsvrn@mail.ru', '88003017090', '+8 (800) 301-70-90'],
                    [explode(' ', $product->name)[1], 'briks@mail.ru', '+12345678', '+12345678'],
                    $subcategory->description,
                ) !!}</p>
            </div>
            @if (isset($subcategory->docs) && count($subcategory->docs) > 0)
                <div class="mb-3">
                    <div class="d-flex flex-wrap gap-3">
                        @foreach ($subcategory->docs_file_names as $doc => $name)
                            <a href="{{ Storage::url($doc) }}"
                                class="btn btn-outline-primary d-flex align-items-center gap-2" target="_blank">
                                <i class="docs__icon {{ $product::getDocIcon($doc) }}"></i>
                                <span>{{ $name }}</span>
                                <span class="small text-muted">
                                    @if (Storage::disk('public')->size($doc) / 1024 / 1024 < 1)
                                        {{ round(Storage::disk('public')->size($doc) / 1024) }} Kб
                                    @else
                                        {{ round(Storage::disk('public')->size($doc) / 1024 / 1024, 1) }} Мб
                                    @endif
                                    ({{ $product::getDocExtension($doc) }})
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        <div class="tab-pane fade" id="chars" role="tabpanel">
            <h5 class="mb-3">Технические характеристики</h5>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <tbody>
                        @foreach ($product->attributeValues as $attributeValue)
                            <tr>
                                <th class="bg-light">{{ $attributeValue->attribute->name }}</th>
                                <td>{{ $attributeValue->value->value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="how-buy" role="tabpanel">
            <h5>Как заказать</h5>
            <p>Оформить заказ можно любым удобным для вас способом:</p>
            <ul>
                <li>Через форму на сайте: нажмите кнопку заказать в один клик в карточке товара, заполните данные и
                    нажмите «Заказать».</li>
                <li>По электронной почте: отправьте письмо на <a href="mailto:briks@mail.ru">briks@mail.ru</a>,
                    прикрепите реквизиты вашей организации и укажите наименование интересующего товара.</li>
                <li>По телефону: позвоните по номеру <a href="tel:+12345678">+12345678</a>, озвучьте специалисту
                    наименование интересующего товара.</li>
            </ul>
        </div>
        <div class="tab-pane fade" id="pay" role="tabpanel">
            <h5>Оплата</h5>
            <p><strong>Для юридических лиц</strong></p>
            <p>Оставьте заявку на странице товара, через форму на сайте или по Email: <a
                    href="mailto:briks@mail.ru">briks@mail.ru</a>.</p>
            <p>Наш специалист выставит вам счет для оплаты по безналичному расчету. Вы оплачиваете счет и мы занимаемся
                доставкой вашего заказа.</p>
            <ul>
                <li>Возможна частичная предоплата по согласованию с менеджером.</li>
                <li>Комплект бухгалтерских документов отправляется вместе с товаром или почтой.</li>
                <li>При необходимости оформляется Договор поставки.</li>
            </ul>
            <p><strong>Для физических лиц</strong></p>
            <p>Оставьте заявку на странице товара, через форму на сайте или по Email: <a
                    href="mailto:briks@mail.ru">briks@mail.ru</a>.</p>
            <p>Наш специалист выставит вам счет для оплаты по безналичному расчету. Вы оплачиваете счет (через мобильный
                банк или в отделении любого банка через кассу) и мы занимаемся доставкой вашего заказа.</p>
        </div>
        <div class="tab-pane fade" id="delivery" role="tabpanel">
            <h5>Доставка</h5>
            <p>Организуем доставку в любую точку России и СНГ удобной для вас транспортной компанией. Доставка до
                терминала в г. Поставщика бесплатно!</p>
            <ul>
                <li>После предоплаты мы отвезем товар (бесплатно) на терминал транспортной компании и оформим его
                    доставку до вашего города.</li>
                <li>По прибытию заказа на терминал в вашем городе, сотрудник транспортной компании уведомит вас об этом.
                </li>
                <li>Вы приезжаете в офис транспортной компании с паспортом и доверенностью и забираете товар.</li>
            </ul>
            <p>По вашему желанию можем организовать экспресс-доставку ведущими курьерскими службами (рекомендуется для
                мелких посылок).</p>
        </div>
        <div class="tab-pane fade" id="garanty" role="tabpanel">
            <h5>Гарантийные обязательства и порядок возврата</h5>
            <p>Приобретая любое оборудование на сайте <a href="{{ route('home') }}">briks.ru</a>, вы получаете гарантию
                качества от 12 до 60 месяцев в зависимости от группы товара. Претензии относительно недостатков товара,
                которые не могли быть выявлены в момент его получения, принимаются в течение установленного гарантийного
                срока.</p>
            <ul>
                <li>Потребовать безвозмездное устранение недостатков товара.</li>
                <li>Потребовать соразмерного уменьшения покупной цены.</li>
                <li>Потребовать замены на товар аналогичной марки или на такой же товар другой марки с соответствующим
                    перерасчетом цены.</li>
                <li>Отказаться от исполнения договора и потребовать возврата уплаченной суммы (возврат денежных средств
                    осуществляется после получения и осмотра товара Поставщиком).</li>
            </ul>
            <p><strong>Необходимые документы и условия для гарантии:</strong></p>
            <ul>
                <li>Документ, удостоверяющий покупку: накладная или УПД.</li>
                <li>Товар в полной комплектации.</li>
            </ul>
            <p>Товар ненадлежащего качества — это товар, в котором выявлены недостатки. Замена или возврат такого товара
                производится на основании Закона РФ «О защите прав потребителей».</p>
            <p>Обратите внимание: при выявлении фактов ненадлежащего использования, механических повреждений,
                гарантийные обязательства могут быть аннулированы.</p>
        </div>
    </div>
</div>
