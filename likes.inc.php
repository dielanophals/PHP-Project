<div class="likes">
	<?php $like = Post::like($_SESSION['userID'], $s['id']); ?>

	<?php if ($like['active'] == 1): ?>
		<span data-id="<?php echo $s['id']; ?>" class="unlike like-btn fas fa-heart"></span>
		<span data-id="<?php echo $s['id']; ?>" class="like like-btn hide far fa-heart"></span>
	<?php endif; ?>

	<?php if ($like['active'] == 0): ?>
		<span data-id="<?php echo $s['id']; ?>" class="unlike like-btn hide fas fa-heart"></span>
		<span data-id="<?php echo $s['id']; ?>" class="like like-btn far fa-heart"></span>
	<?php endif; ?>

	<?php $likeCount = Post::likeCount($s['id']); ?>

	<!--No likes-->
	<?php if($likeCount == 0): ?>
		<a class="likes__users">
			<span class="likes-count">
				<?php echo $likeCount; ?> likes
			</span>
		</a>
	<?php endif; ?>

	<!--1 like-->
	<?php if($likeCount == 1 ): ?>
		<a class="likes__users">
			<span class="likes-count">
				<p><?php echo $likeCount; ?> likes</p>
			</span>
			<div class="likes__users--names">
				<?php $users = Post::getLikesOfPost($s['id']);?>
				<?php foreach($users as $user): ?>
					<p><?php echo $user; ?></p>
				<?php endforeach; ?>
			</div>
		</a>
	<?php endif; ?>

	<!--Multiple likes-->
	<?php if($likeCount > 1) : ?>
		<a class="likes__users">
			<span class="likes-count">
				<p><?php echo $likeCount; ?> likes</p>
			</span>
			<div class="likes__users--names">
				<?php $users = Post::getLikesOfPost($s['id']);?>
				<?php foreach($users as $user): ?>
					<p><?php echo $user; ?></p>
				<?php endforeach; ?>
			</div>
		</a>
	<?php endif; ?>
</div>