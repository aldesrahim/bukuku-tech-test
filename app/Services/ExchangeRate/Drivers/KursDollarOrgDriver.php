<?php

namespace App\Services\ExchangeRate\Drivers;

use App\Helper\DateTransformHelper;
use App\Helper\StringHelper;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class KursDollarOrgDriver extends BaseExchangeRateDriver
{
    protected string $url = 'https://kursdollar.org/';

    protected ?Crawler $content = null;

    public function getContent(): Crawler
    {
        if ($this->content !== null) {
            return $this->content;
        }

        $request = $this->httpClient->request('GET', $this->url);
        $response = $request
            ->filter('#container main div.row')->eq(1)
            ->filter('table.in_table')->first();

        return $this->content = $response;
    }

    public function getMeta(): array
    {
        $mainTitle = $this
            ->getContent()
            ->filter('tr')->first()
            ->filter('td')->first()
            ->innerText();

        $mainTitle = StringHelper::cleanHTML($mainTitle);
        $titleDate = Str::afterLast($mainTitle, '- ');
        $titleDate = DateTransformHelper::createFromIsoFormat('dddd, DD MMMM YYYY', $titleDate);

        $subTitleDOM = $this
            ->getContent()
            ->filter('tr')->eq(1);

        $subTitle = $subTitleDOM
            ->filter('td')->eq(1)
            ->text();

        $wordDOM = $subTitleDOM->filter('td')->eq(2);
        $word = "{$wordDOM->innerText()} {$wordDOM->filter('nobr')->innerText()}";

        return [
            'date' => $titleDate->format('d-m-Y'),
            'day' => DateTransformHelper::dayNameToEN($titleDate->dayName),
            'indonesia' => StringHelper::cleanHTML($subTitle),
            'word' => StringHelper::cleanHTML($word),
        ];
    }

    public function getRates(): array
    {
        $length = $this
            ->getContent()
            ->filter('tr')
            ->count();
        $start = 3;
        $end = $length - 2;
        $rates = [];

        $this
            ->getContent()
            ->filter('tr')
            ->each(function (Crawler $node, $i) use ($start, $end, &$rates) {
                if ($i >= $start && $i < $end) {
                    $rates[] = [
                        'currency' => StringHelper::getLettersOnly($node->filter('td')->eq(0)->text()),
                        'buy' => $this->cleanRateValue($node->filter('td')->eq(1)->text()),
                        'sell' => $this->cleanRateValue($node->filter('td')->eq(2)->text()),
                        'average' => $this->cleanRateValue($node->filter('td')->eq(3)->text()),
                        'word_rate' => $this->cleanRateValue($node->filter('td')->eq(4)->text()),
                    ];
                }
            });

        return $rates;
    }

    public function cleanRateValue($str): string
    {
        $str = StringHelper::cleanHTML($str);
        $str = preg_replace('/ \([^)]*\)/', '', $str);

        return StringHelper::unformatNumber($str);
    }
}
