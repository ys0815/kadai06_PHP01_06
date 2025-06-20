<?php
//write.phpで作った「data.csv」からデータを読み込んで、集計グラフをつくる

//file(はファイルの中身を1行ずつ配列として読み込む関数
//FILE_IGNORE_NEW_LINES＝各配列要素の末尾の改行をスキップする
$lines = file(__DIR__ . '/data/data.csv', FILE_IGNORE_NEW_LINES);

//各項目を保存するための変数を準備 それぞれの質問の集計に使う配列をあらかじめ用意！
$data = [];           // 全体のデータ保存用（後で表で表示）
$animalCount = [];    // Q1: 飼っている動物の種類ごとの件数を数える
$changeCount = [];    // Q2: 感じた良い変化の種類ごとの件数を数える
$ageCount = [];       // Q3: お迎え年齢ごとの件数を数える
$troubleCount = [];   // Q4: 困りごとの種類ごとの件数を数える

// CSVファイルの各行（1人分の回答）を順番に処理していくループ
foreach ($lines as $line) {
    // 空行だったらスキップ（無視）する
    if (trim($line) === '') continue;
    //explode(',', $line)＝データをカンマで区切って配列する
    [$name, $email, $animal, $change, $age, $trouble] = explode(',', $line);
    //compact() =変数を使用して配列にまとめて $data[] に追加
    $data[] = compact('name', 'email', 'animal', 'change', 'age', 'trouble');

    // 回答内容ごとの件数をカウントしていく
    // ?? 0) は、「まだ数えてなかったら0、すでに数えてたらその値」それに +1 して、投稿数を1つ増やしている
    $animalCount[$animal] = ($animalCount[$animal] ?? 0) + 1;
    $changeCount[$change] = ($changeCount[$change] ?? 0) + 1;
    $ageCount[$age] = ($ageCount[$age] ?? 0) + 1;
    $troubleCount[$trouble] = ($troubleCount[$trouble] ?? 0) + 1;
}
// 折れ線グラフで使いたい年齢ラベルを順番に定義
$ageLabels = [
    '20歳以下',
    '21歳〜30歳',
    '31歳〜40歳',
    '41歳〜50歳',
    '51歳〜60歳',
    '61歳〜65歳',
    '66歳〜70歳',
    '71歳〜75歳',
    '76歳〜80歳',
    '80歳以上'
];

// 折れ線グラフ用に、順番付きで年齢のカウント数を取り出す
// 上記の $ageLabels の順番に従って、グラフに並ぶように整形する
$ageChartData = [];
foreach ($ageLabels as $label) {
    // もしその年齢ラベルの回答がなかった場合は 0 件として扱う
    $ageChartData[$label] = $ageCount[$label] ?? 0;
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アンケート結果</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.1.2/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>

</head>

<body>

    <header class="main-page-header">
        <h1>🐾 アンケート集計結果</h1>
    </header>
    <div class="chart-grid">
        <!-- 「Chart.js」アンケート結果の表示に使用しました -->
        <!-- Q1：好きな動物（ドーナツ） -->
        <div class="chart-box">
            <canvas id="animalChart"></canvas>
        </div>

        <!-- Q2：良い変化（円） -->
        <div class="chart-box">
            <canvas id="changeChart"></canvas>
        </div>

        <!-- Q3：お迎え年齢（折れ線） -->
        <div class="chart-box">
            <canvas id="ageChart"></canvas>
        </div>

        <!-- Q4：困りごと（棒） -->
        <div class="chart-box">
            <canvas id="troubleChart"></canvas>
        </div>
    </div>
    <!-- 回答一覧表 -->
    <h2>📋 回答一覧</h2>
    <table>
        <tr>
            <th>名前</th>
            <th>好きな動物</th>
            <th>良い変化</th>
            <th>年齢</th>
            <th>困りごと</th>
        </tr>
        <?php foreach ($data as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['animal']) ?></td>
                <td><?= htmlspecialchars($row['change']) ?></td>
                <td><?= htmlspecialchars($row['age']) ?></td>
                <td><?= htmlspecialchars($row['trouble']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <script>
        // Chart.jsのプラグイン「ChartDataLabels」を使えるように登録
        Chart.register(ChartDataLabels);

        // Q1：好きな動物のドーナツチャート
        new Chart(document.getElementById('animalChart'), {
            type: 'doughnut', // グラフの種類：ドーナツ
            data: {
                // ラベルに使う動物の名前（猫、犬など）
                labels: <?= json_encode(array_keys($animalCount)) ?>,
                datasets: [{
                    // 各動物に対応する投稿数
                    data: <?= json_encode(array_values($animalCount)) ?>,
                    // 円の色を指定（色は順番に適用される）
                    backgroundColor: ['#f39c12', '#3498db', '#e74c3c', '#2ecc71', '#9b59b6', '#1abc9c', '#8e44ad', '#16a085', '#c0392b']
                }]
            },
            options: {
                responsive: true, // レスポンシブ対応（画面サイズに合わせて拡縮）
                plugins: {
                    datalabels: {
                        // 円グラフのラベルに「割合（%）」を表示
                        formatter: (value, context) => {
                            const total = context.chart._metasets[0].total;
                            const percentage = ((value / total) * 100).toFixed(1); // 小数点1桁
                            return `${percentage}%`;
                        },
                        color: '#000', // ラベルの色（黒）
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    },
                    title: {
                        display: true, // タイトルを表示
                        text: 'Q1. あなたが今飼っているペットの種類を教えて下さい。',
                        font: {
                            size: 18 // タイトルの文字サイズ
                        }
                    },
                    legend: {
                        position: 'bottom', // 凡例（ラベル）の位置を下に
                        labels: {
                            font: {
                                size: 14 // 凡例の文字サイズ
                            }
                        }
                    }
                }
            },
            plugins: [ChartDataLabels] // ラベル表示のプラグイン
        });

        // Q2：良い変化の円グラフ（pie）
        new Chart(document.getElementById('changeChart'), {
            type: 'pie', // 円グラフ
            data: {
                labels: <?= json_encode(array_keys($changeCount)) ?>,
                datasets: [{
                    data: <?= json_encode(array_values($changeCount)) ?>,
                    backgroundColor: ['#ffadad', '#ffd6a5', '#fdffb6', '#caffbf', '#9bf6ff', '#a0c4ff', '#bdb2ff', '#ffc6ff']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    datalabels: {
                        formatter: (value, context) => {
                            const total = context.chart._metasets[0].total;
                            const percentage = ((value / total) * 100).toFixed(1);
                            return `${percentage}%`;
                        },
                        color: '#000',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    },
                    title: {
                        display: true,
                        text: 'Q2. ペットと暮らすことで、どのような良い変化を感じますか？',
                        font: {
                            size: 18
                        }
                    },
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

        // Q3：お迎え年齢の折れ線グラフ（line）
        new Chart(document.getElementById('ageChart'), {
            type: 'line', // 折れ線グラフ
            data: {
                labels: <?= json_encode(array_keys($ageChartData)) ?>, // 年齢区分のラベル（横軸）
                datasets: [{
                    label: '人数', // 凡例ラベル
                    data: <?= json_encode(array_values($ageChartData)) ?>, // 各年齢の人数
                    borderColor: '#2980b9', // 線の色
                    backgroundColor: '#3498db', // データポイントの塗り色
                    tension: 0.2 // 線のなめらかさ（0で直線、1で曲線）
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Q3. 何歳の時にペットをお迎えしましたか？',
                        font: {
                            size: 18
                        }
                    },
                    legend: {
                        labels: {
                            font: {
                                size: 16
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true, // Y軸の開始を0にする
                        ticks: {
                            precision: 0 // 小数点を表示しない
                        }
                    }
                }
            }
        });

        // Q4：困りごとの棒グラフ（bar）
        new Chart(document.getElementById('troubleChart'), {
            type: 'bar', // 棒グラフ
            data: {
                labels: <?= json_encode(array_keys($troubleCount)) ?>, // 困りごとの種類
                datasets: [{
                    label: '回答数', // 凡例ラベル
                    data: <?= json_encode(array_values($troubleCount)) ?>, // 各項目の件数
                    backgroundColor: '#f39c12' // 棒の色
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Q4. ペットを飼っていて困ることはありますか？',
                        font: {
                            size: 18
                        }
                    },
                    legend: {
                        labels: {
                            font: {
                                size: 16
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true, // Y軸の開始を0に設定
                        ticks: {
                            precision: 0 // 小数点なしの整数表示
                        }
                    }
                }
            }
        });
    </script>

</body>

</html>