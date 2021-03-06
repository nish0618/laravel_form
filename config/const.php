<?php

return [

    // フォーム入力開始日時
    'START_FORM' => env('START_FORM'),

    // クーポン引き換え開始日時
    'START_GIFT_REDEMPTION' => env('START_GIFT_REDEMPTION'),

    // 性別
    'GENDER' => [
        1 => '男性',
        2 => '女性'
    ],

    // 年代
    'AGE' => [
        1 => '10代以下',
        2 => '20代',
        3 => '30代',
        4 => '40代',
        5 => '50代',
        6 => '60代',
        7 => '70代',
        8 => '80代以上',
    ],

    // 都道府県
    'PREFECTURE' => [
        '北海道',
        '青森県',
        '岩手県',
        '宮城県',
        '秋田県',
        '山形県',
        '福島県',
        '茨城県',
        '栃木県',
        '群馬県',
        '埼玉県',
        '千葉県',
        '東京都',
        '神奈川県',
        '新潟県',
        '富山県',
        '石川県',
        '福井県',
        '山梨県',
        '長野県',
        '岐阜県',
        '静岡県',
        '愛知県',
        '三重県',
        '滋賀県',
        '京都府',
        '大阪府',
        '兵庫県',
        '奈良県',
        '和歌山県',
        '鳥取県',
        '島根県',
        '岡山県',
        '広島県',
        '山口県',
        '徳島県',
        '香川県',
        '愛媛県',
        '高知県',
        '福岡県',
        '佐賀県',
        '長崎県',
        '熊本県',
        '大分県',
        '宮崎県',
        '鹿児島県',
        '沖縄県'
    ],

    // アンケートQ1回答
    'ANSWER_Q1' => [
        1 => 'PHP',
        2 => 'Ruby',
        3 => 'Python',
        4 => 'JavaScript',
        5 => 'Java',
        6 => 'C',
        7 => 'C++',
        8 => 'C#'
    ],

    // クーポン使用フラグ
    'COUPON_FLAG' => [
        0 => '未使用',
        1 => '使用済'
    ],
];
