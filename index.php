<?php

/* 新しい imagick オブジェクトを作成します */
$im = new Imagick();


/* 新しい画像を作成して、これを塗りつぶしパターンとして使用します */
$im->newPseudoImage(50, 50, "gradient:red-black");

/* imagickdraw オブジェクトを作成します */
$draw = new ImagickDraw();

/* "gradient" という新しいパターンを開始します */
$draw->pushPattern('gradient', 0, 0, 50, 50);

/* パターン上のグラデーションを合成します */
$draw->composite(Imagick::COMPOSITE_OVER, 0, 0, 50, 50, $im);

/* パターンを閉じます */
$draw->popPattern();

/* "gradient" を塗りつぶしパターンとして指定します */
$draw->setFillPatternURL('#gradient');

/* フォントサイズを 52 に設定します */
$draw->setFontSize(52);

/* テキストを追加します */
$draw->annotation(20, 50, "Hello World!");

/* 新しいキャンバスオブジェクトと白い画像をを作成します */
$canvas = new Imagick();
$canvas->newImage(350, 70, "white");

/* ImagickDraw をキャンバス上に描画します */
$canvas->drawImage($draw);

/* 幅 1px の黒い枠線で画像の周りを囲みます */
$canvas->borderImage('black', 1, 1);

/* フォーマットを PNG に設定します */
$canvas->setImageFormat('png');

/* 画像を出力します */
header("Content-Type: image/png");
echo $canvas;
?>
