<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Param;
use App\Models\ParamsOption;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParamsProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO `params_product` (
            `product_id`,
            `param_id`,
            `value`
        )
        SELECT
            `product_id`,
            `attribute_id`,
            `number_value`
        FROM `mtrock`.`mr_store_product_attribute_value`
        WHERE
            `number_value` IS NOT NULL AND
            `product_id` IN (SELECT id FROM products)
        ');
        DB::insert('INSERT INTO `params_product` (
            `product_id`,
            `param_id`,
            `value`
        )
        SELECT
            `product_id`,
            `attribute_id`,
            `string_value`
        FROM `mtrock`.`mr_store_product_attribute_value`
        WHERE
            `string_value` IS NOT NULL AND
            `product_id` IN (SELECT id FROM products)
        ');
        DB::insert('INSERT INTO `params_product` (
            `product_id`,
            `param_id`,
            `params_option_id`
        )
        SELECT
            `product_id`,
            `attribute_id`,
            `option_value`
        FROM `mtrock`.`mr_store_product_attribute_value`
        WHERE
            `option_value` IS NOT NULL AND
            `product_id` IN (SELECT id FROM products)
        ');

        $this->setCategoryByOption('Палатки', 'Область применения', 'Кемпинг', 'Кемпинговые палатки');
        $this->setCategoryByOption('Палатки', 'Область применения', 'Трекинг', 'Трекинговые палатки');
        $this->setCategoryByOption('Палатки', 'Область применения', 'Экстрим', 'Экстремальные палатки');
        $this->setCategoryByOption('Палатки', 'Область применения', 'Для рыбалки', 'Палатки для рыбалки');
        $this->setCategoryByOption('Спальные мешки', 'Тип спального мешка', 'Одеяло', 'Одеяло');
        $this->setCategoryByOption('Спальные мешки', 'Тип спального мешка', 'Кокон', 'Кокон');
        $this->setCategoryByOption('Рюкзаки', 'Тип рюкзака', 'Городской', 'Городские рюкзаки');
        $this->setCategoryByOption('Рюкзаки', 'Тип рюкзака', 'Туристический', 'Туристические рюкзаки');
        $this->setCategoryByOption('Рюкзаки', 'Тип рюкзака', 'Велосипедный', 'Велосипедные рюкзаки');
        $this->setCategoryByOption('Рюкзаки', 'Тип рюкзака', 'Велосипедный', 'Велосипедные рюкзаки');
        $this->setCategoryByTypePrefix('Питьевая система', 'Питьевые системы');
        $this->setCategoryByTypePrefix('Чехол для рюкзака', 'Накидки');
        $this->setCategoryByTypePrefix('Накидка на рюкзак', 'Накидки');
        $this->setCategoryByTypePrefix('Накидка', 'Накидки');

        $this->setCategoryByTypePrefix('Аптечка', 'Аптечки');
        $this->setCategoryByTypePrefix('Аптечка туристическая', 'Аптечки');
        $this->setCategoryByTypePrefix('Топор', 'Разведение огня');
        $this->setCategoryByTypePrefix('Огниво с кресалом', 'Разведение огня');
        $this->setCategoryByTypePrefix('Огниво', 'Разведение огня');
        $this->setCategoryByTypePrefix('Проволочная пила', 'Разведение огня');
        $this->setCategoryByTypePrefix('Пила проволочная', 'Разведение огня');
        $this->setCategoryByTypePrefix('Пила складная', 'Разведение огня');
        $this->setCategoryByTypePrefix('Гамаши', 'Гамаши');
        $this->setCategoryByTypePrefix('Гетры', 'Гамаши');
        $this->setCategoryByTypePrefix('Кошелек', 'Кошельки');

        $this->setCategoryByTypePrefix('Клюв и штычок для лопаты', 'Лавинное снаряжение');

        $this->setCategoryByTypePrefix('Набор посуды', 'Наборы посуды');
        $this->setCategoryByTypePrefix('Чайник походный', 'Котелки и чайники');
        $this->setCategoryByTypePrefix('Чайник', 'Котелки и чайники');
        $this->setCategoryByTypePrefix('Походный чайник', 'Котелки и чайники');
        $this->setCategoryByTypePrefix('Походный чайник', 'Котелки и чайники');
        $this->setCategoryByTypePrefix('Котелок', 'Котелки и чайники');
        $this->setCategoryByTypePrefix('Сковорода', 'Котелки и чайники');
        $this->setCategoryByTypePrefix('Набор котелков', 'Котелки и чайники');
        $this->setCategoryByTypePrefix('Набор посуды с горелкой', 'Котелки и чайники');
        $this->setCategoryByTypePrefix('Набор титановой посуды', 'Котелки и чайники');
        $this->setCategoryByTypePrefix('Титановый котелок', 'Котелки и чайники');
        $this->setCategoryByTypePrefix('Котел', 'Котелки и чайники');
        $this->setCategoryByTypePrefix('Термос', 'Термосы и фляги');
        $this->setCategoryByTypePrefix('Фляга алюминиевая', 'Термосы и фляги');
        $this->setCategoryByTypePrefix('Фляжка', 'Термосы и фляги');
        $this->setCategoryByTypePrefix('Фляга', 'Термосы и фляги');
        $this->setCategoryByTypePrefix('Термо бутылка', 'Термосы и фляги');
        $this->setCategoryByTypePrefix('Складная канистра для воды', 'Термосы и фляги');
        $this->setCategoryByTypePrefix('Набор столовых приборов', 'Столовые приборы');
        $this->setCategoryByTypePrefix('Ловилка', 'Столовые приборы');
        $this->setCategoryByTypePrefix('Складная титановая ложка-вилка', 'Столовые приборы');
        $this->setCategoryByTypePrefix('Складная ложка-вилка', 'Столовые приборы');
        $this->setCategoryByTypePrefix('Титановая вилка-ложка-нож', 'Столовые приборы');
        $this->setCategoryByTypePrefix('Ложка-вилка-нож', 'Столовые приборы');
        $this->setCategoryByTypePrefix('Титановая ложка-вилка', 'Столовые приборы');
        $this->setCategoryByTypePrefix('Титановая вилка', 'Столовые приборы');
        $this->setCategoryByTypePrefix('Титановая ложка', 'Столовые приборы');
        $this->setCategoryByTypePrefix('Титановый нож', 'Столовые приборы');
        $this->setCategoryByTypePrefix('Набор складных столовых приборов', 'Столовые приборы');
        $this->setCategoryByTypePrefix('Ложка-вилка', 'Столовые приборы');
        $this->setCategoryByTypePrefix('Ложка', 'Столовые приборы');
        $this->setCategoryByTypePrefix('Вилка', 'Столовые приборы');
        $this->setCategoryByTypePrefix('Двусторонняя ложка-вилка', 'Столовые приборы');
        $this->setCategoryByTypePrefix('Миска', 'Миски');
        $this->setCategoryByTypePrefix('Суповая тарелка', 'Миски');
        $this->setCategoryByTypePrefix('Миска со складной ручкой', 'Миски');
        $this->setCategoryByTypePrefix('Набор туристической посуды', 'Миски');
        $this->setCategoryByTypePrefix('Миска с ручкой', 'Миски');
        $this->setCategoryByTypePrefix('Набор мисок', 'Миски');
        $this->setCategoryByTypePrefix('Кружка', 'Кружки');
        $this->setCategoryByTypePrefix('Термокружка', 'Кружки');
        $this->setCategoryByTypePrefix('Стакан', 'Кружки');
        $this->setCategoryByTypePrefix('Автокружка с подогревом', 'Кружки');
        $this->setCategoryByTypePrefix('Кружка со складными ручками', 'Кружки');
        $this->setCategoryByTypePrefix('Кружка с карабином', 'Кружки');
        $this->setCategoryByTypePrefix('Силиконовый стакан', 'Кружки');
        $this->setCategoryByTypePrefix('Титановая кружка', 'Кружки');
        $this->setCategoryByTypePrefix('Фильтр для воды', 'Аксессуары для походной кухни');
        $this->setCategoryByTypePrefix('Ручка-хваталка', 'Аксессуары для походной кухни');
        $this->setCategoryByTypePrefix('Набор лопаток', 'Аксессуары для походной кухни');
        $this->setCategoryByTypePrefix('Контейнер для еды', 'Аксессуары для походной кухни');
        $this->setCategoryByTypePrefix('Ведро складное', 'Аксессуары для походной кухни');
        $this->setCategoryByTypePrefix('Ветрозащитный экран', 'Аксессуары для походной кухни');

        $this->setCategoryByTypePrefix('Самонадувающийся коврик', 'Самонадувающиеся коврики');
        $this->setCategoryByTypePrefix('Ковер самонадувающийся', 'Самонадувающиеся коврики');
        $this->setCategoryByTypePrefix('Коврик самонадувающийся', 'Самонадувающиеся коврики');
        $this->setCategoryByTypePrefix('Надувной коврик', 'Надувные коврики');
        $this->setCategoryByTypePrefix('Коврик надувной', 'Надувные коврики');
        $this->setCategoryByTypePrefix('Ковер надувной', 'Надувные коврики');
        $this->setCategoryByTypePrefix('Ковер надувной утеплённый', 'Надувные коврики');
        $this->setCategoryByTypePrefix('Надувной матрас', 'Надувные коврики');

        $this->setCategoryByTypePrefix('Система приготовления пищи', 'Системы приготовления');
        $this->setCategoryByTypePrefix('Система для приготовления пищи', 'Системы приготовления');
        $this->setCategoryByTypePrefix('Горелка с кастрюлей', 'Системы приготовления');
        $this->setCategoryByTypePrefix('Спиртовая горелка', 'Спиртовые горелки');
        $this->setCategoryByTypePrefix('Горелка спиртовая', 'Спиртовые горелки');
        $this->setCategoryByTypePrefix('Горелка газовая', 'Газовые горелки');
        $this->setCategoryByTypePrefix('Горелка газовая (титан)', 'Газовые горелки');
        $this->setCategoryByTypePrefix('Мультитопливная горелка', 'Мультитопливные горелки');
        $this->setCategoryByTypePrefix('Горелка мультитопливная', 'Мультитопливные горелки');
        $this->setCategoryByTypePrefix('Горелка бензиновая', 'Мультитопливные горелки');
        $this->setCategoryByTypePrefix('Гриль газовый', 'Газовые плиты');
        $this->setCategoryByTypePrefix('Плита газовая', 'Газовые плиты');
        $this->setCategoryByTypePrefix('Лампа газовая', 'Газовые лампы');
        $this->setCategoryByTypePrefix('Газовая лампа', 'Газовые лампы');
        $this->setCategoryByTypePrefix('Обогреватель газовый', 'Газовые обогреватели');
        $this->setCategoryByTypePrefix('Газовый обогреватель', 'Газовые обогреватели');
        $this->setCategoryByTypePrefix('Емкость под бензин', 'Аксессуары для горелок');
        $this->setCategoryByTypePrefix('Емкость для топлива', 'Аксессуары для горелок');
        $this->setCategoryByTypePrefix('Газовый картридж', 'Аксессуары для горелок');
        $this->setCategoryByTypePrefix('Газовый баллон', 'Аксессуары для горелок');
        $this->setCategoryByTypePrefix('Переходник на цанговый баллон', 'Аксессуары для горелок');
        Product::query()
            ->where('category_id', '=', $this->getCategory('Горелки туристические'))
            ->update(['category_id' => $this->getCategory('Аксессуары для горелок')]);

        $this->setCategoryByTypePrefix('Стул', 'Стулья');
        $this->setCategoryByTypePrefix('Стул кемпинговый', 'Стулья');
        $this->setCategoryByTypePrefix('Стул складной', 'Стулья');
        $this->setCategoryByTypePrefix('Стул-кресло', 'Стулья');
        $this->setCategoryByTypePrefix('Складное кресло', 'Стулья');
        $this->setCategoryByTypePrefix('Раскладное кресло', 'Стулья');
        $this->setCategoryByTypePrefix('Стул директорский со столом', 'Стулья');
        $this->setCategoryByTypePrefix('Директорский стул со столом', 'Стулья');
        $this->setCategoryByTypePrefix('Табурет складной', 'Стулья');
        $this->setCategoryByTypePrefix('Стул директорский', 'Стулья');
        $this->setCategoryByTypePrefix('Кресло', 'Стулья');
        $this->setCategoryByTypePrefix('Стол', 'Столы');
        $this->setCategoryByTypePrefix('Складной стол', 'Столы');
        $this->setCategoryByTypePrefix('Стол кемпинговый', 'Столы');
        $this->setCategoryByTypePrefix('Стол складной', 'Столы');
        $this->setCategoryByTypePrefix('Кухня кемпинговая', 'Столы');
        $this->setCategoryByTypePrefix('Стеллаж кемпинговый', 'Столы');
        $this->setCategoryByTypePrefix('Кухня походная', 'Столы');
        $this->setCategoryByTypePrefix('Складная походная кухня', 'Столы');
        $this->setCategoryByTypePrefix('Кухня', 'Столы');
        $this->setCategoryByTypePrefix('Набор мебели в кейсе', 'Столы');
        $this->setCategoryByTypePrefix('Набор мебели', 'Столы');
        $this->setCategoryByTypePrefix('Раскладушка', 'Раскладушки');
        $this->setCategoryByTypePrefix('Чехол', 'Раскладушки');
        $this->setCategoryByTypePrefix('Кровать кемпинговая', 'Раскладушки');

        $this->setCategoryByTypePrefix('Каркасный тент', 'Каркасные тенты и шатры');
        $this->setCategoryByTypePrefix('Палатка-шатер', 'Каркасные тенты и шатры');
        $this->setCategoryByTypePrefix('Тент-шатер', 'Каркасные тенты и шатры');
        $this->setCategoryByTypePrefix('Шатер кемпинговый', 'Каркасные тенты и шатры');
        $this->setCategoryByTypePrefix('Тент для душа/туалета', 'Каркасные тенты и шатры');
        $this->setCategoryByTypePrefix('Тент', 'Туристические тенты');
        $this->setCategoryByTypePrefix('Туристический тент', 'Туристические тенты');
        $this->setCategoryByTypePrefix('Тент со стойками', 'Туристические тенты');
    }

    private function setCategoryByOption(string $whereCategory, string $attributeTitle, string $attributeValue, string $categoryTitle): void
    {
        Product::query()
            ->where('category_id', '=', $this->getCategory($whereCategory))
            ->whereHas(
                'params',
                fn (Builder $query) => $query
                    ->where('params_product.param_id', '=', $this->getParam($attributeTitle))
                    ->where('params_product.params_option_id', '=', $this->getParamsOption($attributeValue))
            )
            ->update(['category_id' => $this->getCategory($categoryTitle)]);
    }

    private function setCategoryByTypePrefix(string $typePrefix, string $categoryTitle): void
    {
        Product::query()
            ->where('type_prefix', '=', $typePrefix)
            ->update(['category_id' => $this->getCategory($categoryTitle)]);
    }

    private function getParam(string $title): int
    {
        return Param::where('title', '=', $title)->firstOrFail()->id;
    }

    private function getParamsOption(string $title): int
    {
        return ParamsOption::where('value', '=', $title)->firstOrFail()->id;
    }

    private function getCategory(string $title): int
    {
        return Category::where('title', '=', $title)->firstOrFail()->id;
    }
}
