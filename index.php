<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8" />
	<title>好きな動物アンケート</title>
	<link rel="stylesheet" href="./css/reset.css">
	<link rel="stylesheet" href="./css/style.css" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New&display=swap" rel="stylesheet">
</head>

<body>
	<header class="main-page-header">
		<h1>🐾 ペットに関するアンケート</h1>
	</header>
	<form action="write.php" method="post" class="form-area">
		<div class="form-group">
			<label for="name">名前（ニックネーム）</label>
			<input type="text" id="name" name="name" required />
		</div>

		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" id="email" name="email" required />
		</div>
		<!-- === Q1.あなたが今飼っているペットの種類を教えて下さい。 === -->
		<div class="form-group">
			<label for="animal">Q1. あなたが今飼っているペットの種類を教えて下さい。</label>
			<select id="animal" name="animal" required>
				<option value="">選択してください</option>
				<option value="犬">犬</option>
				<option value="猫">猫</option>
				<option value="金魚・熱帯魚">金魚・熱帯魚</option>
				<option value="鳥">鳥</option>
				<option value="げっ歯類">げっ歯類</option>
				<option value="うさぎ">うさぎ</option>
				<option value="カメ">カメ</option>
				<option value="昆虫">昆虫</option>
				<option value="爬虫類">爬虫類</option>
				<option value="猛禽類">猛禽類</option>
				<option value="その他">その他</option>
				<option value="昔飼っていたが、今は飼っていない">昔飼っていたが、今は飼っていない</option>
			</select>
		</div>
		<!-- === Q2.ペットと暮らすことで、どのような良い変化を感じますか？ === -->
		<div class="form-group">
			<label for="good_change">Q2. ペットと暮らすことで、どのような良い変化を感じますか？</label>
			<select id="good_change" name="good_change" required>
				<option value="">選択してください</option>
				<option value="気持ちが癒された">気持ちが癒された</option>
				<option value="穏やかに過ごせる時間が増えた">穏やかに過ごせる時間が増えた</option>
				<option value="楽しい思い出が増えた">楽しい思い出が増えた</option>
				<option value="家族との会話が増えた">家族との会話が増えた</option>
				<option value="ストレスが緩和された">ストレスが緩和された</option>
				<option value="生活が楽しくなった">生活が楽しくなった</option>
				<option value="散歩などを通じて健康になった">散歩などを通じて健康になった</option>
				<option value="孤独を感じる機会が減った">孤独を感じる機会が減った</option>
				<option value="規則正しい生活をするようになった">規則正しい生活をするようになった</option>
				<option value="生きがいを感じる機会が増えた">生きがいを感じる機会が増えた</option>
				<option value="ペットを通じて友人や仲間が増えた">ペットを通じて友人や仲間が増えた</option>
				<option value="その他">その他</option>
			</select>
		</div>
		<!-- === Q3.何歳の時にペットをお迎えしましたか？ === -->
		<div class="form-group">
			<label for="age_adopted">Q3.何歳の時にペットをお迎えしましたか？</label>
			<select id="age_adopted" name="age_adopted" required>
				<option value="">選択してください</option>
				<option value="20歳以下">20歳以下</option>
				<option value="21歳〜30歳">21歳〜30歳</option>
				<option value="31歳〜40歳">31歳〜40歳</option>
				<option value="41歳〜50歳">41歳〜50歳</option>
				<option value="51歳〜60歳">51歳〜60歳</option>
				<option value="61歳〜65歳">61歳〜65歳</option>
				<option value="66歳〜70歳">66歳〜70歳</option>
				<option value="71歳〜75歳">71歳〜75歳</option>
				<option value="76歳〜80歳">76歳〜80歳</option>
				<option value="80歳以上">80歳以上</option>
			</select>
		</div>
		<!-- === Q4.ペットを飼っていて困ることはありますか？ === -->
		<div class="form-group">
			<label for="troubles">Q4.ペットを飼っていて困ることはありますか？</label>
			<select id="troubles" name="troubles" required>
				<option value="">選択してください</option>
				<option value="長く家を空けづらい">長く家を空けづらい</option>
				<option value="排泄物の始末">排泄物の始末</option>
				<option value="部屋が散らかる・汚れる">部屋が散らかる・汚れる</option>
				<option value="お金がかかる">お金がかかる</option>
				<option value="温度管理">温度管理</option>
				<option value="しつけ">しつけ</option>
				<option value="臭い">臭い</option>
				<option value="毎日の散歩">毎日の散歩</option>
				<option value="鳴き声が大きい">鳴き声が大きい</option>
				<option value="人を家に招きづらい">人を家に招きづらい</option>
				<option value="介護">介護</option>
				<option value="その他">その他</option>
				<option value="困っていることはない">困っていることはない</option>
			</select>
		</div>
		<button type="submit">送信する</button>
	</form>

	<p style="text-align: center"><a href="read.php">→ 結果を見る</a></p>
</body>

</html>