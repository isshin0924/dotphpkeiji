<?php 
$dataFile = 'bbs.dat';

function h($s){
return htmlspecialchars($s,ENT_QUOTES,'utf-8');
}


if (!empty($_POST)) {
# code...
if ($_POST['message'] != '') {
	if ($_POST['user'] != '') {
		# code...

$message = $_POST['message'];
$user = $_POST['user'];
$postdate = date('Y-m-d H:i:s'); 
$message = str_replace("\t", ' ', $message);
$user = str_replace("\t", ' ', $user);

//↓の文でもし$userの中身が空だった場合NoNameを入れて
//入ってたら$userを入れる
$user = ($user === '') ? 'NoName' : $user;
$newData = $message . "\t" . $user . "\t" . $postdate . "\n";
$fp = fopen($dataFile,'a');
fwrite($fp,$newData);
fclose($fp);
}
}
//↓で配列を一つ一つとってきて
//FILE_IGNORE_NEW_LINESで配列の最後に来たら改行する
$post = file($dataFile,FILE_IGNORE_NEW_LINES);

$post = array_reverse($post);


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>簡易掲示板</title>
</head>
<body>
	<h1>keiji</h1>

	<form action="" method="post">
	message:<input type="text" name="message">
	user:<input type="text" name="user">
	<input type="submit" value="Post">
	</form>


	<h2>投稿一覧</h2>
	<ul>
	<?php if (!empty($_POST)): ?>
	<?php if (count($post)) :?>
		<?php foreach ($post as $posts):?>
			<?php list($message,$user,$postdate) = explode("\t",$posts); ?>
			<li><?php echo h($message); ?>-<?php echo h($user); ?>-<?php echo h($postdate); ?></li>
		<?php endforeach; ?>
	<?php else: ?>
		<li>not yet</li>
	<?php endif; ?>
<?php endif; ?>
	</ul>

</body>
</html>