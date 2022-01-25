<?php

namespace Database\Seeders\Content;

use App\Models\Teacher;
use App\Traits\SeedContainable;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    use SeedContainable;

    /** @var string $modelClass */
    private $modelClass = Teacher::class;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->seedData();
    }

    /**
     * @return array
     */
    protected function getEnData(): array
    {
        return [
            [
                'name' => 'Mike Mike',
                'gender_id' => 1,
                'email' => 'mike@emial.com',
                'phone' => 06556235656,
                'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using',
                'testimonials_first' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour',
                'testimonials_second' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour'
            ],
            [
                'name' => 'Sara Jo',
                'gender_id' => 2,
                'email' => 'sara@emial.com',
                'phone' => 06556235656,
                'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using',
                'testimonials_first' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour',
                'testimonials_second' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour'
            ],
            [
                'name' => 'Peter Peter',
                'gender_id' => 1,
                'email' => 'peter@emial.com',
                'phone' => 06556235656,
                'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using',
                'testimonials_first' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour',
                'testimonials_second' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour'
            ],
        ];
    }

    /**
     * @return array
     */
    protected function getArData(): array
    {
        return [
            [
                'name' => 'Mike M',
                'gender_id' => 1,
                'email' => 'mike@emial.com',
                'phone' => 06556235656,
                'description' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. الهدف من استخدام Lorem Ipsum هو أنه يحتوي على توزيع طبيعي للأحرف إلى حد ما',
                'testimonials_first' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. الهدف من استخدام Lorem Ipsum هو أنه يحتوي على توزيع طبيعي للأحرف إلى حد ما',
                'testimonials_second' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. الهدف من استخدام Lorem Ipsum هو أنه يحتوي على توزيع طبيعي للأحرف إلى حد ما',

            ],
            [
                'name' => 'Sara Jo',
                'gender_id' => 2,
                'email' => 'sara@emial.com',
                'phone' => 06556235656,
                'description' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. الهدف من استخدام Lorem Ipsum هو أنه يحتوي على توزيع طبيعي للأحرف إلى حد ما',
                'testimonials_first' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. الهدف من استخدام Lorem Ipsum هو أنه يحتوي على توزيع طبيعي للأحرف إلى حد ما',
                'testimonials_second' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. الهدف من استخدام Lorem Ipsum هو أنه يحتوي على توزيع طبيعي للأحرف إلى حد ما',
            ],
            [
                'name' => 'Peter Peter',
                'gender_id' => 1,
                'email' => 'peter@emial.com',
                'phone' => 06556235656,
                'description' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. الهدف من استخدام Lorem Ipsum هو أنه يحتوي على توزيع طبيعي للأحرف إلى حد ما',
                'testimonials_first' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. الهدف من استخدام Lorem Ipsum هو أنه يحتوي على توزيع طبيعي للأحرف إلى حد ما',
                'testimonials_second' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. الهدف من استخدام Lorem Ipsum هو أنه يحتوي على توزيع طبيعي للأحرف إلى حد ما',
            ],
        ];
    }

    /**
     * @return array
     */
    protected function getOmData(): array
    {
        return [
            [
                'name' => 'Mike Mike',
                'gender_id' => 1,
                'email' => 'mike@emial.com',
                'phone' => 06556235656,
                'description' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. الهدف من استخدام Lorem Ipsum هو أنه يحتوي على توزيع طبيعي للأحرف إلى حد ما',
                'testimonials_first' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. الهدف من استخدام Lorem Ipsum هو أنه يحتوي على توزيع طبيعي للأحرف إلى حد ما',
                'testimonials_second' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. الهدف من استخدام Lorem Ipsum هو أنه يحتوي على توزيع طبيعي للأحرف إلى حد ما',
            ],
            [
                'name' => 'Sara Jo',
                'gender_id' => 2,
                'email' => 'sara@emial.com',
                'phone' => 06556235656,
                'description' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. الهدف من استخدام Lorem Ipsum هو أنه يحتوي على توزيع طبيعي للأحرف إلى حد ما',
                'testimonials_first' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. الهدف من استخدام Lorem Ipsum هو أنه يحتوي على توزيع طبيعي للأحرف إلى حد ما',
                'testimonials_second' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. الهدف من استخدام Lorem Ipsum هو أنه يحتوي على توزيع طبيعي للأحرف إلى حد ما',
            ],
            [
                'name' => 'Peter Peter',
                'gender_id' => 1,
                'email' => 'peter@emial.com',
                'phone' => 06556235656,
                'description' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. الهدف من استخدام Lorem Ipsum هو أنه يحتوي على توزيع طبيعي للأحرف إلى حد ما',
                'testimonials_first' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. الهدف من استخدام Lorem Ipsum هو أنه يحتوي على توزيع طبيعي للأحرف إلى حد ما',
                'testimonials_second' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. الهدف من استخدام Lorem Ipsum هو أنه يحتوي على توزيع طبيعي للأحرف إلى حد ما',
            ],
        ];
    }
}
